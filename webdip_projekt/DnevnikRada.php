<?php
require_once './baza.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DnevnikRada
 *
 * @author Matej
 */
class DnevnikRada {
    public static function PopuniDnevnik($korisnik,$aktivnost,$datumiVrijeme){
        $baza= new Baza();
        $baza->spojiDB();
        $sql = "INSERT INTO `dnevnik_aktivnosti` (`id_dnevnik_aktivnosti`, `aktivnost`, `datum_vrijeme`, `korisnik_id_korisnik`) VALUES (NULL, '".$aktivnost."','".$datumiVrijeme."','".$korisnik."')";
        $baza->updateDB($sql);
        $baza->zatvoriDB();
    }
}
