<?php
require_once 'ReservationService.php';

class ReservationWs {

    private $reservationService;

    public function __construct() {
        $this->reservationService = new ReservationService();
    }

    public function ajouterReservation($clientId, $vehiculeId, $dateDebut, $dateFin, $montantTotal, $statut) {
        try {
            $this->reservationService->ajouterReservation($clientId, $vehiculeId, $dateDebut, $dateFin, $montantTotal, $statut);
            return "Réservation ajoutée avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function getToutesReservations() {
        try {
            $reservations = $this->reservationService->getToutesReservations();
            return $reservations;
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function getReservationParId($idReservation) {
        try {
            $reservation = $this->reservationService->getReservationParId($idReservation);
            if ($reservation) {
                return $reservation;
            } else {
                return "Réservation non trouvée.";
            }
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function mettreAJourReservation($idReservation, $clientId, $vehiculeId, $dateDebut, $dateFin, $montantTotal, $statut) {
        try {
            $this->reservationService->mettreAJourReservation($idReservation, $clientId, $vehiculeId, $dateDebut, $dateFin, $montantTotal, $statut);
            return "Réservation mise à jour avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function supprimerReservation($idReservation) {
        try {
            $this->reservationService->supprimerReservation($idReservation);
            return "Réservation supprimée avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }
}

$server = new SoapServer(null, array('uri' => 'http://localhost/reservation_service'));
$server->setClass('ReservationWs');
$server->handle();
?>
