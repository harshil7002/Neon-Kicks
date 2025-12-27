<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ../login.php?redirect=admin/users.php');
    exit;
}

require_once __DIR__ . '/../includes/User.php';

$database = new Database();
$db = $database->getConnection();
$userModel = new User($db);

// Handle update from POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
  $uid = (int)$_POST['id'];
  $name = trim($_POST['name'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $role = in_array($_POST['role'] ?? '', ['customer','admin']) ? $_POST['role'] : 'customer';
  $is_active = isset($_POST['is_active']) ? 1 : 0;

  // Update name and phone via User model
  $userModel->id = $uid;
  $userModel->name = $name;
  $userModel->phone = $phone;
  $userModel->update();

  // Update role and active via direct query
  $stmt = $db->prepare('UPDATE users SET role = ?, is_active = ? WHERE id = ?');
  $stmt->execute([$role, $is_active, $uid]);

  // Update password if provided
  if (!empty($_POST['password'])) {
    $userModel->id = $uid;
    $userModel->updatePassword($_POST['password']);
  }

  header('Location: users.php');
  exit;
}

// Toggle active
if (isset($_GET['action']) && $_GET['action'] === 'toggle' && !empty($_GET['id'])) {
  $userModel->toggleActive((int)$_GET['id']);
  header('Location: users.php');
  exit;
}

// Delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && !empty($_GET['id'])) {
  $userModel->delete((int)$_GET['id']);
  header('Location: users.php');
  exit;
}

$editingUser = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && !empty($_GET['id'])) {
  $editingUser = $userModel->getById((int)$_GET['id']);
}

// simple search + pagination
$q = trim($_GET['q'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 20;
$offset = ($page - 1) * $limit;

$params = [];
$sql = 'SELECT id, name, email, phone, role, is_active, created_at FROM users WHERE 1=1';
if ($q !== '') {
  $sql .= ' AND (name LIKE ? OR email LIKE ?)';
  $params[] = '%'.$q.'%'; $params[] = '%'.$q.'%';
}
$sql .= ' ORDER BY created_at DESC LIMIT ? OFFSET ?';
$stmt = $db->prepare($sql);

// Bind positional params (search terms) first
$paramIndex = 1;
foreach ($params as $p) {
  $stmt->bindValue($paramIndex, $p);
  $paramIndex++;
}

// Bind limit/offset as integers (positional)
$stmt->bindValue($paramIndex, (int)$limit, PDO::PARAM_INT);
$stmt->bindValue($paramIndex + 1, (int)$offset, PDO::PARAM_INT);

$stmt->execute();
$users = $stmt->fetchAll();

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Users · Admin</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>

  <div class="admin-panel">
    <h1>Users</h1>

    <div style="margin-bottom:12px;">
      <form method="get" action="users.php" style="display:flex;gap:8px;align-items:center;">
        <input name="q" placeholder="Search users..." value="<?php echo htmlspecialchars($q); ?>">
        <button type="submit">Search</button>
      </form>
    </div>

    <?php if ($editingUser): ?>
      <h2>Edit User #<?php echo htmlspecialchars($editingUser['id']); ?></h2>
      <form method="post" action="users.php">
        <input type="hidden" name="id" value="<?php echo $editingUser['id']; ?>">
        <div><label>Name<br><input name="name" required value="<?php echo htmlspecialchars($editingUser['name']); ?>"></label></div>
        <div><label>Phone<br><input name="phone" value="<?php echo htmlspecialchars($editingUser['phone']); ?>"></label></div>
        <div><label>Role<br><select name="role"><option value="customer" <?php if($editingUser['role']=='customer') echo 'selected'; ?>>Customer</option><option value="admin" <?php if($editingUser['role']=='admin') echo 'selected'; ?>>Admin</option></select></label></div>
        <div><label>Active<br><input type="checkbox" name="is_active" <?php if($editingUser['is_active']) echo 'checked'; ?>></label></div>
        <div><label>New Password (leave blank to keep)<br><input name="password" type="password"></label></div>
        <div style="margin-top:8px;"><button type="submit">Save</button> <a href="users.php">Cancel</a></div>
      </form>
      <hr>
    <?php endif; ?>

    <table>
      <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Active</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <tr>
            <td><?php echo htmlspecialchars($u['id']); ?></td>
            <td><?php echo htmlspecialchars($u['name']); ?></td>
            <td><?php echo htmlspecialchars($u['email']); ?></td>
            <td><?php echo htmlspecialchars($u['role']); ?></td>
            <td><?php echo $u['is_active'] ? 'Yes' : 'No'; ?></td>
            <td>
              <a href="users.php?action=edit&id=<?php echo $u['id']; ?>">Edit</a> |
              <a href="users.php?action=toggle&id=<?php echo $u['id']; ?>">Toggle Active</a> |
              <a href="users.php?action=delete&id=<?php echo $u['id']; ?>" onclick="return confirm('Delete user?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div style="margin-top:12px;">
      <?php if ($page>1): ?>
        <a href="users.php?q=<?php echo urlencode($q); ?>&page=<?php echo $page-1; ?>">&lt; Prev</a>
      <?php endif; ?>
      <span style="margin:0 8px;">Page <?php echo $page; ?></span>
      <?php if (count($users) === $limit): ?>
        <a href="users.php?q=<?php echo urlencode($q); ?>&page=<?php echo $page+1; ?>">Next &gt;</a>
      <?php endif; ?>
    </div>
  </div>

<?php include __DIR__ . '/footer.php'; ?>

