<?php
$url = $_SERVER["REQUEST_URI"];
$strrpos = strrpos($url, "/");
$dir = $_SERVER["SERVER_NAME"] . substr($url, 0, $strrpos + 1);
if (!isset($_SERVER["HTTPS"]) || strtolower($_SERVER["HTTPS"]) != "on") {
    $adresa = 'https://' . $dir . 'prijava.php';
    header("Location: $adresa");
    exit();
}


include ("sesija.class.php");
include './DnevnikRada.php';
include './Konfiguracija.php';
Sesija::kreirajSesiju();


$baza = new Baza();
$baza->spojiDB();

//$korsnickoIme = $_POST["korimePrijava"];
//$lozinka = $_POST["lozinkaPrijava"];

$pogreska_zakljucan = "";
$pogreska = "";
$prijavaKolacic = '';
$provjeraKolacic = 0;
$idUloge = 0;
$idKorisnika = 0;

if (isset($_COOKIE['Prijava'])) {
    $prijavaKolacic = $_COOKIE['Prijava'];
    $provjeraKolacic = 1;
}

if (Sesija::dajKorisnika() == null) {
    if (isset($_POST["prijavise"])) {
        $korisnickoIme = $_POST["korimePrijava"];
        $lozinka = $_POST["lozinkaPrijava"];

        $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $korisnickoIme . "' AND lozinka = '" . $lozinka . "' AND status = '1'";
        $korisnik = $baza->selectDB($upit);
        if (mysqli_num_rows($korisnik) > 0) {
            while ($row = $korisnik->fetch_assoc()) {
                $idUloge = $row["uloga_id_uloga"];
                $idKorisnika = $row['id_korisnik'];
            }
            if ($idUloge == '1') {
                $tip = "administrator";
            }
            if ($idUloge == '2') {
                $tip = "moderator";
            }
            if ($idUloge == '3') {
                $tip = "registrirani_korisnik";
            }

            Sesija::kreirajKorisnika($korisnickoIme, $tip, $idKorisnika);
            
            $vrijeme_isteka =  strtotime(VirtualnoVrijeme()+TrajanjeKolacicaPrijave()*3600);
            setcookie('Prijava', $korisnickoIme, $vrijeme_isteka);
            $aktivnost = "Uspjesna prijava";
            $datumiVrijeme = VirtualnoVrijeme();
            DnevnikRada::PopuniDnevnik($idKorisnika, $aktivnost, $datumiVrijeme);
            Header('Location:index.php');
        } else {
            $korisnickoIme = $_POST["korimePrijava"];
            $lozinka = $_POST["lozinkaPrijava"];


            $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $korisnickoIme . "'";
            $brojPokusaja = BrojPokusaja();
            $korisnici = $baza->selectDB($upit);
            if (mysqli_num_rows($korisnici) > 0) {
                while ($row = $korisnici->fetch_assoc()) {
                    $neuspjesnaPrijava = $row["neuspjesnih_prijava"];
                    $idKorisnika = $row['id_korisnik'];
                }
                $neuspjesnaPrijava++;

                if ($neuspjesnaPrijava == $brojPokusaja) {
                    $upit = "UPDATE korisnik SET neuspjesnih_prijava = '3', status = '0' WHERE korisnicko_ime = '" . $korisnickoIme . "'";
                    $promijeni = $baza->selectDB($upit);
                    $pogreska_zakljucan = "Previše neuspješnih prijava!";

                    $aktivnost = "Blokiran racun";
                    $datumiVrijeme = VirtualnoVrijeme();
                    DnevnikRada::PopuniDnevnik($idKorisnika, $aktivnost, $datumiVrijeme);
                } else {
                    $upit = "UPDATE korisnik SET neuspjesnih_prijava = '" . $neuspjesnaPrijava . "' WHERE korisnicko_ime = '" . $korisnickoIme . "'";
                    $promijeni = $baza->selectDB($upit);
                    $pogreska = "Netočno korisničko ime ili lozinka!";
                     $aktivnost = "Neuspjesna prijava";
                    $datumiVrijeme = VirtualnoVrijeme();
                    DnevnikRada::PopuniDnevnik($idKorisnika, $aktivnost, $datumiVrijeme);
                }
               
            }
        }
    }
    $baza->zatvoriDB();
}
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Prijava">
        <meta name="autor" content="Matej Krznarić">
        <meta name="kljucne" content="Prijava, Login, Prijavi se">
        <link href="css/mkrznaric.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_480.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_800.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1024.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1800.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1 id="pocetak_prijava">Prijava</h1>
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
        </nav><br>

        <section id="sadrzaj">
            <form id="prijava" novalidate method="post" name="prijava" action="prijava.php">
                <table id="tablicaprijava">
                    <tr>
                        <td>
                            <label for="korime">Korisničko ime: </label>

                        </td>
                        <td>
                            <input type="text" id="korimePrijava" name="korimePrijava" size="20" maxlength="20" placeholder="korisničko ime" autofocus="autofocus" required="required" <?php
                if (isset($_COOKIE['Prijava'])) {
                    echo "value='" . $_COOKIE['Prijava'] . "'";
                }
                ?>><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="lozinka">Lozinka: </label>

                        </td>
                        <td>
                            <input type="password" id="lozinkaPrijava" name="lozinkaPrijava" size="20" maxlength="20" placeholder="lozinka" required="required"><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><a href="zaboravljena_lozinka.php">Zaboravili ste lozinku?</a><br></td>
                    </tr>
                    <tr style="color:red">
                        <td colspan="2"> <?php
                            echo $pogreska_zakljucan;
                            echo $pogreska;
                ?> <br></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit"  name="prijavise" id="prijavise" value=" Prijavi">
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
            <p>&copy; 2019 Matej Krznarić</p>
            <address><strong>Kontakt:</strong> <a href="mailto:mkrznaric@foi.hr">Matej Krznarić</a></address>
        </footer>
    </body>
</html>


