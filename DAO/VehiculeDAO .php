<?php
require_once "Vehicule.php";

class VehiculeDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=locatiovoiture", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function ajouterVehicule(Vehicule $vehicule) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO vehicule (marque, modele, type, prix_par_jour, disponible, nombre_places, carburant, image)
                 VALUES (:marque, :modele, :type, :prix_par_jour, :disponible, :nombre_places, :carburant, :image)"
            );
            $stmt->bindValue(':marque', $vehicule->getMarque());
            $stmt->bindValue(':modele', $vehicule->getModele());
            $stmt->bindValue(':type', $vehicule->getType());  // Assurez-vous que le type est valide (Voiture, Moto, Camion)
            $stmt->bindValue(':prix_par_jour', $vehicule->getPrixParJour());
            $stmt->bindValue(':disponible', $vehicule->getDisponible(), PDO::PARAM_BOOL);
            $stmt->bindValue(':nombre_places', $vehicule->getNombrePlaces(), PDO::PARAM_INT);
            $stmt->bindValue(':carburant', $vehicule->getCarburant());
            $stmt->bindValue(':image', $vehicule->getImage());

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout du véhicule : " . $e->getMessage());
        }
    }

    public function getTousVehicules() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM vehicule");
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $vehicules = [];
            foreach ($resultats as $data) {
                $vehicule = $this->mapDataToVehicule($data);
                $vehicules[] = $vehicule;
            }

            return $vehicules;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des véhicules : " . $e->getMessage());
        }
    }

    public function getVehiculeParId($idVehicule) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM vehicule WHERE id_vehicule = :id_vehicule");
            $stmt->bindValue(':id_vehicule', $idVehicule, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return $this->mapDataToVehicule($data);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du véhicule : " . $e->getMessage());
        }
    }

    public function mettreAJourVehicule(Vehicule $vehicule) {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE vehicule SET marque = :marque, modele = :modele, type = :type, prix_par_jour = :prix_par_jour, 
                 disponible = :disponible, nombre_places = :nombre_places, carburant = :carburant, image = :image
                 WHERE id_vehicule = :id_vehicule"
            );
            $stmt->bindValue(':marque', $vehicule->getMarque());
            $stmt->bindValue(':modele', $vehicule->getModele());
            $stmt->bindValue(':type', $vehicule->getType());  // Assurez-vous que le type est valide (Voiture, Moto, Camion)
            $stmt->bindValue(':prix_par_jour', $vehicule->getPrixParJour());
            $stmt->bindValue(':disponible', $vehicule->getDisponible(), PDO::PARAM_BOOL);
            $stmt->bindValue(':nombre_places', $vehicule->getNombrePlaces(), PDO::PARAM_INT);
            $stmt->bindValue(':carburant', $vehicule->getCarburant());
            $stmt->bindValue(':image', $vehicule->getImage());
            $stmt->bindValue(':id_vehicule', $vehicule->getIdVehicule(), PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour du véhicule : " . $e->getMessage());
        }
    }

    public function supprimerVehicule($idVehicule) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM vehicule WHERE id_vehicule = :id_vehicule");
            $stmt->bindValue(':id_vehicule', $idVehicule, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression du véhicule : " . $e->getMessage());
        }
    }

    private function mapDataToVehicule($data) {
        $vehicule = new Vehicule();
        $vehicule->setIdVehicule($data['id_vehicule']);
        $vehicule->setMarque($data['marque']);
        $vehicule->setModele($data['modele']);
        $vehicule->setType($data['type']);  // Assurez-vous que le type est correctement récupéré
        $vehicule->setPrixParJour($data['prix_par_jour']);
        $vehicule->setDisponible($data['disponible']);
        $vehicule->setNombrePlaces($data['nombre_places']);
        $vehicule->setCarburant($data['carburant']);
        $vehicule->setImage($data['image']);

        return $vehicule;
    }

    // Rechercher un véhicule par son nom ou sa marque
    public function findByName($name) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT * FROM vehicule WHERE marque LIKE :name OR modele LIKE :name"
            );
            $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
            $stmt->execute();
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $vehicules = [];
            foreach ($resultats as $data) {
                $vehicule = $this->mapDataToVehicule($data);
                $vehicules[] = $vehicule;
            }

            return $vehicules;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la recherche des véhicules par nom : " . $e->getMessage());
        }
    }
}
?>
