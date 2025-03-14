<?php
session_start();
require_once 'db.php';

// If not logged in, redirect
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}

// If form posted, you can parse cart_data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // e.g. $cartData = json_decode($_POST['cart_data'], true);
    // Insert order into DB, etc.
    header("Location: payment.php?success=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hindi Farm - Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!-- NAVBAR -->
  <?php $loggedIn = true; ?>
  <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-leaf"></i>
        Hindi Farm
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center" id="authButtons">
          <a href="profile.php" class="btn btn-login me-2">Profile</a>
          <button class="btn btn-signup" onclick="window.location='logout.php'">Log Out</button>
        </div>
        <a href="cart.php" class="cart-icon ms-3">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-badge">0</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- Payment Section -->
  <section class="py-5 mt-5">
    <div class="container">
      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success text-center">
          Payment successful! Thank you for your order.
        </div>
      <?php endif; ?>
      <h2 class="text-center section-title mb-4">Checkout</h2>
      <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
          <div class="bg-light p-4 rounded">
            <h5>Order Summary</h5>
            <p class="mb-1">Subtotal: $<span id="paymentSubtotal">0.00</span></p>
            <p class="mb-1">Shipping: $<span id="paymentShipping">5.00</span></p>
            <h5>Total: $<span id="paymentTotal">0.00</span></h5>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card product-card p-4">
            <form id="paymentForm" method="POST" action="payment.php">
              <!-- Hidden input to store cart JSON -->
              <input type="hidden" name="cart_data" id="cartDataInput" value="" />
              <div class="mb-3">
                <label for="cardName" class="form-label">Cardholder Name</label>
                <input type="text" class="form-control" id="cardName" required />
              </div>
              <div class="mb-3">
                <label for="cardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" required />
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cardExpiry" class="form-label">Expiration (MM/YY)</label>
                  <input type="text" class="form-control" id="cardExpiry" required />
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cardCvv" class="form-label">CVV</label>
                  <input type="text" class="form-control" id="cardCvv" required />
                </div>
              </div>
              <div class="mb-3">
                <label for="billingAddress" class="form-label">Billing Address</label>
                <input type="text" class="form-control" id="billingAddress" required />
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-3">
                Complete Payment
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer mt-5">
    <div class="container">
      <p class="text-center mt-4">&copy; 2025 Hindi Farm. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/payment.js"></script>
</body>
</html>
