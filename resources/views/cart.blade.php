<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart | Beitna Furniture</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

 <header class="header">
  <nav class="nav">
    <h1 class="logo">Beitna Furniture</h1>

    <button class="hamburger" id="hamburger" onclick="toggleNav()">
      <span></span><span></span><span></span>
    </button>

    <div class="nav-overlay" id="navOverlay" onclick="toggleNav()"></div>

    <ul class="nav-links" id="nav-links">
  <li><a href="{{ route('home') }}" onclick="toggleNav()">Home</a></li>
  <li><a href="{{ route('shop') }}" onclick="toggleNav()">Shop</a></li>
  <li><a href="{{ route('cart') }}" onclick="toggleNav()">Cart</a></li>

 
  @guest
    <li><a href="{{ route('login') }}" onclick="toggleNav()">Login</a></li>
    <li><a href="{{ route('register') }}" onclick="toggleNav()">Register</a></li>
  @endguest

 
  @auth

    <li>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="
          background: none;
          border: none;
          color: #2b2b2b;
          font-weight: 500;
          cursor: pointer;
          font-size: 1rem;
          padding: 0;
          font-family: inherit;
        ">Logout</button>
      </form>
    </li>
  @endauth
</ul>
  </nav>
</header>

<section class="cart-section">
  <h1 class="cart-title">Your Cart</h1>

  <div id="cart-items" class="cart-items"></div>

  <div class="cart-summary">
    <div id="total-price" class="total" name="total-price">Total: $0</div>
    <button class="checkout-btn" onclick="showOrderForm()">Place Order</button>
  </div>
</section>

<section class="order-section" id="order-section" style="display: none;">
<h2>Complete Your Order</h2>
<p class="order-subtitle">Every piece deserves a home — tell us where to bring yours</p>
<form action="POST" class="order-form" id="order-form">
  <div class="form-label"><span>Personal Information</span></div>

  <div class="form-input">
    <label for="fname">First Name:</label>
    <input type="text" name="fname" id="fname" placeholder="Enter your first name" required>
  </div>

   <div class="form-input">
    <label for="lname">Last Name:</label>
    <input type="text" name="lname" id="lname" placeholder="Enter your last name" required>
  </div>

   <div class="form-input">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Enter your email" required>
  </div>

    <div class="form-input">
    <label for="phone">Phone Number:</label>
    <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required>
  </div>

   <div class="form-input">
    <label for="address">Address:</label>
    <input type="text" name="address" id="address" placeholder="Enter your address" required>
  </div>

   <div class="form-input">
    <label for="price">Total Price:</label>
    <input type="text" name="total_price" id="price" readonly>
  </div>
 <div class="form-button">
   <button type="submit">Confirm Order</button>
  </div>
</form>
</section>

  <script src="{{ asset('js/cart.js') }}"></script>
  <script src="{{ asset('js/animation.js') }}"></script>

</body>
</html>
