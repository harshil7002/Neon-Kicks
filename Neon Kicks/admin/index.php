<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

// Require admin
if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ../login.php?redirect=admin/index.php');
    exit;
}

require_once __DIR__ . '/../includes/Product.php';
require_once __DIR__ . '/../includes/Order.php';
require_once __DIR__ . '/../includes/User.php';

$database = new Database();
$db = $database->getConnection();

$productModel = new Product($db);
$orderModel = new Order($db);
$userModel = new User($db);

$products_count = $productModel->getCount();
$orders_count = $orderModel->getCount();
$users_count = $userModel->getCount();
$total_revenue = $orderModel->getTotalRevenue();

?>
<?php include __DIR__ . '/header.php'; ?>

  <div class="admin-panel">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
    <div style="display:grid; grid-template-columns: repeat(auto-fit,minmax(200px,1fr)); gap:12px; margin-top:12px;">
      <div class="card">
        <strong>Products</strong>
        <div style="font-size:28px"><?php echo (int)$products_count; ?></div>
        <div><a href="products.php">Manage</a></div>
      </div>

      <div class="card">
        <strong>Orders</strong>
        <div style="font-size:28px"><?php echo (int)$orders_count; ?></div>
        <div><a href="orders.php">Manage</a></div>
      </div>

      <div class="card">
        <strong>Users</strong>
        <div style="font-size:28px"><?php echo (int)$users_count; ?></div>
        <div><a href="users.php">Manage</a></div>
      </div>

      <div class="card">
        <strong>Total Revenue (INR)</strong>
        <div style="font-size:28px"><?php echo number_format((float)$total_revenue, 2); ?></div>
      </div>
    </div>
  </div>

<?php include __DIR__ . '/footer.php'; ?>
