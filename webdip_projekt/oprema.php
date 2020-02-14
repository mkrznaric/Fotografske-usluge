<?php
include ("baza.class.php");
include("sesija.class.php");

Sesija::kreirajSesiju();

if(Sesija::dajKorisnika()!= null){
    $tip = $_SESSION["tip"];
    $korisnickoIme = $_SESSION["korisnik"];
}
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Oprema</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Oprema">
        <meta name="autor" content="Matej Krznarić">
        <meta name="kljucne" content="Multimedija, Golovi, Sport">
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
            <h1 id="pocetak_multimedija">Oprema</h1>
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

        <section id="sadrzaj">
            <form id="pretraga_oprema" novalidate method="post" name="pretraga_oprema" action="">
                <br>
                <br>

                <input type="text" id="vrijednostPretrazi" name="vrijednostPretrazi" placeholder="Pretraži">

                <br>
                <br>

                <select name="combo" id="combo">
                    <option disabled selected value>Odaberi Lokaciju</option>
                    <?php
                    $upit1 = "SELECT id_lokacija,naziv FROM lokacija";
                    $baza = new Baza();
                    $baza->spojiDB();
                    $rs = $baza->selectDB($upit1);
                    while (list($id,$naziv) = mysqli_fetch_array($rs)) {
                        echo "<option  value=" . $id . ">" . $naziv . "</option>";
                    }
                    $baza->zatvoriDB();
                    ?>

                </select>

                
                <button  name="pretrazi" id="pretrazi" >Pretrazi</button><br>
                <br><br>
                <br>
                <div id='popisOpreme' name='popisOpreme'></div>
                
                <br><br>
                <div id='detalji' name='detalji'></div>
            </form>
        </section>
            
            <section>
<!--            <table class="popis">
                <tr>
                    <th class="zaglavlje">Naziv opreme</th>
                    <th class="zaglavlje">Lokacija</th>
                </tr>-->
                <?php
                
                /*if (!isset($_GET["pretrazi"]) && !isset($_GET["combo"])) {
                    $upit2 = "SELECT naziv,(SELECT naziv FROM lokacija WHERE id_lokacija = oprema.lokacija_id_lokacija) as Lokacija FROM oprema";
                    $baza = new Baza();
                    $baza->spojiDB();
                    $rs = $baza->selectDB($upit2);
                    while (list($naziv_opreme, $lokacija) = mysqli_fetch_array($rs)) {
                        echo "<tr>\n<td><a href=oprema.php?naziv=$naziv_opreme>$naziv_opreme</a></td>\n<td><a href=lokacija.php?id_lokacija=$lokacija>$lokacija</a></td>\n</tr>\n";
                    }
                    $baza->zatvoriDB();
                } else if(isset($_GET["pretrazi"]) && isset($_GET["vrijednostPretrazi"])){
                    $vrijednost=$_GET["vrijednostPretrazi"];
                    $upit3 = "SELECT naziv,(SELECT naziv FROM lokacija WHERE id_lokacija = oprema.lokacija_id_lokacija) FROM oprema WHERE naziv LIKE '%".$vrijednost."%'";
                    $baza = new Baza();
                    $baza->spojiDB();
                    $rs = $baza->selectDB($upit3);
                    while (list($naziv_opreme, $lokacija) = mysqli_fetch_array($rs)) {
                        echo "<tr>\n<td><a href=oprema.php?naziv=$naziv_opreme>$naziv_opreme</a></td>\n<td><a href=lokacija.php?id_lokacija=$lokacija>$lokacija</a></td>\n</tr>\n";
                    }
                    
                    $baza->zatvoriDB();
                }
                else if(isset($_GET["pretrazi"]) && !empty($_GET["combo"])){
                    $vrijednostCombo=$_GET["combo"];
                    $upit4 = "SELECT naziv,(SELECT naziv FROM lokacija WHERE id_lokacija = oprema.lokacija_id_lokacija) AS lokacijaa FROM oprema WHERE id_oprema LIKE '".$vrijednostCombo."'";
                    $baza = new Baza();
                    $baza->spojiDB();
                    $rs = $baza->selectDB($upit4);
                    while (list($naziv_opreme, $lokacija) = mysqli_fetch_array($rs)) {
                        echo "<tr>\n<td><a href=oprema.php?naziv=$naziv_opreme>$naziv_opreme</a></td>\n<td><a href=lokacija.php?id_lokacija=$lokacija>$lokacija</a></td>\n</tr>\n";
                    }
                    
                    $baza->zatvoriDB();
                }
                
              */  ?>

            <!--</table>-->
            <br>
            <br>
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

