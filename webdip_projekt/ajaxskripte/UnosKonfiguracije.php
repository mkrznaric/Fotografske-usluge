<?php

include '../baza.class.php';
include '../sesija.class.php';

Sesija::kreirajSesiju();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$veza = new Baza();
$veza->spojiDB();
$kolacicPrijava = $_POST['kolacicPrijave'];
$kolacicUvjeti = $_POST['kolacicUvjeta'];
$duljinaLozinke = $_POST['novaLozinka'];
$trajanjeLinka = $_POST['aktivacijskiLink'];
$brojPokusaja = $_POST['pokusaji'];

$upit = "UPDATE konfiguracija set kolacic_uvjeta='" . $kolacicUvjeti . "', kolacic_prijave='" . $kolacicPrijava . "', trajanje_aktivacijskog='" . $trajanjeLinka . "', broj_pokusaja='" . $brojPokusaja . "',nova_lozinka='" . $duljinaLozinke . "' where id_konfiguracija='1'";

$veza->updateDB($upit);


$id = $_SESSION['id'];
$aktivnost = "Promjena konfiguracije sustava";
$pom="Select pomak_sati from konfiguracija";
$rezultat=$veza->selectDB($pom);
$pomak=$rezultat->fetch_assoc();
$trenutno=time();
$virtualTime= $trenutno+ ($pomak['pomak_sati']*3600);
$datumiVrijeme= date("Y-m-d H:i:s", $virtualTime);
$korisnik=$_SESSION['id'];
$sql = "INSERT INTO `dnevnik_aktivnosti` (`id_dnevnik_aktivnosti`, `aktivnost`, `datum_vrijeme`, `korisnik_id_korisnik`) VALUES (NULL, '" . $aktivnost . "','" . $datumiVrijeme . "','" . $korisnik . "')";
$veza->updateDB($sql);
$veza->zatvoriDB();
echo 'Promjene u bazi su pohranjene';
