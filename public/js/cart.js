// Load cart from localStorage. Each item: { title, price, image, qty }
const CART_KEY = window.cartStorageKey || "cart_guest";
let cart = JSON.parse(localStorage.getItem(CART_KEY)) || [];

// Normalise legacy items that don't have a qty field
cart = cart.map(item => ({ ...item, qty: item.qty || 1 }));

const container = document.getElementById("cart-items");
const checkoutBtn = document.getElementById("checkout-btn");
const totalEl   = document.getElementById("total-price");
let total =0;

function saveCart() {
  localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

function renderCart() {
  container.innerHTML = "";

if (cart.length === 0) {
  total = 0;
  container.innerHTML = "<p class='empty'>Your cart is empty</p>";
  totalEl.textContent = "Total: $0";

  if (checkoutBtn) {
    checkoutBtn.disabled = true;
    checkoutBtn.style.opacity = "0.5";
    checkoutBtn.style.cursor = "not-allowed";
  }

  const orderSection = document.getElementById("order-section");
  if (orderSection) {
    orderSection.style.display = "none";
  }

  return;
}

if (checkoutBtn) {
  checkoutBtn.disabled = false;
  checkoutBtn.style.opacity = "1";
  checkoutBtn.style.cursor = "pointer";
}

  total = 0;

  cart.forEach((item, index) => {
    const subtotal = item.price * item.qty;
    total += subtotal;

    const div = document.createElement("div");
    div.classList.add("cart-item");

    div.innerHTML = `
      <img src="${item.image}" alt="${item.title}">

      <div class="cart-info">
        <h3>${item.title}</h3>
        <p class="cart-price">$${item.price.toFixed(2)} each</p>

        <div class="qty-controls">
          <button class="qty-btn" onclick="changeQty(${index}, -1)">−</button>
          <span class="qty-value">${item.qty}</span>
          <button class="qty-btn" onclick="changeQty(${index}, 1)">+</button>
        </div>

        <p class="item-subtotal">Subtotal: $${subtotal.toFixed(2)}</p>
      </div>

      <div class="cart-item-actions">
        <button class="remove-btn" onclick="removeItem(${index})">Remove</button>
      </div>
    `;

    container.appendChild(div);
  });

  totalEl.textContent = "Total: $" + total.toFixed(2);
}

function changeQty(index, delta) {
  cart[index].qty += delta;

  if (cart[index].qty < 1)
    // Remove item if quantity drops below 1
    cart.splice(index, 1);
  saveCart();
  renderCart();
}

function removeItem(index) {
  cart.splice(index, 1);
  saveCart();
  renderCart();
}


function showOrderForm(){
  if (cart.length === 0) {
    alert("Your cart is empty!");
    return;
  }

  const orderSection = document.getElementById("order-section");
  orderSection.style.display = "block";
  orderSection.scrollIntoView({ behavior: "smooth" });

  const priceField = document.getElementById("price");
  if (priceField) {
    priceField.value = "$" + total.toFixed(2);
  }
}

// this script convert cart data into hidden inputs that laravel will receive

document.addEventListener('DOMContentLoaded',() => {
const form = document.getElementById('order-form');
if(!form) return;

 form.addEventListener("submit", (e) => {
  if (cart.length === 0) {
      e.preventDefault();
      alert("Your cart is empty!");
      return;
}

form.querySelectorAll(".cart-hidden").forEach(el => el.remove());
   const hiddenTotal = document.createElement("input");
    hiddenTotal.type  = "hidden";
    hiddenTotal.name  = "total_price";
    hiddenTotal.value = total.toFixed(2);
    hiddenTotal.classList.add("cart-hidden");
    form.appendChild(hiddenTotal);

    cart.forEach((item, i) => {
      const fields = {
        product_id: item.id,
        name:       item.title,
        category:   item.category,
        price:      item.price,
        qty:        item.qty,
      };

      Object.entries(fields).forEach(([key, value]) => {
        const input   = document.createElement("input");
        input.type    = "hidden";
        input.name    = `items[${i}][${key}]`;
        input.value   = value ?? "";
        input.classList.add("cart-hidden");
        form.appendChild(input);
      });
    });
  });
});

renderCart();
