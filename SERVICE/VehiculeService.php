<?php
require_once 'VehiculeDAO.php';

class VehiculeService {

    private $vehiculeDAO;

    public function __construct() {
        $this->vehiculeDAO = new VehiculeDAO();
    }

    public function ajouterVehicule(Vehicule $vehicule) {
        return $this->vehiculeDAO->ajouterVehicule($vehicule);
    }

    public function getTousVehicules() {
        return $this->vehiculeDAO->getTousVehicules();
    }

    public function getVehiculeParId($idVehicule) {
        return $this->vehiculeDAO->getVehiculeParId($idVehicule);
    }

    public function mettreAJourVehicule(Vehicule $vehicule) {
        return $this->vehiculeDAO->mettreAJourVehicule($vehicule);
    }

    public function supprimerVehicule($idVehicule) {
        return $this->vehiculeDAO->supprimerVehicule($idVehicule);
    }

    public function findByName($name) {
        return $this->vehiculeDAO->findByName($name);
    }
}
?>
