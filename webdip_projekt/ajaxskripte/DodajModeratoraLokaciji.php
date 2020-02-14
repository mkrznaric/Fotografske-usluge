<?php

include '../baza.class.php';
include '../sesija.class.php';
Sesija::kreirajSesiju();
$baza = new Baza();
$baza->spojiDB();
$moderatorID = $_POST['moderatorID'];
$lokacijaID = $_POST['lokacijaID'];
$sql = "Select *from moderator where korisnik_id_korisnik='" . $moderatorID . "' and lokacija_id_lokacija='" . $lokacijaID . "'";
$rezultat = $baza->selectDB($sql);
if ($rezultat->num_rows > 0) {
    $baza->zatvoriDB();
    echo 'Ne možete lokaciji dodati već postojeću kategoriju !';
} else {
    $upit = "Insert into moderator values(NULL,'" . $moderatorID . "','" . $lokacijaID . "')";
    $baza->selectDB($upit);
    $trenutno = time();
    $pom = "Select pomak_sati from konfiguracija";
    $rezultat = $baza->selectDB($pom);
    $pomak = $rezultat->fetch_assoc();
    $virtualTime = $trenutno + ($pomak['pomak_sati'] * 3600);
    $datumiVrijeme = date("Y-m-d H:i:s", $virtualTime);
    $id=$_SESSION['id'];
    $aktivnost = "Dodjela moderatora lokaciji.";
    $sql = "INSERT INTO `dnevnik_aktivnosti` (`id_dnevnik_aktivnosti`, `aktivnost`, `datum_vrijeme`, `korisnik_id_korisnik`) VALUES (NULL, '" . $aktivnost . "','" . $datumiVrijeme . "','" . $id . "')";
    $baza->updateDB($sql);

    $baza->zatvoriDB();
    echo "Lokaciji ste uspješno dodijelili moderatora !!";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

