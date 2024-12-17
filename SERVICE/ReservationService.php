<?php
require_once 'ReservationDAO.php';
require_once 'Reservation.php';

class ReservationService {

    private $reservationDAO;

    public function __construct() {
        $this->reservationDAO = new ReservationDAO();
    }

    public function ajouterReservation($clientId, $vehiculeId, $dateDebut, $dateFin, $montantTotal, $statut) {
        $reservation = new Reservation();
        $reservation->setClientId($clientId);
        $reservation->setVehiculeId($vehiculeId);
        $reservation->setDateDebut($dateDebut);
        $reservation->setDateFin($dateFin);
        $reservation->setMontantTotal($montantTotal);
        $reservation->setStatut($statut);
        $this->reservationDAO->ajouterReservation($reservation);
    }

    public function getToutesReservations() {
        return $this->reservationDAO->getToutesReservations();
    }

    public function getReservationParId($idReservation) {
        return $this->reservationDAO->getReservationParId($idReservation);
    }

    public function mettreAJourReservation($idReservation, $clientId, $vehiculeId, $dateDebut, $dateFin, $montantTotal, $statut) {
        $reservation = $this->reservationDAO->getReservationParId($idReservation);
        
        if ($reservation) {
            $reservation->setClientId($clientId);
            $reservation->setVehiculeId($vehiculeId);
            $reservation->setDateDebut($dateDebut);
            $reservation->setDateFin($dateFin);
            $reservation->setMontantTotal($montantTotal);
            $reservation->setStatut($statut);
            $this->reservationDAO->mettreAJourReservation($reservation);
        } else {
            throw new Exception("Réservation non trouvée");
        }
    }

    public function supprimerReservation($idReservation) {
        $this->reservationDAO->supprimerReservation($idReservation);
    }
}
?>
