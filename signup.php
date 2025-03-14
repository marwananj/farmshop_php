<?php
// signup.php

session_start();
require_once 'db.php'; // Update path if db.php is in a subfolder

// We'll store any sign-up error message here
$signupError = '';

// If form was submitted, handle sign-up logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        $signupError = "All fields are required.";
    } else {
        // Check if email already in use
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            $signupError = "Email already in use.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword]);

            // Optionally log them in right away
            $_SESSION['user_id']    = $pdo->lastInsertId();
            $_SESSION['user_name']  = $name;
            $_SESSION['user_email'] = $email;

            // Redirect to profile or anywhere you want
            header("Location: profile.php");
            exit;
        }
    }
}

// If not POST or we have an error, show the form below
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hindi Farm - Sign Up</title>
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
  <!-- Main CSS (same as your index) -->
  <link rel="stylesheet" href="style.css" />

  <!-- Inline Styles for Sign Up Page -->
  <style>
    .signup-container {
      max-width: 400px;
      margin: 120px auto;
      padding: 1rem;
      animation: fadeInUp 0.7s ease forwards;
    }
    .signup-card {
      background-color: #fff;
      border-radius: 8px;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transform: translateY(50px);
      opacity: 0;
      animation: slideUp 0.8s ease forwards;
    }
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(50px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideUp {
      0% { transform: translateY(50px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }
    .signup-card .form-control {
      border-radius: 4px;
      margin-bottom: 1rem;
      transition: border-color 0.3s ease;
    }
    .signup-card .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(74,120,98,0.25);
    }
    .signup-card .btn {
      border-radius: 4px;
      padding: 0.6rem 1.2rem;
      transition: transform 0.3s ease;
    }
    .signup-card .btn:hover {
      transform: translateY(-2px);
    }
    .btn-primary {
      background-color: var(--primary-color);
      border: none;
    }
    .btn-primary:hover {
      background-color: var(--secondary-color);
    }
    .signup-card p {
      margin-top: 1rem;
      text-align: center;
    }
    .signup-card a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
    }
    .signup-card a:hover {
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
          <a href="signin.php" class="btn btn-login me-2" id="loginBtn">
            <i class="fas fa-user me-2"></i>Login
          </a>
          <!-- On the sign-up page, highlight sign-up if desired -->
          <a href="signup.php" class="btn btn-signup active" id="signupBtn">
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

  <!-- SIGNUP FORM -->
  <div class="signup-container">
    <div class="signup-card">
      <h2 class="text-center mb-4">Create an Account</h2>

      <!-- Display any sign-up error -->
      <?php if (!empty($signupError)): ?>
        <div class="alert alert-danger text-center">
          <?php echo htmlspecialchars($signupError); ?>
        </div>
      <?php endif; ?>

      <form action="signup.php" method="POST">
        <input
          type="text"
          class="form-control"
          name="name"
          placeholder="Full Name"
          required
        />
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
        <button type="submit" class="btn btn-primary w-100 mt-3">
          Sign Up
        </button>
      </form>
      <p class="mt-3">
        Already have an account?
        <a href="signin.php">Sign In</a>
      </p>
    </div>
  </div>

  <!-- Optional: Footer or any other content if you want -->
  <!-- For consistency, you can add your same site footer here -->

  <!-- Bootstrap JS -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
