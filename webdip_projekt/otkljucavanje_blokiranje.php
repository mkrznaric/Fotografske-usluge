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
            <form id="promjenaStatusaKorisnika" novalidate method="post" name="promjenaStatusaKorisnika" action="otkljucavanje_blokiranje.php">
                <br>
                <br>
<?php

           
               
                $baza = new Baza();
                $baza->spojiDB();
                if (isset($_GET['order'])) {
                    $order = $_GET['order'];
                } else {
                    $order = 'status';
                }

                if (isset($_GET['sort'])) {
                    $sort = $_GET['sort'];
                } else {
                    $sort = 'ASC';
                }
                $upit = "SELECT *from korisnik ORDER BY $order $sort";

                $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';




                $rs = $baza->selectDB($upit);

                echo"<table id ='table_id'  class='display'>
    <thead>
                <tr>
                    <th class='zaglavlje'>Korisničko ime</th>
                    <th class='zaglavlje'><a href='?order=datum_vrijme_registracije&&sort=$sort'>Datum registracije</a></th>
                    <th class='zaglavlje'><a href='?order=status&&sort=$sort'>Status</a></th>
                        <th>Odabrani Korisnik</th>
                </tr>
                </thead>
                <tbody>";

                
                while ($row=$rs->fetch_assoc()) {
                    $naziv=$row['korisnicko_ime'];
                    $datum_vrijeme=$row['datum_vrijme_registracije'];
                    $status=$row['status'];
                    $id=$row['id_korisnik'];
                    echo "<tr>\n<td>$naziv</td>\n<td>$datum_vrijeme</td>\n<td>$status</td><td><input type='radio' name='radiobutton' value='".$id."'></td></tr>";
                }
                $baza->zatvoriDB();


                echo"</tbody></table>";
                
            ?>
                
                <input  type="submit" name="promijeni" id="promijeniUseruStatus" value="Promijeni">
                
              
                <br>
                <br>
             
                <br><br>
                <br>
            </form>
            <br>
            
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

