<?php
require_once '../baza.class.php';
include '../sesija.class.php';

Sesija::kreirajSesiju();
$veza= new Baza();
$veza->spojiDB();
$naziv=$_POST['naziv'];
$zupanija=$_POST['zupanija'];
$opis=$_POST['info'];

$korisnikID;

$sql="Insert into lokacija values(NULL,'".$naziv."','".$zupanija."','".$opis."','1')";
$veza->updateDB($sql);
$korisnikID=$_SESSION['id'];

$pom="Select pomak_sati from konfiguracija";
$rezultat=$veza->selectDB($pom);
$pomak=$rezultat->fetch_assoc();
$trenutno=time();
$virtualTime= $trenutno+ ($pomak['pomak_sati']*3600);
$datumiVrijeme= date("Y-m-d H:i:s", $virtualTime);
$aktivnost="Unos nove  lokacije u bazu.";
$sql = "INSERT INTO `dnevnik_aktivnosti` (`id_dnevnik_aktivnosti`, `aktivnost`, `datum_vrijeme`, `korisnik_id_korisnik`) VALUES (NULL, '" . $aktivnost . "','" . $datumiVrijeme . "','" .$korisnikID. "')";
$veza->updateDB($sql);

$veza->zatvoriDB();
echo "Uspjesno ste unijeli novu lokaciju !";



