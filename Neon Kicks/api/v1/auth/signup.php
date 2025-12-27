<?php
// Signup endpoint for NeonKicks
// Disable running errors from breaking JSON
ini_set('display_errors', 0);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Include config and database
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

if (!is_array($data) || empty($data['email']) || empty($data['password']) || empty($data['name'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

try {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    // Check if email already exists
    if ($user->emailExists($data['email'])) {
        http_response_code(409); // Conflict
        echo json_encode(['success' => false, 'message' => 'Email already registered']);
        exit;
    }

    // Assign data to user object
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->phone = $data['phone'] ?? '';
    $user->password = $data['password'];
    $user->role = 'customer'; // Default role

    if ($user->register()) {
        http_response_code(201);
        echo json_encode([
            'success' => true, 
            'message' => 'User registered successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ]);
        
        // Optional: Auto-login after signup? 
        // For now, we will require them to login or client can handle the transition.
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Unable to register user']);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}
