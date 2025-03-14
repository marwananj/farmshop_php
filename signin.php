<?php
// signin.php
session_start();

// If there's a login error from login.php, retrieve and clear it
$loginError = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hindi Farm - Sign In</title>
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

  <!-- Inline styles for a centered login form with animations -->
  <style>
    .login-container {
      max-width: 400px;
      margin: 120px auto;
      padding: 1rem;
      animation: fadeInUp 0.7s ease forwards;
    }
    .login-card {
      background-color: #fff;
      border-radius: 8px;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transform: translateY(50px);
      opacity: 0;
      animation: slideUp 0.8s ease forwards;
    }
    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(50px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    @keyframes slideUp {
      0% {
        transform: translateY(50px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
    .login-card .form-control {
      border-radius: 4px;
      margin-bottom: 1rem;
      transition: border-color 0.3s ease;
    }
    .login-card .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(74,120,98,0.25);
    }
    .login-card .btn {
      border-radius: 4px;
      padding: 0.6rem 1.2rem;
      transition: transform 0.3s ease;
    }
    .login-card .btn:hover {
      transform: translateY(-2px);
    }
    .btn-primary {
      background-color: var(--primary-color);
      border: none;
    }
    .btn-primary:hover {
      background-color: var(--secondary-color);
    }
    .login-card p {
      margin-top: 1rem;
      text-align: center;
    }
    .login-card a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
    }
    .login-card a:hover {
      text-decoration: underline;
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
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        <div class="d-flex align-items-center" id="authButtons">
          <!-- On the sign-in page, highlight the login link if desired -->
          <a href="signin.php" class="btn btn-login me-2 active" id="loginBtn">
            <i class="fas fa-user me-2"></i>Login
          </a>
          <a href="signup.php" class="btn btn-signup" id="signupBtn">
            <i class="fas fa-user-plus me-2"></i>Sign Up
          </a>
          <a href="profile.php" class="btn btn-login me-2" id="profileBtn" style="display: none;">
            <i class="fas fa-user-circle me-2"></i>Profile
          </a>
          <button class="btn btn-signup" id="logoutBtn" style="display: none;">
            <i class="fas fa-sign-out-alt me-2"></i>Log Out
          </button>
        </div>
        <a href="cart.php" class="cart-icon ms-3" aria-label="View Cart">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-badge">0</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- SIGN IN FORM -->
  <div class="login-container">
    <div class="login-card">
      <h2 class="text-center mb-4">Sign In</h2>

      <!-- Display any login error from session -->
      <?php if ($loginError): ?>
        <div class="alert alert-danger">
          <?php echo htmlspecialchars($loginError); ?>
        </div>
      <?php endif; ?>

      <form action="login.php" method="POST">
        <input
          type="email"
          class="form-control"
          name="email"
          placeholder="Email"
          required
        />
        <input
          type="password"
          class="form-control"
          name="password"
          placeholder="Password"
          required
        />
        <button type="submit" class="btn btn-primary w-100 mt-3">Sign In</button>
      </form>
      <p class="mt-3">
        Don't have an account?
        <a href="signup.php">Sign Up</a>
      </p>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
