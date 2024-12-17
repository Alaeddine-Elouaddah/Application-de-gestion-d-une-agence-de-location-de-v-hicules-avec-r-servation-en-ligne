<?php
require_once 'VehiculeService.php';

class VehiculeWs {

    private $vehiculeService;

    public function __construct() {
        $this->vehiculeService = new VehiculeService();
    }

    // Ajouter un véhicule
    public function ajouterVehicule($marque, $modele, $type, $prix_par_jour, $disponible, $nombre_places, $carburant, $image) {
        try {
            $vehicule = new Vehicule();
            $vehicule->setMarque($marque);
            $vehicule->setModele($modele);
            $vehicule->setType($type);
            $vehicule->setPrixParJour($prix_par_jour);
            $vehicule->setDisponible($disponible);
            $vehicule->setNombrePlaces($nombre_places);
            $vehicule->setCarburant($carburant);
            $vehicule->setImage($image);

            $this->vehiculeService->ajouterVehicule($vehicule);
            return "Véhicule ajouté avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Récupérer tous les véhicules
    public function getTousVehicules() {
        try {
            $vehicules = $this->vehiculeService->getTousVehicules();
            $vehiculeList = [];
            foreach ($vehicules as $vehicule) {
                $vehiculeList[] = [
                    'id_vehicule' => $vehicule->getIdVehicule(),
                    'marque' => $vehicule->getMarque(),
                    'modele' => $vehicule->getModele(),
                    'type' => $vehicule->getType(),
                    'prix_par_jour' => $vehicule->getPrixParJour(),
                    'disponible' => $vehicule->getDisponible(),
                    'nombre_places' => $vehicule->getNombrePlaces(),
                    'carburant' => $vehicule->getCarburant(),
                    'image' => $vehicule->getImage()
                ];
            }
            return $vehiculeList;
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Récupérer un véhicule par son ID
    public function getVehiculeParId($idVehicule) {
        try {
            $vehicule = $this->vehiculeService->getVehiculeParId($idVehicule);
            if ($vehicule) {
                return [
                    'id_vehicule' => $vehicule->getIdVehicule(),
                    'marque' => $vehicule->getMarque(),
                    'modele' => $vehicule->getModele(),
                    'type' => $vehicule->getType(),
                    'prix_par_jour' => $vehicule->getPrixParJour(),
                    'disponible' => $vehicule->getDisponible(),
                    'nombre_places' => $vehicule->getNombrePlaces(),
                    'carburant' => $vehicule->getCarburant(),
                    'image' => $vehicule->getImage()
                ];
            } else {
                return "Véhicule non trouvé.";
            }
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Mettre à jour un véhicule
    public function mettreAJourVehicule($id_vehicule, $marque, $modele, $type, $prix_par_jour, $disponible, $nombre_places, $carburant, $image) {
        try {
            $vehicule = new Vehicule();
            $vehicule->setIdVehicule($id_vehicule);
            $vehicule->setMarque($marque);
            $vehicule->setModele($modele);
            $vehicule->setType($type);
            $vehicule->setPrixParJour($prix_par_jour);
            $vehicule->setDisponible($disponible);
            $vehicule->setNombrePlaces($nombre_places);
            $vehicule->setCarburant($carburant);
            $vehicule->setImage($image);

            $this->vehiculeService->mettreAJourVehicule($vehicule);
            return "Véhicule mis à jour avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Supprimer un véhicule
    public function supprimerVehicule($idVehicule) {
        try {
            $this->vehiculeService->supprimerVehicule($idVehicule);
            return "Véhicule supprimé avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Rechercher un véhicule par nom ou marque
    public function findByName($name) {
        try {
            $vehicules = $this->vehiculeService->findByName($name);
            $vehiculeList = [];
            foreach ($vehicules as $vehicule) {
                $vehiculeList[] = [
                    'id_vehicule' => $vehicule->getIdVehicule(),
                    'marque' => $vehicule->getMarque(),
                    'modele' => $vehicule->getModele(),
                    'type' => $vehicule->getType(),
                    'prix_par_jour' => $vehicule->getPrixParJour(),
                    'disponible' => $vehicule->getDisponible(),
                    'nombre_places' => $vehicule->getNombrePlaces(),
                    'carburant' => $vehicule->getCarburant(),
                    'image' => $vehicule->getImage()
                ];
            }
            return $vehiculeList;
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }
}

// Configuration du serveur SOAP
$server = new SoapServer(null, array('uri' => 'http://localhost/vehicule_service'));
$server->setClass('VehiculeWs');
$server->handle();
?>
