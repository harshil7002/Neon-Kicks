<?php
include("windows/header.php");
?>
  <style>
    .hero-shoe-page {
      padding-top: 80px;
      min-height: 100vh;
      background: radial-gradient(circle at 50% 50%, rgba(102, 255, 0, 0.05), transparent 70%);
    }
    
    .hero-showcase {
      display: grid;
      grid-template-columns: 1.2fr 1fr;
      gap: 3rem;
      align-items: center;
      min-height: 90vh;
    }
    
    .shoe-3d-container {
      position: relative;
      perspective: 1000px;
    }
    
    .shoe-3d {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      transform-style: preserve-3d;
      animation: rotate3d 20s linear infinite;
      filter: drop-shadow(0 0 50px var(--neon-green-glow));
    }
    
    @keyframes rotate3d {
      0% { transform: rotateY(0deg) rotateX(5deg); }
      100% { transform: rotateY(360deg) rotateX(5deg); }
    }
    
    .shoe-3d:hover {
      animation-play-state: paused;
    }
    
    .feature-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.5rem;
      margin: 2rem 0;
    }
    
    .feature-card {
      background: var(--glass-bg);
      backdrop-filter: var(--glass-blur);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-md);
      padding: 1.5rem;
      text-align: center;
      transition: all var(--transition-normal);
    }
    
    .feature-card:hover {
      border-color: var(--neon-green);
      transform: translateY(-5px);
      box-shadow: var(--shadow-glow);
    }
    
    .feature-card i {
      font-size: 2.5rem;
      color: var(--neon-green);
      margin-bottom: 1rem;
    }
    
    @media (max-width: 968px) {
      .hero-showcase {
        grid-template-columns: 1fr;
      }
      
      .feature-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <section class="hero-shoe-page">
    <div class="container">
      <div class="hero-showcase">
        <div class="shoe-3d-container">
          <div class="glass-card" style="padding: 3rem; text-align: center;">
            <!-- 3D Model Viewer -->
             <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
             <style>
                model-viewer {
                    width: 100%;
                    height: 500px;
                    --poster-color: transparent;
                }
             </style>
            <model-viewer 
                src="assets/icons/nike_air_jordan.glb" 
                alt="NeonKicks Pro Runner 3D Model" 
                shadow-intensity="1" 
                camera-controls 
                auto-rotate
                ar
                style="background-color: transparent;"
            ></model-viewer>
            <p style="color: var(--gray); margin-top: 2rem; font-size: 0.9rem;">
              <i class="ti ti-hand-move"></i> Hover to pause rotation
            </p>
          </div>
        </div>
        
        <div>
          <span style="color: var(--neon-green); text-transform: uppercase; letter-spacing: 2px; font-weight: 600;">Hero Product</span>
          <h1 class="hero-title text-gradient" style="margin: 1rem 0;">NeonKicks Pro Runner</h1>
          <p style="color: var(--gray); font-size: 1.2rem; line-height: 1.8; margin-bottom: 2rem;">
            The ultimate fusion of futuristic design and cutting-edge performance technology. Engineered for athletes who demand the best.
          </p>
          
          <div class="product-price" style="margin: 2rem 0;">
            <span class="price-inr" style="font-size: 2.5rem;">₹12,449</span>
            <span class="price-usd" style="font-size: 1.8rem;">$149.99</span>
          </div>
          
          <div style="display: flex; gap: 1rem; margin-bottom: 3rem;">
            <a href="product-detail.php?id=1" class="btn btn-primary" style="flex: 1;">
              <i class="ti ti-shopping-cart"></i> Buy Now
            </a>
            <a href="products.php" class="btn btn-secondary" style="flex: 1;">
              View All Products
            </a>
          </div>
          
          <div class="glass-card" style="padding: 1.5rem; margin-bottom: 2rem;">
            <h3 style="color: var(--neon-green); margin-bottom: 1rem;">Premium Features</h3>
            <ul style="list-style: none;">
              <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--glass-border);">
                <i class="ti ti-check" style="color: var(--neon-green);"></i> Advanced cushioning technology
              </li>
              <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--glass-border);">
                <i class="ti ti-check" style="color: var(--neon-green);"></i> Breathable mesh upper
              </li>
              <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--glass-border);">
                <i class="ti ti-check" style="color: var(--neon-green);"></i> Neon glow accents for visibility
              </li>
              <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--glass-border);">
                <i class="ti ti-check" style="color: var(--neon-green);"></i> Lightweight carbon fiber sole
              </li>
              <li style="padding: 0.5rem 0;">
                <i class="ti ti-check" style="color: var(--neon-green);"></i> Ergonomic fit for maximum comfort
              </li>
            </ul>
          </div>
        </div>
      </div>
      
      <div style="margin-top: 4rem;">
        <h2 class="text-center text-gradient" style="margin-bottom: 3rem;">Why Choose NeonKicks Pro Runner</h2>
        <div class="feature-grid">
          <div class="feature-card">
            <i class="ti ti-bolt"></i>
            <h3>Lightning Fast</h3>
            <p style="color: var(--gray); margin-top: 0.5rem;">Engineered for speed with responsive cushioning</p>
          </div>
          
          <div class="feature-card">
            <i class="ti ti-shield-check"></i>
            <h3>Durable Build</h3>
            <p style="color: var(--gray); margin-top: 0.5rem;">Premium materials built to last</p>
          </div>
          
          <div class="feature-card">
            <i class="ti ti-wind"></i>
            <h3>Breathable</h3>
            <p style="color: var(--gray); margin-top: 0.5rem;">Advanced ventilation keeps feet cool</p>
          </div>
          
          <div class="feature-card">
            <i class="ti ti-sparkles"></i>
            <h3>Futuristic Design</h3>
            <p style="color: var(--gray); margin-top: 0.5rem;">Stand out with neon aesthetics</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
include("windows/footer.php");
?>
  <script src="script.js"></script>
</body>
</html>