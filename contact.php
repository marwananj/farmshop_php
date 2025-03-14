<?php
// contact.php
session_start(); // Start session for login checks

// Check if user is logged in
$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hindi Farm - Contact</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap 5.3.2 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <!-- Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  />
  <!-- Google Font (Poppins) -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />
  <!-- Main CSS -->
  <link rel="stylesheet" href="style.css" />

  <!-- Optional Inline Styles for the Contact Form Card & Fade-In -->
  <style>
    @keyframes fadeInContact {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .contact-card {
      background-color: #fff;
      border-radius: 8px;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      animation: fadeInContact 0.6s ease forwards;
    }
    .contact-card .form-control {
      border-radius: 4px;
      margin-bottom: 1rem;
      transition: border-color 0.3s ease;
    }
    .contact-card .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(74, 120, 98, 0.25);
    }
    .contact-card .btn {
      border-radius: 4px;
      padding: 0.6rem 1.2rem;
      transition: transform 0.3s ease;
    }
    .contact-card .btn:hover {
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <i class="fas fa-leaf me-2"></i>
        <span>Hindi Farm</span>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="contact.php">Contact</a>
          </li>
        </ul>
        <!-- Session-based Auth Buttons -->
        <div class="d-flex align-items-center" id="authButtons">
          <?php if (!$loggedIn): ?>
            <!-- Show Login/Sign Up if NOT logged in -->
            <a href="signin.php" class="btn btn-login me-2">
              <i class="fas fa-user me-2"></i>Login
            </a>
            <a href="signup.php" class="btn btn-signup">
              <i class="fas fa-user-plus me-2"></i>Sign Up
            </a>
          <?php else: ?>
            <!-- Show Profile/Logout if logged in -->
            <a href="profile.php" class="btn btn-login me-2">
              <i class="fas fa-user-circle me-2"></i>Profile
            </a>
            <button class="btn btn-signup" onclick="window.location='logout.php'">
              <i class="fas fa-sign-out-alt me-2"></i>Log Out
            </button>
          <?php endif; ?>
        </div>
        <a href="cart.php" class="cart-icon ms-3" aria-label="View Cart">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-badge">0</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- HERO SECTION (Optional smaller hero for Contact) -->
  <section
    class="hero-section"
    style="
      background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
        url('https://images.unsplash.com/photo-1510626176961-4b7323b060c6?auto=format&q=80&w=1920');
      background-position: center;
      background-size: cover;
      height: 60vh;
      margin-top: -76px;
    "
  >
    <div class="container d-flex flex-column justify-content-center align-items-center text-white h-100">
      <h1 class="mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
        Contact Us
      </h1>
      <p class="text-center" style="max-width: 600px;">
        We’re here to help. Get in touch with any questions or concerns.
      </p>
    </div>
  </section>

  <!-- CONTACT FORM -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center section-title mb-4">Get in Touch</h2>
      <p class="text-center mb-5 mx-auto" style="max-width: 600px;">
        Fill out the form below and we'll respond as soon as possible.
      </p>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <!-- More professional card styling for the contact form -->
          <div class="contact-card">
            <form>
              <div class="mb-3">
                <label for="contactName" class="form-label">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="contactName"
                  placeholder="Your Name"
                />
              </div>
              <div class="mb-3">
                <label for="contactEmail" class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="contactEmail"
                  placeholder="Your Email"
                />
              </div>
              <div class="mb-3">
                <label for="contactMessage" class="form-label">Message</label>
                <textarea
                  class="form-control"
                  id="contactMessage"
                  rows="4"
                  placeholder="Your Message"
                ></textarea>
              </div>
              <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <!-- Footer Column 1 -->
        <div class="col-md-4 mb-4">
          <h5>Hindi Farm</h5>
          <p>
            Providing fresh dairy products since 1990. Our commitment to quality
            and tradition continues to this day.
          </p>
        </div>
        <!-- Footer Column 2 -->
        <div class="col-md-4 mb-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="about.php">About Us</a></li>
            <li><a href="products.php">Our Products</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
        <!-- Footer Column 3 -->
        <div class="col-md-4 mb-4">
          <h5>Connect With Us</h5>
          <p>Follow us on social media for updates and special offers.</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </div>
      <!-- Footer Bottom -->
      <div class="row mt-4">
        <div class="col-12 text-center">
          <p class="mb-0">&copy; 2025 Hindi Farm. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
