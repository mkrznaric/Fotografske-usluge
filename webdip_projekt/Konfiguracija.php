<?php
require_once  './baza.class.php';

function DohvatiSvePodatke(){
    $veza= new Baza();
    $veza->spojiDB();
    $rezultat=$veza->selectDB("Select *from konfiguracija where id_konfiguracija=1");
    $veza->zatvoriDB();
    return $rezultat->fetch_assoc();
}
function VirtualnoVrijeme(){
    $pom= DohvatiSvePodatke();
    $trenutno=time();
    $virtualTime= $trenutno+ ($pom['pomak_sati']*3600);
    return date("Y-m-d H:i:s", $virtualTime);
    
}
function DuljinaNoveLozinke(){
    $pom = DohvatiSvePodatke();
    return $pom['nova_lozinka'];
}

function TrajanjeAktivacijsogLinka(){
    $pom = DohvatiSvePodatke();
    return $pom['trajanje_aktivacijskog'];
    
}

function TrajanjeKolacicaPrijave(){
    $pom = DohvatiSvePodatke();
    return $pom['kolacic_prijave'];
}
function TrajanjeKolacicaUvjeta(){
    $pom = DohvatiSvePodatke();
    return $pom['kolacic_uvjeta'];
}

function BrojPokusaja(){
    
    $pom = DohvatiSvePodatke();
    return $pom['broj_pokusaja'];
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
