// ===========================
// MOCK DATA
// ===========================

const MOCK_PRODUCTS = [
  {
    id: '1',
    name: 'NeonKicks Pro Runner',
    brand: 'Nike',
    category: 'Running',
    priceUSD: 149.99,
    priceINR: 12449,
    image: 'https://images.unsplash.com/photo-1696889645027-9b8e5efc1914?w=500',
    images: [
      'https://images.unsplash.com/photo-1696889645027-9b8e5efc1914?w=500',
      'https://images.unsplash.com/photo-1719759674376-a001dc166cb6?w=500'
    ],
    sizes: ['7', '8', '9', '10', '11', '12'],
    colors: ['Green', 'Black'],
    description: 'Premium futuristic running shoes with neon green accents. Engineered for maximum performance and style.',
    features: ['Lightweight design', 'Breathable mesh upper', 'Responsive cushioning', 'Neon glow accents', 'Durable rubber outsole'],
    inStock: true,
    isHero: true,
    rating: 4.8,
    reviews: 234
  },
  {
    id: '2',
    name: 'Shadow Strike',
    brand: 'Adidas',
    category: 'Casual',
    priceUSD: 129.99,
    priceINR: 10789,
    image: 'https://images.unsplash.com/photo-1562668288-599305dfd285?w=500',
    images: ['https://images.unsplash.com/photo-1562668288-599305dfd285?w=500'],
    sizes: ['7', '8', '9', '10', '11'],
    colors: ['Black', 'White'],
    description: 'Sleek black sneakers perfect for everyday wear with modern design.',
    features: ['Premium leather', 'Comfortable fit', 'Versatile style', 'Cushioned insole'],
    inStock: true,
    rating: 4.5,
    reviews: 156
  },
  {
    id: '3',
    name: 'Cloud Walker',
    brand: 'New Balance',
    category: 'Lifestyle',
    priceUSD: 119.99,
    priceINR: 9959,
    image: 'https://images.unsplash.com/photo-1699092372518-2dd5c28eb566?w=500',
    images: ['https://images.unsplash.com/photo-1699092372518-2dd5c28eb566?w=500'],
    sizes: ['6', '7', '8', '9', '10', '11', '12'],
    colors: ['White'],
    description: 'Minimalist white sneakers with clean lines and ultimate comfort.',
    features: ['Minimalist design', 'All-day comfort', 'Easy to clean', 'Lightweight'],
    inStock: true,
    rating: 4.7,
    reviews: 189
  },
  {
    id: '4',
    name: 'Velocity Red',
    brand: 'Puma',
    category: 'Sports',
    priceUSD: 139.99,
    priceINR: 11619,
    image: 'https://images.unsplash.com/photo-1581068506097-9eb0677b95af?w=500',
    images: ['https://images.unsplash.com/photo-1581068506097-9eb0677b95af?w=500'],
    sizes: ['7', '8', '9', '10', '11', '12'],
    colors: ['Red', 'White'],
    description: 'Dynamic red sports shoes designed for peak athletic performance.',
    features: ['High-performance', 'Energy return', 'Breathable', 'Secure fit'],
    inStock: true,
    rating: 4.6,
    reviews: 142
  },
  {
    id: '5',
    name: 'Sky Hopper',
    brand: 'Jordan',
    category: 'Basketball',
    priceUSD: 179.99,
    priceINR: 14939,
    image: 'https://images.unsplash.com/photo-1615450996941-33dc3878a88a?w=500',
    images: ['https://images.unsplash.com/photo-1615450996941-33dc3878a88a?w=500'],
    sizes: ['8', '9', '10', '11', '12'],
    colors: ['Blue', 'White'],
    description: 'High-top basketball shoes with superior ankle support and style.',
    features: ['High-top design', 'Ankle support', 'Court traction', 'Premium cushioning'],
    inStock: true,
    rating: 4.9,
    reviews: 298
  },
  {
    id: '6',
    name: 'Urban Stealth',
    brand: 'Vans',
    category: 'Casual',
    priceUSD: 89.99,
    priceINR: 7469,
    image: 'https://images.unsplash.com/photo-1509717030864-56dcbd57463e?w=500',
    images: ['https://images.unsplash.com/photo-1509717030864-56dcbd57463e?w=500'],
    sizes: ['6', '7', '8', '9', '10', '11'],
    colors: ['Black'],
    description: 'Classic black sneakers with timeless appeal.',
    features: ['Classic design', 'Durable canvas', 'Comfortable', 'Versatile'],
    inStock: true,
    rating: 4.4,
    reviews: 112
  },
  {
    id: '7',
    name: 'Neon Flash',
    brand: 'Under Armour',
    category: 'Running',
    priceUSD: 134.99,
    priceINR: 11204,
    image: 'https://images.unsplash.com/photo-1578765133656-22895d7652b9?w=500',
    images: ['https://images.unsplash.com/photo-1578765133656-22895d7652b9?w=500'],
    sizes: ['7', '8', '9', '10', '11', '12'],
    colors: ['Green', 'Black'],
    description: 'High-performance running shoes with neon accents for visibility.',
    features: ['Reflective details', 'Lightweight', 'Responsive', 'Breathable mesh'],
    inStock: true,
    rating: 4.7,
    reviews: 167
  },
  {
    id: '8',
    name: 'Storm Breaker',
    brand: 'Reebok',
    category: 'Training',
    priceUSD: 124.99,
    priceINR: 10374,
    image: 'https://images.unsplash.com/photo-1608472206291-2c9708b1e59e?w=500',
    images: ['https://images.unsplash.com/photo-1608472206291-2c9708b1e59e?w=500'],
    sizes: ['7', '8', '9', '10', '11'],
    colors: ['Black', 'White'],
    description: 'Versatile training shoes built for intense workouts.',
    features: ['Multi-directional traction', 'Stable base', 'Flexible', 'Durable'],
    inStock: true,
    rating: 4.5,
    reviews: 134
  },
  {
    id: '9',
    name: 'Glacier White',
    brand: 'Converse',
    category: 'Lifestyle',
    priceUSD: 79.99,
    priceINR: 6639,
    image: 'https://images.unsplash.com/photo-1653179767820-357d9145cb98?w=500',
    images: ['https://images.unsplash.com/photo-1653179767820-357d9145cb98?w=500'],
    sizes: ['6', '7', '8', '9', '10', '11', '12'],
    colors: ['White'],
    description: 'Clean white sneakers perfect for any casual outfit.',
    features: ['Iconic style', 'Canvas upper', 'Comfortable', 'Easy to style'],
    inStock: true,
    rating: 4.6,
    reviews: 201
  },
  {
    id: '10',
    name: 'Thunder Blue',
    brand: 'Asics',
    category: 'Running',
    priceUSD: 144.99,
    priceINR: 12034,
    image: 'https://images.unsplash.com/photo-1616258372736-f5e5d5337d6e?w=500',
    images: ['https://images.unsplash.com/photo-1616258372736-f5e5d5337d6e?w=500'],
    sizes: ['7', '8', '9', '10', '11', '12'],
    colors: ['Blue', 'White'],
    description: 'Advanced running shoes with gel cushioning technology.',
    features: ['GEL cushioning', 'Lightweight', 'Breathable', 'Impact absorption'],
    inStock: true,
    rating: 4.8,
    reviews: 223
  }
];

// Generate additional products to reach 70+
for (let i = 11; i <= 70; i++) {
  const brands = ['Nike', 'Adidas', 'Puma', 'Reebok', 'New Balance', 'Converse', 'Vans', 'Jordan', 'Under Armour', 'Asics'];
  const categories = ['Running', 'Casual', 'Sports', 'Sneakers', 'Basketball', 'Training', 'Lifestyle'];
  const colors = ['Black', 'White', 'Red', 'Blue', 'Green', 'Gray'];
  const images = [
    'https://images.unsplash.com/photo-1562668288-599305dfd285?w=500',
    'https://images.unsplash.com/photo-1509717030864-56dcbd57463e?w=500',
    'https://images.unsplash.com/photo-1699092372518-2dd5c28eb566?w=500',
    'https://images.unsplash.com/photo-1581068506097-9eb0677b95af?w=500',
    'https://images.unsplash.com/photo-1615450996941-33dc3878a88a?w=500'
  ];
  
  MOCK_PRODUCTS.push({
    id: i.toString(),
    name: `Shoe Model ${i}`,
    brand: brands[Math.floor(Math.random() * brands.length)],
    category: categories[Math.floor(Math.random() * categories.length)],
    priceUSD: Math.floor(Math.random() * 100) + 80,
    priceINR: Math.floor((Math.random() * 100 + 80) * 83),
    image: images[Math.floor(Math.random() * images.length)],
    images: [images[Math.floor(Math.random() * images.length)]],
    sizes: ['7', '8', '9', '10', '11', '12'],
    colors: [colors[Math.floor(Math.random() * colors.length)]],
    description: 'Premium quality shoes designed for comfort and style.',
    features: ['Comfortable fit', 'Durable materials', 'Modern design', 'Great value'],
    inStock: Math.random() > 0.1,
    rating: (Math.random() * 1.5 + 3.5).toFixed(1),
    reviews: Math.floor(Math.random() * 200) + 50
  });
}

// ===========================
// GLOBAL STATE
// ===========================

let cart = JSON.parse(localStorage.getItem('neonkicks-cart')) || [];
let currentFilters = {
  brands: [],
  colors: [],
  priceRange: { min: 0, max: 300 },
  categories: [],
  searchQuery: '',
  sortBy: 'popular'
};

// ===========================
// UTILITY FUNCTIONS
// ===========================

function formatINR(price) {
  return `₹${price.toLocaleString('en-IN')}`;
}

function formatUSD(price) {
  return `$${price.toFixed(2)}`;
}

function saveCart() {
  localStorage.setItem('neonkicks-cart', JSON.stringify(cart));
  updateCartCount();
}

function updateCartCount() {
  const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
  const cartCountEl = document.querySelector('.cart-count');
  if (cartCountEl) {
    cartCountEl.textContent = cartCount;
    cartCountEl.style.display = cartCount > 0 ? 'flex' : 'none';
  }
}

function addToCart(productId, size) {
  const product = MOCK_PRODUCTS.find(p => p.id === productId);
  if (!product) return;
  
  const existingItem = cart.find(item => item.product.id === productId && item.size === size);
  
  if (existingItem) {
    existingItem.quantity++;
  } else {
    cart.push({ product, size, quantity: 1 });
  }
  
  saveCart();
  showNotification('Added to cart!', 'success');
}

function removeFromCart(productId, size) {
  cart = cart.filter(item => !(item.product.id === productId && item.size === size));
  saveCart();
}

function showNotification(message, type = 'info') {
  // Remove any existing notifications first
  const existingNotifications = document.querySelectorAll('.notification');
  existingNotifications.forEach(notif => notif.remove());
  
  const notification = document.createElement('div');
  notification.className = `notification notification-${type}`;
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed;
    top: 90px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--neon-green);
    padding: 1rem 2rem;
    border-radius: var(--radius-sm);
    color: var(--white);
    z-index: 10001;
    box-shadow: var(--shadow-card);
    min-width: 300px;
    max-width: 500px;
    text-align: center;
    animation: slideInTop 0.3s ease;
  `;
  
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.style.animation = 'slideOutTop 0.3s ease';
    setTimeout(() => notification.remove(), 300);
  }, 3000);
}

// ===========================
// NAVIGATION
// ===========================

function initNavigation() {
  const hamburger = document.querySelector('.hamburger');
  const navMenu = document.querySelector('.nav-menu');
  
  if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
      navMenu.classList.toggle('active');
    });
    
    // Close menu when clicking on a link
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('active');
      });
    });
  }
}

// ===========================
// HEADER SEARCH
// ===========================
function initHeaderSearch() {
  const searchIcon = document.getElementById('searchIcon');
  if (!searchIcon) return;

  function openSearchOverlay(initialValue = '') {
    // prevent multiple overlays
    if (document.getElementById('nk-search-overlay')) return;

    const overlay = document.createElement('div');
    overlay.id = 'nk-search-overlay';
    overlay.style.cssText = `position:fixed;top:0;left:0;right:0;z-index:10005;display:flex;justify-content:center;padding:20px;pointer-events:none;`;

    const box = document.createElement('div');
    box.style.cssText = `pointer-events:auto;max-width:700px;width:100%;background:var(--glass-bg);backdrop-filter:var(--glass-blur);border:1px solid var(--glass-border);border-radius:8px;padding:12px;display:flex;gap:8px;align-items:center;`;

    const input = document.createElement('input');
    input.type = 'search';
    input.placeholder = 'Search products...' ;
    input.value = initialValue;
    input.style.cssText = 'flex:1;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.06);background:transparent;color:var(--white);outline:none;';

    const btn = document.createElement('button');
    btn.textContent = 'Search';
    btn.className = 'btn btn-primary';

    const close = document.createElement('button');
    close.innerHTML = '✕';
    close.style.cssText = 'background:none;border:none;color:var(--gray);font-size:18px;cursor:pointer;padding:6px;border-radius:6px;';

    box.appendChild(input);
    box.appendChild(btn);
    box.appendChild(close);
    overlay.appendChild(box);
    document.body.appendChild(overlay);

    setTimeout(() => input.focus(), 50);

    function doSearch() {
      const q = input.value.trim();
      const target = 'products.php' + (q ? `?search=${encodeURIComponent(q)}` : '');
      window.location.href = target;
    }

    btn.addEventListener('click', doSearch);
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') doSearch();
      if (e.key === 'Escape') removeOverlay();
    });
    close.addEventListener('click', removeOverlay);

    function removeOverlay() {
      overlay.remove();
    }

    // click outside to close
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) removeOverlay();
    });
  }

  searchIcon.style.cursor = 'pointer';
  searchIcon.addEventListener('click', (e) => {
    // if on products page and input exists, focus it
    const pageInput = document.getElementById('searchInput');
    if (pageInput) {
      pageInput.focus();
      return;
    }
    openSearchOverlay('');
  });
}

// ===========================
// PRODUCT FILTERING
// ===========================

function filterProducts() {
  let filtered = [...MOCK_PRODUCTS];
  
  // Search
  if (currentFilters.searchQuery) {
    filtered = filtered.filter(p => 
      p.name.toLowerCase().includes(currentFilters.searchQuery.toLowerCase()) ||
      p.brand.toLowerCase().includes(currentFilters.searchQuery.toLowerCase())
    );
  }
  
  // Brands
  if (currentFilters.brands.length > 0) {
    filtered = filtered.filter(p => currentFilters.brands.includes(p.brand));
  }
  
  // Colors
  if (currentFilters.colors.length > 0) {
    filtered = filtered.filter(p => 
      p.colors.some(c => currentFilters.colors.includes(c))
    );
  }
  
  // Categories
  if (currentFilters.categories.length > 0) {
    filtered = filtered.filter(p => currentFilters.categories.includes(p.category));
  }
  
  // Price range
  filtered = filtered.filter(p => 
    p.priceUSD >= currentFilters.priceRange.min && 
    p.priceUSD <= currentFilters.priceRange.max
  );
  
  // Sort
  switch (currentFilters.sortBy) {
    case 'price-low-high':
      filtered.sort((a, b) => a.priceUSD - b.priceUSD);
      break;
    case 'price-high-low':
      filtered.sort((a, b) => b.priceUSD - a.priceUSD);
      break;
    case 'newest':
      filtered.sort((a, b) => b.id.localeCompare(a.id));
      break;
    case 'popular':
      filtered.sort((a, b) => (b.reviews || 0) - (a.reviews || 0));
      break;
  }
  
  return filtered;
}

  // Custom sort dropdown: render options in body to avoid clipping inside transformed elements
  (function(){
    document.addEventListener('DOMContentLoaded', function(){
      const native = document.getElementById('sortSelect');
      const custom = document.getElementById('customSort');
      if (!native || !custom) return;

      const opts = Array.from(native.options).map(o => ({ value: o.value, label: o.text }));

      function openMenu() {
        closeMenu();
        const rect = custom.getBoundingClientRect();
        const menu = document.createElement('div');
        menu.className = 'custom-select-menu';
        menu.style.minWidth = Math.max(rect.width, 180) + 'px';
        menu.style.left = (rect.left + window.scrollX) + 'px';
        menu.style.top = (rect.bottom + window.scrollY + 6) + 'px';

        opts.forEach(opt => {
          const it = document.createElement('div');
          it.className = 'item';
          it.textContent = opt.label;
          it.dataset.value = opt.value;
          if (native.value === opt.value) it.classList.add('active');
          it.addEventListener('click', function(e){
            native.value = opt.value;
            native.dispatchEvent(new Event('change', { bubbles: true }));
            document.querySelector('.custom-select-label').textContent = opt.label;
            closeMenu();
          });
          menu.appendChild(it);
        });

        document.body.appendChild(menu);

        // close on outside click
        setTimeout(()=>{
          document.addEventListener('click', onDocClick);
        }, 10);

        function onDocClick(e){ if (!menu.contains(e.target) && !custom.contains(e.target)) closeMenu(); }
        function closeMenu(){
          const existing = document.querySelectorAll('.custom-select-menu');
          existing.forEach(n=>n.remove());
          document.removeEventListener('click', onDocClick);
        }
      }

      custom.addEventListener('click', function(e){ e.stopPropagation(); openMenu(); });
      // sync label on native change
      native.addEventListener('change', function(){ const opt = native.options[native.selectedIndex]; document.querySelector('.custom-select-label').textContent = opt.text; });
    });
  })();

// ===========================
// MODAL FUNCTIONS
// ===========================

function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('active');
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('active');
  }
}

// ===========================
// CART MODAL FUNCTIONS
// ===========================

function openCartModal() {
  let cartModal = document.getElementById('cartModal');
  
  if (!cartModal) {
    // Create cart modal if it doesn't exist
    cartModal = document.createElement('div');
    cartModal.id = 'cartModal';
    cartModal.className = 'modal';
    cartModal.innerHTML = `
      <div class="modal-content" style="max-width: 600px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
          <h2 style="color: var(--neon-green);">
            <i class="ti ti-shopping-cart"></i> Shopping Cart
          </h2>
          <i class="ti ti-x modal-close" onclick="closeModal('cartModal')"></i>
        </div>
        <div id="cartModalItems" style="max-height: 400px; overflow-y: auto; margin-bottom: 2rem;">
          <!-- Cart items will be loaded here -->
        </div>
        <div style="border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
          <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
            <span style="font-size: 1.2rem; font-weight: 600;">Total:</span>
            <div style="text-align: right;">
              <div id="cartModalTotalINR" style="font-size: 1.3rem; color: var(--neon-green); font-weight: 700;">₹0</div>
              <div id="cartModalTotalUSD" style="color: var(--gray); font-size: 0.9rem;">$0.00</div>
            </div>
          </div>
          <button class="btn btn-primary" style="width: 100%;" onclick="window.location.href='checkout.php'">
            <i class="ti ti-credit-card"></i> Proceed to Checkout
          </button>
          <button class="btn btn-secondary" style="width: 100%; margin-top: 1rem;" onclick="closeModal('cartModal')">
            Continue Shopping
          </button>
        </div>
      </div>
    `;
    document.body.appendChild(cartModal);
    
    // Close modal when clicking outside
    cartModal.addEventListener('click', (e) => {
      if (e.target === cartModal) {
        closeModal('cartModal');
      }
    });
  }
  
  renderCartModal();
  openModal('cartModal');
}

function renderCartModal() {
  const cartItemsEl = document.getElementById('cartModalItems');
  
  if (cart.length === 0) {
    cartItemsEl.innerHTML = `
      <div style="text-align: center; padding: 3rem 0;">
        <i class="ti ti-shopping-cart" style="font-size: 4rem; color: var(--gray); margin-bottom: 1rem;"></i>
        <p style="color: var(--gray);">Your cart is empty</p>
        <button class="btn btn-primary" style="margin-top: 1.5rem;" onclick="closeModal('cartModal'); window.location.href='products.php'">
          Start Shopping
        </button>
      </div>
    `;
    document.getElementById('cartModalTotalINR').textContent = '₹0';
    document.getElementById('cartModalTotalUSD').textContent = '$0.00';
    return;
  }
  
  let totalINR = 0;
  let totalUSD = 0;
  
  cartItemsEl.innerHTML = cart.map((item, index) => {
    totalINR += item.product.priceINR * item.quantity;
    totalUSD += item.product.priceUSD * item.quantity;
    
    return `
      <div style="display: flex; gap: 1rem; padding: 1rem; border-bottom: 1px solid var(--glass-border); align-items: center;">
        <img src="${item.product.image}" alt="${item.product.name}" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius-sm);">
        <div style="flex: 1;">
          <h4 style="margin-bottom: 0.25rem;">${item.product.name}</h4>
          <p style="color: var(--gray); font-size: 0.85rem;">Size: ${item.size}</p>
          <p style="color: var(--neon-green); font-weight: 600; margin-top: 0.5rem;">
            ${formatINR(item.product.priceINR)} × ${item.quantity}
          </p>
        </div>
        <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
          <div style="display: flex; align-items: center; gap: 0.5rem; background: var(--glass-bg); border-radius: var(--radius-sm); padding: 0.25rem;">
            <button onclick="updateCartQuantity(${index}, -1)" style="background: none; border: none; color: var(--white); cursor: pointer; padding: 0.25rem 0.5rem; font-size: 1.2rem;">
              <i class="ti ti-minus"></i>
            </button>
            <span style="min-width: 30px; text-align: center; font-weight: 600;">${item.quantity}</span>
            <button onclick="updateCartQuantity(${index}, 1)" style="background: none; border: none; color: var(--white); cursor: pointer; padding: 0.25rem 0.5rem; font-size: 1.2rem;">
              <i class="ti ti-plus"></i>
            </button>
          </div>
          <button onclick="removeCartItem(${index})" style="background: none; border: none; color: var(--gray); cursor: pointer; padding: 0.25rem; transition: color var(--transition-fast);" onmouseover="this.style.color='var(--neon-green)'" onmouseout="this.style.color='var(--gray)'">
            <i class="ti ti-trash"></i>
          </button>
        </div>
      </div>
    `;
  }).join('');
  
  document.getElementById('cartModalTotalINR').textContent = formatINR(totalINR);
  document.getElementById('cartModalTotalUSD').textContent = formatUSD(totalUSD);
}

function updateCartQuantity(index, change) {
  if (cart[index]) {
    cart[index].quantity += change;
    if (cart[index].quantity <= 0) {
      cart.splice(index, 1);
    }
    saveCart();
    renderCartModal();
  }
}

function removeCartItem(index) {
  cart.splice(index, 1);
  saveCart();
  renderCartModal();
  showNotification('Item removed from cart', 'info');
}

// ===========================
// FORM VALIDATION
// ===========================

function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validatePhone(phone) {
  return /^\d{10}$/.test(phone.replace(/\D/g, ''));
}

function validateCardNumber(cardNumber) {
  return /^\d{16}$/.test(cardNumber.replace(/\s/g, ''));
}

function validateCVV(cvv) {
  return /^\d{3,4}$/.test(cvv);
}

// ===========================
// USER AUTHENTICATION
// ===========================

function getCurrentUser() {
  const userStr = localStorage.getItem('neonkicks-current-user');
  return userStr ? JSON.parse(userStr) : null;
}

function logout() {
  localStorage.removeItem('neonkicks-current-user');
  showNotification('Logged out successfully', 'info');
  setTimeout(() => {
    window.location.href = 'login.php';
  }, 1000);
}

function updateUserUI() {
  const user = getCurrentUser();
  const userIcon = document.querySelector('.nav-icons .ti-user');
  
  if (user && userIcon) {
    // Create user dropdown
    const userContainer = userIcon.parentElement;
    userContainer.style.position = 'relative';
    userContainer.style.cursor = 'pointer';
    
    // Add click handler
    userIcon.addEventListener('click', () => {
      let dropdown = document.getElementById('userDropdown');
      
      if (!dropdown) {
        dropdown = document.createElement('div');
        dropdown.id = 'userDropdown';
        dropdown.style.cssText = `
          position: absolute;
          top: 100%;
          right: 0;
          margin-top: 1rem;
          background: var(--glass-bg);
          backdrop-filter: var(--glass-blur);
          border: 1px solid var(--glass-border);
          border-radius: var(--radius-md);
          padding: 1rem;
          min-width: 200px;
          box-shadow: var(--shadow-card);
          z-index: 1000;
          display: none;
        `;
        
        dropdown.innerHTML = `
          <div style="padding-bottom: 0.75rem; border-bottom: 1px solid var(--glass-border); margin-bottom: 0.75rem;">
            <div style="font-weight: 600; margin-bottom: 0.25rem;">${user.name}</div>
            <div style="color: var(--gray); font-size: 0.85rem;">${user.email}</div>
          </div>
          <a href="#" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; color: var(--white); text-decoration: none; border-radius: var(--radius-sm); transition: all var(--transition-fast);" onmouseover="this.style.background='var(--glass-bg)'" onmouseout="this.style.background='transparent'">
            <i class="ti ti-user"></i> My Profile
          </a>
          <a href="#" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; color: var(--white); text-decoration: none; border-radius: var(--radius-sm); transition: all var(--transition-fast);" onmouseover="this.style.background='var(--glass-bg)'" onmouseout="this.style.background='transparent'">
            <i class="ti ti-package"></i> My Orders
          </a>
          <a href="#" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; color: var(--white); text-decoration: none; border-radius: var(--radius-sm); transition: all var(--transition-fast);" onmouseover="this.style.background='var(--glass-bg)'" onmouseout="this.style.background='transparent'">
            <i class="ti ti-heart"></i> Wishlist
          </a>
          <div style="border-top: 1px solid var(--glass-border); margin-top: 0.75rem; padding-top: 0.75rem;">
            <a href="#" onclick="logout(); return false;" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; color: var(--neon-green); text-decoration: none; border-radius: var(--radius-sm); transition: all var(--transition-fast);" onmouseover="this.style.background='var(--glass-bg)'" onmouseout="this.style.background='transparent'">
              <i class="ti ti-logout"></i> Logout
            </a>
          </div>
        `;
        
        userContainer.appendChild(dropdown);
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
          if (!userContainer.contains(e.target)) {
            dropdown.style.display = 'none';
          }
        });
      }
      
      dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });
  } else if (userIcon) {
    // Not logged in - redirect to login
    userIcon.addEventListener('click', () => {
      window.location.href = 'login.php';
    });
    userIcon.style.cursor = 'pointer';
  }
}

// ===========================
// INITIALIZE
// ===========================

document.addEventListener('DOMContentLoaded', () => {
  initNavigation();
  initHeaderSearch();
  updateCartCount();
  updateUserUI();
  
  // Add cart icon click handler
  const cartIcon = document.getElementById('cartIcon');
  if (cartIcon) {
    cartIcon.addEventListener('click', openCartModal);
    cartIcon.style.cursor = 'pointer';
  }
  
  // Add CSS animations
  const style = document.createElement('style');
  style.textContent = `
    @keyframes slideInTop {
      from {
        transform: translateX(-50%) translateY(-100%);
        opacity: 0;
      }
      to {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
      }
    }
    
    @keyframes slideOutTop {
      from {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
      }
      to {
        transform: translateX(-50%) translateY(-100%);
        opacity: 0;
      }
    }
  `;
  document.head.appendChild(style);
});

// Export for use in other pages
if (typeof module !== 'undefined' && module.exports) {
  module.exports = {
    MOCK_PRODUCTS,
    cart,
    addToCart,
    removeFromCart,
    formatINR,
    formatUSD,
    filterProducts,
    showNotification,
    openModal,
    closeModal
  };
}