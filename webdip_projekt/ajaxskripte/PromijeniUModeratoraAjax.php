<?php
include '../baza.class.php';
include '../sesija.class.php';
Sesija::kreirajSesiju();
$baza= new Baza();
$baza->spojiDB();
$id=$_POST['id'];
$upit="Update korisnik set uloga_id_uloga='2' where id_korisnik='".$id."'";
$baza->updateDB($upit);

$trenutno=time();
$pom="Select pomak_sati from konfiguracija";
$rezultat=$baza->selectDB($pom);
$pomak=$rezultat->fetch_assoc();
$virtualTime= $trenutno+ ($pomak['pomak_sati']*3600);
$datumiVrijeme= date("Y-m-d H:i:s", $virtualTime);

$aktivnost="Dodjela korisniku uloge moderator.";
$sql = "INSERT INTO `dnevnik_aktivnosti` (`id_dnevnik_aktivnosti`, `aktivnost`, `datum_vrijeme`, `korisnik_id_korisnik`) VALUES (NULL, '" . $aktivnost . "','" . $datumiVrijeme . "','" .  $id . "')";
$baza->updateDB($sql);

$baza->zatvoriDB();
echo "Korisniku ste uspješno dodijelili ulogu moderator";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

