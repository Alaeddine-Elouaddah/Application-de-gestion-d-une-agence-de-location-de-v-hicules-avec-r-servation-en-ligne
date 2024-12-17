<?php
class ReservationDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=locatiovoiture", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function ajouterReservation(Reservation $reservation) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO reservation (client_id, vehicule_id, date_debut, date_fin, montant_total, statut)
                 VALUES (:client_id, :vehicule_id, :date_debut, :date_fin, :montant_total, :statut)"
            );
            $stmt->bindValue(':client_id', $reservation->getClientId(), PDO::PARAM_INT);
            $stmt->bindValue(':vehicule_id', $reservation->getVehiculeId(), PDO::PARAM_INT);
            $stmt->bindValue(':date_debut', $reservation->getDateDebut());
            $stmt->bindValue(':date_fin', $reservation->getDateFin());
            $stmt->bindValue(':montant_total', $reservation->getMontantTotal());
            $stmt->bindValue(':statut', $reservation->getStatut());

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de la réservation : " . $e->getMessage());
        }
    }

    public function getToutesReservations() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM reservation");
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $reservations = [];
            foreach ($resultats as $data) {
                $reservation = $this->mapDataToReservation($data);
                $reservations[] = $reservation;
            }

            return $reservations;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des réservations : " . $e->getMessage());
        }
    }

    public function getReservationParId($idReservation) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM reservation WHERE id_reservation = :id_reservation");
            $stmt->bindValue(':id_reservation', $idReservation, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return $this->mapDataToReservation($data);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de la réservation : " . $e->getMessage());
        }
    }

    public function mettreAJourReservation(Reservation $reservation) {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE reservation SET client_id = :client_id, vehicule_id = :vehicule_id, date_debut = :date_debut, 
                 date_fin = :date_fin, montant_total = :montant_total, statut = :statut
                 WHERE id_reservation = :id_reservation"
            );
            $stmt->bindValue(':client_id', $reservation->getClientId(), PDO::PARAM_INT);
            $stmt->bindValue(':vehicule_id', $reservation->getVehiculeId(), PDO::PARAM_INT);
            $stmt->bindValue(':date_debut', $reservation->getDateDebut());
            $stmt->bindValue(':date_fin', $reservation->getDateFin());
            $stmt->bindValue(':montant_total', $reservation->getMontantTotal());
            $stmt->bindValue(':statut', $reservation->getStatut());
            $stmt->bindValue(':id_reservation', $reservation->getIdReservation(), PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour de la réservation : " . $e->getMessage());
        }
    }

    public function supprimerReservation($idReservation) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM reservation WHERE id_reservation = :id_reservation");
            $stmt->bindValue(':id_reservation', $idReservation, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la réservation : " . $e->getMessage());
        }
    }

    private function mapDataToReservation($data) {
        $reservation = new Reservation();
        $reservation->setIdReservation($data['id_reservation']);
        $reservation->setClientId($data['client_id']);
        $reservation->setVehiculeId($data['vehicule_id']);
        $reservation->setDateDebut($data['date_debut']);
        $reservation->setDateFin($data['date_fin']);
        $reservation->setMontantTotal($data['montant_total']);
        $reservation->setStatut($data['statut']);

        return $reservation;
    }
}
?>
