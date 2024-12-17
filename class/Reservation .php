<?php





class Reservation {
    const STATUT_CONFIRME = 'Confirmée';
    const STATUT_ANNULEE = 'Annulée';
    const STATUT_EN_ATTENTE = 'En attente';

    private $idReservation;
    private $clientId;
    private $vehiculeId;
    private $dateDebut;
    private $dateFin;
    private $montantTotal;
    private $statut;

    public function getIdReservation() {
        return $this->idReservation;
    }

    public function setIdReservation($idReservation) {
        $this->idReservation = $idReservation;
    }

    public function getClientId() {
        return $this->clientId;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
    }

    public function getVehiculeId() {
        return $this->vehiculeId;
    }

    public function setVehiculeId($vehiculeId) {
        $this->vehiculeId = $vehiculeId;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

    public function getMontantTotal() {
        return $this->montantTotal;
    }

    public function setMontantTotal($montantTotal) {
        $this->montantTotal = $montantTotal;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatut($statut) {
        if (in_array($statut, [self::STATUT_CONFIRME, self::STATUT_ANNULEE, self::STATUT_EN_ATTENTE])) {
            $this->statut = $statut;
        } else {
            throw new Exception("Statut invalide.");
        }
    }
}






?>