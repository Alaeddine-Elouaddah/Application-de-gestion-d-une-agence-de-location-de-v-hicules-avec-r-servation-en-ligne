<?php
require_once 'AdministrateurService.php';

class AdministrateurWs {

    private $administrateurService;

    public function __construct() {
        $this->administrateurService = new AdministrateurService();
    }

    public function getAdministrateurById($id) {
        try {
            $admin = $this->administrateurService->getAdministrateurById($id);
            if ($admin) {
                return [
                    'id' => $admin->getId(),
                    'email' => $admin->getEmail(),
                    'role' => $admin->getRole(),
                    'isVerified' => $admin->getIsVerified()
                ];
            } else {
                return "Administrateur non trouvé.";
            }
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function login($email, $motDePasse) {
        try {
            $admin = $this->administrateurService->login($email, $motDePasse);
            if ($admin) {
                return [
                    'id' => $admin->getId(),
                    'email' => $admin->getEmail(),
                    'role' => $admin->getRole(),
                    'isVerified' => $admin->getIsVerified()
                ];
            } else {
                return "Identifiants incorrects.";
            }
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function updateAdministrateur($id, $email, $motDePasse, $resetToken, $resetTokenExpiry, $verificationCode, $isVerified) {
        try {
            $admin = new Administrateur();
            $admin->setId($id);
            $admin->setEmail($email);
            $admin->setMotDePasse($motDePasse);
            $admin->setResetToken($resetToken);
            $admin->setResetTokenExpiry($resetTokenExpiry);
            $admin->setVerificationCode($verificationCode);
            $admin->setIsVerified($isVerified);

            $this->administrateurService->updateAdministrateur($admin);
            return "Administrateur mis à jour avec succès.";
        } catch (Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    }
}

$server = new SoapServer(null, array('uri' => 'http://localhost/administrateur_service'));
$server->setClass('AdministrateurWs');
$server->handle();
?>
