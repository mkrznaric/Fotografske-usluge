<?php
include '../baza.class.php';
$veza=new Baza();
$veza->spojiDB();
$upit="Select *from korisnik where uloga_id_uloga='2'";
$rezultat=$veza->selectDB($upit);
$polje=[];
while ($row=$rezultat->fetch_assoc()){
    $odgovor['korime']=$row['korisnicko_ime'];
    $odgovor['id_korisnik']=$row['id_korisnik'];
    $polje[]=$odgovor;
}
$veza->zatvoriDB();
echo json_encode($polje);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

