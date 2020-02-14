<?php
require_once '../baza.class.php';
$baza= new Baza();
$baza->spojiDB();
$idLoakcije=$_POST['id'];
$naziv=$_POST['naziv'];
$upit="";
$polje=[];
if(empty($idLoakcije) && empty($naziv)){
    $upit="SELECT id_oprema,naziv,(SELECT naziv FROM lokacija WHERE id_lokacija = oprema.lokacija_id_lokacija) as lokacijaa FROM oprema";
}
else if(!empty ($naziv) && empty ($idLoakcije)){
   $upit = "SELECT id_oprema,naziv,(SELECT naziv FROM lokacija WHERE id_lokacija = oprema.lokacija_id_lokacija)as lokacijaa FROM oprema WHERE naziv LIKE '%".$naziv."%'";
}
else if(empty ($naziv) && !empty($idLoakcije)){
    $upit = "SELECT id_oprema,naziv,(SELECT naziv FROM lokacija WHERE id_lokacija = oprema.lokacija_id_lokacija) AS lokacijaa FROM oprema WHERE id_oprema = '".$idLoakcije."'";
}
else{
    $upit = "SELECT id_oprema,naziv,(SELECT naziv FROM lokacija WHERE id_lokacija = oprema.lokacija_id_lokacija) AS lokacijaa FROM oprema WHERE id_oprema = '".$idLoakcije."' and naziv LIKE '%".$naziv."%'";
}
$rezultat=$baza->selectDB($upit);
if($rezultat->num_rows>0){
    while($row=$rezultat->fetch_assoc()){
        $odgovor['naziv']=$row['naziv'];
        $odgovor['lokacija']=$row['lokacijaa'];
        $odgovor['id']=$row['id_oprema'];
        $polje[]=$odgovor;
        
    }
    echo json_encode($polje);
}
 else {
     $polje['greska']="Nema rezultata za traženi zapis";
     echo json_encode($polje);
}
$baza->zatvoriDB();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

