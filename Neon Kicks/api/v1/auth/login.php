<?php
// Simple JSON login endpoint for NeonKicks
// Disable running errors from breaking JSON
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Expects: POST JSON { email, password }
header('Content-Type: application/json');

// Include config to ensure session is started and constants are defined
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../includes/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data) || empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$email = trim($data['email']);
$password = $data['password'];

try {
    // Initialize Database connection
    $database = new Database();
    $db = $database->getConnection();

    $userModel = new User($db);
    $result = $userModel->login($email, $password);

    if (!empty($result['success'])) {
        $user = $result['user'];
        // Set session values used by the site
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        echo json_encode(['success' => true, 'user' => $user]);
        exit;
    }

    http_response_code(401);
    echo json_encode(['success' => false, 'message' => $result['message'] ?? 'Invalid credentials']);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
    exit;
}

