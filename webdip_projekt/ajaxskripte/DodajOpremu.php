<?php

include '../baza.class.php';
include '../sesija.class.php';
Sesija::kreirajSesiju();
$id=$_SESSION['id'];
$veza = new Baza();
$veza->spojiDB();
$naziv = $_POST['naziv'];
$detalji = $_POST['opis'];
$lokacijaID=$_POST['lokacijaID'];
$upit = "INSERT INTO `oprema` (`id_oprema`, `naziv`, `dostupnost`, `zahtjev_za_najam_opreme_id_zahtjev_za_najam_opreme`, "
        . "`korisnik_id_korisnik`, `lokacija_id_lokacija`, `slika_id_slika`, `opis`) VALUES (NULL, '".$naziv."', '0', '1', '1','".$lokacijaID."', '1', '".$detalji."')";
$veza->updateDB($upit);

$trenutno=time();
$pom="Select pomak_sati from konfiguracija";
$rezultat=$veza->selectDB($pom);
$pomak=$rezultat->fetch_assoc();
$virtualTime= $trenutno+ ($pomak['pomak_sati']*3600);
$datumiVrijeme= date("Y-m-d H:i:s", $virtualTime);

$aktivnost="Unos nove opreme u bazu.";
$sql = "INSERT INTO `dnevnik_aktivnosti` (`id_dnevnik_aktivnosti`, `aktivnost`, `datum_vrijeme`, `korisnik_id_korisnik`) VALUES (NULL, '" . $aktivnost . "','" . $datumiVrijeme . "','" .  $id . "')";
$veza->updateDB($sql);



$veza->zatvoriDB();

echo 'Dodali ste novu opremu u bazu';
