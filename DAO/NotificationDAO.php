<?php
class NotificationDAO {
    private $pdo;

    // Constructeur qui initialise la connexion PDO
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=locatiovoiture", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function ajouterNotification(Notification $notification) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO notification (client_id, message, date_envoi)
                 VALUES (:client_id, :message, :date_envoi)"
            );
            $stmt->bindValue(':client_id', $notification->getClientId(), PDO::PARAM_INT);
            $stmt->bindValue(':message', $notification->getMessage());
            $stmt->bindValue(':date_envoi', $notification->getDateEnvoi());

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de la notification : " . $e->getMessage());
        }
    }

    public function getToutesNotifications() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM notification");
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $notifications = [];
            foreach ($resultats as $data) {
                $notification = $this->mapDataToNotification($data);
                $notifications[] = $notification;
            }

            return $notifications;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des notifications : " . $e->getMessage());
        }
    }

    public function getNotificationParId($idNotification) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM notification WHERE id_notification = :id_notification");
            $stmt->bindValue(':id_notification', $idNotification, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return $this->mapDataToNotification($data);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de la notification : " . $e->getMessage());
        }
    }

    public function mettreAJourNotification(Notification $notification) {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE notification SET client_id = :client_id, message = :message, date_envoi = :date_envoi
                 WHERE id_notification = :id_notification"
            );
            $stmt->bindValue(':client_id', $notification->getClientId(), PDO::PARAM_INT);
            $stmt->bindValue(':message', $notification->getMessage());
            $stmt->bindValue(':date_envoi', $notification->getDateEnvoi());
            $stmt->bindValue(':id_notification', $notification->getIdNotification(), PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour de la notification : " . $e->getMessage());
        }
    }

    public function supprimerNotification($idNotification) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM notification WHERE id_notification = :id_notification");
            $stmt->bindValue(':id_notification', $idNotification, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la notification : " . $e->getMessage());
        }
    }

    private function mapDataToNotification($data) {
        $notification = new Notification();
        $notification->setIdNotification($data['id_notification']);
        $notification->setClientId($data['client_id']);
        $notification->setMessage($data['message']);
        $notification->setDateEnvoi($data['date_envoi']);

        return $notification;
    }
}
?>
