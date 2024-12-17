<?php
require_once"AdministrateurAPI.php";
header("Content-Type: application/json");

$dao = new AdministrateurDAO(new PDO("mysql:host=localhost;dbname=locationvoiture", "root", ""));

// Récupérer un administrateur par ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $admin = $dao->getAdministrateurById($_GET['id']);
    if ($admin) {
        echo json_encode($admin);
    } else {
        echo json_encode(['message' => 'Administrateur non trouvé']);
    }
}

// Connexion d'un administrateur
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['motDePasse'])) {
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];

    $admin = $dao->login($email, $motDePasse);
    if ($admin) {
        echo json_encode(['message' => 'Connexion réussie', 'admin' => $admin]);
    } else {
        echo json_encode(['message' => 'Identifiants invalides']);
    }
}

// Mettre à jour les informations d'un administrateur
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['id'])) {
    $data = json_decode(file_get_contents("php://input"));

    $admin = new Administrateur();
    $admin->setId($_GET['id']);
    $admin->setEmail($data->email);
    $admin->setMotDePasse(password_hash($data->motDePasse, PASSWORD_BCRYPT));  // Assurez-vous de hasher le mot de passe
    $admin->setResetToken($data->resetToken);
    $admin->setResetTokenExpiry($data->resetTokenExpiry);
    $admin->setVerificationCode($data->verificationCode);
    $admin->setIsVerified($data->isVerified);

    $result = $dao->updateAdministrateur($admin);
    if ($result) {
        echo json_encode(['message' => 'Informations mises à jour']);
    } else {
        echo json_encode(['message' => 'Échec de la mise à jour']);
    }
}
?>
