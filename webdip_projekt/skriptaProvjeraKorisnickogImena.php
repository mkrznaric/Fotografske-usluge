<?php

include("baza.class.php");

$mySql = new Baza();
$mySql->spojiDB();
if (!empty($_POST)) {
    $korisnicko_ime = $_POST["korisnicko_ime"];
    $upit = $mySql->selectDB("Select id_korisnik from korisnik where korisnicko_ime='$korisnicko_ime';");
    if (mysqli_num_rows($upit) > 0) {
        echo "Korisnicko ime već postoji!";
        
    }
}
$mySql->zatvoriDB();

?>

