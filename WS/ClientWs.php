<?php
require_once 'ClientService.php';

class ClientWs {

    private $clientService;

    public function __construct() {
        $this->clientService = new ClientService();
    }

    public function getClientById($id) {
        try {
            $client = $this->clientService->getClientById($id);
            if ($client) {
                return [
                    'id' => $client->getId(),
                    'email' => $client->getEmail(),
                    'cin' => $client->getCin(),
                    'telephone' => $client->getTelephone(),
                    'numeroPermis' => $client->getNumeroPermis(),
                    'isVerified' => $client->getIsVerified()
                ];
            } else {
                return "Client non trouvé.";
            }
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function createClient($email, $motDePasse, $resetToken, $resetTokenExpiry, $verificationCode, $isVerified, $cin, $telephone, $numeroPermis) {
        try {
            $client = new Client();
            $client->setEmail($email);
            $client->setMotDePasse($motDePasse);
            $client->setResetToken($resetToken);
            $client->setResetTokenExpiry($resetTokenExpiry);
            $client->setVerificationCode($verificationCode);
            $client->setIsVerified($isVerified);
            $client->setCin($cin);
            $client->setTelephone($telephone);
            $client->setNumeroPermis($numeroPermis);

            $this->clientService->createClient($client);
            return "Client créé avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function updateClient($id, $email, $motDePasse, $resetToken, $resetTokenExpiry, $verificationCode, $isVerified, $cin, $telephone, $numeroPermis) {
        try {
            $client = new Client();
            $client->setId($id);
            $client->setEmail($email);
            $client->setMotDePasse($motDePasse);
            $client->setResetToken($resetToken);
            $client->setResetTokenExpiry($resetTokenExpiry);
            $client->setVerificationCode($verificationCode);
            $client->setIsVerified($isVerified);
            $client->setCin($cin);
            $client->setTelephone($telephone);
            $client->setNumeroPermis($numeroPermis);

            $this->clientService->updateClient($client);
            return "Client mis à jour avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function deleteClient($id) {
        try {
            $this->clientService->deleteClient($id);
            return "Client supprimé avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function getAllClients() {
        try {
            $clients = $this->clientService->getAllClients();
            $clientList = [];
            foreach ($clients as $client) {
                $clientList[] = [
                    'id' => $client->getId(),
                    'email' => $client->getEmail(),
                    'cin' => $client->getCin(),
                    'telephone' => $client->getTelephone(),
                    'numeroPermis' => $client->getNumeroPermis(),
                    'isVerified' => $client->getIsVerified()
                ];
            }
            return $clientList;
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }
}

$server = new SoapServer(null, array('uri' => 'http://localhost/client_service'));
$server->setClass('ClientWs');
$server->handle();
?>
