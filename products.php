<?php
session_start();
// Check if user is logged in
$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hindi Farm - Our Products</title>
  <!-- Bootstrap 5.3.2 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <!-- Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  >
  <!-- Google Font (Poppins) -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  >
  <!-- Main CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Optional: auth.js if using localStorage approach -->
  <script type="module" src="js/auth.js"></script>

  <!-- Inline styles for fade-in, hover animations, sale badges, etc. -->
  <style>
    /* Product card fade-in animation */
    .product-card.fade-in {
      animation: fadeInProducts 0.4s ease forwards;
      opacity: 0;
      transform: translateY(10px);
    }
    @keyframes fadeInProducts {
      0% {
        opacity: 0;
        transform: translateY(10px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Sale badge styling */
    .sale-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: #e74c3c;
      color: #fff;
      padding: 0.3rem 0.5rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 600;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      z-index: 1;
    }

    /* Hover lift & scale effect for product cards */
    .product-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    /* Category filter buttons styling */
    .category-filters {
      display: flex;
      justify-content: center;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }
    .category-filters .btn {
      transition: transform 0.3s ease;
    }
    .category-filters .btn:hover {
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top" role="navigation">
    <div class="container">
      <a class="navbar-brand" href="index.php" role="heading" aria-level="1">
        <i class="fas fa-leaf" aria-hidden="true"></i>
        Hindi Farm
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
            <a class="nav-link active" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        <!-- Session-based Auth Buttons -->
        <div class="d-flex align-items-center auth-buttons">
          <?php if (!$loggedIn): ?>
            <!-- Show Login/Sign Up if not logged in -->
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
        <a href="cart.php" class="cart-icon">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-badge">0</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- Products Section -->
  <section class="py-5 mt-5" role="main">
    <div class="container">
      <h1 class="text-center section-title mb-4">Our Products</h1>

      <!-- Category Filter Buttons -->
      <div class="category-filters mb-4">
        <button class="btn btn-outline-success" onclick="filterProducts('All')">All</button>
        <button class="btn btn-outline-success" onclick="filterProducts('Cheese')">Cheese</button>
        <button class="btn btn-outline-success" onclick="filterProducts('Milk')">Milk</button>
        <button class="btn btn-outline-success" onclick="filterProducts('Yogurt')">Yogurt</button>
        <button class="btn btn-outline-success" onclick="filterProducts('Butter')">Butter</button>
      </div>

      <!-- Search Bar -->
      <div class="row mb-4">
        <div class="col-md-6 mx-auto">
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-search"></i>
            </span>
            <input
              type="text"
              id="searchInput"
              class="form-control"
              placeholder="Search products..."
              aria-label="Search products"
            >
          </div>
        </div>
      </div>

      <!-- Products Grid (loaded by products.js) -->
      <div class="row" id="productsContainer" role="list">
        <!-- Dynamically loaded here by products.js -->
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5>Hindi Farm</h5>
          <p>
            Providing fresh dairy products since 1990. Our commitment to quality
            and tradition continues to this day.
          </p>
        </div>
        <div class="col-md-4 mb-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled" role="list">
            <li><a href="about.php">About Us</a></li>
            <li><a href="products.php">Our Products</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
        <div class="col-md-4 mb-4">
          <h5>Connect With Us</h5>
          <p>Follow us on social media for updates and special offers.</p>
          <div class="social-icons" role="list">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook" aria-hidden="true"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
            <a href="#" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
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
  <!-- products.js (handles category filters, sale badges, fade-in, search) -->
  <script src="js/products.js"></script>
</body>
</html>
