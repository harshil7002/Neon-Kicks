<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config/config.php';
// simple admin header
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="admin.css">
  <?php
  // include csrf helper and ensure token
  require_once __DIR__ . '/csrf.php';
  $csrf = generate_csrf_token();
  ?>
  <meta name="csrf-token" content="<?php echo htmlspecialchars($csrf); ?>">
  <title>Admin · NeonKicks</title>
</head>
<body class="admin-root">
  <header class="admin-header">
    <div class="admin-brand"><a href="/index.php">NeonKicks</a> — Admin</div>
    <nav class="admin-nav">
      <a href="index.php">Dashboard</a>
      <a href="products.php">Products</a>
      <a href="orders.php">Orders</a>
      <a href="users.php">Users</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>
  <main class="admin-main">
  <script>
    // automatically inject csrf token into forms marked with data-requires-csrf
    (function(){
      document.addEventListener('DOMContentLoaded', function(){
        var token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!token) return;
        document.querySelectorAll('form[data-requires-csrf]').forEach(function(f){
          if (!f.querySelector('input[name="csrf_token"]')){
            var i = document.createElement('input');
            i.type='hidden'; i.name='csrf_token'; i.value=token; f.appendChild(i);
          }
        });
      });
    })();
  </script>
