<?php
include  '../baza.class.php';
$baza = new Baza();
$baza->spojiDB();
$upit="Select *from korisnik where uloga_id_uloga='3'";
$rezultat=$baza->selectDB($upit);
$polje=[];
while ($row=$rezultat->fetch_assoc()){
    $odgovor['korime']=$row['korisnicko_ime'];
    $odgovor['id_korisnik']=$row['id_korisnik'];
    $polje[]=$odgovor;
}
$baza->zatvoriDB();
echo json_encode($polje);


