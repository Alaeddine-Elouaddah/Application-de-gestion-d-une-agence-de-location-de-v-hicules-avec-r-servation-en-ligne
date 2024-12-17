<?php
require_once "Utilisateur.php";

class Client extends Utilisateur {
    public $cin;
    public $telephone;
    public  $numeroPermis;

    public function getCin() {
        return $this->cin;
    }

    public function setCin($cin) {
        $this->cin = $cin;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function getNumeroPermis() {
        return $this->numeroPermis;
    }

    public function setNumeroPermis($numeroPermis) {
        $this->numeroPermis = $numeroPermis;
    }
}
?>
