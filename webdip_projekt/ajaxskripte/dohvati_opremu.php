<?php
require_once '../baza.class.php';
$baza = new Baza();
$baza->spojiDB();
$polje=[];
$upit="SELECT id_oprema,naziv,(SELECT naziv FROM lokacija WHERE id_lokacija = oprema.lokacija_id_lokacija) as Lokacija,lokacija_id_lokacija FROM oprema";
$rezultat=$baza->selectDB($upit);
if($rezultat->num_rows>0){
    while ($row = $rezultat->fetch_assoc()) {
        $odgovor['naziv']=$row['naziv'];
        $odgovor['lokacija']=$row['Lokacija'];
        $odgovor['lokacija_id']=$row['lokacija_id_lokacija'];
        $odgovor['id']=$row['id_oprema'];
        $polje[]=$odgovor;
    }
    echo json_encode($polje);
}
$baza->zatvoriDB();


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

