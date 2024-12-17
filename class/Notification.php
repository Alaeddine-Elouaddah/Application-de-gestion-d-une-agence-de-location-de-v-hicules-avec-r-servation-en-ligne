<?php
class Notification {
    private $idNotification;
    private $clientId;
    private $message;
    private $dateEnvoi;

    public function getIdNotification() {
        return $this->idNotification;
    }

    public function setIdNotification($idNotification) {
        $this->idNotification = $idNotification;
    }

    public function getClientId() {
        return $this->clientId;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getDateEnvoi() {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi($dateEnvoi) {
        $this->dateEnvoi = $dateEnvoi;
    }
}




?>