<?php
include ("sesija.class.php");

include './DnevnikRada.php';
include './Konfiguracija.php';
Sesija::kreirajSesiju();

$pogreske = "";
if (isset($_POST["registrirajse"])) {
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $korisnickoime = $_POST["korime"];

    if (preg_match("/(['\!?\#]+)/", $ime)) {
        $pogreske .= "Unijeli ste nedozvoljene znakove u polje ime!<br>";
    }
    if (preg_match("/(['\!?\#]+)/", $prezime)) {
        $pogreske .= "Unijeli ste nedozvoljene znakove u polje prezime!<br>";
    }

    if ($_POST["lozinka1"] !== $_POST["lozinka2"]) {
        $pogreske .= "Lozinke se ne poklapaju!<br>";
    }

    if (!preg_match("/([A-Z])\w*/", $ime)) {
        $pogreske .= "Ime mora započeti velikim slovom!<br>";
    }
    if (!preg_match("/([A-Z])\w*/", $prezime)) {
        $pogreske .= "Prezime mora započeti velikim slovom!<br>";
    }

    $baza = new Baza();
    $baza->spojiDB();
    $email = $_POST["email"];
    $upit = $baza->selectDB("Select id_korisnik from korisnik where email ='$email'; ");
    if (mysqli_num_rows($upit) > 0) {
        $pogreske .= "Već je registriran korisnik s unesenim e-mailom!";
    }

    if (empty($pogreske)) {
        
        $datum = VirtualnoVrijeme();
        $salt = "lsfhgksdbnxckhvs";
        $klozinka = $_POST["lozinka1"] . $salt;
        $klozinka = sha1($klozinka);
        $unos = "INSERT INTO korisnik  (id_korisnik, ime, prezime, korisnicko_ime, lozinka , kriptirana_lozinka , email ,datum_vrijme_registracije ,status , uloga_id_uloga) VALUES (NULL, '" . $ime . "', '" . $prezime . "', '" . $korisnickoime . "', '" . $_POST["lozinka1"] . "', '" . $klozinka . "', '" . $email . "', '" . $datum . "', '0','3')";
        $unosUbazu = $baza->selectDB($unos);

        $link = "http://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x077/aktivacija.php?korisnickoime=" . $korisnickoime . "&aktivacijskikod=" . $klozinka;
        $mail_to = $email;
        $mail_subject = "Fotografske usluge - aktivacija računa";
        $mail_body = $link;
        $mail_from = "fotografske_usluge@foi.hr";
        mail($mail_to, $mail_subject, $mail_body, $mail_from);
        
        $idKorisnik=0;
        
        $upit = "Select * from korisnik where korisnicko_ime ='".$korisnickoime."'";
        $korisnik = $baza->selectDB($upit);
        if (mysqli_num_rows($korisnik) > 0) {
            while ($row = $korisnik->fetch_assoc()) {
                $idKorisnik = $row["id_korisnik"];
        }
        }
        $aktivnost = "Uspjesna registracija";
        $datumiVrijeme = VirtualnoVrijeme();
        DnevnikRada::PopuniDnevnik($idKorisnik, $aktivnost, $datumiVrijeme);
    }


    $baza->zatvoriDB();
}
?>
<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija">
        <meta name="autor" content="Matej Krznarić">
        <meta name="kljucne" content="Registracija, Register, Registriraj se">
        <link href="css/mkrznaric.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_480.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_800.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1024.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1800.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="validacija_klijent.js"></script>
    </head>
    <body>
        <header>
            <h1 id="pocetak_registracija">Registracija</h1>
        </header>
        <nav>
            <ul class="nav">
                <li><a href="index.php">Početna stranica</a></li>
                <li><a href="oprema.php">Oprema</a></li>
                <li><a href="privatno/korisnici.php">Korisnici</a></li>
                <?php
                if (Sesija::dajKorisnika() == null) {
                    echo '<li><a href="prijava.php">Prijava</a></li>';
                    echo '<li><a href="registracija.php">Registracija</a></li>';
                } else if (Sesija::dajKorisnika() != null) {
                    if ($tip == "administrator") {
                        echo '<li><a href="odjava.php">Odjava</a></li>';
                        echo '<li><a href="dnevnik.php">Dnevnik aktivnosti</a></li>';
                        echo '<li><a href="VirtualTime.php">Virtualno vrijeme</a></li>';
                        echo '<li><a href="konfiguracija_sustava.php">Konfiguracija sustava</a></li>';
                        echo '<li><a href="otkljucavanje_blokiranje.php">Upravljanje korisnicima</a></li>';
                    }
                    if ($tip == "moderator") {
                        echo '<li><a href="odjava.php">Odjava</a></li>';
                    }
                    if ($tip == "registrirani_korisnik") {
                        echo '<li><a href="odjava.php">Odjava</a></li>';
                    }
                }
                ?>
            </ul>
        </nav>

        <section id="sadrzaj">
            <?php echo $pogreske; ?>
            <form id="registracija" method="POST" name="registracija" action="registracija.php" novalidate onsubmit="return recaptchaProvjera();">
                <table id="tablicaregistracija">
                    <tr>
                        <td>
                            <label class="labela" for="ime">Ime: </label>
                        </td>
                        <td>
                            <input type="text" id="ime" name="ime" autofocus="autofocus" size="20" maxlength="25" placeholder="Ime" required="required"><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id='pogreskaIme'></div></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="labela" for="prezime">Prezime: </label>
                        </td>
                        <td>
                            <input type="text" id="prezime" name="prezime" size="20" maxlength="40" placeholder="Prezime" required="required"><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id='pogreskaPrezime'></div></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="labela" for="korime">Korisničko ime: </label>
                        </td>
                        <td>
                            <input type="text" id="korime" name="korime" size="20" maxlength="20" placeholder="korisničko ime" required="required" onblur="ProvjeraKorisnickogImena(this.value)"><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id='pogreskaKorisnickoIme'></div></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id='pogreskaKorisnickoIme1'></div></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="labela" for="email">Email adresa: </label>
                        </td>
                        <td>
                            <input type="email" id="email" name="email" size="20" maxlength="35" placeholder="ime.prezime@posluzitelj.xxx" required="required"><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id='pogreskaEmail'></div></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="labela" for="lozinka1">Lozinka: </label>
                        </td>
                        <td>
                            <input type="password" id="lozinka1" name="lozinka1" size="20" maxlength="15" placeholder="lozinka" required="required"><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id='pogreskaLozinka1'></div></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="labela" for="lozinka2">Potvrda pozinke: </label>
                        </td>
                        <td>
                            <input type="password" id="lozinka2" name="lozinka2" size="20" maxlength="15" placeholder="lozinka" required="required"><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id='pogreskaLozinka2'></div></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="g-recaptcha" data-sitekey="6LeCBKgUAAAAAB-YPK8SV21C--8A5aCEpa5EBxuH"></div>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" id="registrirajse" name="registrirajse"  value="Registriraj">
                        </td>
                        <td>

                        </td>
                    </tr>
                </table>
                <br>



            </form>

        </section>

        <footer id="kraj">
            <p>&copy; 2019 Matej Krznarić</p>
            <address><strong>Kontakt:</strong> <a href="mailto:mkrznaric@foi.hr">Matej Krznarić</a></address>
            <br>

        </footer>
    </body>
</html>

<script>
    function ProvjeraKorisnickogImena(val) {
        $.ajax({
            url: "skriptaProvjeraKorisnickogImena.php",
            data: 'korisnicko_ime=' + val,
            type: "POST",
            success: function (data) {
                $("#pogreskaKorisnickoIme").html(data);
                $("#registrirajse").attr("disabled", true);
                document.getElementById("pogreskaKorisnickoIme").style.color = "red";
            }
        });
    }
</script>

<script type="text/javascript">
    function recaptchaProvjera() {
        if (grecaptcha.getResponse() === "") {
            alert("Captcha validacija neuspješna!");
            return false;
        } else {
            return true;
        }
    }
</script>

