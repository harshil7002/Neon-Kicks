<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - NeonKicks</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("windows/header.php");
?>

  <section style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
      <div style="text-align: center; margin-bottom: 4rem;">
        <h1 class="hero-title text-gradient">About NeonKicks</h1>
        <p style="color: var(--gray); font-size: 1.2rem; margin-top: 1rem; max-width: 800px; margin-left: auto; margin-right: auto;">
          Pioneering the future of footwear with innovative design and cutting-edge technology
        </p>
      </div>

      <div class="glass-card" style="padding: 3rem; margin-bottom: 3rem;">
        <h2 style="color: var(--neon-green); margin-bottom: 1.5rem;">The Global Shoe Industry</h2>
        <p style="color: var(--gray); line-height: 1.8; margin-bottom: 1rem;">
          The global footwear industry is a multi-billion dollar market that continues to evolve with technological advancements and changing consumer preferences. From athletic performance to fashion-forward designs, shoes have become an essential part of modern lifestyle and self-expression.
        </p>
        <p style="color: var(--gray); line-height: 1.8; margin-bottom: 1rem;">
          Innovation in materials science, manufacturing processes, and design thinking has transformed footwear from simple protective gear to sophisticated products that enhance performance, provide comfort, and make bold style statements.
        </p>
        <p style="color: var(--gray); line-height: 1.8;">
          The industry is witnessing a shift towards sustainable practices, smart technology integration, and personalized experiences, making it an exciting time for both manufacturers and consumers.
        </p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        <div class="glass-card" style="padding: 2rem; text-align: center;">
          <i class="ti ti-rocket" style="font-size: 3rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
          <h3 style="margin-bottom: 1rem;">Our Mission</h3>
          <p style="color: var(--gray); line-height: 1.8;">
            To revolutionize the footwear industry by combining futuristic design with cutting-edge performance technology, creating shoes that inspire confidence and elevate every step.
          </p>
        </div>

        <div class="glass-card" style="padding: 2rem; text-align: center;">
          <i class="ti ti-bulb" style="font-size: 3rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
          <h3 style="margin-bottom: 1rem;">Innovation</h3>
          <p style="color: var(--gray); line-height: 1.8;">
            We push the boundaries of what's possible in footwear design, incorporating advanced materials, smart technology, and sustainable practices to create the shoes of tomorrow.
          </p>
        </div>

        <div class="glass-card" style="padding: 2rem; text-align: center;">
          <i class="ti ti-heart" style="font-size: 3rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
          <h3 style="margin-bottom: 1rem;">Quality First</h3>
          <p style="color: var(--gray); line-height: 1.8;">
            Every pair of NeonKicks shoes undergoes rigorous quality control to ensure premium craftsmanship, durability, and comfort that exceeds expectations.
          </p>
        </div>
      </div>

      <div class="glass-card" style="padding: 3rem; margin-bottom: 3rem;">
        <h2 style="color: var(--neon-green); margin-bottom: 1.5rem;">Our Vision</h2>
        <p style="color: var(--gray); line-height: 1.8; margin-bottom: 1rem;">
          At NeonKicks, we envision a future where footwear seamlessly blends style, performance, and technology. We're not just selling shoes – we're creating experiences that empower individuals to express themselves and achieve their goals.
        </p>
        <p style="color: var(--gray); line-height: 1.8; margin-bottom: 1rem;">
          Our commitment to innovation drives us to constantly explore new materials, manufacturing techniques, and design philosophies. We believe that the perfect shoe should feel like a natural extension of your body while making a bold statement about who you are.
        </p>
        <p style="color: var(--gray); line-height: 1.8;">
          Through sustainable practices and ethical manufacturing, we're building a brand that not only looks to the future but also takes responsibility for it.
        </p>
      </div>

      <div class="glass-card" style="padding: 3rem; background: linear-gradient(135deg, var(--glass-bg), rgba(102, 255, 0, 0.05));">
        <h2 style="color: var(--neon-green); margin-bottom: 1.5rem; text-align: center;">Website Developer</h2>
        <div style="text-align: center; max-width: 600px; margin: 0 auto;">
          <div style="width: 100px; height: 100px; background: var(--neon-green); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 700; color: var(--black);">
            JH
          </div>
          <h3 style="margin-bottom: 0.5rem;">Jethva Harshil Arvindbhai</h3>
          <p style="color: var(--gray); margin-bottom: 1rem;">Full-Stack Web Developer & UI/UX Designer</p>
          <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
            <p style="color: var(--white);">
              <i class="ti ti-phone" style="color: var(--neon-green);"></i> +91 6354694980
            </p>
            <p style="color: var(--white);">
              <i class="ti ti-mail" style="color: var(--neon-green);"></i> jethvaharshil1@gmail.com
            </p>
          </div>
          <p style="color: var(--gray); margin-top: 1.5rem; line-height: 1.8;">
            Passionate about creating modern, user-friendly web experiences that combine beautiful design with powerful functionality.
          </p>
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