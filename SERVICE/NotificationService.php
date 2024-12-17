<?php
require_once 'NotificationDAO.php';

class NotificationService {

    private $notificationDAO;

    public function __construct() {
        $this->notificationDAO = new NotificationDAO();
    }

    public function ajouterNotification(Notification $notification) {
        return $this->notificationDAO->ajouterNotification($notification);
    }

    public function getToutesNotifications() {
        return $this->notificationDAO->getToutesNotifications();
    }

    public function getNotificationParId($idNotification) {
        return $this->notificationDAO->getNotificationParId($idNotification);
    }

    public function mettreAJourNotification(Notification $notification) {
        return $this->notificationDAO->mettreAJourNotification($notification);
    }

    public function supprimerNotification($idNotification) {
        return $this->notificationDAO->supprimerNotification($idNotification);
    }
}
?>
