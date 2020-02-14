<?php

include ("sesija.class.php");
include './Konfiguracija.php';

Sesija::kreirajSesiju();

if (Sesija::dajKorisnika() != null) {
    $tip = $_SESSION["tip"];
    $korisnickoIme = $_SESSION["korisnik"];
}
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Nova lokacija</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> 
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="jquery/mkrznaric_jquery.js" type="text/javascript"></script>
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
        </nav><br>

        <section id="sadrzaj">
            <form id="novaLokacija" novalidate method="post" name="newlocation" action="">
                <table id="tablicaprijava">
                    
                    <tr>
                        <td>
                            <label for="nazivLokacije">Naziv lokacije: </label>

                        </td>
                        <td>
                            <input type="text"  id="nazivLokacije" name="nazivLokacije" required="required" placeholder="Unesite naziv lokacije" >
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="zupanija">Naziv županije </label>

                        </td>
                        <td>
                            <input type="text"  id="zupanija" name="zupanija" required="required" placeholder="Unesite naziv zupanije" >
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="Dodatneinformacije"> Dodatne informacije:</label>

                        </td>
                        <td>
                            <textarea rows="4" cols="50" name="dodatneInformacije" id="dodatneInformacije"></textarea>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="dodajnovulokacijuubazu" id="dodajnovulokacijuubazu" value="Unesi novu lokaciju u bazu">
                                
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



