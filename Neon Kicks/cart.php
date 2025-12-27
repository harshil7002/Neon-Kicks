<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart - NeonKicks</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .cart-page {
      padding-top: 120px;
      min-height: 100vh;
    }
    
    .cart-container {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 2rem;
      margin-top: 2rem;
    }
    
    .cart-item-card {
      background: var(--glass-bg);
      backdrop-filter: var(--glass-blur);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-md);
      padding: 1.5rem;
      margin-bottom: 1rem;
      display: flex;
      gap: 1.5rem;
      align-items: center;
      transition: all var(--transition-normal);
    }
    
    .cart-item-card:hover {
      border-color: var(--neon-green);
      box-shadow: var(--shadow-glow);
    }
    
    .cart-item-image {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: var(--radius-sm);
    }
    
    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 1rem;
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-sm);
      padding: 0.5rem 1rem;
    }
    
    .quantity-btn {
      background: none;
      border: none;
      color: var(--white);
      cursor: pointer;
      font-size: 1.3rem;
      padding: 0.25rem 0.5rem;
      transition: color var(--transition-fast);
    }
    
    .quantity-btn:hover {
      color: var(--neon-green);
    }
    
    .quantity-value {
      min-width: 40px;
      text-align: center;
      font-weight: 600;
      font-size: 1.1rem;
    }
    
    @media (max-width: 968px) {
      .cart-container {
        grid-template-columns: 1fr;
      }
      
      .cart-item-card {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>
<body>

<?php
include("windows/header.php");
?>
  <section class="cart-page">
    <div class="container">
      <h1 class="text-gradient text-center">Shopping Cart</h1>
      
      <div class="cart-container">
        <div>
          <div id="cartItemsList">
            <!-- Cart items will be loaded here -->
          </div>
          
          <div style="margin-top: 2rem;">
            <a href="products.php" class="btn btn-secondary">
              <i class="ti ti-arrow-left"></i> Continue Shopping
            </a>
          </div>
        </div>
        
        <div>
          <div class="glass-card" style="padding: 2rem; position: sticky; top: 100px;">
            <h2 style="color: var(--neon-green); margin-bottom: 1.5rem;">Order Summary</h2>
            
            <div style="margin-bottom: 1.5rem;">
              <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                <span style="color: var(--gray);">Items (<span id="itemCount">0</span>)</span>
                <span id="subtotalINR">₹0</span>
              </div>
              <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                <span style="color: var(--gray);">Shipping</span>
                <span style="color: var(--neon-green);">FREE</span>
              </div>
              <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                <span style="color: var(--gray);">Tax</span>
                <span>Included</span>
              </div>
            </div>
            
            <div style="border-top: 1px solid var(--glass-border); padding-top: 1.5rem; margin-bottom: 1.5rem;">
              <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="font-weight: 700; font-size: 1.2rem;">Total</span>
                <div style="text-align: right;">
                  <div id="totalINR" style="font-weight: 700; font-size: 1.4rem; color: var(--neon-green);">₹0</div>
                  <div id="totalUSD" style="color: var(--gray); font-size: 0.9rem;">$0.00</div>
                </div>
              </div>
            </div>
            
            <button class="btn btn-primary" style="width: 100%;" onclick="proceedToCheckout()">
              <i class="ti ti-credit-card"></i> Proceed to Checkout
            </button>
            
            <div style="margin-top: 1.5rem; padding: 1rem; background: var(--glass-bg); border-radius: var(--radius-sm); text-align: center;">
              <p style="color: var(--gray); font-size: 0.85rem; margin-bottom: 0.5rem;">
                <i class="ti ti-truck-delivery" style="color: var(--neon-green);"></i> Free shipping on orders above ₹2000
              </p>
              <p style="color: var(--gray); font-size: 0.85rem;">
                <i class="ti ti-shield-check" style="color: var(--neon-green);"></i> Secure checkout
              </p>
            </div>
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
    function loadCartPage() {
      const cartItemsList = document.getElementById('cartItemsList');
      
      if (cart.length === 0) {
        cartItemsList.innerHTML = `
          <div class="glass-card" style="padding: 4rem; text-align: center;">
            <i class="ti ti-shopping-cart" style="font-size: 5rem; color: var(--gray); margin-bottom: 1.5rem;"></i>
            <h2 style="color: var(--gray); margin-bottom: 1rem;">Your cart is empty</h2>
            <p style="color: var(--gray); margin-bottom: 2rem;">Add some awesome shoes to get started!</p>
            <a href="products.php" class="btn btn-primary">
              <i class="ti ti-shopping-bag"></i> Start Shopping
            </a>
          </div>
        `;
        updateSummary();
        return;
      }
      
      cartItemsList.innerHTML = cart.map((item, index) => `
        <div class="cart-item-card">
          <img src="${item.product.image}" alt="${item.product.name}" class="cart-item-image">
          
          <div style="flex: 1;">
            <h3 style="margin-bottom: 0.5rem;">${item.product.name}</h3>
            <p style="color: var(--gray); margin-bottom: 0.5rem;">${item.product.brand} • ${item.product.category}</p>
            <p style="color: var(--gray); font-size: 0.9rem; margin-bottom: 1rem;">Size: ${item.size}</p>
            
            <div style="display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
              <div class="quantity-controls">
                <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">
                  <i class="ti ti-minus"></i>
                </button>
                <span class="quantity-value">${item.quantity}</span>
                <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">
                  <i class="ti ti-plus"></i>
                </button>
              </div>
              
              <div>
                <div style="font-size: 1.3rem; color: var(--neon-green); font-weight: 700;">
                  ${formatINR(item.product.priceINR * item.quantity)}
                </div>
                <div style="color: var(--gray); font-size: 0.9rem;">
                  ${formatUSD(item.product.priceUSD * item.quantity)}
                </div>
              </div>
            </div>
          </div>
          
          <button onclick="removeItem(${index})" style="background: none; border: none; color: var(--gray); cursor: pointer; font-size: 1.5rem; padding: 0.5rem; transition: all var(--transition-fast);" onmouseover="this.style.color='var(--neon-green)'; this.style.transform='scale(1.2)'" onmouseout="this.style.color='var(--gray)'; this.style.transform='scale(1)'">
            <i class="ti ti-trash"></i>
          </button>
        </div>
      `).join('');
      
      updateSummary();
    }
    
    function updateQuantity(index, change) {
      if (cart[index]) {
        cart[index].quantity += change;
        if (cart[index].quantity <= 0) {
          cart.splice(index, 1);
        }
        saveCart();
        loadCartPage();
      }
    }
    
    function removeItem(index) {
      cart.splice(index, 1);
      saveCart();
      loadCartPage();
      showNotification('Item removed from cart', 'info');
    }
    
    function updateSummary() {
      let totalINR = 0;
      let totalUSD = 0;
      let itemCount = 0;
      
      cart.forEach(item => {
        totalINR += item.product.priceINR * item.quantity;
        totalUSD += item.product.priceUSD * item.quantity;
        itemCount += item.quantity;
      });
      
      document.getElementById('itemCount').textContent = itemCount;
      document.getElementById('subtotalINR').textContent = formatINR(totalINR);
      document.getElementById('totalINR').textContent = formatINR(totalINR);
      document.getElementById('totalUSD').textContent = formatUSD(totalUSD);
    }
    
    function proceedToCheckout() {
      if (cart.length === 0) {
        showNotification('Your cart is empty', 'info');
        return;
      }
      
      // Check if user is logged in
      const currentUser = getCurrentUser();
      if (!currentUser) {
        showNotification('Please login to proceed with checkout', 'info');
        setTimeout(() => {
          window.location.href = 'login.php?redirect=checkout.php';
        }, 1500);
        return;
      }
      
      window.location.href = 'checkout.php';
    }
    
    document.addEventListener('DOMContentLoaded', () => {
      loadCartPage();
    });
  </script>
</body>
</html>