<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Browse our complete collection of 70+ premium shoes at NeonKicks">
  <title>Products - NeonKicks</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .products-page {
      padding-top: 100px;
      min-height: 100vh;
    }
    
    .products-container {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 2rem;
      margin-top: 2rem;
    }
    
    .filters-sidebar {
      position: sticky;
      top: 100px;
      height: fit-content;
    }
    
    .filter-section {
      margin-bottom: 2rem;
    }
    
    .filter-section h3 {
      color: var(--neon-green);
      margin-bottom: 1rem;
      font-size: 1.1rem;
    }
    
    .filter-option {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.5rem;
      cursor: pointer;
    }
    
    .filter-option input[type="checkbox"] {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: var(--neon-green);
    }
    
    .filter-option label {
      cursor: pointer;
      color: var(--gray);
      transition: color var(--transition-fast);
    }
    
    .filter-option:hover label {
      color: var(--white);
    }
    
    .price-range {
      display: flex;
      gap: 1rem;
      align-items: center;
    }
    
    .price-input {
      width: 80px;
      padding: 0.5rem;
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-sm);
      color: var(--white);
      text-align: center;
    }
    
    .products-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      flex-wrap: wrap;
      gap: 1rem;
    }
    
    .search-bar {
      flex: 1;
      max-width: 400px;
      position: relative;
    }
    
    .search-bar input {
      width: 100%;
      padding: 0.75rem 2.5rem 0.75rem 1rem;
      background: var(--glass-bg);
      backdrop-filter: var(--glass-blur);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-sm);
      color: var(--white);
      font-size: 1rem;
    }
    
    .search-bar i {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
    }
    
    .sort-dropdown {
      padding: 0.75rem 1rem;
      background: var(--glass-bg);
      backdrop-filter: var(--glass-blur);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-sm);
      color: var(--white);
      cursor: pointer;
    }
    
    .products-count {
      color: var(--gray);
    }
    
    @media (max-width: 968px) {
      .products-container {
        grid-template-columns: 1fr;
      }
      
      .filters-sidebar {
        position: static;
      }
    }
  </style>
</head>
<body>
<?php
include("windows/header.php");
?>
<?php
// Server-side product fetch for search results
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/Product.php';
$database = new Database();
$db = $database->getConnection();
$productModel = new Product($db);
$searchQuery = trim($_GET['search'] ?? '');
$filters = ['limit' => 1000, 'offset' => 0];
if ($searchQuery !== '') $filters['search'] = $searchQuery;
$products_from_db = $productModel->getAll($filters);

// Normalize products for client-side rendering
$server_products = array_map(function($p){
  $image = $p['image_url'] ?? '';
  if (!$image) {
    $image = 'https://via.placeholder.com/500';
  } else {
    // If the image is not an absolute URL, try to resolve it to an absolute URL
    if (!preg_match('#^https?://#i', $image)) {
      $imagePath = ltrim($image, '/');
      // Build a base URL that includes the current script folder so paths work when the project isn't at web root
      $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
      $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
      $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
      $baseUrl = $scheme . '://' . $host . $scriptDir;

      // If the file exists relative to project root, use that; otherwise use the script directory
      $docPath = $_SERVER['DOCUMENT_ROOT'] ?? __DIR__;
      if (file_exists($docPath . '/' . $imagePath)) {
        $image = $scheme . '://' . $host . '/' . $imagePath;
      } else {
        $image = $baseUrl . '/' . $imagePath;
      }
    }
  }
  return [
    'id' => (string)($p['id'] ?? ''),
    'name' => $p['name'] ?? '',
    'brand' => $p['brand'] ?? '',
    'category' => $p['category'] ?? '',
    'priceUSD' => (float)($p['price_usd'] ?? 0),
    'priceINR' => (float)($p['price_inr'] ?? 0),
    'image' => $image,
    'images' => $p['images'] ? json_decode($p['images'], true) : ($image ? [$image] : []),
    'sizes' => $p['sizes'] ? json_decode($p['sizes'], true) : [],
    'colors' => $p['colors'] ? json_decode($p['colors'], true) : [],
    'description' => $p['description'] ?? '',
    'inStock' => !empty($p['in_stock']),
    'rating' => (float)($p['rating'] ?? 0),
    'reviews' => (int)($p['review_count'] ?? 0)
  ];
}, $products_from_db);
?>
  <!-- Products Page -->
  <section class="products-page">
    <div class="container">
      <h1 class="text-gradient text-center">Our Complete Collection</h1>
      <p class="text-center" style="color: var(--gray); margin-top: 1rem;">Explore 70+ premium shoes from top brands</p>
      
      <div class="products-container">
        <!-- Filters Sidebar -->
        <aside class="filters-sidebar glass-card" style="padding: 1.5rem;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="color: var(--neon-green);">
              <i class="ti ti-filter"></i> Filters
            </h2>
            <button class="btn-glass" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="clearFilters()">
              Clear All
            </button>
          </div>
          
          <!-- Brand Filter -->
          <div class="filter-section">
            <h3>Brand</h3>
            <div id="brandFilters"></div>
          </div>
          
          <!-- Category Filter -->
          <div class="filter-section">
            <h3>Category</h3>
            <div id="categoryFilters"></div>
          </div>
          
          <!-- Color Filter -->
          <div class="filter-section">
            <h3>Color</h3>
            <div id="colorFilters"></div>
          </div>
          
          <!-- Price Range -->
          <div class="filter-section">
            <h3>Price Range (USD)</h3>
            <div class="price-range">
              <input type="number" class="price-input" id="minPrice" value="0" min="0" placeholder="Min">
              <span style="color: var(--gray);">-</span>
              <input type="number" class="price-input" id="maxPrice" value="300" min="0" placeholder="Max">
            </div>
            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;" onclick="applyPriceFilter()">
              Apply
            </button>
          </div>
        </aside>
        
        <!-- Products Grid -->
        <div>
          <div class="products-header">
            <div class="search-bar">
              <input type="text" id="searchInput" placeholder="Search products...">
              <button id="searchBtn" class="btn" style="position:absolute;right:40px;top:6px;padding:6px 10px;border-radius:6px;">Search</button>
              <i class="ti ti-search" id="searchIconInline" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--gray);"></i>
            </div>
            
            <select class="sort-dropdown" id="sortSelect" style="display:none;">
              <option value="popular">Most Popular</option>
              <option value="price-low-high">Price: Low to High</option>
              <option value="price-high-low">Price: High to Low</option>
              <option value="newest">Newest First</option>
            </select>
            <div id="customSort" class="custom-select" role="listbox" tabindex="0" aria-haspopup="true" aria-expanded="false">
              <span class="custom-select-label">Most Popular</span>
              <i class="ti ti-chevrons-down" style="margin-left:8px;color:var(--gray);"></i>
            </div>
            
            <div class="products-count" id="productsCount">
              Showing 0 products
            </div>
          </div>
          
          <div class="product-grid" id="productsGrid">
            <!-- Products will be loaded here -->
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
include("windows/footer.php");
?>
  <script src="script.js"></script>
  <script>
    // Inject server-side products (if any)
    <?php if (!empty($server_products)): ?>
    window.SERVER_PRODUCTS = <?php echo json_encode($server_products, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;
    <?php else: ?>
    window.SERVER_PRODUCTS = [];
    <?php endif; ?>

    // Merge server-provided products with the local mock catalog so the page shows a complete collection.
    // Priority: server product fields replace mock ones by `id`, and any server-only products are appended.
    const ALL_PRODUCTS = (function(){
      const base = [...MOCK_PRODUCTS];
      if (Array.isArray(window.SERVER_PRODUCTS) && window.SERVER_PRODUCTS.length > 0) {
        const serverMap = new Map(window.SERVER_PRODUCTS.map(p => [String(p.id), p]));
        // Replace matching mock products with server versions
        const merged = base.map(p => serverMap.get(String(p.id)) || p);
        // Add server products that weren't in mocks
        window.SERVER_PRODUCTS.forEach(p => {
          if (!merged.find(x => String(x.id) === String(p.id))) merged.push(p);
        });
        return merged;
      }
      return base;
    })();

    // Working copy used for rendering and filtering
    let filteredProducts = ALL_PRODUCTS.slice();

    // Override the generic filterProducts (defined in script.js) so filtering uses the merged ALL_PRODUCTS
    function filterProducts() {
      let filtered = [...ALL_PRODUCTS];

      // Search
      if (currentFilters.searchQuery) {
        const q = currentFilters.searchQuery.toLowerCase();
        filtered = filtered.filter(p => 
          (p.name || '').toLowerCase().includes(q) ||
          (p.brand || '').toLowerCase().includes(q) ||
          (p.category || '').toLowerCase().includes(q)
        );
      }

      // Brands
      if (currentFilters.brands.length > 0) {
        filtered = filtered.filter(p => currentFilters.brands.includes(p.brand));
      }

      // Colors
      if (currentFilters.colors.length > 0) {
        filtered = filtered.filter(p => (p.colors || []).some(c => currentFilters.colors.includes(c)));
      }

      // Categories
      if (currentFilters.categories.length > 0) {
        filtered = filtered.filter(p => currentFilters.categories.includes(p.category));
      }

      // Price range (assume USD)
      filtered = filtered.filter(p => {
        const price = Number(p.priceUSD || p.priceUSD === 0 ? p.priceUSD : (p.priceINR ? p.priceINR / 83.3333 : 0));
        return price >= (currentFilters.priceRange.min || 0) && price <= (currentFilters.priceRange.max || Number.MAX_SAFE_INTEGER);
      });

      // Sort
      switch (currentFilters.sortBy) {
        case 'price-low-high':
          filtered.sort((a, b) => (a.priceUSD || 0) - (b.priceUSD || 0));
          break;
        case 'price-high-low':
          filtered.sort((a, b) => (b.priceUSD || 0) - (a.priceUSD || 0));
          break;
        case 'newest':
          filtered.sort((a, b) => String(b.id).localeCompare(String(a.id)));
          break;
        case 'popular':
        default:
          filtered.sort((a, b) => (b.reviews || 0) - (a.reviews || 0));
          break;
      }

      return filtered;
    }

    // Initialize filters
    function initFilters() {
      const brands = [...new Set(ALL_PRODUCTS.map(p => p.brand))].sort();
      const categories = [...new Set(ALL_PRODUCTS.map(p => p.category))].sort();
      const colors = [...new Set(ALL_PRODUCTS.flatMap(p => p.colors || []))].sort();
      
      document.getElementById('brandFilters').innerHTML = brands.map(brand => `
        <div class="filter-option">
          <input type="checkbox" id="brand-${brand}" value="${brand}" onchange="applyFilters()">
          <label for="brand-${brand}">${brand}</label>
        </div>
      `).join('');
      
      document.getElementById('categoryFilters').innerHTML = categories.map(category => `
        <div class="filter-option">
          <input type="checkbox" id="category-${category}" value="${category}" onchange="applyFilters()">
          <label for="category-${category}">${category}</label>
        </div>
      `).join('');
      
      document.getElementById('colorFilters').innerHTML = colors.map(color => `
        <div class="filter-option">
          <input type="checkbox" id="color-${color}" value="${color}" onchange="applyFilters()">
          <label for="color-${color}">${color}</label>
        </div>
      `).join('');
    }
    
    // Apply filters
    function applyFilters() {
      const selectedBrands = Array.from(document.querySelectorAll('#brandFilters input:checked')).map(cb => cb.value);
      const selectedCategories = Array.from(document.querySelectorAll('#categoryFilters input:checked')).map(cb => cb.value);
      const selectedColors = Array.from(document.querySelectorAll('#colorFilters input:checked')).map(cb => cb.value);
      const searchQuery = document.getElementById('searchInput').value.toLowerCase();
      const minPrice = parseFloat(document.getElementById('minPrice').value) || 0;
      const maxPrice = parseFloat(document.getElementById('maxPrice').value) || 1000;
      
      currentFilters = {
        brands: selectedBrands,
        categories: selectedCategories,
        colors: selectedColors,
        searchQuery,
        priceRange: { min: minPrice, max: maxPrice },
        sortBy: document.getElementById('sortSelect').value
      };
      
      filteredProducts = filterProducts();
      renderProducts();
    }
    
    function applyPriceFilter() {
      applyFilters();
    }
    
    function clearFilters() {
      document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
      document.getElementById('searchInput').value = '';
      document.getElementById('minPrice').value = '0';
      document.getElementById('maxPrice').value = '300';
      document.getElementById('sortSelect').value = 'popular';
      applyFilters();
    }
    
    // Render products
    function renderProducts() {
      const grid = document.getElementById('productsGrid');
      document.getElementById('productsCount').textContent = `Showing ${filteredProducts.length} products`;
      
      grid.innerHTML = filteredProducts.map(product => `
        <div class="product-card" onclick="window.location.href='product-detail.php?id=${product.id}'">
          <img src="${product.image}" alt="${product.name}" class="product-image" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='https://via.placeholder.com/500?text=No+Image'">
          <div class="product-info">
            <h3 class="product-name">${product.name}</h3>
            <p style="color: var(--gray); font-size: 0.9rem;">${product.brand} • ${product.category}</p>
            <div style="display: flex; align-items: center; gap: 0.5rem; margin: 0.5rem 0;">
              <div style="display: flex; gap: 2px;">
                ${Array(5).fill(0).map((_, i) => `
                  <i class="ti ti-star${i < Math.floor(product.rating) ? '-filled' : ''}" style="color: var(--neon-green); font-size: 0.9rem;"></i>
                `).join('')}
              </div>
              <span style="color: var(--gray); font-size: 0.85rem;">(${product.reviews})</span>
            </div>
            <div class="product-price">
              <span class="price-inr">${formatINR(product.priceINR)}</span>
              <span class="price-usd">${formatUSD(product.priceUSD)}</span>
            </div>
            ${product.inStock ? 
              `<button class="btn btn-primary" style="width: 100%; margin-top: 1rem;" onclick="event.stopPropagation(); window.location.href='product-detail.php?id=${product.id}'">View Details</button>` :
              `<button class="btn btn-glass" style="width: 100%; margin-top: 1rem;" disabled>Out of Stock</button>`
            }
          </div>
        </div>
      `).join('');
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
      initFilters();
      renderProducts();
      
      // Check for search query parameter
      const urlParams = new URLSearchParams(window.location.search);
      const searchQuery = urlParams.get('search');
      if (searchQuery) {
        document.getElementById('searchInput').value = searchQuery;
        applyFilters();
      }
      
      // Search input
      const searchInputEl = document.getElementById('searchInput');
      if (searchInputEl) {
        // keep live filtering for convenience
        searchInputEl.addEventListener('input', applyFilters);
        // Enter key navigates to server-side search results page
        searchInputEl.addEventListener('keydown', (e) => {
          if (e.key === 'Enter') {
            const q = searchInputEl.value.trim();
            window.location.href = 'products.php' + (q ? ('?search=' + encodeURIComponent(q)) : '');
          }
        });
      }
      const searchBtnEl = document.getElementById('searchBtn');
      if (searchBtnEl) searchBtnEl.addEventListener('click', () => {
        const q = searchInputEl ? searchInputEl.value.trim() : '';
        window.location.href = 'products.php' + (q ? ('?search=' + encodeURIComponent(q)) : '');
      });
      const searchIconInline = document.getElementById('searchIconInline');
      if (searchIconInline) searchIconInline.addEventListener('click', () => {
        const q = searchInputEl ? searchInputEl.value.trim() : '';
        window.location.href = 'products.php' + (q ? ('?search=' + encodeURIComponent(q)) : '');
      });
      
      // Sort dropdown
      document.getElementById('sortSelect').addEventListener('change', applyFilters);
    });
  </script>
</body>
</html>