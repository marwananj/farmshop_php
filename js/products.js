/**************************************************************
 * products.js
 *  - Dynamic product listing & search
 *  - 15 unique products, each with a distinct Unsplash image
 *  - Category filtering (Cheese, Milk, Yogurt, Butter)
 *  - "Sale" badge for some items
 *  - Fade-in animation on re-render
 **************************************************************/

const productData = [
  // 3 Milk items
  {
    id: 1,
    name: "Fresh Whole Milk",
    description: "Farm-fresh whole milk, rich in nutrients.",
    price: 3.99,
    image: "https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&q=80&w=800",
    category: "Milk",
    sale: false
  },
  {
    id: 8,
    name: "Organic Milk",
    description: "Pure organic milk from grass-fed cows.",
    price: 4.49,
    image: "https://images.unsplash.com/photo-1563636619-e9143da7973b?auto=format&q=80&w=800",
    category: "Milk",
    sale: false
  },
  {
    id: 13,
    name: "Farmhouse Milk",
    description: "Creamy, nutrient-packed milk from local farms.",
    price: 4.99,
    image: "https://images.unsplash.com/photo-1517448931760-9bf4414148c5?auto=format&q=80&w=800",
    category: "Milk",
    sale: false
  },

  // 4 Cheese items
  {
    id: 2,
    name: "Organic Cheddar",
    description: "Aged cheddar cheese made from organic milk.",
    price: 5.99,
    image: "https://images.unsplash.com/photo-1552767059-ce182ead6c1b?auto=format&q=80&w=800",
    category: "Cheese",
    sale: true
  },
  {
    id: 5,
    name: "Gouda Cheese",
    description: "Aged Gouda with a rich flavor.",
    price: 7.99,
    image: "https://images.unsplash.com/photo-1634487359989-3e90c9432133?auto=format&q=80&w=800",
    category: "Cheese",
    sale: false
  },
  {
    id: 11,
    name: "Mozzarella",
    description: "Fresh mozzarella, perfect for pizzas and salads.",
    price: 6.49,
    image: "https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?auto=format&q=80&w=800",
    category: "Cheese",
    sale: false
  },
  {
    id: 14,
    name: "Brie Cheese",
    description: "Soft and creamy Brie cheese.",
    price: 8.49,
   image: "https://images.unsplash.com/photo-1624806992066-5ffcf7ca186b?auto=format&q=80&w=800",
    category: "Cheese",
    sale: false
  },

  // 4 Yogurt items
  {
    id: 3,
    name: "Greek Yogurt",
    description: "Creamy Greek yogurt, perfect for breakfast.",
    price: 4.49,
    image: "https://images.unsplash.com/photo-1488477181946-6428a0291777?auto=format&q=80&w=800",
    category: "Yogurt",
    sale: false
  },
  {
    id: 6,
    name: "Strawberry Yogurt",
    description: "Creamy yogurt with real strawberries.",
    price: 4.99,
    image: "https://images.unsplash.com/photo-1488477304112-4944851de03d?auto=format&q=80&w=800",
    category: "Yogurt",
    sale: true
  },
  {
    id: 9,
    name: "Vanilla Yogurt",
    description: "Smooth and creamy vanilla bean yogurt.",
    price: 4.79,
    image: "https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?auto=format&q=80&w=800",
    category: "Yogurt",
    sale: false
  },
  {
    id: 12,
    name: "Blueberry Yogurt",
    description: "Yogurt blended with fresh blueberries.",
    price: 4.99,
    image: "https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&q=80&w=800",
    category: "Yogurt",
    sale: false
  },

  // 4 Butter items
  {
    id: 4,
    name: "Artisan Butter",
    description: "Hand-churned butter from premium cream.",
    price: 6.99,
    image: "https://images.unsplash.com/photo-1589985270826-4b7bb135bc9d?auto=format&q=80&w=800",
    category: "Butter",
    sale: false
  },
  {
    id: 7,
    name: "Cultured Butter",
    description: "European-style cultured butter.",
    price: 8.99,
    image: "https://images.unsplash.com/photo-1573812461383-e5f8b759d12e?auto=format&q=80&w=800",
    category: "Butter",
    sale: false
  },
  {
    id: 10,
    name: "Cultured Butter (Sale)",
    description: "Tangy, European-style butter on sale.",
    price: 8.99,
    image: "https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&q=80&w=800",
    category: "Butter",
    sale: true
  },
  {
    id: 15,
    name: "Herb Butter",
    description: "Butter infused with fresh herbs.",
    price: 7.99,
    image: "https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&q=80&w=800",
    category: "Butter",
    sale: false
  }
];

// DOM references
const productsContainer = document.getElementById("productsContainer");
const searchInput = document.getElementById("searchInput");

// Track currently filtered products
let currentProducts = [...productData];

/**
 * Renders the product list with fade-in animation, sale badges, etc.
 */
function renderProducts(list) {
  if (!productsContainer) return;

  const productHTML = list.map((p) => `
    <div class="col-md-4 mb-4">
      <div class="card product-card h-100 fade-in">
        <div class="product-image-container position-relative">
          ${p.sale ? `<div class="sale-badge">Sale</div>` : ""}
          <img
            src="${p.image}"
            class="card-img-top"
            alt="${p.name}"
          />
        </div>
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">${p.name}</h5>
          <p class="card-text flex-grow-1">${p.description}</p>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="price">$${p.price.toFixed(2)}</span>
            <button
              class="btn btn-primary"
              onclick="addToCart({
                id: ${p.id},
                name: '${p.name}',
                price: ${p.price},
                image: '${p.image}'
              })"
            >
              Add to Cart <i class="fas fa-shopping-cart ms-2"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  `).join("");

  productsContainer.innerHTML = productHTML;
}

/**
 * filterProducts(category)
 * Filters by category (All, Cheese, Milk, Yogurt, Butter).
 */
function filterProducts(category) {
  if (category === "All") {
    currentProducts = [...productData];
  } else {
    currentProducts = productData.filter((p) => p.category === category);
  }
  applySearchFilter(); // Also apply any existing search term
}

/**
 * applySearchFilter()
 * Filters currentProducts by the search term in #searchInput.
 */
function applySearchFilter() {
  const searchTerm = (searchInput?.value || "").toLowerCase();
  const filtered = currentProducts.filter((p) =>
    p.name.toLowerCase().includes(searchTerm) ||
    p.description.toLowerCase().includes(searchTerm)
  );
  renderProducts(filtered);
}

/**
 * handleSearchInput()
 * Debounce or direct filter on search input changes.
 */
let searchTimeout;
function handleSearchInput() {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    applySearchFilter();
  }, 300);
}

// On DOM load, show all products & set up search listener
document.addEventListener("DOMContentLoaded", () => {
  if (searchInput) {
    searchInput.addEventListener("input", handleSearchInput);
  }
  // Default: show all
  filterProducts("All");
});
