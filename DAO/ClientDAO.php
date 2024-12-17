<?php
require_once "Client.php";

class ClientDAO {
    private $pdo;

    public function __construct($pdo) {
      $this->pdo = new PDO("mysql:host=localhost;dbname=locatiovoiture", "root", "");
    }
    

    public function getClientById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id = :id AND role = 'Client'");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $client = new Client();
                $client->setId($data['id']);
                $client->setEmail($data['email']);
                $client->setMotDePasse($data['motDePasse']);
                $client->setRole($data['role']);
                $client->setResetToken($data['resetToken']);
                $client->setResetTokenExpiry($data['resetTokenExpiry']);
                $client->setVerificationCode($data['verification_code']);
                $client->setIsVerified($data['is_verified']);
                $client->setCin($data['cin']);
                $client->setTelephone($data['telephone']);
                $client->setNumeroPermis($data['numeroPermis']);

                return $client;
            }

            return null;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du client : " . $e->getMessage());
        }
    }

    public function createClient(Client $client) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO utilisateur (email, motDePasse, role, resetToken, resetTokenExpiry, verification_code, is_verified, cin, telephone, numeroPermis)
                VALUES (:email, :motDePasse, 'Client', :resetToken, :resetTokenExpiry, :verification_code, :is_verified, :cin, :telephone, :numeroPermis)"
            );
            $stmt->bindParam(':email', $client->getEmail(), PDO::PARAM_STR);
            $stmt->bindParam(':motDePasse', $client->getMotDePasse(), PDO::PARAM_STR);
            $stmt->bindParam(':resetToken', $client->getResetToken(), PDO::PARAM_STR);
            $stmt->bindParam(':resetTokenExpiry', $client->getResetTokenExpiry(), PDO::PARAM_STR);
            $stmt->bindParam(':verification_code', $client->getVerificationCode(), PDO::PARAM_STR);
            $stmt->bindParam(':is_verified', $client->getIsVerified(), PDO::PARAM_INT);
            $stmt->bindParam(':cin', $client->getCin(), PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $client->getTelephone(), PDO::PARAM_STR);
            $stmt->bindParam(':numeroPermis', $client->getNumeroPermis(), PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la création du client : " . $e->getMessage());
        }
    }

    public function updateClient(Client $client) {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE utilisateur SET email = :email, motDePasse = :motDePasse, resetToken = :resetToken, resetTokenExpiry = :resetTokenExpiry,
                verification_code = :verification_code, is_verified = :is_verified, cin = :cin, telephone = :telephone, numeroPermis = :numeroPermis
                WHERE id = :id AND role = 'Client'"
            );
            $stmt->bindParam(':email', $client->getEmail(), PDO::PARAM_STR);
            $stmt->bindParam(':motDePasse', $client->getMotDePasse(), PDO::PARAM_STR);
            $stmt->bindParam(':resetToken', $client->getResetToken(), PDO::PARAM_STR);
            $stmt->bindParam(':resetTokenExpiry', $client->getResetTokenExpiry(), PDO::PARAM_STR);
            $stmt->bindParam(':verification_code', $client->getVerificationCode(), PDO::PARAM_STR);
            $stmt->bindParam(':is_verified', $client->getIsVerified(), PDO::PARAM_INT);
            $stmt->bindParam(':cin', $client->getCin(), PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $client->getTelephone(), PDO::PARAM_STR);
            $stmt->bindParam(':numeroPermis', $client->getNumeroPermis(), PDO::PARAM_STR);
            $stmt->bindParam(':id', $client->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour du client : " . $e->getMessage());
        }
    }

    public function deleteClient($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM utilisateur WHERE id = :id AND role = 'Client'");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression du client : " . $e->getMessage());
        }
    }

    public function getAllClients() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE role = 'Client'");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $clients = [];
            foreach ($results as $data) {
                $client = new Client();
                $client->setId($data['id']);
                $client->setEmail($data['email']);
                $client->setMotDePasse($data['motDePasse']);
                $client->setRole($data['role']);
                $client->setResetToken($data['resetToken']);
                $client->setResetTokenExpiry($data['resetTokenExpiry']);
                $client->setVerificationCode($data['verification_code']);
                $client->setIsVerified($data['is_verified']);
                $client->setCin($data['cin']);
                $client->setTelephone($data['telephone']);
                $client->setNumeroPermis($data['numeroPermis']);

                $clients[] = $client;
            }

            return $clients;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des clients : " . $e->getMessage());
        }
    }
}
?>
