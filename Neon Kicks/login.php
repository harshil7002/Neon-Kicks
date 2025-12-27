<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - NeonKicks</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .auth-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      background: radial-gradient(circle at 30% 50%, rgba(102, 255, 0, 0.1), transparent 50%),
                  radial-gradient(circle at 70% 50%, rgba(0, 229, 255, 0.1), transparent 50%);
    }
    
    .auth-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      max-width: 1000px;
      width: 100%;
      background: var(--glass-bg);
      backdrop-filter: var(--glass-blur);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-lg);
      overflow: hidden;
      box-shadow: var(--shadow-card);
    }
    
    .auth-visual {
      background: linear-gradient(135deg, rgba(102, 255, 0, 0.1), rgba(0, 229, 255, 0.1));
      padding: 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    
    .auth-visual::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(102, 255, 0, 0.2) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .auth-visual-content {
      position: relative;
      z-index: 1;
    }
    
    .auth-visual img {
      width: 100%;
      max-width: 300px;
      filter: drop-shadow(0 0 30px var(--neon-green-glow));
      animation: float 3s ease-in-out infinite;
    }
    
    .auth-form-container {
      padding: 3rem;
    }
    
    .auth-tabs {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
      border-bottom: 1px solid var(--glass-border);
    }
    
    .auth-tab {
      flex: 1;
      padding: 1rem;
      background: none;
      border: none;
      color: var(--gray);
      font-family: var(--font-heading);
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all var(--transition-fast);
      border-bottom: 2px solid transparent;
    }
    
    .auth-tab.active {
      color: var(--neon-green);
      border-bottom-color: var(--neon-green);
    }
    
    .auth-form {
      display: none;
    }
    
    .auth-form.active {
      display: block;
    }
    
    .social-login {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-top: 1.5rem;
    }
    
    .social-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.75rem;
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-sm);
      color: var(--white);
      font-weight: 500;
      cursor: pointer;
      transition: all var(--transition-fast);
    }
    
    .social-btn:hover {
      border-color: var(--neon-green);
      box-shadow: var(--shadow-glow);
    }
    
    .divider {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin: 1.5rem 0;
      color: var(--gray);
    }
    
    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--glass-border);
    }
    
    .password-toggle {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--gray);
      cursor: pointer;
      font-size: 1.2rem;
      transition: color var(--transition-fast);
    }
    
    .password-toggle:hover {
      color: var(--neon-green);
    }
    
    @media (max-width: 968px) {
      .auth-container {
        grid-template-columns: 1fr;
      }
      
      .auth-visual {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="auth-page">
    <div class="auth-container">
      <div class="auth-visual">
        <div class="auth-visual-content">
          <a href="index.php" class="logo" style="font-size: 2.5rem; text-decoration: none; margin-bottom: 2rem; display: block;">
            NeonKicks
          </a>
          <img src="https://images.unsplash.com/photo-1696889645027-9b8e5efc1914?w=400" alt="NeonKicks Shoe">
          <h2 style="margin-top: 2rem; margin-bottom: 1rem;">Step Into The Future</h2>
          <p style="color: var(--gray);">Join thousands of sneaker enthusiasts worldwide</p>
          
          <div style="margin-top: 3rem; display: flex; gap: 1rem; justify-content: center;">
            <div style="text-align: center;">
              <div style="font-size: 2rem; font-weight: 700; color: var(--neon-green);">70+</div>
              <div style="color: var(--gray); font-size: 0.9rem;">Products</div>
            </div>
            <div style="width: 1px; background: var(--glass-border);"></div>
            <div style="text-align: center;">
              <div style="font-size: 2rem; font-weight: 700; color: var(--neon-green);">10K+</div>
              <div style="color: var(--gray); font-size: 0.9rem;">Customers</div>
            </div>
            <div style="width: 1px; background: var(--glass-border);"></div>
            <div style="text-align: center;">
              <div style="font-size: 2rem; font-weight: 700; color: var(--neon-green);">4.8</div>
              <div style="color: var(--gray); font-size: 0.9rem;">Rating</div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="auth-form-container">
        <div class="auth-tabs">
          <button class="auth-tab active" onclick="switchTab('login')">Login</button>
          <button class="auth-tab" onclick="switchTab('signup')">Sign Up</button>
        </div>
        
        <!-- Login Form -->
        <form class="auth-form active" id="loginForm">
          <h2 style="color: var(--neon-green); margin-bottom: 1.5rem;">Welcome Back!</h2>
          
          <div class="form-group">
            <label class="form-label">Email Address *</label>
            <input type="email" class="form-input" id="loginEmail" required placeholder="your@email.com">
          </div>
          
          <div class="form-group" style="position: relative;">
            <label class="form-label">Password *</label>
            <input type="password" class="form-input" id="loginPassword" required placeholder="Enter your password">
            <button type="button" class="password-toggle" onclick="togglePassword('loginPassword')">
              <i class="ti ti-eye"></i>
            </button>
          </div>
          
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
              <input type="checkbox" style="width: 18px; height: 18px; accent-color: var(--neon-green);">
              <span style="color: var(--gray); font-size: 0.9rem;">Remember me</span>
            </label>
            <a href="#" style="color: var(--neon-green); text-decoration: none; font-size: 0.9rem;">Forgot Password?</a>
          </div>
          
          <button type="submit" class="btn btn-primary" style="width: 100%;">
            <i class="ti ti-login"></i> Login
          </button>
          <div style="text-align:center;margin-top:0.75rem;">
            <a id="backHomeLink" href="index.php" style="color:var(--neon-green);text-decoration:none;">← Back to Home</a>
          </div>
          
          <div class="divider">or continue with</div>
          
          <div class="social-login">
            <button type="button" class="social-btn" onclick="socialLogin('google')">
              <i class="ti ti-brand-google"></i> Google
            </button>
            <button type="button" class="social-btn" onclick="socialLogin('facebook')">
              <i class="ti ti-brand-facebook"></i> Facebook
            </button>
          </div>
        </form>
        
        <!-- Signup Form -->
        <form class="auth-form" id="signupForm">
          <h2 style="color: var(--neon-green); margin-bottom: 1.5rem;">Create Account</h2>
          
          <div class="form-group">
            <label class="form-label">Full Name *</label>
            <input type="text" class="form-input" id="signupName" required placeholder="John Doe">
          </div>
          
          <div class="form-group">
            <label class="form-label">Email Address *</label>
            <input type="email" class="form-input" id="signupEmail" required placeholder="your@email.com">
          </div>
          
          <div class="form-group">
            <label class="form-label">Phone Number *</label>
            <input type="tel" class="form-input" id="signupPhone" required placeholder="10-digit number">
          </div>
          
          <div class="form-group" style="position: relative;">
            <label class="form-label">Password *</label>
            <input type="password" class="form-input" id="signupPassword" required placeholder="Create a strong password">
            <button type="button" class="password-toggle" onclick="togglePassword('signupPassword')">
              <i class="ti ti-eye"></i>
            </button>
          </div>
          
          <div class="form-group" style="position: relative;">
            <label class="form-label">Confirm Password *</label>
            <input type="password" class="form-input" id="signupConfirmPassword" required placeholder="Re-enter password">
            <button type="button" class="password-toggle" onclick="togglePassword('signupConfirmPassword')">
              <i class="ti ti-eye"></i>
            </button>
          </div>
          
          <div style="margin-bottom: 1.5rem;">
            <label style="display: flex; align-items: start; gap: 0.5rem; cursor: pointer;">
              <input type="checkbox" required style="width: 18px; height: 18px; margin-top: 0.25rem; accent-color: var(--neon-green);">
              <span style="color: var(--gray); font-size: 0.9rem;">
                I agree to the <a href="#" style="color: var(--neon-green); text-decoration: none;">Terms & Conditions</a> and <a href="#" style="color: var(--neon-green); text-decoration: none;">Privacy Policy</a>
              </span>
            </label>
          </div>
          
          <button type="submit" class="btn btn-primary" style="width: 100%;">
            <i class="ti ti-user-plus"></i> Create Account
          </button>
          
          <div class="divider">or sign up with</div>
          
          <div class="social-login">
            <button type="button" class="social-btn" onclick="socialLogin('google')">
              <i class="ti ti-brand-google"></i> Google
            </button>
            <button type="button" class="social-btn" onclick="socialLogin('facebook')">
              <i class="ti ti-brand-facebook"></i> Facebook
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
  <script>
    function switchTab(tab) {
      // Update tabs
      document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
      event.target.classList.add('active');
      
      // Update forms
      document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));
      document.getElementById(tab + 'Form').classList.add('active');
    }
    
    function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      const icon = event.currentTarget.querySelector('i');
      
      if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'ti ti-eye-off';
      } else {
        input.type = 'password';
        icon.className = 'ti ti-eye';
      }
    }
    
    function socialLogin(provider) {
      showNotification(`${provider.charAt(0).toUpperCase() + provider.slice(1)} login coming soon!`, 'info');
    }
    
    // Login Form Handler
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const email = document.getElementById('loginEmail').value;
      const password = document.getElementById('loginPassword').value;

      if (!validateEmail(email)) {
        showNotification('Please enter a valid email address', 'info');
        return;
      }

      if (password.length < 6) {
        showNotification('Password must be at least 6 characters', 'info');
        return;
      }

      // Try server-side login first (creates PHP session)
      const payload = { email, password };
      const redirectUrl = new URLSearchParams(window.location.search).get('redirect') || 'index.php';

      fetch('api/v1/auth/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify(payload)
      })
      .then(async res => {
        const text = await res.text().catch(() => '');
        let data = null;
        try { data = JSON.parse(text); } catch (e) { /* non-JSON */ }

        console.debug('Login response', { status: res.status, body: text, parsed: data });

        if (res.ok && data && data.success) {
          const user = data.user;
          try { localStorage.setItem('neonkicks-current-user', JSON.stringify(user)); } catch (err) {}
          showNotification('Login successful! Redirecting...', 'success');
          // If the authenticated user is admin, always send to admin dashboard
          if (user.role === 'admin') {
            setTimeout(() => { window.location.href = 'admin/index.php'; }, 700);
            return;
          }
          setTimeout(() => { window.location.href = redirectUrl; }, 900);
          return;
        }

        // Fallback to localStorage users if server auth failed
        const users = JSON.parse(localStorage.getItem('neonkicks-users')) || [];
        const localUser = users.find(u => u.email === email && u.password === password);
        if (localUser) {
          localStorage.setItem('neonkicks-current-user', JSON.stringify(localUser));
          showNotification('Login successful! (local)', 'success');
          setTimeout(() => { window.location.href = 'index.php'; }, 900);
          return;
        }

        const msg = (data && data.message) ? data.message : (text || 'Invalid email or password');
        showNotification(msg, 'info');
      })
      .catch(err => {
        console.error('Login request failed', err);
        const users = JSON.parse(localStorage.getItem('neonkicks-users')) || [];
        const user = users.find(u => u.email === email && u.password === password);
        if (user) {
          localStorage.setItem('neonkicks-current-user', JSON.stringify(user));
          showNotification('Login successful! (offline)', 'success');
          setTimeout(() => { window.location.href = 'index.php'; }, 900);
        } else {
          showNotification('Unable to contact server and local login failed', 'info');
        }
      });
    });
    
    // Signup Form Handler
    document.getElementById('signupForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const name = document.getElementById('signupName').value;
      const email = document.getElementById('signupEmail').value;
      const phone = document.getElementById('signupPhone').value;
      const password = document.getElementById('signupPassword').value;
      const confirmPassword = document.getElementById('signupConfirmPassword').value;
      
      if (!validateEmail(email)) {
        showNotification('Please enter a valid email address', 'info');
        return;
      }
      
      if (typeof validatePhone === 'function' && !validatePhone(phone)) {
        showNotification('Please enter a valid 10-digit phone number', 'info');
        return;
      }
      
      if (password.length < 6) {
        showNotification('Password must be at least 6 characters', 'info');
        return;
      }
      
      if (password !== confirmPassword) {
        showNotification('Passwords do not match', 'info');
        return;
      }
      
      const payload = { name, email, phone, password };

      fetch('api/v1/auth/signup.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })
      .then(async res => {
          const text = await res.text();
          let data = null;
          try { data = JSON.parse(text); } catch(e) {}

          if (res.ok && data && data.success) {
              showNotification(data.message || 'Account created successfully!', 'success');
              showNotification(data.message || 'Account created successfully!', 'success');
              
              // Switch to login and pre-fill email
              if (typeof switchTab === 'function') {
                  document.getElementById('loginEmail').value = email;
                  switchTab('login');
                  showNotification('Please login with your new account', 'info');
              } else {
                  setTimeout(() => window.location.reload(), 1500);
              }
          } else {
              const msg = (data && data.message) ? data.message : 'Registration failed';
              showNotification(msg, 'error');
          }
      })
      .catch(err => {
          console.error('Signup error:', err);
          showNotification('Unable to contact server. Please try again later.', 'error');
      });
    });
    
    // Check if user is already logged in
    document.addEventListener('DOMContentLoaded', () => {
      const currentUser = localStorage.getItem('neonkicks-current-user');
      if (currentUser) {
        const urlParams = new URLSearchParams(window.location.search);
        if (!urlParams.get('force')) {
          window.location.href = 'index.php';
        }
      }
      // Check for tab/action URL parameters
      const urlParams = new URLSearchParams(window.location.search);
      const outputTab = urlParams.get('tab') || urlParams.get('action');
      if (outputTab === 'signup' || outputTab === 'register') {
          switchTab('signup');
      }

      // Set back-home link to respect redirect when present
      const backLink = document.getElementById('backHomeLink');
      if (backLink) {
        const redirect = urlParams.get('redirect');
        backLink.href = redirect ? redirect : 'index.php';
      }
    });

    // Helper validation if not in script.js
    if (typeof validatePhone !== 'function') {
        window.validatePhone = function(phone) {
            return /^\d{10}$/.test(phone.replace(/\D/g, ''));
        };
    }
  </script>
</body>
</html>