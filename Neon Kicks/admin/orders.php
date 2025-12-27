<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ../login.php?redirect=admin/orders.php');
    exit;
}

require_once __DIR__ . '/../includes/Order.php';

$database = new Database();
$db = $database->getConnection();
$orderModel = new Order($db);

// Handle status/payment updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
  $id = (int)$_POST['id'];
  // CSRF check
  require_once __DIR__ . '/csrf.php';
  if (empty($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
    header('Location: orders.php'); exit;
  }
  if (!empty($_POST['status'])) {
    $orderModel->updateStatus($id, $_POST['status']);
  }
  if (!empty($_POST['payment_status'])) {
    $orderModel->updatePaymentStatus($id, $_POST['payment_status']);
  }
  header('Location: orders.php');
  exit;
}

$orders = $orderModel->getAll(['limit' => 200, 'offset' => 0]);

// CSV export
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
  $rows = $orders;
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="orders.csv"');
  $out = fopen('php://output','w');
  fputcsv($out, ['id','order_number','user_name','total_amount_inr','status','payment_status','created_at']);
  foreach ($rows as $r) {
    fputcsv($out, [
      $r['id'] ?? '',
      $r['order_number'] ?? '',
      $r['user_name'] ?? '',
      $r['total_amount_inr'] ?? ($r['total_amount_usd'] ?? ''),
      $r['status'] ?? '',
      $r['payment_status'] ?? '',
      $r['created_at'] ?? ''
    ]);
  }
  fclose($out);
  exit;
}

?>
<?php include __DIR__ . '/header.php'; ?>

  <div class="admin-panel">
    <h1>Orders</h1>
    <div style="margin-bottom:12px;">
      <a href="orders.php?export=csv">Export CSV</a>
    </div>

    <table>
      <thead>
        <tr><th>Order #</th><th>User</th><th>Total (INR)</th><th>Status</th><th>Payment</th><th>Created</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $o): ?>
          <tr>
            <td><?php echo htmlspecialchars($o['order_number']); ?></td>
            <td><?php echo htmlspecialchars($o['user_name'] ?? $o['shipping_name']); ?></td>
            <td><?php echo htmlspecialchars($o['total_amount_inr']); ?></td>
            <td><?php echo htmlspecialchars($o['status']); ?></td>
            <td><?php echo htmlspecialchars($o['payment_status']); ?></td>
            <td><?php echo htmlspecialchars($o['created_at']); ?></td>
                    <td>
                      <form method="post" action="orders.php" style="display:inline-block;" data-requires-csrf> 
                        <input type="hidden" name="id" value="<?php echo $o['id']; ?>">
                        <select name="status">
                  <option value="pending" <?php if($o['status']==='pending') echo 'selected'; ?>>pending</option>
                  <option value="processing" <?php if($o['status']==='processing') echo 'selected'; ?>>processing</option>
                  <option value="shipped" <?php if($o['status']==='shipped') echo 'selected'; ?>>shipped</option>
                  <option value="delivered" <?php if($o['status']==='delivered') echo 'selected'; ?>>delivered</option>
                  <option value="cancelled" <?php if($o['status']==='cancelled') echo 'selected'; ?>>cancelled</option>
                </select>
                <select name="payment_status">
                  <option value="pending" <?php if($o['payment_status']==='pending') echo 'selected'; ?>>pending</option>
                  <option value="completed" <?php if($o['payment_status']==='completed') echo 'selected'; ?>>completed</option>
                  <option value="failed" <?php if($o['payment_status']==='failed') echo 'selected'; ?>>failed</option>
                  <option value="refunded" <?php if($o['payment_status']==='refunded') echo 'selected'; ?>>refunded</option>
                </select>
                <button type="submit">Save</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php include __DIR__ . '/footer.php'; ?>

