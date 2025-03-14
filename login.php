<?php
session_start();
require_once 'db.php'; // Adjust path if db.php is in a subfolder

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Basic validation
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "All fields are required.";
        header("Location: signin.php");
        exit;
    }

    // Look up user by email
    $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no user found, or password doesn't match
    if (!$user || !password_verify($password, $user['password'])) {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: signin.php");
        exit;
    }

    // Correct credentials => set session
    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_name']  = $user['name'];
    $_SESSION['user_email'] = $user['email'];

    // Redirect to profile page (or anywhere you want)
    header("Location: profile.php");
    exit;
} else {
    // If not POST, redirect to sign in page
    header("Location: signin.php");
    exit;
}
?>
