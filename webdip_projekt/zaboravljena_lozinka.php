<?php
include ("sesija.class.php");
include ("./DnevnikRada.php");
include './Konfiguracija.php';
Sesija::kreirajSesiju();

function NovaLozinka() {
    $velicina = DuljinaNoveLozinke();
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $velicina);
}

if (isset($_POST["posaljiZaboravljenu"])) {
    $baza = new Baza();
    $baza->spojiDB();
    $email = $_POST["email"];
    $novaLozinka = NovaLozinka();

    $salt = "lsfhgksdbnxckhvs";
    $klozinka = $novaLozinka . $salt;
    $klozinka = sha1($klozinka);

    $upit = "update korisnik set lozinka ='$novaLozinka', kriptirana_lozinka='$klozinka' where email='$email'";
    $promjena = $baza->selectDB($upit);
    if (!empty($promjena)) {
        $subject = "Fotografske usluge - zaboravljena lozinka";
        $sadrzaj = "Nova lozinka je : " . $novaLozinka;
        $sender = "Fotografske usluge";
        $idKorisnik = 0;

        $upit = "Select * from korisnik where email ='" . $email . "'";
        $korisnik = $baza->selectDB($upit);
        if (mysqli_num_rows($korisnik) > 0) {
            while ($row = $korisnik->fetch_assoc()) {
                $idKorisnik = $row["id_korisnik"];
            }
        }
        mail($email, $subject, $sadrzaj, $sender);
        $datumiVrijeme = VirtualnoVrijeme();
        $aktivnost = "Zahtjev za novom lozinkom";
        DnevnikRada::PopuniDnevnik($idKorisnik, $aktivnost, $datumiVrijeme);
        Header('Location:index.php');
    }
    $bazaPodataka->zatvoriDB();
}
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Zaboravljena lozinka</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Zaboravljena lozinka">
        <meta name="autor" content="Matej Krznarić">
        <meta name="kljucne" content="Zaboravljena lozinka">
        <link href="css/mkrznaric.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_480.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_800.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1024.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1800.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1 id="pocetak_prijava">Zaboravljena lozinka</h1>
        </header>
        <nav>
            <ul class="nav">
                <li><a href="index.php">Početna stranica</a></li>
                <?php
                if (Sesija::dajKorisnika() == null) {
                    echo '<li><a href="prijava.php">Prijava</a></li>';
                    echo '<li><a href="registracija.php">Registracija</a></li>';
                } else if (Sesija::dajKorisnika() != null) {
                    if ($tipKorisnika = 1) {
                        echo '<li><a href="odjava.php">Odjava</a></li>';
                    }
                }
                ?>
            </ul>
        </nav><br>

        <section id="sadrzaj">
            <form id="prijava" novalidate method="post" name="zaboravljenaLozinka" action="zaboravljena_lozinka.php">
                <table id="tablicaprijava">
                    <tr>
                        <td>
                            <label for="email">E-mail: </label>

                        </td>
                        <td>
                            <input type="text" id="email" name="email" size="20" maxlength="50" placeholder="email" autofocus="autofocus" required="required"><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit"  name="posaljiZaboravljenu" id="posaljiZaboravljenu" value=" Pošalji">
                        </td>
                    </tr>

                </table>
                <br>
            </form>
            <br>
            <br>
            <br>
            <br>
            <br>
        </section>

        <footer id="kraj">
            <p>&copy; 2019 Matej Krznarić, Datum posljednje izmjene: 24.03.2019.</p>
            <address><strong>Kontakt:</strong> <a href="mailto:mkrznaric@foi.hr">Matej Krznarić</a></address>
        </footer>
    </body>
</html>

