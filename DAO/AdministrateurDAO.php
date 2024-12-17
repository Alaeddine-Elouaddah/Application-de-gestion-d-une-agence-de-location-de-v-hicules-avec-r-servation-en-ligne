<?php
require_once "Administrateur.php";

class AdministrateurDAO {
    private $pdo;

    public function __construct($pdo) {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=locatiovoiture", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getAdministrateurById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id = :id AND role = 'Admin'");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $admin = new Administrateur();
                $admin->setId($data['id']);
                $admin->setEmail($data['email']);
                $admin->setMotDePasse($data['motDePasse']);
                $admin->setRole($data['role']);
                $admin->setResetToken($data['resetToken']);
                $admin->setResetTokenExpiry($data['resetTokenExpiry']);
                $admin->setVerificationCode($data['verification_code']);
                $admin->setIsVerified($data['is_verified']);

                return $admin;
            }

            return null;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de l'administrateur : " . $e->getMessage());
        }
    }

    public function login($email, $motDePasse) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = :email AND role = 'Admin'");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data && password_verify($motDePasse, $data['motDePasse'])) {
                $admin = new Administrateur();
                $admin->setId($data['id']);
                $admin->setEmail($data['email']);
                $admin->setMotDePasse($data['motDePasse']);
                $admin->setRole($data['role']);
                $admin->setResetToken($data['resetToken']);
                $admin->setResetTokenExpiry($data['resetTokenExpiry']);
                $admin->setVerificationCode($data['verification_code']);
                $admin->setIsVerified($data['is_verified']);

                return $admin;
            }

            return null;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la connexion : " . $e->getMessage());
        }
    }

    public function updateAdministrateur(Administrateur $admin) {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE utilisateur SET email = :email, motDePasse = :motDePasse, resetToken = :resetToken, resetTokenExpiry = :resetTokenExpiry, verification_code = :verificationCode, is_verified = :isVerified WHERE id = :id AND role = 'Admin'"
            );
            $stmt->bindParam(':email', $admin->getEmail(), PDO::PARAM_STR);
            $stmt->bindParam(':motDePasse', $admin->getMotDePasse(), PDO::PARAM_STR);
            $stmt->bindParam(':resetToken', $admin->getResetToken(), PDO::PARAM_STR);
            $stmt->bindParam(':resetTokenExpiry', $admin->getResetTokenExpiry(), PDO::PARAM_STR);
            $stmt->bindParam(':verificationCode', $admin->getVerificationCode(), PDO::PARAM_STR);
            $stmt->bindParam(':isVerified', $admin->getIsVerified(), PDO::PARAM_STR);
            $stmt->bindParam(':id', $admin->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour de l'administrateur : " . $e->getMessage());
        }
    }
}
?>
