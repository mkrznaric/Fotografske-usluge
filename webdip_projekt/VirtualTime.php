<?php
include ("sesija.class.php");
include './Konfiguracija.php';
Sesija::kreirajSesiju();

if (Sesija::dajKorisnika() != null) {
    $tip = $_SESSION["tip"];
    $korisnickoIme = $_SESSION["korisnik"];
}

$pom= file_get_contents('http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json');
$decodeJSON= json_decode($pom,true);
$brojsati=$decodeJSON['WebDiP']['vrijeme']['pomak']['brojSati'];
$veza= new Baza();
$veza->spojiDB();
$upit = "UPDATE konfiguracija SET pomak_sati ='$brojsati' WHERE id_konfiguracija = 1;";
$veza->updateDB($upit);

$veza->zatvoriDB();


?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Virtualno vrijeme</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Virtualno vrijeme">
        <meta name="autor" content="Matej Krznarić">
        <meta name="kljucne" content="Početna stranica, Nogomet, Sport">
        <link href="css/mkrznaric.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_480.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_800.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1024.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1800.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="kolacic_uvjeti_koristenja.js"></script>
    </head>
    <body>

        <header>
            <h1 id="pocetak">Virtualno vrijeme</h1>
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
                        echo '<li><a href="DodijeliModeratora.php">Dodijela moderatora</a></li>';
                        echo '<li><a href="NovaLokacija.php">Nova lokacija</a></li>';
                        echo '<li><a href="NovaOprema.php">Nova oprema</a></li>';
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

        <section>
            <a href=" http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html"> <input name="virtualnoVrijeme" type="submit" value="dohvati_vrijeme" id="virtualnoVrijeme"></a>
        </section>

        <footer id="kraj">
            <p>&copy; 2019 Matej Krznarić</p>
            <address><strong>Kontakt:</strong> <a href="mailto:mkrznaric@foi.hr">Matej Krznarić</a></address>
            <br>

        </footer>
    </body>
</html>