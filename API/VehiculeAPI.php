<?php
require_once 'VehiculeDAO.php';
require_once 'Vehicule.php';

class VehiculeAPI {

    private $vehiculeDAO;

    public function __construct() {
        $this->vehiculeDAO = new VehiculeDAO();
    }

    // GET: Récupérer tous les véhicules
    public function getAllVehicules() {
        $vehicules = $this->vehiculeDAO->getTousVehicules();
        echo json_encode($vehicules);
    }

    // GET: Récupérer un véhicule par son ID
    public function getVehiculeById($id) {
        $vehicule = $this->vehiculeDAO->getVehiculeParId($id);
        if ($vehicule) {
            echo json_encode($vehicule);
        } else {
            echo json_encode(['message' => 'Véhicule not found']);
        }
    }

    // POST: Ajouter un véhicule
    public function addVehicule() {
        $data = json_decode(file_get_contents("php://input"));
        $vehicule = new Vehicule();
        $vehicule->setMarque($data->marque);
        $vehicule->setModele($data->modele);
        $vehicule->setType($data->type);
        $vehicule->setPrixParJour($data->prix_par_jour);
        $vehicule->setDisponible($data->disponible);
        $vehicule->setNombrePlaces($data->nombre_places);
        $vehicule->setCarburant($data->carburant);
        $vehicule->setImage($data->image);
        
        try {
            $this->vehiculeDAO->ajouterVehicule($vehicule);
            echo json_encode(['message' => 'Véhicule ajouté avec succès']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // PUT: Mettre à jour un véhicule
    public function updateVehicule($id) {
        $data = json_decode(file_get_contents("php://input"));
        $vehicule = new Vehicule();
        $vehicule->setIdVehicule($id);
        $vehicule->setMarque($data->marque);
        $vehicule->setModele($data->modele);
        $vehicule->setType($data->type);
        $vehicule->setPrixParJour($data->prix_par_jour);
        $vehicule->setDisponible($data->disponible);
        $vehicule->setNombrePlaces($data->nombre_places);
        $vehicule->setCarburant($data->carburant);
        $vehicule->setImage($data->image);

        try {
            $this->vehiculeDAO->mettreAJourVehicule($vehicule);
            echo json_encode(['message' => 'Véhicule mis à jour avec succès']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // DELETE: Supprimer un véhicule
    public function deleteVehicule($id) {
        try {
            $this->vehiculeDAO->supprimerVehicule($id);
            echo json_encode(['message' => 'Véhicule supprimé avec succès']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

// Gestion des requêtes API
$api = new VehiculeAPI();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$id = isset($requestUri[1]) ? $requestUri[1] : null;

switch ($requestMethod) {
    case 'GET':
        if ($id) {
            $api->getVehiculeById($id);
        } else {
            $api->getAllVehicules();
        }
        break;
    case 'POST':
        $api->addVehicule();
        break;
    case 'PUT':
        if ($id) {
            $api->updateVehicule($id);
        }
        break;
    case 'DELETE':
        if ($id) {
            $api->deleteVehicule($id);
        }
        break;
    default:
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
?>
