<?php
class Vehicule {
    // Types de véhicules correspondant à l'ENUM dans la base de données
    const TYPE_VOITURE = 'Voiture';
    const TYPE_MOTO = 'Moto';
    const TYPE_CAMION = 'Camion';

    private $idVehicule;
    private $marque;
    private $modele;
    private $type;
    private $prixParJour;
    private $disponible;
    private $nombrePlaces;
    private $carburant;
    private $image;

    public function getIdVehicule() {
        return $this->idVehicule;
    }

    public function setIdVehicule($idVehicule) {
        $this->idVehicule = $idVehicule;
    }

    public function getMarque() {
        return $this->marque;
    }

    public function setMarque($marque) {
        $this->marque = $marque;
    }

    public function getModele() {
        return $this->modele;
    }

    public function setModele($modele) {
        $this->modele = $modele;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        // Validation pour s'assurer que le type est valide (en fonction de l'ENUM de la base de données)
        $validTypes = [
            self::TYPE_VOITURE, self::TYPE_MOTO, self::TYPE_CAMION
        ];
        if (in_array($type, $validTypes)) {
            $this->type = $type;
        } else {
            throw new Exception("Type de véhicule invalide.");
        }
    }

    public function getPrixParJour() {
        return $this->prixParJour;
    }

    public function setPrixParJour($prixParJour) {
        $this->prixParJour = $prixParJour;
    }

    public function getDisponible() {
        return $this->disponible;
    }

    public function setDisponible($disponible) {
        $this->disponible = $disponible;
    }

    public function getNombrePlaces() {
        return $this->nombrePlaces;
    }

    public function setNombrePlaces($nombrePlaces) {
        $this->nombrePlaces = $nombrePlaces;
    }

    public function getCarburant() {
        return $this->carburant;
    }

    public function setCarburant($carburant) {
        $this->carburant = $carburant;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}
?>
