<?php
require_once 'NotificationService.php';

class NotificationWs {

    private $notificationService;

    public function __construct() {
        $this->notificationService = new NotificationService();
    }

    // Ajouter une notification
    public function ajouterNotification($client_id, $message, $date_envoi) {
        try {
            $notification = new Notification();
            $notification->setClientId($client_id);
            $notification->setMessage($message);
            $notification->setDateEnvoi($date_envoi);

            $this->notificationService->ajouterNotification($notification);
            return "Notification ajoutée avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Récupérer toutes les notifications
    public function getToutesNotifications() {
        try {
            $notifications = $this->notificationService->getToutesNotifications();
            $notificationList = [];
            foreach ($notifications as $notification) {
                $notificationList[] = [
                    'id_notification' => $notification->getIdNotification(),
                    'client_id' => $notification->getClientId(),
                    'message' => $notification->getMessage(),
                    'date_envoi' => $notification->getDateEnvoi()
                ];
            }
            return $notificationList;
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Récupérer une notification par son ID
    public function getNotificationParId($idNotification) {
        try {
            $notification = $this->notificationService->getNotificationParId($idNotification);
            if ($notification) {
                return [
                    'id_notification' => $notification->getIdNotification(),
                    'client_id' => $notification->getClientId(),
                    'message' => $notification->getMessage(),
                    'date_envoi' => $notification->getDateEnvoi()
                ];
            } else {
                return "Notification non trouvée.";
            }
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Mettre à jour une notification
    public function mettreAJourNotification($id_notification, $client_id, $message, $date_envoi) {
        try {
            $notification = new Notification();
            $notification->setIdNotification($id_notification);
            $notification->setClientId($client_id);
            $notification->setMessage($message);
            $notification->setDateEnvoi($date_envoi);

            $this->notificationService->mettreAJourNotification($notification);
            return "Notification mise à jour avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    // Supprimer une notification
    public function supprimerNotification($idNotification) {
        try {
            $this->notificationService->supprimerNotification($idNotification);
            return "Notification supprimée avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }
}

// Configuration du serveur SOAP
$server = new SoapServer(null, array('uri' => 'http://localhost/notification_service'));
$server->setClass('NotificationWs');
$server->handle();
?>
