<?php
require_once '../baza.class.php';

$baza = new Baza();
$baza->spojiDB();
$id=$_POST['id'];
$upit="Select status from korisnik where id_korisnik = '".$id."'";
$red=$baza->selectDB($upit)->fetch_assoc();

$status=$red['status'];

if(empty($status)){
    $upit ="UPDATE korisnik set status='1' where id_korisnik = '".$id."'";
}else{
     $upit ="UPDATE korisnik set status='0' where id_korisnik = '".$id."'";
}
$baza->updateDB($upit);
$trenutno=time();
$pom="Select pomak_sati from konfiguracija";
$rezultat=$baza->selectDB($pom);
$pomak=$rezultat->fetch_assoc();
$virtualTime= $trenutno+ ($pomak['pomak_sati']*3600);
$datumiVrijeme= date("Y-m-d H:i:s", $virtualTime);

$aktivnost="Promjena statusa korisnika.";
$sql = "INSERT INTO `dnevnik_aktivnosti` (`id_dnevnik_aktivnosti`, `aktivnost`, `datum_vrijeme`, `korisnik_id_korisnik`) VALUES (NULL, '" . $aktivnost . "','" . $datumiVrijeme . "','" .  $id . "')";
$baza->updateDB($sql);
$baza->zatvoriDB();
echo "Status korisnika je promjenjen  !";


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

