<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - NeonKicks</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .checkout-container {
      display: grid;
      grid-template-columns: 1.5fr 1fr;
      gap: 3rem;
      margin-top: 2rem;
    }
    
    .payment-method {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1.5rem;
      background: var(--glass-bg);
      border: 2px solid var(--glass-border);
      border-radius: var(--radius-md);
      cursor: pointer;
      transition: all var(--transition-fast);
      margin-bottom: 1rem;
    }
    
    .payment-method:hover,
    .payment-method.active {
      border-color: var(--neon-green);
      box-shadow: var(--shadow-glow);
    }
    
    .payment-method input[type="radio"] {
      width: 20px;
      height: 20px;
      accent-color: var(--neon-green);
    }
    
    .payment-method i {
      font-size: 2rem;
      color: var(--neon-green);
    }
    
    .cart-item {
      display: flex;
      gap: 1rem;
      padding: 1rem;
      border-bottom: 1px solid var(--glass-border);
    }
    
    .cart-item img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: var(--radius-sm);
    }
    
    @media (max-width: 968px) {
      .checkout-container {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
<?php
include("windows/header.php");

// Server-side check: must be logged in to checkout
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login
    header("Location: login.php?redirect=checkout.php");
    exit();
}
?>
  <section style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
      <h1 class="text-gradient text-center">Checkout</h1>
      
      <div id="checkoutContent" class="checkout-container">
        <div>
          <div class="glass-card" style="padding: 2rem; margin-bottom: 2rem;">
            <h2 style="color: var(--neon-green); margin-bottom: 1.5rem;">Shipping Information</h2>
            <form id="checkoutForm">
              <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" class="form-input" id="fullName" required>
              </div>

              <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" class="form-input" id="email" required>
              </div>

              <div class="form-group">
                <label class="form-label">Phone Number *</label>
                <input type="tel" class="form-input" id="phone" required placeholder="10-digit number">
              </div>

              <div class="form-group">
                <label class="form-label">Shipping Address *</label>
                <textarea class="form-textarea" id="address" required style="min-height: 100px;"></textarea>
              </div>

              <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                  <label class="form-label">City *</label>
                  <input type="text" class="form-input" id="city" required>
                </div>
                <div class="form-group">
                  <label class="form-label">State *</label>
                  <input type="text" class="form-input" id="state" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Pincode *</label>
                  <input type="text" class="form-input" id="pincode" required>
                </div>
              </div>
            </form>
          </div>

          <div class="glass-card" style="padding: 2rem;">
            <h2 style="color: var(--neon-green); margin-bottom: 1.5rem;">Payment Method</h2>
            
            <div class="payment-method active" onclick="selectPayment('card', this)">
              <input type="radio" name="payment" value="card" checked>
              <i class="ti ti-credit-card"></i>
              <div>
                <h4>Credit/Debit Card</h4>
                <p style="color: var(--gray); font-size: 0.9rem;">Pay securely with your card</p>
              </div>
            </div>

            <div class="payment-method" onclick="selectPayment('upi', this)">
              <input type="radio" name="payment" value="upi">
              <i class="ti ti-qrcode"></i>
              <div>
                <h4>UPI</h4>
                <p style="color: var(--gray); font-size: 0.9rem;">Pay using UPI apps</p>
              </div>
            </div>

            <div class="payment-method" onclick="selectPayment('wallet', this)">
              <input type="radio" name="payment" value="wallet">
              <i class="ti ti-wallet"></i>
              <div>
                <h4>Digital Wallet</h4>
                <p style="color: var(--gray); font-size: 0.9rem;">Pay with digital wallets</p>
              </div>
            </div>

            <div id="cardDetails" style="margin-top: 2rem;">
              <div class="form-group">
                <label class="form-label">Card Number *</label>
                <input type="text" class="form-input" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
              </div>

              <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                  <label class="form-label">Month *</label>
                  <select class="form-select" id="expiryMonth">
                    <option value="">MM</option>
                    ${Array.from({length: 12}, (_, i) => `<option value="${String(i + 1).padStart(2, '0')}">${String(i + 1).padStart(2, '0')}</option>`).join('')}
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label">Year *</label>
                  <select class="form-select" id="expiryYear">
                    <option value="">YYYY</option>
                    ${Array.from({length: 10}, (_, i) => {
                      const year = new Date().getFullYear() + i;
                      return `<option value="${year}">${year}</option>`;
                    }).join('')}
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label">CVV *</label>
                  <input type="text" class="form-input" id="cvv" placeholder="123" maxlength="4">
                </div>
              </div>
            </div>

            <div id="upiDetails" style="display: none; margin-top: 2rem;">
              <div class="form-group">
                <label class="form-label">UPI ID *</label>
                <input type="text" class="form-input" id="upiId" placeholder="yourname@upi">
              </div>
            </div>

            <div id="walletDetails" style="display: none; margin-top: 2rem;">
              <div class="form-group">
                <label class="form-label">Select Wallet *</label>
                <select class="form-select" id="walletType">
                  <option value="">Choose Wallet</option>
                  <option value="paytm">Paytm</option>
                  <option value="phonepe">PhonePe</option>
                  <option value="googlepay">Google Pay</option>
                  <option value="amazonpay">Amazon Pay</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="glass-card" style="padding: 2rem; position: sticky; top: 100px;">
            <h2 style="color: var(--neon-green); margin-bottom: 1.5rem;">Order Summary</h2>
            
            <div id="cartItems" style="margin-bottom: 1.5rem;">
              <!-- Cart items will be loaded here -->
            </div>

            <div style="border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
              <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                <span style="color: var(--gray);">Subtotal</span>
                <span id="subtotalINR">₹0</span>
              </div>
              <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                <span style="color: var(--gray);">Shipping</span>
                <span style="color: var(--neon-green);">FREE</span>
              </div>
              <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; padding-top: 0.75rem; border-top: 1px solid var(--glass-border);">
                <span style="font-weight: 700; font-size: 1.2rem;">Total</span>
                <div style="text-align: right;">
                  <div id="totalINR" style="font-weight: 700; font-size: 1.3rem; color: var(--neon-green);">₹0</div>
                  <div id="totalUSD" style="color: var(--gray); font-size: 0.9rem;">$0.00</div>
                </div>
              </div>
            </div>

            <button class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;" onclick="processPayment()">
              <i class="ti ti-lock"></i> Place Order
            </button>

            <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 1rem; color: var(--gray); font-size: 0.85rem;">
              <i class="ti ti-shield-check" style="color: var(--neon-green);"></i>
              Secure Payment
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Success Modal -->
  <div class="modal" id="successModal">
    <div class="modal-content" style="text-align: center;">
      <i class="ti ti-circle-check" style="font-size: 5rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
      <h2 style="color: var(--neon-green); margin-bottom: 1rem;">Order Confirmed!</h2>
      <p style="color: var(--gray); margin-bottom: 2rem;">
        Thank you for your purchase. Your order has been successfully placed.
      </p>
      <div style="background: var(--glass-bg); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem;">
        <p style="color: var(--gray); margin-bottom: 0.5rem;">Order ID</p>
        <p style="font-family: var(--font-heading); font-size: 1.2rem; color: var(--neon-green);" id="orderId"></p>
      </div>
      <button class="btn btn-primary" onclick="window.location.href='index.php'">
        Continue Shopping
      </button>
    </div>
  </div>
<?php
include("windows/footer.php");
?>

  <script src="script.js"></script>
  <script>
    // Check if cart is empty - redirect to cart page
    if (cart.length === 0) {
      showNotification('Your cart is empty. Add items before checkout.', 'info');
      setTimeout(() => {
        window.location.href = 'cart.php';
      }, 1500);
    } 
    // Server-side redirect handles authentication check, but we can verify client-side if needed 
    // (though server is the source of truth for session)

    
    let selectedPaymentMethod = 'card';
    
    function selectPayment(method, element) {
      selectedPaymentMethod = method;
      document.querySelectorAll('.payment-method').forEach(pm => pm.classList.remove('active'));
      element.classList.add('active');
      
      document.getElementById('cardDetails').style.display = method === 'card' ? 'block' : 'none';
      document.getElementById('upiDetails').style.display = method === 'upi' ? 'block' : 'none';
      document.getElementById('walletDetails').style.display = method === 'wallet' ? 'block' : 'none';
    }
    
    function loadCart() {
      const cartItemsEl = document.getElementById('cartItems');
      
      if (cart.length === 0) {
        cartItemsEl.innerHTML = '<p style="color: var(--gray); text-align: center;">Your cart is empty</p>';
        return;
      }
      
      let totalINR = 0;
      let totalUSD = 0;
      
      cartItemsEl.innerHTML = cart.map(item => {
        totalINR += item.product.priceINR * item.quantity;
        totalUSD += item.product.priceUSD * item.quantity;
        
        return `
          <div class="cart-item">
            <img src="${item.product.image}" alt="${item.product.name}">
            <div style="flex: 1;">
              <h4 style="margin-bottom: 0.25rem;">${item.product.name}</h4>
              <p style="color: var(--gray); font-size: 0.85rem;">Size: ${item.size} | Qty: ${item.quantity}</p>
              <p style="color: var(--neon-green); font-weight: 600; margin-top: 0.5rem;">
                ${formatINR(item.product.priceINR * item.quantity)}
              </p>
            </div>
          </div>
        `;
      }).join('');
      
      document.getElementById('subtotalINR').textContent = formatINR(totalINR);
      document.getElementById('totalINR').textContent = formatINR(totalINR);
      document.getElementById('totalUSD').textContent = formatUSD(totalUSD);
    }
    
    function processPayment() {
      // Validate shipping info
      const fullName = document.getElementById('fullName').value;
      const email = document.getElementById('email').value;
      const phone = document.getElementById('phone').value;
      const address = document.getElementById('address').value;
      const city = document.getElementById('city').value;
      const state = document.getElementById('state').value;
      const pincode = document.getElementById('pincode').value;
      
      if (!fullName || !email || !phone || !address || !city || !state || !pincode) {
        showNotification('Please fill in all shipping information', 'info');
        return;
      }
      
      if (typeof validateEmail === 'function' && !validateEmail(email)) {
        showNotification('Please enter a valid email address', 'info');
        return;
      }
      
      if (typeof validatePhone === 'function' && !validatePhone(phone)) {
        showNotification('Please enter a valid 10-digit phone number', 'info');
        return;
      }
      
      // Validate payment details
      if (selectedPaymentMethod === 'card') {
        const cardNumber = document.getElementById('cardNumber').value;
        const expiryMonth = document.getElementById('expiryMonth').value;
        const expiryYear = document.getElementById('expiryYear').value;
        const cvv = document.getElementById('cvv').value;
        
        if (!cardNumber || !expiryMonth || !expiryYear || !cvv) {
          showNotification('Please fill in all card details', 'info');
          return;
        }
        
        if (typeof validateCardNumber === 'function' && !validateCardNumber(cardNumber)) {
          showNotification('Please enter a valid 16-digit card number', 'info');
          return;
        }
        
        if (typeof validateCVV === 'function' && !validateCVV(cvv)) {
          showNotification('Please enter a valid CVV', 'info');
          return;
        }
      } else if (selectedPaymentMethod === 'upi') {
        const upiId = document.getElementById('upiId').value;
        if (!upiId) {
          showNotification('Please enter your UPI ID', 'info');
          return;
        }
      } else if (selectedPaymentMethod === 'wallet') {
        const walletType = document.getElementById('walletType').value;
        if (!walletType) {
          showNotification('Please select a wallet', 'info');
          return;
        }
      }
      
      // Prepare payload
      const totalINR = cart.reduce((sum, item) => sum + (item.product.priceINR * item.quantity), 0);
      const totalUSD = cart.reduce((sum, item) => sum + (item.product.priceUSD * item.quantity), 0);
      
      const payload = {
        items: cart,
        shipping_info: { fullName, email, phone, address, city, state, pincode },
        payment_method: selectedPaymentMethod,
        totalINR,
        totalUSD
      };

      // Send to server
      fetch('api/v1/orders/create.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })
      .then(async res => {
          const text = await res.text();
          let data = null;
          try { data = JSON.parse(text); } catch (e) {}

          if (res.ok && data && data.success) {
               // Success
               const orderId = data.orderId || 'NK' + Date.now().toString().slice(-8);
               document.getElementById('orderId').textContent = orderId;
               
               // Also save to localStorage for legacy/offline support or immediate UI update
               if (getCurrentUser()) {
                   const orders = JSON.parse(localStorage.getItem('neonkicks-orders')) || [];
                   const order = {
                     orderId,
                     userId: getCurrentUser().id,
                     items: [...cart],
                     totalINR,
                     totalUSD,
                     shippingInfo: payload.shipping_info,
                     paymentMethod: selectedPaymentMethod,
                     status: 'confirmed',
                     createdAt: new Date().toISOString()
                   };
                   orders.push(order);
                   localStorage.setItem('neonkicks-orders', JSON.stringify(orders));
               }

               // Clear cart
               cart = [];
               saveCart();
               
               // Show success modal
               openModal('successModal');
          } else {
             const msg = (data && data.message) ? data.message : 'Order placement failed';
             if (res.status === 401) {
                 showNotification('Session expired. Please login again.', 'error');
                 setTimeout(() => window.location.href = 'login.php', 2000);
             } else {
                 showNotification(msg, 'error');
             }
          }
      })
      .catch(err => {
          console.error('Order error:', err);
          showNotification('Unable to contact server. Please try again.', 'error');
      });
    }
    
    // Format card number input
    document.getElementById('cardNumber')?.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\s/g, '');
      let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
      e.target.value = formattedValue;
    });
    
    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
      // Only load cart if user is logged in and cart is not empty
      if (cart.length > 0 && getCurrentUser()) {
        loadCart();
      }
    });
  </script>
</body>
</html>