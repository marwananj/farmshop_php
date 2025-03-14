<?php
// cart.php
session_start(); // Start session for login checks

// Check if user is logged in
$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hindi Farm - Cart</title>
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
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-leaf me-2"></i>
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
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        <!-- Session-based Auth Buttons -->
        <div class="d-flex align-items-center" id="authButtons">
          <?php if (!$loggedIn): ?>
            <!-- Show Login/Sign Up if not logged in -->
            <a href="signin.php" class="btn btn-login me-2" id="loginBtn">
              <i class="fas fa-user me-2"></i>Login
            </a>
            <a href="signup.php" class="btn btn-signup" id="signupBtn">
              <i class="fas fa-user-plus me-2"></i>Sign Up
            </a>
          <?php else: ?>
            <!-- Show Profile/Logout if logged in -->
            <a href="profile.php" class="btn btn-login me-2" id="profileBtn">
              <i class="fas fa-user-circle me-2"></i>Profile
            </a>
            <button class="btn btn-signup" id="logoutBtn" onclick="window.location='logout.php'">
              <i class="fas fa-sign-out-alt me-2"></i>Log Out
            </button>
          <?php endif; ?>
        </div>
        <!-- Cart link is highlighted if on cart page -->
        <a
          href="cart.php"
          class="cart-icon ms-3"
          aria-label="View Cart"
          style="color: var(--primary-color);"
        >
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-badge">0</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- CART SECTION -->
  <section class="py-5" style="margin-top: 2rem;">
    <div class="container">
      <h2 class="text-center section-title mb-4">Your Cart</h2>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <!-- CART ITEMS -->
          <div id="cartItemsContainer" class="mb-4">
            <!-- Dynamically loaded from cart.js / localStorage -->
          </div>
          <!-- CART SUMMARY -->
          <div class="bg-light p-4 rounded" id="cartSummary" style="display: none;">
            <h5>Order Summary</h5>
            <p class="mb-1">Subtotal: $<span id="cartSubtotal">0.00</span></p>
            <p class="mb-3">Shipping: $<span id="cartShipping">5.00</span></p>
            <h5>Total: $<span id="cartTotal">0.00</span></h5>
            <button class="btn btn-primary w-100 mt-3" id="checkoutBtn">
              Proceed to Checkout
            </button>
          </div>
          <!-- EMPTY CART MESSAGE -->
          <div class="text-center" id="emptyCartMessage" style="display: none;">
            <h4>Your cart is empty!</h4>
            <p>
              Browse our <a href="products.php">Products</a> to add items to your cart.
            </p>
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

  <!-- Bootstrap JS -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  ></script>
  <!-- cart.js to load cart items, handle checkout, etc. -->
  <script src="js/cart.js"></script>
</body>
</html>
