<?php
session_start();
// Check if user is logged in via session
$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hindi Farm - Home</title>
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
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
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
        <!-- Auth Buttons (session-based) -->
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

  <!-- HERO SECTION -->
  <section
    class="hero-section"
    style="
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('https://images.unsplash.com/photo-1570042225831-d98fa7577f1e');
      background-size: cover;
      background-position: center;
      height: calc(100vh - 76px);
      margin-top: -76px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      text-align: center;
    "
  >
    <div class="container">
      <h1>Premium Dairy Products from Hindi Farm</h1>
      <p>Experience the authentic taste of cheese, yogurt, and more, crafted with love.</p>
      <a href="products.php" class="btn btn-primary me-2">
        <i class="fas fa-shopping-basket me-2"></i>Shop Now
      </a>
      <a href="about.php" class="btn btn-outline-light">
        <i class="fas fa-info-circle me-2"></i>Learn More
      </a>
    </div>
  </section>

  <!-- FEATURED PRODUCTS SECTION -->
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">Featured Products</h2>
        <p class="text-muted">Some of our best-selling dairy items</p>
      </div>
      <div class="row g-4">
        <!-- Product 1 -->
        <div class="col-md-4">
          <div class="card product-card h-100">
            <div class="product-image-container">
              <img
                src="https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&q=80&w=800"
                class="card-img-top"
                alt="Fresh Whole Milk"
                loading="lazy"
              />
            </div>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Fresh Whole Milk</h5>
              <p class="card-text flex-grow-1">
                Farm-fresh whole milk, rich in nutrients and naturally creamy.
              </p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="price">$3.99</span>
                <!-- Add to Cart button calls addToCart() from cart.js -->
                <button
                  class="btn btn-primary"
                  onclick="addToCart({
                    id: 101,
                    name: 'Fresh Whole Milk',
                    price: 3.99,
                    image: 'https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&q=80&w=800'
                  })"
                >
                  Add to Cart <i class="fas fa-shopping-cart ms-2"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-4">
          <div class="card product-card h-100">
            <div class="product-image-container">
              <img
                src="https://images.unsplash.com/photo-1552767059-ce182ead6c1b?auto=format&q=80&w=800"
                class="card-img-top"
                alt="Organic Cheddar"
                loading="lazy"
              />
            </div>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Organic Cheddar</h5>
              <p class="card-text flex-grow-1">
                Aged cheddar cheese made from organic milk.
              </p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="price">$5.99</span>
                <button
                  class="btn btn-primary"
                  onclick="addToCart({
                    id: 102,
                    name: 'Organic Cheddar',
                    price: 5.99,
                    image: 'https://images.unsplash.com/photo-1552767059-ce182ead6c1b?auto=format&q=80&w=800'
                  })"
                >
                  Add to Cart <i class="fas fa-shopping-cart ms-2"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="col-md-4">
          <div class="card product-card h-100">
            <div class="product-image-container">
              <img
                src="https://images.unsplash.com/photo-1488477181946-6428a0291777?auto=format&q=80&w=800"
                class="card-img-top"
                alt="Greek Yogurt"
                loading="lazy"
              />
            </div>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Greek Yogurt</h5>
              <p class="card-text flex-grow-1">
                Creamy Greek yogurt, perfect for breakfast.
              </p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="price">$4.49</span>
                <button
                  class="btn btn-primary"
                  onclick="addToCart({
                    id: 103,
                    name: 'Greek Yogurt',
                    price: 4.49,
                    image: 'https://images.unsplash.com/photo-1488477181946-6428a0291777?auto=format&q=80&w=800'
                  })"
                >
                  Add to Cart <i class="fas fa-shopping-cart ms-2"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- More featured products if desired -->
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS SECTION -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">What Our Customers Say</h2>
        <p class="text-muted">Real testimonials from real people who love our dairy products.</p>
      </div>
      <div class="row g-4">
        <!-- Testimonial 1 -->
        <div class="col-md-4">
          <div class="text-center p-4 h-100 bg-white rounded-3 shadow-sm">
            <img
              src="https://images.unsplash.com/photo-1603415526960-f0a266f4b37c?auto=format&q=80&w=200"
              alt="Customer"
              class="rounded-circle mb-3"
              style="width: 80px; height: 80px; object-fit: cover;"
            />
            <h5 class="fw-bold">John Smith</h5>
            <div class="mb-2">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
            </div>
            <p class="text-muted">
              “The best dairy products I’ve ever tasted. My family can’t get enough of Hindi Farm!”
            </p>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="col-md-4">
          <div class="text-center p-4 h-100 bg-white rounded-3 shadow-sm">
            <img
              src="https://images.unsplash.com/photo-1600783874152-7835b5d24a5a?auto=format&q=80&w=200"
              alt="Customer"
              class="rounded-circle mb-3"
              style="width: 80px; height: 80px; object-fit: cover;"
            />
            <h5 class="fw-bold">Emily Johnson</h5>
            <div class="mb-2">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star-half-alt text-warning"></i>
            </div>
            <p class="text-muted">
              “I love how fresh everything is. The butter is so creamy and the yogurt is perfect for breakfast!”
            </p>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="col-md-4">
          <div class="text-center p-4 h-100 bg-white rounded-3 shadow-sm">
            <img
              src="https://images.unsplash.com/photo-1625037241005-8f8d02c5b10d?auto=format&q=80&w=200"
              alt="Customer"
              class="rounded-circle mb-3"
              style="width: 80px; height: 80px; object-fit: cover;"
            />
            <h5 class="fw-bold">David Martinez</h5>
            <div class="mb-2">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="far fa-star text-warning"></i>
            </div>
            <p class="text-muted">
              “Amazing quality and fast delivery. Hindi Farm has become my go-to for all dairy needs.”
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer mt-5">
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
  <!-- auth.js (optional) if using localStorage checks -->
  <script src="js/auth.js"></script>
  <!-- cart.js for addToCart, etc. -->
  <script src="js/cart.js"></script>
</body>
</html>
