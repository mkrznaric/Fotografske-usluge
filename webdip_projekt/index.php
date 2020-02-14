<?php
include ("sesija.class.php");
include './Konfiguracija.php';
Sesija::kreirajSesiju();

if (Sesija::dajKorisnika() != null) {
    $tip = $_SESSION["tip"];
    $korisnickoIme = $_SESSION["korisnik"];
}

if (!isset($_COOKIE['prvi_dolazak'])) {
    $pocetak = VirtualnoVrijeme();
    $trajanje = TrajanjeKolacicaUvjeta();
    setcookie('prvi_dolazak', 'Prihvaćeni uvjeti koristenja', strtotime($pocetak) + 3600 * $trajanje);
    echo "<script>alert('Ova stranica sprema i koristi kolačiće.')</script>";
}
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Fotografske usluge</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Početna stranica">
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
            <h1 id="pocetak">Fotografske usluge</h1>
        </header>
        <nav>
            <ul class="nav">
                <li><a href="index.php">Početna stranica</a></li>
                <li><a href="o_autoru.html">O autoru</a></li>
                <li><a href="dokumentacija.html">Dokumentacija</a></li>
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

        <section id="sadrzaj">
            <h1 id="pocetak">Dobro došli na stranicu Fotografskih usluga!</h1>
            <img class="fotografija_pocetna" src="multimedija/vjencanje.jpg" alt="Vjencanje" height="600px" width="1000px">
            <br>
            <br>
            <div class="usluge">

                <h1>Neke od usluga koje nudimo:</h1>
                <ul>
                    <li>
                        <h2>Kreiranje zahtjeva za uslugom slikanja na lokaciji</h2>
                    </li>
                </ul>
                <ul>
                    <li>
                        <h2>Pregledavanje slika i opreme</h2> 
                    </li>
                </ul>
                <ul>
                    <li>
                        <h2>Pregledavanje lokacija</h2>
                    </li>
                </ul>
            </div>
            <br>
            <br>
            <br>
        </section>

        <footer id="kraj">
            <p>&copy; 2019 Matej Krznarić</p>
            <address><strong>Kontakt:</strong> <a href="mailto:mkrznaric@foi.hr">Matej Krznarić</a></address>
            <br>

        </footer>
    </body>
</html>


