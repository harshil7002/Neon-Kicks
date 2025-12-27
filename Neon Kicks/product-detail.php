<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details - NeonKicks</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .product-detail-page {
      padding-top: 100px;
      min-height: 100vh;
    }
    
    .product-detail-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      margin-top: 2rem;
    }
    
    .product-gallery {
      position: sticky;
      top: 100px;
      height: fit-content;
    }
    
    .main-image {
      width: 100%;
      border-radius: var(--radius-md);
      margin-bottom: 1rem;
      border: 1px solid var(--glass-border);
    }
    
    .thumbnail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
      gap: 1rem;
    }
    
    .thumbnail {
      width: 100%;
      aspect-ratio: 1;
      object-fit: cover;
      border-radius: var(--radius-sm);
      border: 2px solid transparent;
      cursor: pointer;
      transition: all var(--transition-fast);
    }
    
    .thumbnail:hover,
    .thumbnail.active {
      border-color: var(--neon-green);
      box-shadow: var(--shadow-glow);
    }
    
    .size-selector {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
      margin: 1.5rem 0;
    }
    
    .size-chip {
      padding: 0.75rem 1.25rem;
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-sm);
      cursor: pointer;
      transition: all var(--transition-fast);
      font-weight: 600;
    }
    
    .size-chip:hover,
    .size-chip.selected {
      background: var(--neon-green);
      color: var(--black);
      border-color: var(--neon-green);
      box-shadow: var(--shadow-glow);
    }
    
    .feature-list {
      list-style: none;
      margin: 1.5rem 0;
    }
    
    .feature-list li {
      padding: 0.75rem 0;
      border-bottom: 1px solid var(--glass-border);
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    
    .feature-list li i {
      color: var(--neon-green);
    }
    
    @media (max-width: 968px) {
      .product-detail-container {
        grid-template-columns: 1fr;
      }
      
      .product-gallery {
        position: static;
      }
    }
  </style>
</head>
<body>
<?php
include("windows/header.php");
?>
  <section class="product-detail-page">
    <div class="container">
      <div class="product-detail-container" id="productDetail">
        <!-- Content loaded by JavaScript -->
      </div>
    </div>
  </section>

<?php
include("windows/footer.php");
?>
  <script src="script.js"></script>
  <script>
    let selectedSize = null;
    let currentProduct = null;
    
    document.addEventListener('DOMContentLoaded', () => {
      const urlParams = new URLSearchParams(window.location.search);
      const productId = urlParams.get('id');
      console.log('Product ID from URL:', productId);
      console.log('MOCK_PRODUCTS length:', MOCK_PRODUCTS ? MOCK_PRODUCTS.length : 'undefined');
      currentProduct = MOCK_PRODUCTS.find(p => p.id === productId);
      console.log('Found product:', currentProduct);

      if (!currentProduct) {
        console.log('Product not found, redirecting to products.php');
        window.location.href = 'products.php';
        return;
      }

      console.log('Product data:', currentProduct);
      console.log('Images array:', currentProduct.images);
      console.log('Sizes array:', currentProduct.sizes);
      console.log('Features array:', currentProduct.features);
      
      document.getElementById('productDetail').innerHTML = `
        <div class="product-gallery">
          <img src="${currentProduct.image}" alt="${currentProduct.name}" class="main-image glass-card" id="mainImage">
          <div class="thumbnail-grid">
            ${currentProduct.images.map((img, i) => `
              <img src="${img}" alt="${currentProduct.name}" class="thumbnail ${i === 0 ? 'active' : ''}" onclick="changeImage('${img}', this)">
            `).join('')}
          </div>
        </div>
        
        <div class="product-info glass-card" style="padding: 2rem;">
          <h1>${currentProduct.name}</h1>
          <p style="color: var(--gray); margin: 0.5rem 0;">${currentProduct.brand} • ${currentProduct.category}</p>
          
          <div style="display: flex; align-items: center; gap: 0.5rem; margin: 1rem 0;">
            <div style="display: flex; gap: 2px;">
              ${Array(5).fill(0).map((_, i) => `
                <i class="ti ti-star${i < Math.floor(currentProduct.rating) ? '-filled' : ''}" style="color: var(--neon-green); font-size: 1.2rem;"></i>
              `).join('')}
            </div>
            <span style="color: var(--gray);">${currentProduct.rating} (${currentProduct.reviews} reviews)</span>
          </div>
          
          <div class="product-price" style="margin: 1.5rem 0;">
            <span class="price-inr" style="font-size: 2rem;">${formatINR(currentProduct.priceINR)}</span>
            <span class="price-usd" style="font-size: 1.5rem;">${formatUSD(currentProduct.priceUSD)}</span>
          </div>
          
          <div style="padding: 1rem; background: var(--glass-bg); border-radius: var(--radius-sm); margin: 1.5rem 0;">
            <p style="color: var(--neon-green); margin-bottom: 0.5rem;">
              <i class="ti ti-truck-delivery"></i> Free Shipping on orders above ₹2000
            </p>
            <p style="color: var(--neon-green);">
              <i class="ti ti-refresh"></i> 30-day Easy Returns
            </p>
          </div>
          
          <h3 style="margin-top: 2rem;">Select Size</h3>
          <div class="size-selector">
            ${currentProduct.sizes.map(size => `
              <div class="size-chip" onclick="selectSize('${size}', this)">${size}</div>
            `).join('')}
          </div>
          
          <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button class="btn btn-primary" style="flex: 1;" onclick="handleAddToCart()">
              <i class="ti ti-shopping-cart"></i> Add to Cart
            </button>
            <button class="btn btn-secondary" style="flex: 1;" onclick="handleBuyNow()">
              Buy Now
            </button>
          </div>
          
          <h3 style="margin-top: 2rem;">Description</h3>
          <p style="color: var(--gray); line-height: 1.8;">${currentProduct.description}</p>
          
          <h3 style="margin-top: 2rem;">Features</h3>
          <ul class="feature-list">
            ${currentProduct.features.map(feature => `
              <li><i class="ti ti-check"></i> ${feature}</li>
            `).join('')}
          </ul>
        </div>
      `;
    });
    
    function changeImage(src, element) {
      document.getElementById('mainImage').src = src;
      document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
      element.classList.add('active');
    }
    
    function selectSize(size, element) {
      selectedSize = size;
      document.querySelectorAll('.size-chip').forEach(c => c.classList.remove('selected'));
      element.classList.add('selected');
    }
    
    function handleAddToCart() {
      if (!selectedSize) {
        showNotification('Please select a size', 'info');
        return;
      }
      addToCart(currentProduct.id, selectedSize);
    }
    
    function handleBuyNow() {
      if (!selectedSize) {
        showNotification('Please select a size', 'info');
        return;
      }
      
      // Check if user is logged in
      const currentUser = getCurrentUser();
      if (!currentUser) {
        showNotification('Please login to purchase', 'info');
        setTimeout(() => {
          window.location.href = 'login.php?redirect=product-detail.php?id=' + currentProduct.id;
        }, 1500);
        return;
      }
      
      addToCart(currentProduct.id, selectedSize);
      window.location.href = 'checkout.php';
    }
  </script>
</body>
</html>