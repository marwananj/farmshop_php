/**************************************************************
 * payment.js
 *  - Loads cart from localStorage
 *  - Calculates totals, populates order summary
 *  - Places cart data into a hidden input for server processing
 **************************************************************/
document.addEventListener("DOMContentLoaded", () => {
  const cartData = JSON.parse(localStorage.getItem("cart")) || [];
  const SHIPPING_COST = 5.0;

  const paymentSubtotalEl = document.getElementById("paymentSubtotal");
  const paymentShippingEl = document.getElementById("paymentShipping");
  const paymentTotalEl = document.getElementById("paymentTotal");
  const paymentForm = document.getElementById("paymentForm");
  const cartDataInput = document.getElementById("cartDataInput");

  // Calculate subtotal
  let subtotal = cartData.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  let total = subtotal + SHIPPING_COST;

  // Display on the page
  if (paymentSubtotalEl) paymentSubtotalEl.textContent = subtotal.toFixed(2);
  if (paymentShippingEl) paymentShippingEl.textContent = SHIPPING_COST.toFixed(2);
  if (paymentTotalEl) paymentTotalEl.textContent = total.toFixed(2);

  // Put cart data JSON into hidden input
  if (cartDataInput) {
    cartDataInput.value = JSON.stringify(cartData);
  }

  if (paymentForm) {
    paymentForm.addEventListener("submit", (e) => {
      // If you want to do client-side validation or an AJAX approach, do it here
      // For a direct form POST, we can let it submit. The server can read `cart_data`
      // from the hidden input.
      // e.preventDefault();

      // Example: if you want to do final checks
      // const cardName = document.getElementById("cardName").value.trim();
      // etc.

      // If successful, the server can store the order in DB. Then you can clear cart:
      // localStorage.setItem("cart", JSON.stringify([]));
    });
  }
});
