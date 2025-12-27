<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - NeonKicks</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("windows/header.php");
?>
  <section style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
      <div style="text-align: center; margin-bottom: 4rem;">
        <h1 class="hero-title text-gradient">Get In Touch</h1>
        <p style="color: var(--gray); font-size: 1.2rem; margin-top: 1rem;">
          We'd love to hear from you. Send us a message!
        </p>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; margin-bottom: 4rem;">
        <div class="glass-card" style="padding: 3rem;">
          <h2 style="color: var(--neon-green); margin-bottom: 2rem;">Send Us a Message</h2>
          <form id="contactForm">
            <div class="form-group">
              <label class="form-label">Name *</label>
              <input type="text" class="form-input" id="name" required>
            </div>

            <div class="form-group">
              <label class="form-label">Email *</label>
              <input type="email" class="form-input" id="email" required>
            </div>

            <div class="form-group">
              <label class="form-label">Message *</label>
              <textarea class="form-textarea" id="message" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
              <i class="ti ti-send"></i> Send Message
            </button>
          </form>
        </div>

        <div>
          <div class="glass-card" style="padding: 2rem; margin-bottom: 2rem;">
            <h3 style="color: var(--neon-green); margin-bottom: 1.5rem;">Contact Information</h3>
            
            <div style="display: flex; align-items: start; gap: 1rem; margin-bottom: 1.5rem;">
              <i class="ti ti-phone" style="font-size: 1.5rem; color: var(--neon-green);"></i>
              <div>
                <h4>Phone</h4>
                <p style="color: var(--gray);">+91 6354694980</p>
              </div>
            </div>

            <div style="display: flex; align-items: start; gap: 1rem; margin-bottom: 1.5rem;">
              <i class="ti ti-mail" style="font-size: 1.5rem; color: var(--neon-green);"></i>
              <div>
                <h4>Email</h4>
                <p style="color: var(--gray);">jethvaharshil1@gmail.com</p>
              </div>
            </div>

            <div style="display: flex; align-items: start; gap: 1rem;">
              <i class="ti ti-map-pin" style="font-size: 1.5rem; color: var(--neon-green);"></i>
              <div>
                <h4>Address</h4>
                <p style="color: var(--gray);">India</p>
              </div>
            </div>
          </div>

          <div class="glass-card" style="padding: 2rem;">
            <h3 style="color: var(--neon-green); margin-bottom: 1.5rem;">Business Hours</h3>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
              <span>Monday - Friday</span>
              <span style="color: var(--gray);">9:00 AM - 6:00 PM</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
              <span>Saturday</span>
              <span style="color: var(--gray);">10:00 AM - 4:00 PM</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
              <span>Sunday</span>
              <span style="color: var(--gray);">Closed</span>
            </div>
          </div>
        </div>
      </div>

      <div class="glass-card" style="padding: 0; overflow: hidden; height: 400px;">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.9876543210987!2d72.5714!3d23.0225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDAxJzIxLjAiTiA3MsKwMzQnMTcuMCJF!5e0!3m2!1sen!2sin!4v1234567890"
          width="100%" 
          height="400" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy">
        </iframe>
      </div>
    </div>
  </section>

<?php
include("windows/footer.php");
?>
  <script src="script.js"></script>
  <script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const message = document.getElementById('message').value;
      
      if (typeof validateEmail === 'function' && !validateEmail(email)) {
        showNotification('Please enter a valid email address', 'info');
        return;
      }
      
      fetch('api/v1/contact/submit.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name, email, message })
      })
      .then(async res => {
          const text = await res.text();
          let data = null;
          try { data = JSON.parse(text); } catch (e) {}

          if (res.ok && data && data.success) {
              showNotification('Thank you! Your message has been sent successfully.', 'success');
              document.getElementById('contactForm').reset();
          } else {
              const msg = (data && data.message) ? data.message : 'Failed to send message';
              showNotification(msg, 'error');
          }
      })
      .catch(err => {
          console.error('Contact form error:', err);
          showNotification('Unable to contact server. Please try again.', 'error');
      });
    });
  </script>
</body>
</html>