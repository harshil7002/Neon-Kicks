<?php
// Create Order Endpoint
// Disable running errors from breaking JSON
ini_set('display_errors', 0);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Include config and database
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../includes/Order.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode([
        'success' => false, 
        'message' => 'Unauthorized: Please login again to place order',
        'debug_session_id' => session_id() // helpful for debugging
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data) || empty($data['items']) || empty($data['shipping_info'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid order data']);
    exit;
}

try {
    $database = new Database();
    $db = $database->getConnection();
    $orderModel = new Order($db);

    // Populate order data
    $orderModel->user_id = $_SESSION['user_id'];
    $orderModel->shipping_name = $data['shipping_info']['fullName'] ?? '';
    $orderModel->shipping_email = $data['shipping_info']['email'] ?? '';
    $orderModel->shipping_phone = $data['shipping_info']['phone'] ?? '';
    $orderModel->shipping_address = $data['shipping_info']['address'] ?? '';
    $orderModel->shipping_city = $data['shipping_info']['city'] ?? '';
    $orderModel->shipping_state = $data['shipping_info']['state'] ?? '';
    $orderModel->shipping_pincode = $data['shipping_info']['pincode'] ?? '';
    
    // Add notes to the model (was causing failure if required and missing)
    $orderModel->notes = ''; 
    
    $orderModel->payment_method = $data['payment_method'] ?? 'card';
    
    // Calculate totals server-side for security (though here we trust client params for MVP)
    $orderModel->total_amount_inr = $data['totalINR'];
    $orderModel->total_amount_usd = $data['totalUSD'];
    $orderModel->status = 'pending';
    $orderModel->payment_status = 'completed'; // Assuming instant payment for now

    $items = [];
    foreach ($data['items'] as $item) {
        $items[] = [
            'product_id' => $item['product']['id'],
            'product_name' => $item['product']['name'],
            'product_image' => $item['product']['image'],
            'size' => $item['size'] ?? null,
            'color' => $item['color'] ?? null, // Map color if available
            'quantity' => $item['quantity'],
            'price_usd' => $item['product']['priceUSD'],
            'price_inr' => $item['product']['priceINR']
        ];
    }

    if ($orderModel->create($items)) {
        http_response_code(201);
        echo json_encode([
            'success' => true, 
            'message' => 'Order placed successfully', 
            'orderId' => $orderModel->order_number
        ]);
    } else {
        // Log the specific error if create returns false (though it throws exception usually)
        error_log("Order creation returned false");
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to place order']);
    }

} catch (Exception $e) {
    // Log error to file
    file_put_contents(__DIR__ . '/error_log.txt', date('Y-m-d H:i:s') . " Error: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n", FILE_APPEND);
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}
