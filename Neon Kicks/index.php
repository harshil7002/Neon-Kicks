<?php
include("windows/header.php")
?>
<body>
  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-bg" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 50% 50%, rgba(102, 255, 0, 0.1), transparent 50%); z-index: 0;"></div>
    <div class="container" style="position: relative; z-index: 1;">
      <div class="hero-grid">
        <div class="hero-content">
          <h1 class="hero-title text-gradient" style="margin-bottom: 1.5rem;">
            Step Into The Future
          </h1>
          <p style="font-size: 1.3rem; color: var(--gray); margin-bottom: 2rem;">
            Experience the next generation of footwear with NeonKicks. Premium design meets cutting-edge technology.
          </p>
          <div style="display: flex; gap: 1rem;">
            <a href="products.php" class="btn btn-primary">Shop Now</a>
            <a href="hero-shoe.php" class="btn btn-secondary">View Hero Shoe</a>
          </div>
        </div>
        
        <div class="hero-shoe" style="position: relative;">
          <div class="glass-card animate-float" style="padding: 2rem; text-align: center;">
            <img src="https://images.unsplash.com/photo-1696889645027-9b8e5efc1914?w=600" alt="NeonKicks Pro Runner" style="width: 100%; max-width: 380px; filter: drop-shadow(0 0 30px var(--neon-green-glow));" class="animate-glow">
            <h3 style="margin-top: 1.5rem; color: var(--neon-green);">NeonKicks Pro Runner</h3>
            <p style="color: var(--gray); margin: 0.5rem 0;">The Ultimate Performance Shoe</p>
            <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1rem;">
              <span class="price-inr">₹12,449</span>
              <span class="price-usd">$149.99</span>
            </div>
            <a href="hero-shoe.php" class="btn btn-primary" style="margin-top: 1.5rem;">Explore 3D View</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="featured-products" style="padding: 4rem 0;">
    <div class="container">
      <div style="text-align: center; margin-bottom: 3rem;">
        <h2 class="text-gradient">Featured Collection</h2>
        <p style="color: var(--gray); margin-top: 1rem;">Discover our handpicked selection of premium footwear</p>
      </div>
      
      <div class="product-grid" id="featuredGrid">
        <!-- Products will be loaded here by JavaScript -->
      </div>
      
      <div style="text-align: center; margin-top: 3rem;">
        <a href="products.php" class="btn btn-secondary">View All Products</a>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features" style="padding: 4rem 0; background: var(--dark-gray);">
    <div class="container">
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
        <div class="glass-card" style="padding: 2rem; text-align: center;">
          <i class="ti ti-truck-delivery" style="font-size: 3rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
          <h3 style="margin-bottom: 0.5rem;">Free Shipping</h3>
          <p style="color: var(--gray);">On orders above ₹2000</p>
        </div>
        
        <div class="glass-card" style="padding: 2rem; text-align: center;">
          <i class="ti ti-refresh" style="font-size: 3rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
          <h3 style="margin-bottom: 0.5rem;">Easy Returns</h3>
          <p style="color: var(--gray);">30-day return policy</p>
        </div>
        
        <div class="glass-card" style="padding: 2rem; text-align: center;">
          <i class="ti ti-credit-card" style="font-size: 3rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
          <h3 style="margin-bottom: 0.5rem;">Secure Payment</h3>
          <p style="color: var(--gray);">100% secure transactions</p>
        </div>
        
        <div class="glass-card" style="padding: 2rem; text-align: center;">
          <i class="ti ti-star-filled" style="font-size: 3rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
          <h3 style="margin-bottom: 0.5rem;">Premium Quality</h3>
          <p style="color: var(--gray);">Authentic products only</p>
        </div>
      </div>
    </div>
  </section>
<?php
include("windows/footer.php")
?>
</body>
</html>