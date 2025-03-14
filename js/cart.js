/**************************************************************
 * cart.js
 *  - Manages cart items in localStorage
 *  - Renders them in cart.php
 *  - Proceeds to payment.php without localStorage-based login check
 *    (Server session check in payment.php is the source of truth)
 **************************************************************/

// Load cart from localStorage or start empty
let cart = JSON.parse(localStorage.getItem("cart")) || [];

/**
 * saveCart()
 * Saves the current cart array to localStorage.
 */
function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

/**
 * addToCart(product)
 * Adds a product object to the cart (or increments quantity).
 * product must have { id, name, price, image }.
 */
function addToCart(product) {
  const existingItem = cart.find((item) => item.id === product.id);
  if (existingItem) {
    existingItem.quantity++;
  } else {
    cart.push({ ...product, quantity: 1 });
  }
  saveCart();
  updateCartBadge();
}

/**
 * updateCartBadge()
 * Updates the cart icon badge with the total item count.
 */
function updateCartBadge() {
  const badge = document.querySelector(".cart-badge");
  if (!badge) return;
  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
  badge.textContent = totalItems;
}

/**
 * renderCartItems()
 * Renders the cart items in cart.php using #cartItemsContainer, #cartSummary, etc.
 */
function renderCartItems() {
  const cartItemsContainer = document.getElementById("cartItemsContainer");
  const cartSummary = document.getElementById("cartSummary");
  const emptyCartMessage = document.getElementById("emptyCartMessage");
  const cartSubtotalEl = document.getElementById("cartSubtotal");
  const cartShippingEl = document.getElementById("cartShipping");
  const cartTotalEl = document.getElementById("cartTotal");
  const checkoutBtn = document.getElementById("checkoutBtn");

  // If these elements don't exist, return
  if (!cartItemsContainer || !cartSummary || !emptyCartMessage) return;

  // Clear existing items
  cartItemsContainer.innerHTML = "";

  // If cart is empty
  if (cart.length === 0) {
    cartSummary.style.display = "none";
    emptyCartMessage.style.display = "block";
    return;
  } else {
    cartSummary.style.display = "block";
    emptyCartMessage.style.display = "none";
  }

  // Calculate subtotal
  let subtotal = 0;
  cart.forEach((item) => {
    const itemSubtotal = item.price * item.quantity;
    subtotal += itemSubtotal;

    // Create a card for each cart item
    const card = document.createElement("div");
    card.className = "card mb-3 product-card";
    card.innerHTML = `
      <div class="row g-0">
        <div class="col-md-4">
          <img
            src="${item.image}"
            class="img-fluid h-100 w-100"
            alt="${item.name}"
            style="object-fit: cover;"
          />
        </div>
        <div class="col-md-8">
          <div class="card-body d-flex flex-column justify-content-between h-100">
            <div>
              <h5 class="card-title">${item.name}</h5>
              <p class="card-text mb-1"><strong>Price:</strong> $${item.price.toFixed(2)}</p>
              <p class="card-text mb-2"><strong>Subtotal:</strong> $${itemSubtotal.toFixed(2)}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <label for="qty-${item.id}" class="me-2 mb-0">Qty:</label>
                <input
                  type="number"
                  class="form-control"
                  id="qty-${item.id}"
                  value="${item.quantity}"
                  min="1"
                  style="width: 70px;"
                />
              </div>
              <div>
                <button class="btn btn-danger btn-sm me-2" data-id="${item.id}">
                  <i class="fas fa-trash"></i> Remove
                </button>
                <button class="btn btn-secondary btn-sm" data-id="${item.id}">
                  <i class="fas fa-edit"></i> Update
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
    // Remove / Update buttons
    const removeBtn = card.querySelector(".btn-danger");
    removeBtn.addEventListener("click", () => removeItem(item.id));

    const updateBtn = card.querySelector(".btn-secondary");
    updateBtn.addEventListener("click", () => {
      const qtyInput = card.querySelector(`#qty-${item.id}`);
      const newQty = parseInt(qtyInput.value, 10);
      if (newQty > 0) {
        updateItemQuantity(item.id, newQty);
      } else {
        removeItem(item.id);
      }
    });

    cartItemsContainer.appendChild(card);
  });

  // Shipping cost
  const SHIPPING_COST = 5.0;
  cartSubtotalEl.textContent = subtotal.toFixed(2);
  cartShippingEl.textContent = SHIPPING_COST.toFixed(2);
  cartTotalEl.textContent = (subtotal + SHIPPING_COST).toFixed(2);

  // Handle checkout button
  if (checkoutBtn) {
    checkoutBtn.addEventListener("click", handleCheckout);
  }
}

/**
 * removeItem(itemId)
 * Removes an item from the cart by itemId.
 */
function removeItem(itemId) {
  cart = cart.filter((c) => c.id !== itemId);
  saveCart();
  updateCartBadge();
  renderCartItems();
}

/**
 * updateItemQuantity(itemId, newQty)
 * Updates the quantity of a cart item.
 */
function updateItemQuantity(itemId, newQty) {
  const cartItem = cart.find((c) => c.id === itemId);
  if (cartItem) {
    cartItem.quantity = newQty;
  }
  saveCart();
  updateCartBadge();
  renderCartItems();
}

/**
 * handleCheckout()
 * Redirects to payment.php, letting the server check session for login.
 */
function handleCheckout() {
  // We rely on payment.php to check if user is logged in (session).
  window.location.href = "payment.php";
}

// On page load
document.addEventListener("DOMContentLoaded", () => {
  updateCartBadge();
  renderCartItems();
});
