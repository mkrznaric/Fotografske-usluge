<?php
include ("./baza.class.php");
include("./sesija.class.php");

Sesija::kreirajSesiju();

if (Sesija::dajKorisnika() != null) {
    $tip = $_SESSION["tip"];
    $korisnickoIme = $_SESSION["korisnik"];
}
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Dnevnik aktivnosti</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Popis">
        <meta name="autor" content="Matej Krznarić">
        <meta name="kljucne" content="Dnevnik">
        <link href="css/mkrznaric.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_480.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_ispis.css" media="print" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_800.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1024.css" rel="stylesheet" type="text/css">
        <link href="css/mkrznaric_1800.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
        <script src="jquery/mkrznaric_jquery.js" type="text/javascript"></script>

    </head>
    <body>
        <header>
            <h1 id="pocetak_popis">Dnevnik aktivnosti</h1>
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

        <section id="sadrzajtablica">
            <br>
            <form id="pretraga_dnevnik" novalidate method="post" name="pretraga_dnevnik" action="">
                <br>
                <br>

                <input type="text" id="vrijednostPretraga" name="vrijednostPretraga" placeholder="Pretraži">

                <br>
                <br>
                <button  name="pretraga" id="pretraga" >Pretrazi</button><br>
                <br><br>
                <br>
            </form>
            <br>
            <?php
            if (!isset($_POST["pretraga"]) && !isset($_POST["vrijednostPretraga"])) {
                $baza = new Baza();
                $baza->spojiDB();
                if (isset($_GET['order'])) {
                    $order = $_GET['order'];
                } else {
                    $order = 'korisnik_id_korisnik';
                }

                if (isset($_GET['sort'])) {
                    $sort = $_GET['sort'];
                } else {
                    $sort = 'ASC';
                }
                $upit = "SELECT aktivnost, datum_vrijeme, (SELECT korisnicko_ime FROM korisnik WHERE id_korisnik = dnevnik_aktivnosti.korisnik_id_korisnik) FROM dnevnik_aktivnosti ORDER BY $order $sort";

                $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';




                $rs = $baza->selectDB($upit);

                echo"<table id ='table_id'  class='display'>
    <thead>
                <tr>
                    <th class='zaglavlje'>Aktivnost</th>
                    <th class='zaglavlje'><a href='?order=datum_vrijeme&&sort=$sort'>Datum</a></th>
                    <th class='zaglavlje'><a href='?order=korisnik_id_korisnik&&sort=$sort'>Uloga</a></th>
                </tr></thead><tbody>";


                while (list($aktivnost, $datum_vrijeme, $uloga) = mysqli_fetch_array($rs)) {
                    echo "<tr>\n<td>$aktivnost</td>\n<td>$datum_vrijeme</td>\n<td>$uloga</td></tr>\n";
                }
                $baza->zatvoriDB();
            }

            echo"</tbody></table>";

            if (isset($_POST["pretraga"]) && isset($_POST["vrijednostPretraga"])) {
                $vrijednost = $_POST["vrijednostPretraga"];
                $baza = new Baza();
                $baza->spojiDB();
                if (isset($_GET['order'])) {
                    $order = $_GET['order'];
                } else {
                    $order = 'korisnik_id_korisnik';
                }

                if (isset($_GET['sort'])) {
                    $sort = $_GET['sort'];
                } else {
                    $sort = 'ASC';
                }
                $upit = "SELECT aktivnost, datum_vrijeme, (SELECT korisnicko_ime FROM korisnik WHERE id_korisnik = dnevnik_aktivnosti.korisnik_id_korisnik) as pomocna FROM dnevnik_aktivnosti WHERE aktivnost LIKE '%" . $vrijednost . "%' OR datum_vrijeme LIKE '%" . $vrijednost . "'OR (SELECT korisnicko_ime FROM korisnik WHERE id_korisnik = dnevnik_aktivnosti.korisnik_id_korisnik) LIKE '%" . $vrijednost . "%'  ORDER BY $order $sort";

                $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';




                $rs = $baza->selectDB($upit);

                echo"<table id ='table_id'  class='display'>
    <thead>
                <tr>
                    <th class='zaglavlje'>Aktivnost</th>
                    <th class='zaglavlje'><a href='?order=datum_vrijeme&&sort=$sort'>Datum</a></th>
                    <th class='zaglavlje'><a href='?order=korisnik_id_korisnik&&sort=$sort'>Uloga</a></th>
                </tr>
                </thead>
                <tbody>";


                while (list($aktivnost, $datum_vrijeme, $uloga) = mysqli_fetch_array($rs)) {
                    echo "<tr>\n<td>$aktivnost</td>\n<td>$datum_vrijeme</td>\n<td>$uloga</td></tr>";
                }
                $baza->zatvoriDB();


                echo"</tbody></table>";
            }
            ?>
            <br>
            <br>
            <br>
        </section>

        <footer id="kraj">
            <p>&copy; 2019 Matej Krznarić</p>
            <address><strong>Kontakt:</strong> <a href="mailto:mkrznaric@foi.hr">Matej Krznarić</a></address>
            <br>
            <br>
        </footer>
    </body>
</html>
