<?php
require_once './baza.class.php';
require_once "sesija.class.php";
require_once './DnevnikRada.php';
require_once './Konfiguracija.php';

Sesija::kreirajSesiju();
$id=$_SESSION['id'];
$aktivnost="Uspjesna odjava sa sustava";
$datumiVrijeme= VirtualnoVrijeme();
DnevnikRada::PopuniDnevnik($id, $aktivnost, $datumiVrijeme);
Sesija::obrisiSesiju();

Header('Location:index.php');

?>