<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ../login.php?redirect=admin/products.php');
    exit;
}

require_once __DIR__ . '/../includes/Product.php';

$database = new Database();
$db = $database->getConnection();
$productModel = new Product($db);

// Handle create/update with server-side validation and image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // CSRF check
  require_once __DIR__ . '/csrf.php';
  if (empty($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
    $_SESSION['admin_errors'] = ['Invalid CSRF token'];
    header('Location: products.php'); exit;
  }
  $name = trim($_POST['name'] ?? '');
  $brand = trim($_POST['brand'] ?? '');
  $price_inr = is_numeric($_POST['price_inr'] ?? '') ? (float)$_POST['price_inr'] : null;
  $stock_quantity = is_numeric($_POST['stock_quantity'] ?? '') ? (int)$_POST['stock_quantity'] : 0;
  $description = trim($_POST['description'] ?? '');

  // Basic validation
  $errors = [];
  if ($name === '') $errors[] = 'Name is required';
  if ($price_inr === null) $errors[] = 'Valid price is required';

  // Handle image upload if provided
  $image_url = $_POST['image_url'] ?? '';
  if (!empty($_FILES['image']['name'])) {
    $uploadDir = __DIR__ . '/../' . rtrim(UPLOAD_DIR, '/') . '/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $tmp = $_FILES['image']['tmp_name'];
    $mime = mime_content_type($tmp);
    if (!in_array($mime, ALLOWED_IMAGE_TYPES)) {
      $errors[] = 'Uploaded image type is not allowed';
    } else {
      $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      $filename = uniqid('p_') . '.' . $ext;
      $dest = $uploadDir . $filename;
      if (move_uploaded_file($tmp, $dest)) {
        // Resize image to max 1200x1200 and create thumbnail
        $maxW = 1200; $maxH = 1200;
        $imgData = @getimagesize($dest);
        if ($imgData) {
          list($w,$h) = $imgData;
          $ratio = min($maxW/$w, $maxH/$h, 1);
          $newW = (int)($w * $ratio); $newH = (int)($h * $ratio);
          $src = null; $ext = strtolower(pathinfo($dest, PATHINFO_EXTENSION));
          if (in_array($ext, ['jpg','jpeg'])) $src = imagecreatefromjpeg($dest);
          elseif ($ext === 'png') $src = imagecreatefrompng($dest);
          elseif ($ext === 'webp' && function_exists('imagecreatefromwebp')) $src = imagecreatefromwebp($dest);
          if ($src && ($newW!=$w || $newH!=$h)) {
            $dst = imagecreatetruecolor($newW,$newH);
            imagecopyresampled($dst,$src,0,0,0,0,$newW,$newH,$w,$h);
            if (in_array($ext, ['jpg','jpeg'])) imagejpeg($dst,$dest,85);
            elseif ($ext==='png') imagepng($dst,$dest,6);
            elseif ($ext==='webp' && function_exists('imagewebp')) imagewebp($dst,$dest);
            imagedestroy($dst);
            imagedestroy($src);
          }

        }
        $image_url = rtrim(UPLOAD_DIR, '/') . '/' . $filename;
      } else {
        $errors[] = 'Failed to move uploaded image';
      }
    }
  }

  if (!empty($errors)) {
    // store errors in session to display
    $_SESSION['admin_errors'] = $errors;
    header('Location: products.php');
    exit;
  }

  if (!empty($_POST['id'])) {
    // update
    $productModel->id = (int)$_POST['id'];
    $productModel->name = $name;
    $productModel->brand = $brand;
    $productModel->price_inr = $price_inr;
    $productModel->price_usd = $price_inr / USD_TO_INR_RATE;
    $productModel->stock_quantity = $stock_quantity;
    $productModel->description = $description;
    if ($image_url) $productModel->image_url = $image_url;
    $productModel->update();
    header('Location: products.php');
    exit;
  } else {
    // create
    $productModel->name = $name;
    $productModel->brand = $brand;
    $productModel->price_inr = $price_inr;
    $productModel->price_usd = $price_inr / USD_TO_INR_RATE;
    $productModel->stock_quantity = $stock_quantity;
    $productModel->description = $description;
    $productModel->image_url = $image_url;
    $productModel->create();
    header('Location: products.php');
    exit;
  }
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && !empty($_GET['id'])) {
  $id = (int)$_GET['id'];
  $productModel->delete($id);
  header('Location: products.php');
  exit;
}

$editing = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && !empty($_GET['id'])) {
  $editing = $productModel->getById((int)$_GET['id']);
}

$q = trim($_GET['q'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 20;
$offset = ($page - 1) * $limit;
$filters = ['limit' => $limit, 'offset' => $offset];
if ($q !== '') $filters['search'] = $q;
// For admin listing, use a lightweight query selecting only needed columns
$params = [];
$sql = 'SELECT id, name, brand, price_inr, stock_quantity, image_url, created_at FROM products WHERE 1=1';
if ($q !== '') {
  $sql .= ' AND (name LIKE ? OR brand LIKE ? OR category LIKE ?)';
  $params[] = '%'.$q.'%'; $params[] = '%'.$q.'%'; $params[] = '%'.$q.'%';
}
$sql .= ' ORDER BY created_at DESC LIMIT ? OFFSET ?';
$stmt = $db->prepare($sql);

$paramIndex = 1;
foreach ($params as $p) {
  $stmt->bindValue($paramIndex, $p);
  $paramIndex++;
}
$stmt->bindValue($paramIndex, (int)$limit, PDO::PARAM_INT);
$stmt->bindValue($paramIndex + 1, (int)$offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();

?>
<?php include __DIR__ . '/header.php'; ?>

  <div class="admin-panel">
    <h1>Products</h1>
  <div style="margin-bottom:12px;">
    <form method="get" action="products.php" style="display:flex;gap:8px;align-items:center;">
      <input name="q" placeholder="Search products..." value="<?php echo htmlspecialchars($q); ?>">
      <button type="submit">Search</button>
    </form>
  </div>
  <?php if (!empty($_SESSION['admin_errors'])): $errs = $_SESSION['admin_errors']; unset($_SESSION['admin_errors']); ?>
    <div style="background:#3a1f1f;color:#ffdede;padding:8px;border-radius:6px;margin-bottom:8px;">
      <strong>Errors:</strong>
      <ul><?php foreach($errs as $er) echo '<li>'.htmlspecialchars($er).'</li>'; ?></ul>
    </div>
  <?php endif; ?>
  <form method="post" action="products.php" enctype="multipart/form-data" data-requires-csrf>
    <input type="hidden" name="id" value="<?php echo $editing ? htmlspecialchars($editing['id']) : ''; ?>">
    <div><label>Name<br><input name="name" required value="<?php echo $editing ? htmlspecialchars($editing['name']) : ''; ?>"></label></div>
    <div><label>Brand<br><input name="brand" value="<?php echo $editing ? htmlspecialchars($editing['brand']) : ''; ?>"></label></div>
    <div><label>Price (INR)<br><input name="price_inr" type="number" step="0.01" value="<?php echo $editing ? htmlspecialchars($editing['price_inr']) : ''; ?>"></label></div>
    <div><label>Stock Quantity<br><input name="stock_quantity" type="number" value="<?php echo $editing ? htmlspecialchars($editing['stock_quantity']) : '0'; ?>"></label></div>
    <div class="form-row"><label>Image URL (or upload)<br><input name="image_url" value="<?php echo $editing ? htmlspecialchars($editing['image_url']) : ''; ?>"></label></div>
    <div class="form-row"><label>Upload Image<br><input type="file" name="image" id="product-image-input" accept="image/*"></label>
      <div style="margin-top:8px;"><img id="product-image-preview" src="<?php echo $editing ? htmlspecialchars(resolve_admin_image($editing['image_url'])) : ''; ?>" style="max-width:160px; display:<?php echo $editing && $editing['image_url'] ? 'block' : 'none'; ?>"></div>
    </div>
    <div><label>Description<br><textarea name="description"><?php echo $editing ? htmlspecialchars($editing['description']) : ''; ?></textarea></label></div>
    <div style="margin-top:8px;"><button type="submit"><?php echo $editing ? 'Update' : 'Create'; ?></button>
    <?php if ($editing): ?> <a href="products.php">Cancel</a><?php endif; ?></div>
  </form>

  <hr>

    <?php
    // helper to resolve image path for admin pages
    function resolve_admin_image($url) {
      $placeholder = 'https://via.placeholder.com/220x140?text=No+Image';
      if (empty($url)) return $placeholder;
      // absolute URL
      if (preg_match('#^https?://#i', $url)) return $url;
      // strip leading ../ or ./
      $clean = preg_replace('#^\.+/#', '', ltrim($url));
      $local = __DIR__ . '/../' . $clean;
      if (file_exists($local)) return '../' . $clean;
      // try the uploads folder basename fallback
      $basename = basename($clean);
      $uploadsTry = __DIR__ . '/../' . rtrim(UPLOAD_DIR, '/') . '/' . $basename;
      if (file_exists($uploadsTry)) return '../' . rtrim(UPLOAD_DIR, '/') . '/' . $basename;
      return $placeholder;
    }

    ?>

    <div class="product-grid">
    <?php foreach ($products as $p): 
      $img = resolve_admin_image($p['image_url'] ?? '');
    ?>
      <div class="product-card">
        <div class="product-thumb"><img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>"></div>
        <div class="product-body">
          <h3 class="product-title"><?php echo htmlspecialchars($p['name']); ?></h3>
          <div class="product-meta"><?php echo htmlspecialchars($p['brand']); ?> • ₹<?php echo htmlspecialchars(number_format($p['price_inr'],2)); ?></div>
          <div class="product-stock">Stock: <?php echo htmlspecialchars($p['stock_quantity'] ?? 0); ?></div>
        </div>
        <div class="product-actions">
          <a class="btn btn-small" href="../product-detail.php?id=<?php echo $p['id']; ?>" target="_blank">View</a>
          <a class="btn btn-small" href="products.php?action=edit&id=<?php echo $p['id']; ?>">Edit</a>
          <a class="btn btn-danger btn-small" href="products.php?action=delete&id=<?php echo $p['id']; ?>" onclick="return confirm('Delete product?')">Delete</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div style="margin-top:12px;">
    <?php if ($page>1): ?>
      <a href="products.php?q=<?php echo urlencode($q); ?>&page=<?php echo $page-1; ?>">&lt; Prev</a>
    <?php endif; ?>
    <span style="margin:0 8px;">Page <?php echo $page; ?></span>
    <?php if (count($products) === $limit): ?>
      <a href="products.php?q=<?php echo urlencode($q); ?>&page=<?php echo $page+1; ?>">Next &gt;</a>
    <?php endif; ?>
  </div>

  <script>
    // image preview
    (function(){
      var input = document.getElementById('product-image-input');
      var img = document.getElementById('product-image-preview');
      if (!input || !img) return;
      input.addEventListener('change', function(){
        var file = input.files[0];
        if (!file) { img.style.display='none'; img.src=''; return; }
        var reader = new FileReader();
        reader.onload = function(e){ img.src = e.target.result; img.style.display='block'; };
        reader.readAsDataURL(file);
      });
    })();
  </script>

</body>
</html>
