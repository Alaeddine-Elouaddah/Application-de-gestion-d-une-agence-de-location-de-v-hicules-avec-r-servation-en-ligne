<?php
require_once 'ReservationDAO.php';
header("Content-Type: application/json");

$dao = new ReservationDAO();

// Récupérer toutes les réservations
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['id'])) {
    $reservations = $dao->getToutesReservations();
    echo json_encode($reservations);
}

// Récupérer une réservation par ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $reservation = $dao->getReservationParId($_GET['id']);
    if ($reservation) {
        echo json_encode($reservation);
    } else {
        echo json_encode(['message' => 'Réservation non trouvée']);
    }
}

// Ajouter une réservation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $reservation = new Reservation();
    $reservation->setClientId($data->client_id);
    $reservation->setVehiculeId($data->vehicule_id);
    $reservation->setDateDebut($data->date_debut);
    $reservation->setDateFin($data->date_fin);
    $reservation->setMontantTotal($data->montant_total);
    $reservation->setStatut($data->statut);

    $dao->ajouterReservation($reservation);
    echo json_encode(['message' => 'Réservation ajoutée']);
}

// Mettre à jour une réservation
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['id'])) {
    $data = json_decode(file_get_contents("php://input"));
    $reservation = new Reservation();
    $reservation->setIdReservation($_GET['id']);
    $reservation->setClientId($data->client_id);
    $reservation->setVehiculeId($data->vehicule_id);
    $reservation->setDateDebut($data->date_debut);
    $reservation->setDateFin($data->date_fin);
    $reservation->setMontantTotal($data->montant_total);
    $reservation->setStatut($data->statut);

    $dao->mettreAJourReservation($reservation);
    echo json_encode(['message' => 'Réservation mise à jour']);
}

// Supprimer une réservation
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $dao->supprimerReservation($_GET['id']);
    echo json_encode(['message' => 'Réservation supprimée']);
}
?>
