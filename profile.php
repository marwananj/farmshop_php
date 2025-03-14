<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}

$userId    = $_SESSION['user_id'];
$userName  = $_SESSION['user_name']  ?? 'Unknown';
$userEmail = $_SESSION['user_email'] ?? 'Unknown';

$editError = '';
$editSuccess = '';
$passError = '';
$passSuccess = '';

// Edit Profile
if (isset($_POST['edit_profile'])) {
    $newName  = trim($_POST['name']  ?? '');
    $newEmail = trim($_POST['email'] ?? '');

    if (empty($newName) || empty($newEmail)) {
        $editError = "Name and Email cannot be empty.";
    } else {
        // Check if new email is used by another user
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$newEmail, $userId]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $editError = "That email is already in use by another account.";
        } else {
            // Update user
            $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$newName, $newEmail, $userId]);

            // Update session
            $_SESSION['user_name']  = $newName;
            $_SESSION['user_email'] = $newEmail;
            $userName  = $newName;
            $userEmail = $newEmail;

            $editSuccess = "Profile updated successfully!";
        }
    }
}

// Change Password
if (isset($_POST['change_password'])) {
    $oldPassword = trim($_POST['old_password'] ?? '');
    $newPassword = trim($_POST['new_password'] ?? '');
    $confirmPass = trim($_POST['confirm_password'] ?? '');

    if (empty($oldPassword) || empty($newPassword) || empty($confirmPass)) {
        $passError = "All password fields are required.";
    } elseif ($newPassword !== $confirmPass) {
        $passError = "New passwords do not match.";
    } else {
        // Check old password
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($oldPassword, $user['password'])) {
            $passError = "Old password is incorrect.";
        } else {
            // Hash new password
            $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashed, $userId]);

            $passSuccess = "Password changed successfully!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hindi Farm - Profile</title>
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
        <div class="d-flex align-items-center">
          <a href="profile.php" class="btn btn-login me-2">
            <i class="fas fa-user-circle me-2"></i>Profile
          </a>
          <button class="btn btn-signup" onclick="window.location='logout.php'">
            <i class="fas fa-sign-out-alt me-2"></i>Log Out
          </button>
        </div>
        <a href="cart.php" class="cart-icon ms-3">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-badge">0</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main style="margin-top: 76px;">
    <div class="container" style="max-width: 700px;">
      <h2 class="text-center section-title mb-4">Your Profile</h2>
      <div class="card p-4">
        <div class="text-center mb-4">
          <i class="fas fa-user-circle fa-5x text-secondary"></i>
          <h3 class="mt-3"><?php echo htmlspecialchars($userName); ?></h3>
          <p class="text-muted"><?php echo htmlspecialchars($userEmail); ?></p>
        </div>
        <hr />

        <!-- Edit Profile -->
        <h5>Edit Profile</h5>
        <?php if ($editError): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($editError); ?></div>
        <?php endif; ?>
        <?php if ($editSuccess): ?>
          <div class="alert alert-success"><?php echo htmlspecialchars($editSuccess); ?></div>
        <?php endif; ?>
        <form method="POST" action="profile.php" class="mb-5">
          <input type="hidden" name="edit_profile" value="1" />
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              name="name"
              value="<?php echo htmlspecialchars($userName); ?>"
              required
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              name="email"
              value="<?php echo htmlspecialchars($userEmail); ?>"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>

        <!-- Change Password -->
        <h5>Change Password</h5>
        <?php if ($passError): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($passError); ?></div>
        <?php endif; ?>
        <?php if ($passSuccess): ?>
          <div class="alert alert-success"><?php echo htmlspecialchars($passSuccess); ?></div>
        <?php endif; ?>
        <form method="POST" action="profile.php">
          <input type="hidden" name="change_password" value="1" />
          <div class="mb-3">
            <label class="form-label">Old Password</label>
            <input type="password" class="form-control" name="old_password" required />
          </div>
          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" name="new_password" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" name="confirm_password" required />
          </div>
          <button type="submit" class="btn btn-outline-primary w-100">
            Change Password
          </button>
        </form>

        <hr />
        <!-- Proceed to Payment (optional) -->
        <div class="mt-3 text-center">
          <p class="mb-2">Ready to checkout your cart?</p>
          <a href="payment.php" class="btn btn-success">
            Proceed to Payment
          </a>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer mt-5">
    <div class="container">
      <p class="text-center mt-4">&copy; 2025 Hindi Farm. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional: auth.js, cart.js, etc. -->
  <script src="js/cart.js"></script>
</body>
</html>
