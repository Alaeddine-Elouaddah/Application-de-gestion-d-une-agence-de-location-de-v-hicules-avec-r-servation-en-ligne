<?php
require_once 'NotificationDAO.php';
require_once 'Notification.php';

class NotificationAPI {

    private $notificationDAO;

    public function __construct() {
        $this->notificationDAO = new NotificationDAO();
    }

    // GET: Récupérer toutes les notifications
    public function getAllNotifications() {
        $notifications = $this->notificationDAO->getToutesNotifications();
        echo json_encode($notifications);
    }

    // GET: Récupérer une notification par son ID
    public function getNotificationById($id) {
        $notification = $this->notificationDAO->getNotificationParId($id);
        if ($notification) {
            echo json_encode($notification);
        } else {
            echo json_encode(['message' => 'Notification not found']);
        }
    }

    // POST: Ajouter une notification
    public function addNotification() {
        $data = json_decode(file_get_contents("php://input"));
        $notification = new Notification();
        $notification->setClientId($data->client_id);
        $notification->setMessage($data->message);
        $notification->setDateEnvoi($data->date_envoi);
        
        try {
            $this->notificationDAO->ajouterNotification($notification);
            echo json_encode(['message' => 'Notification added successfully']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // PUT: Mettre à jour une notification
    public function updateNotification($id) {
        $data = json_decode(file_get_contents("php://input"));
        $notification = new Notification();
        $notification->setIdNotification($id);
        $notification->setClientId($data->client_id);
        $notification->setMessage($data->message);
        $notification->setDateEnvoi($data->date_envoi);

        try {
            $this->notificationDAO->mettreAJourNotification($notification);
            echo json_encode(['message' => 'Notification updated successfully']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // DELETE: Supprimer une notification
    public function deleteNotification($id) {
        try {
            $this->notificationDAO->supprimerNotification($id);
            echo json_encode(['message' => 'Notification deleted successfully']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

// Gestion des requêtes API
$api = new NotificationAPI();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$id = isset($requestUri[1]) ? $requestUri[1] : null;

switch ($requestMethod) {
    case 'GET':
        if ($id) {
            $api->getNotificationById($id);
        } else {
            $api->getAllNotifications();
        }
        break;
    case 'POST':
        $api->addNotification();
        break;
    case 'PUT':
        if ($id) {
            $api->updateNotification($id);
        }
        break;
    case 'DELETE':
        if ($id) {
            $api->deleteNotification($id);
        }
        break;
    default:
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
?>
