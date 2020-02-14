<?php
include '../baza.class.php';
$veza= new Baza();
$veza->spojiDB();
$sql="Select *from lokacija";
$polje=[];
$rezultat=$veza->selectDB($sql);
while ($row=$rezultat->fetch_assoc()){
    $odgovor['id']=$row['id_lokacija'];
    $odgovor['naziv']=$row['naziv'];
    $polje[]=$odgovor;
}
$veza->zatvoriDB();
echo json_encode($polje);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

