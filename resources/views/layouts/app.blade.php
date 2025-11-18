<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Queen of Peace Rehab')</title>
  
  <!-- Google Fonts - Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* Global Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary-blue: #0066FF;
      --primary-blue-dark: #0052CC;
      --primary-blue-light: #3385FF;
      --accent-blue: #0047B3;
      --accent-blue-dark: #003D99;
      --text-dark: #1f2937;
      --text-light: #6b7280;
      --bg-light: #f9fafb;
      --white: #ffffff;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background-color: var(--bg-light);
      color: var(--text-dark);
      margin: 0;
      padding: 0;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    a {
      text-decoration: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    h1, h2, h3 {
      color: var(--text-dark);
      font-weight: 700;
      letter-spacing: -0.02em;
    }

    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* Top Bar with Animation */
    .top-bar {
      background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-dark) 100%);
      color: white;
      padding: 12px 0;
      font-size: 14px;
      position: relative;
      overflow: hidden;
    }

    .top-bar::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
      0% { left: -100%; }
      100% { left: 100%; }
    }

    .top-bar .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      position: relative;
      z-index: 1;
    }

    .top-bar-left, .top-bar-right {
      display: flex;
      gap: 24px;
      align-items: center;
    }

    .top-bar a {
      color: white;
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .top-bar a:hover {
      transform: translateY(-2px);
      text-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .social-icons {
      display: flex;
      gap: 10px;
    }

    .social-icons a {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: rgba(255, 255, 255, 0.15);
      border-radius: 50%;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      backdrop-filter: blur(10px);
    }

    .social-icons a:hover {
      background-color: rgba(255, 255, 255, 0.25);
      transform: translateY(-3px) scale(1.1);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Main Navbar with Enhanced Animation */
    nav {
      background-color: rgba(255, 255, 255, 0.98);
      box-shadow: 0 4px 20px rgba(0,102,255,0.08);
      position: sticky;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(0, 102, 255, 0.1);
      animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
      from {
        transform: translateY(-100%);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    nav .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 1rem;
      padding-bottom: 1rem;
      gap: 40px;
    }

    /* Logo Section - Far Left */
    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 22px;
      font-weight: 800;
      color: var(--primary-blue);
      transition: all 0.3s ease;
      letter-spacing: -0.02em;
      flex-shrink: 0;
    }

    .logo:hover {
      transform: scale(1.05);
    }

    .logo i {
      font-size: 32px;
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
    }

    /* Navigation Menu - Centered */
    .nav-menu {
      display: flex;
      list-style: none;
      gap: 8px;
      align-items: center;
      flex: 1;
      justify-content: center;
      margin: 0;
    }

    .nav-menu li a {
      color: var(--text-dark);
      font-weight: 600;
      font-size: 15px;
      padding: 10px 16px;
      position: relative;
      border-radius: 8px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-menu li a::before {
      content: '';
      position: absolute;
      bottom: 8px;
      left: 16px;
      right: 16px;
      height: 2px;
      background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-light));
      transform: scaleX(0);
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      border-radius: 2px;
    }

    .nav-menu li a:hover::before,
    .nav-menu li a.active::before {
      transform: scaleX(1);
    }

    .nav-menu li a:hover {
      color: var(--primary-blue);
      background-color: rgba(0, 102, 255, 0.05);
    }

    .nav-menu li a.active {
      color: var(--primary-blue);
      background-color: rgba(0, 102, 255, 0.1);
    }

    /* Donate Button - Far Right */
    .donate-btn-desktop {
      flex-shrink: 0;
      margin-left: auto;
    }

    .donate-btn {
      background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-dark) 100%);
      color: white;
      padding: 12px 28px;
      border-radius: 10px;
      font-weight: 700;
      font-size: 15px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border: none;
      box-shadow: 0 4px 14px rgba(0, 102, 255, 0.4);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .donate-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s;
    }

    .donate-btn:hover::before {
      left: 100%;
    }

    .donate-btn:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 8px 20px rgba(0, 102, 255, 0.5);
    }

    .donate-btn i {
      animation: heartbeat 1.5s ease-in-out infinite;
    }

    @keyframes heartbeat {
      0%, 100% { transform: scale(1); }
      10%, 30% { transform: scale(1.1); }
      20%, 40% { transform: scale(0.9); }
    }

    /* Mobile Menu Toggle */
    .mobile-toggle {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 8px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .mobile-toggle:hover {
      background-color: rgba(0, 102, 255, 0.1);
    }

    .mobile-toggle span {
      width: 28px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-light));
      border-radius: 3px;
      transition: all 0.3s ease;
    }

    .mobile-toggle.active span:nth-child(1) {
      transform: rotate(45deg) translate(6px, 6px);
    }

    .mobile-toggle.active span:nth-child(2) {
      opacity: 0;
    }

    .mobile-toggle.active span:nth-child(3) {
      transform: rotate(-45deg) translate(6px, -6px);
    }

    /* Mobile Menu */
    #mobileMenu {
      display: none;
      background-color: white;
      box-shadow: 0 8px 24px rgba(0,102,255,0.12);
      padding: 24px;
      animation: slideDown 0.3s ease-out;
    }

    #mobileMenu.active {
      display: block;
    }

    #mobileMenu ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    #mobileMenu ul li a {
      color: var(--text-dark);
      font-weight: 600;
      display: block;
      padding: 14px 16px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    #mobileMenu ul li a:hover {
      color: var(--primary-blue);
      background-color: rgba(0, 102, 255, 0.1);
      padding-left: 24px;
    }

    /* Main Content */
    main {
      min-height: 70vh;
    }

    /* Enhanced Footer with Animations */
    footer {
      background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-dark) 100%);
      color: white;
      padding: 60px 0 30px;
      margin-top: 80px;
      position: relative;
      overflow: hidden;
    }

    footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      opacity: 0.5;
    }

    .footer-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 50px;
      margin-bottom: 40px;
      position: relative;
      z-index: 1;
    }

    .footer-section {
      animation: fadeInUp 0.6s ease-out;
      animation-fill-mode: both;
    }

    .footer-section:nth-child(1) { animation-delay: 0.1s; }
    .footer-section:nth-child(2) { animation-delay: 0.2s; }
    .footer-section:nth-child(3) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .footer-section h3 {
      color: white;
      font-size: 20px;
      margin-bottom: 24px;
      font-weight: 800;
      letter-spacing: -0.02em;
      position: relative;
      display: inline-block;
    }

    .footer-section h3::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 40px;
      height: 3px;
      background: linear-gradient(90deg, white, var(--primary-blue-light));
      border-radius: 3px;
    }

    .footer-section p {
      line-height: 1.8;
      opacity: 0.95;
      font-weight: 400;
    }

    .footer-section ul {
      list-style: none;
    }

    .footer-section ul li {
      margin-bottom: 14px;
    }

    .footer-section ul li a {
      color: white;
      opacity: 0.9;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .footer-section ul li a:hover {
      opacity: 1;
      padding-left: 8px;
      text-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .footer-section ul li a i {
      font-size: 12px;
      transition: transform 0.3s ease;
    }

    .footer-section ul li a:hover i {
      transform: translateX(4px);
    }

    .contact-info {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .contact-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      transition: all 0.3s ease;
      padding: 12px;
      border-radius: 10px;
    }

    .contact-item:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateX(5px);
    }

    .contact-item i {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }

    .contact-item:hover i {
      transform: scale(1.1);
      background: linear-gradient(135deg, var(--primary-blue-light), var(--primary-blue));
    }

    .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      padding-top: 30px;
      text-align: center;
      opacity: 0.95;
      font-size: 14px;
      position: relative;
      z-index: 1;
    }

    .footer-bottom i {
      color: var(--primary-blue-light);
      animation: heartbeat 1.5s ease-in-out infinite;
    }

    /* Responsive Design */
    @media (max-width: 968px) {
      nav .container {
        gap: 20px;
      }

      .nav-menu {
        gap: 4px;
      }

      .nav-menu li a {
        padding: 10px 12px;
        font-size: 14px;
      }

      .donate-btn {
        padding: 10px 20px;
        font-size: 14px;
      }
    }

    @media (max-width: 768px) {
      .top-bar {
        font-size: 13px;
      }

      .top-bar .container {
        justify-content: center;
        text-align: center;
      }

      .top-bar-left, .top-bar-right {
        flex-direction: column;
        gap: 12px;
      }

      nav .container {
        flex-wrap: wrap;
      }

      .nav-menu {
        display: none;
      }

      .mobile-toggle {
        display: flex;
      }

      .donate-btn-desktop {
        display: none;
      }

      .footer-content {
        grid-template-columns: 1fr;
        gap: 35px;
      }

      .logo {
        font-size: 20px;
      }

      .logo i {
        font-size: 28px;
      }
    }

    @media (min-width: 769px) {
      #mobileMenu {
        display: none !important;
      }
    }

    /* Scroll Animation */
    nav.scrolled {
      box-shadow: 0 8px 30px rgba(0,102,255,0.12);
    }
  </style>
</head>
<body>
  <!-- TOP BAR -->
  <div class="top-bar">
    <div class="container">
      <div class="top-bar-left">
        <a href="tel:+263xxxxxxxxx">
          <i class="fas fa-phone"></i>
          <span>+263 xxx xxx xxx</span>
        </a>
        <a href="mailto:info@queenofpeacerehab.org">
          <i class="fas fa-envelope"></i>
          <span>info@queenofpeacerehab.org</span>
        </a>
      </div>
      <div class="top-bar-right">
        <div class="social-icons">
          <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- MAIN NAVBAR -->
  <nav id="mainNav">
    <div class="container">
      <!-- Logo - Far Left -->
      <a href="/" class="logo">
        <img src="{{ asset('images/Logo.svg') }}" alt="Queen of Peace Logo" class="logo-image">
      </a>

      <!-- Desktop Menu - Center -->
      <ul class="nav-menu">
        <li><a href="{{ route('home') }}" class="{{ Request::routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="{{ Request::routeIs('about') ? 'active' : '' }}">About</a></li>
        <li><a href="{{ route('services') }}" class="{{ Request::routeIs('services') ? 'active' : '' }}">Services</a></li>
        <li><a href="{{ route('team') }}" class="{{ Request::routeIs('team') ? 'active' : '' }}">Team</a></li>
        <li><a href="{{ route('faq') }}" class="{{ Request::routeIs('faq') ? 'active' : '' }}">FAQ</a></li>
        <li><a href="{{ route('events') }}" class="{{ Request::routeIs('events') ? 'active' : '' }}">Events</a></li>
        <li><a href="{{ route('gallery') }}" class="{{ Request::routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
        <li><a href="{{ route('blog') }}" class="{{ Request::routeIs('blog') ? 'active' : '' }}">Blog</a></li>
        <li><a href="{{ route('contact') }}" class="{{ Request::routeIs('contact') ? 'active' : '' }}">Contact</a></li>
      </ul>

      <!-- Donate Button - Far Right -->
      <div class="donate-btn-desktop">
        <a href="/donate" class="donate-btn">
          <i class="fas fa-heart"></i>
          Donate Now
        </a>
      </div>

      <!-- Mobile Toggle -->
      <div class="mobile-toggle" onclick="toggleMobileMenu(this)">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About Us</a></li>
        <li><a href="/services">Services</a></li>
        <li><a href="/team">Our Team</a></li>
        <li><a href="/faq">FAQ</a></li>
        <li><a href="/events">Events</a></li>
        <li><a href="/gallery">Gallery</a></li>
        <li><a href="/blog">Blog</a></li>
        <li><a href="/contact">Contact</a></li>
        <li><a href="/donate" style="color: var(--primary-blue); font-weight: 700;">💝 Donate Now</a></li>
      </ul>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main>
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <!-- About Section -->
        <div class="footer-section">
          <h3>Queen of Peace Rehab</h3>
          <p>We support addiction recovery and mental health healing with compassion, dedication, and professional care. Together, we can make a difference.</p>
          <div class="social-icons" style="margin-top: 24px;">
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="footer-section">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="/about"><i class="fas fa-chevron-right"></i> About Us</a></li>
            <li><a href="/services"><i class="fas fa-chevron-right"></i> Our Services</a></li>
            <li><a href="/events"><i class="fas fa-chevron-right"></i> Events</a></li>
            <li><a href="/gallery"><i class="fas fa-chevron-right"></i> Gallery</a></li>
            <li><a href="/blog"><i class="fas fa-chevron-right"></i> Blog</a></li>
            <li><a href="/contact"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div class="footer-section">
          <h3>Contact Us</h3>
          <div class="contact-info">
            <div class="contact-item">
              <i class="fas fa-envelope"></i>
              <div>
                <strong>Email:</strong><br>
                info@queenofpeacerehab.org
              </div>
            </div>
            <div class="contact-item">
              <i class="fas fa-phone"></i>
              <div>
                <strong>Phone:</strong><br>
                +263 xxx xxx xxx
              </div>
            </div>
            <div class="contact-item">
              <i class="fas fa-map-marker-alt"></i>
              <div>
                <strong>Address:</strong><br>
                Gweru, Midlands Province, Zimbabwe
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        © {{ date('Y') }} Queen of Peace Rehab. All rights reserved. | Designed with <i class="fas fa-heart"></i> for a better tomorrow
      </div>
    </div>
  </footer>

  <script>
    function toggleMobileMenu(toggle) {
      const menu = document.getElementById('mobileMenu');
      toggle.classList.toggle('active');
      menu.classList.toggle('active');
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
      const menu = document.getElementById('mobileMenu');
      const toggle = document.querySelector('.mobile-toggle');
      
      if (!menu.contains(event.target) && !toggle.contains(event.target)) {
        menu.classList.remove('active');
        toggle.classList.remove('active');
      }
    });

    // Add scroll effect to navbar
    let lastScroll = 0;
    const nav = document.getElementById('mainNav');

    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset;
      
      if (currentScroll > 100) {
        nav.classList.add('scrolled');
      } else {
        nav.classList.remove('scrolled');
      }
      
      lastScroll = currentScroll;
    });
  </script>
</body>
</html>