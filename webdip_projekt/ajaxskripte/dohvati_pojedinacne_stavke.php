<?php
require_once '../baza.class.php';
$baza = new Baza();
$baza->spojiDB();

$link=$_GET['link'];
$idLokacije= substr($link, strpos($link, "=") + 1);
$upit="Select *from lokacija where id_lokacija='".$idLokacije."'";
$rezultat=$baza->selectDB($upit);
$polje=[];
while ($row=$rezultat->fetch_assoc()) {
    $odgovor['naziv']=$row['naziv'];
    $odgovor['zupanija']=$row['zupanija'];
    $odgovor['dodatneInformacije']=$row['dodatne_informacije'];
    $polje[]=$odgovor;
}
echo json_encode($polje);
$baza->zatvoriDB();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

