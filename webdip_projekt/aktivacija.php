<?php


include './DnevnikRada.php';
include_once './Konfiguracija.php';
$baza = new Baza();
$baza->spojiDB();

$korisnickoime = $_GET["korisnickoime"];
$aktivacijskikod = $_GET["aktivacijskikod"];

if (!empty($_GET["korisnickoime"] && $_GET["aktivacijskikod"])) {

    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $korisnickoime . "' AND kriptirana_lozinka = '" . $aktivacijskikod . "'";
    $korisnici = $baza->selectDB($upit);

    $vrijemeSada = VirtualnoVrijeme();
    $vrijemeupit = "select datum_vrijme_registracije from korisnik where korisnicko_ime = '" . $korisnickoime . "'";

    $vrijemeRegistracije = $baza->selectDB($vrijemeupit);
    $vrijemeReg = "";
    if ($vrijemeRegistracije != null) {
        $odgovorVrijemeRegistracije = $vrijemeRegistracije->fetch_assoc();
        $vrijemeReg = $odgovorVrijemeRegistracije["datum_vrijme_registracije"];
        $vrijemeReg = strtotime($vrijemeReg);
    }
    $trajanjeAktivacijskog= TrajanjeAktivacijsogLinka();
    $vrijemeIsteka = date('Y-m-d H:i:s', $vrijemeReg + $trajanjeAktivacijskog*3600);



    if ($vrijemeSada < $vrijemeIsteka) {

        if (mysqli_num_rows($korisnici) > 0) {
            $aktiviraj = "UPDATE korisnik SET status = '1' WHERE korisnicko_ime = '" . $korisnickoime . "'";
            $aktivacija = $baza->selectDB($aktiviraj);
            echo 'Uspješno ste aktivirali svoj račun!';
            echo 'Vrijeme isteka je : ';
            echo $vrijemeIsteka;
            echo 'Vrijeme sada je : ';
            echo $vrijemeSada;

            $idKorisnik = 0;

            $upit = "Select * from korisnik where korisnicko_ime ='" . $korisnickoime . "'";
            $korisnik = $baza->selectDB($upit);
            if (mysqli_num_rows($korisnik) > 0) {
                while ($row = $korisnik->fetch_assoc()) {
                    $idKorisnik = $row["id_korisnik"];
                }
            }
            $aktivnost = "Uspjesna aktivacija";
            $datumiVrijeme = VirtualnoVrijeme();
            DnevnikRada::PopuniDnevnik($idKorisnik, $aktivnost, $datumiVrijeme);
        }
    } else {
        echo'Vrijeme za aktivaciju je isteklo!';
        echo 'Vrijeme isteka je : ';
        echo $vrijemeIsteka;
        echo 'Vrijeme sada je : ';
        echo $vrijemeSada;
    }
}
?>

