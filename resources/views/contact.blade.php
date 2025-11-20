@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<style>
  /* Import Inter Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

  /* CSS Variables for Consistency */
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
    
    /* Responsive spacing */
    --spacing-xs: clamp(0.25rem, 1vw, 0.5rem);
    --spacing-sm: clamp(0.5rem, 2vw, 1rem);
    --spacing-md: clamp(1rem, 3vw, 1.5rem);
    --spacing-lg: clamp(1.5rem, 4vw, 2.5rem);
    --spacing-xl: clamp(2rem, 5vw, 4rem);
    
    /* Responsive font sizes */
    --font-xs: clamp(0.75rem, 1.5vw, 0.875rem);
    --font-sm: clamp(0.875rem, 2vw, 1rem);
    --font-base: clamp(1rem, 2.5vw, 1.125rem);
    --font-lg: clamp(1.125rem, 3vw, 1.5rem);
    --font-xl: clamp(1.5rem, 4vw, 2rem);
    --font-2xl: clamp(2rem, 5vw, 3rem);
    --font-3xl: clamp(2.5rem, 6vw, 3.5rem);
  }

  /* Hero Section */
  .contact-hero {
    position: relative;
    padding: clamp(4rem, 10vw, 6.25rem) var(--spacing-md);
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?q=80&w=2074&auto=format&fit=crop') center/cover;
    color: white;
    text-align: center;
    overflow: hidden;
    background-attachment: fixed;
  }

  .contact-hero::before {
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
    100% { left: 200%; }
  }

  .contact-hero-content {
    max-width: min(900px, 90vw);
    margin: 0 auto;
    position: relative;
    z-index: 1;
    animation: fadeInUp 1s ease-out;
  }

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

  .contact-hero h1 {
    font-family: 'Inter', sans-serif;
    font-size: var(--font-3xl);
    font-weight: 900;
    margin-bottom: clamp(1rem, 2vw, 1.25rem);
    text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.7);
    letter-spacing: -0.02em;
    color: white;
  }

  .contact-hero p {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.063rem, 2.5vw, 1.3rem);
    opacity: 0.95;
    line-height: 1.7;
    color: white;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
  }

  /* Section */
  .section {
    padding: clamp(3rem, 8vw, 5rem) var(--spacing-md);
    width: 100%;
    overflow: hidden;
  }

  .container {
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
  }

  /* Contact Grid */
  .contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(420px, 100%), 1fr));
    gap: clamp(2rem, 4vw, 2.5rem);
    animation: fadeInScale 0.8s ease-out;
  }

  @keyframes fadeInScale {
    from {
      opacity: 0;
      transform: scale(0.95);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  /* Contact Info Card - IMPROVED */
  .contact-info-card {
    background: white;
    border-radius: clamp(16px, 3vw, 24px);
    padding: clamp(1.5rem, 4vw, 2.8rem);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    height: fit-content;
    position: sticky;
    top: 100px;
  }

  .contact-info-card h4 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.25rem, 3vw, 1.8rem);
    font-weight: 900;
    color: #1f2937;
    margin-bottom: clamp(1.25rem, 3vw, 1.875rem);
    letter-spacing: -0.02em;
  }

  /* Contact Item - IMPROVED FOR MOBILE */
  .contact-item {
    margin-bottom: clamp(1.25rem, 3vw, 1.5rem);
    padding: clamp(1rem, 2.5vw, 1.25rem);
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.03) 0%, rgba(51, 133, 255, 0.03) 100%);
    border-radius: clamp(10px, 2vw, 12px);
    border-left: 4px solid #0066FF;
    transition: all 0.3s ease;
  }

  .contact-item:hover {
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.08) 0%, rgba(51, 133, 255, 0.08) 100%);
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0, 102, 255, 0.1);
  }

  .contact-item:last-of-type {
    margin-bottom: 0;
  }

  .contact-item-label {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.75rem, 1.5vw, 0.875rem);
    font-weight: 800;
    color: #0066FF;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: clamp(0.625rem, 1.5vw, 0.75rem);
    display: flex;
    align-items: center;
    gap: clamp(0.5rem, 1.5vw, 0.625rem);
  }

  .contact-item-label i {
    font-size: clamp(1rem, 2vw, 1.125rem);
    width: clamp(20px, 4vw, 24px);
    text-align: center;
  }

  /* Contact Value - IMPROVED READABILITY */
  .contact-item-value {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.938rem, 2.2vw, 1.05rem);
    color: #1f2937;
    line-height: 1.8;
    word-wrap: break-word;
    overflow-wrap: break-word;
    font-weight: 500;
  }

  .contact-item-value a {
    color: #0066FF;
    text-decoration: none;
    transition: all 0.3s ease;
    word-break: break-word;
    display: inline-block;
    padding: clamp(0.125rem, 0.5vw, 0.25rem) 0;
    font-weight: 600;
  }

  .contact-item-value a:hover {
    color: #0052CC;
    text-decoration: underline;
    transform: translateX(3px);
  }

  .contact-item-value br {
    display: block;
    content: "";
    margin: clamp(0.25rem, 1vw, 0.375rem) 0;
  }

  /* Contact Person - IMPROVED STRUCTURE */
  .contact-person {
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.08) 0%, rgba(51, 133, 255, 0.08) 100%);
    border-radius: clamp(12px, 2vw, 16px);
    padding: clamp(1.125rem, 2.5vw, 1.375rem);
    margin-top: clamp(1.25rem, 3vw, 1.5rem);
    border: 2px solid rgba(0, 102, 255, 0.1);
    transition: all 0.3s ease;
  }

  .contact-person:hover {
    border-color: rgba(0, 102, 255, 0.3);
    box-shadow: 0 4px 12px rgba(0, 102, 255, 0.15);
    transform: translateY(-2px);
  }

  .contact-person h5 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.938rem, 2vw, 1.125rem);
    font-weight: 800;
    color: #0066FF;
    margin-bottom: clamp(0.625rem, 1.5vw, 0.75rem);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-size: clamp(0.813rem, 1.8vw, 0.938rem);
  }

  .contact-person p {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.938rem, 2vw, 1rem);
    color: #1f2937;
    margin-bottom: clamp(0.5rem, 1.2vw, 0.625rem);
    line-height: 1.7;
  }

  .contact-person p:last-child {
    margin-bottom: 0;
  }

  .contact-person strong {
    color: #1f2937;
    display: block;
    margin-bottom: clamp(0.375rem, 1vw, 0.5rem);
    font-size: clamp(1rem, 2.2vw, 1.063rem);
    font-weight: 700;
  }

  .contact-person a {
    color: #0066FF;
    text-decoration: none;
    transition: all 0.3s ease;
    word-break: break-word;
    display: inline-block;
    font-weight: 600;
    padding: clamp(0.25rem, 0.8vw, 0.375rem) 0;
  }

  .contact-person a:hover {
    color: #0052CC;
    text-decoration: underline;
    transform: translateX(3px);
  }

  /* Contact Form Card */
  .contact-form-card {
    background: white;
    border-radius: clamp(16px, 3vw, 24px);
    padding: clamp(2rem, 5vw, 2.8rem);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
  }

  .contact-form-card h4 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.375rem, 3vw, 1.8rem);
    font-weight: 900;
    color: #1f2937;
    margin-bottom: clamp(0.75rem, 2vw, 0.938rem);
    letter-spacing: -0.02em;
  }

  .contact-form-card > p {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.938rem, 2vw, 1.05rem);
    color: #6b7280;
    margin-bottom: clamp(1.75rem, 4vw, 2.2rem);
    line-height: 1.6;
  }

  .form-group {
    margin-bottom: clamp(1.25rem, 3vw, 1.5rem);
  }

  .form-label {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.875rem, 1.8vw, 0.95rem);
    font-weight: 700;
    color: #1f2937;
    margin-bottom: clamp(0.5rem, 1.5vw, 0.625rem);
    display: block;
  }

  .form-control {
    font-family: 'Inter', sans-serif;
    width: 100%;
    padding: clamp(0.75rem, 2vw, 0.875rem) clamp(1rem, 2.5vw, 1.25rem);
    border: 2px solid #e5e7eb;
    border-radius: clamp(10px, 2vw, 12px);
    font-size: clamp(0.938rem, 2vw, 1rem);
    transition: all 0.3s ease;
    background: white;
  }

  .form-control:focus {
    outline: none;
    border-color: #0066FF;
    box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
  }

  textarea.form-control {
    resize: vertical;
    min-height: clamp(120px, 20vw, 150px);
  }

  .form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(250px, 100%), 1fr));
    gap: clamp(1rem, 2.5vw, 1.25rem);
  }

  .form-note {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.75rem, 1.5vw, 0.85rem);
    color: #6b7280;
    margin-top: clamp(0.375rem, 1vw, 0.5rem);
    font-style: italic;
    line-height: 1.4;
  }

  .btn-submit {
    font-family: 'Inter', sans-serif;
    padding: clamp(0.875rem, 2vw, 1rem) clamp(2rem, 5vw, 2.8rem);
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    font-weight: 700;
    border-radius: 50px;
    font-size: clamp(0.938rem, 2vw, 1.1rem);
    border: none;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(0, 102, 255, 0.4);
    display: inline-flex;
    align-items: center;
    gap: clamp(0.5rem, 1.5vw, 0.625rem);
    white-space: nowrap;
    width: auto;
  }

  .btn-submit:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 35px rgba(0, 102, 255, 0.5);
  }

  .btn-submit:active {
    transform: translateY(-1px) scale(1.02);
  }

  /* Map Section */
  .map-section {
    margin-top: clamp(2.5rem, 5vw, 3.75rem);
    border-radius: clamp(16px, 3vw, 24px);
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
  }

  .map-section iframe {
    width: 100%;
    height: clamp(350px, 50vw, 450px);
    border: none;
    display: block;
  }

  /* Quick Contact */
  .quick-contact {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: clamp(3.5rem, 8vw, 5rem) var(--spacing-md);
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
    margin-top: clamp(3.5rem, 8vw, 5rem);
  }

  .quick-contact::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: rotate 25s linear infinite;
  }

  @keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }

  .quick-contact-content {
    max-width: min(800px, 90vw);
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .quick-contact h2 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 900;
    margin-bottom: clamp(1rem, 2vw, 1.25rem);
    letter-spacing: -0.02em;
  }

  .quick-contact p {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.063rem, 2.5vw, 1.2rem);
    margin-bottom: clamp(1.75rem, 4vw, 2.2rem);
    opacity: 0.95;
    line-height: 1.7;
  }

  .quick-contact-buttons {
    display: flex;
    gap: clamp(0.75rem, 2vw, 1.25rem);
    justify-content: center;
    flex-wrap: wrap;
  }

  .btn-quick {
    font-family: 'Inter', sans-serif;
    padding: clamp(0.875rem, 2vw, 1rem) clamp(1.75rem, 4vw, 2.2rem);
    background: white;
    color: #0066FF;
    font-weight: 700;
    border-radius: 50px;
    font-size: clamp(0.938rem, 2vw, 1.05rem);
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: clamp(0.5rem, 1.5vw, 0.625rem);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    white-space: nowrap;
  }

  .btn-quick:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
    background: #3385FF;
    color: white;
  }

  .btn-quick i {
    font-size: clamp(1rem, 2vw, 1.125rem);
  }

  /* Responsive Breakpoints */
  
  /* Extra Small Mobile (320px - 479px) */
  @media (max-width: 479px) {
    .contact-hero {
      background-attachment: scroll;
    }

    .contact-grid {
      grid-template-columns: 1fr;
    }

    .contact-info-card {
      position: static;
      padding: clamp(1.25rem, 4vw, 1.5rem);
    }

    .contact-item {
      padding: clamp(0.875rem, 2.5vw, 1rem);
    }

    .contact-item-value {
      font-size: 0.938rem;
      line-height: 1.7;
    }

    .contact-person {
      padding: 1rem;
    }

    .form-row {
      grid-template-columns: 1fr;
    }

    .btn-submit {
      width: 100%;
      justify-content: center;
    }

    .quick-contact-buttons {
      flex-direction: column;
      align-items: stretch;
    }

    .btn-quick {
      width: 100%;
      justify-content: center;
    }
  }

  /* Mobile Landscape (480px - 767px) */
  @media (min-width: 480px) and (max-width: 767px) {
    .contact-grid {
      grid-template-columns: 1fr;
    }

    .contact-info-card {
      position: static;
    }

    .contact-item {
      padding: 1rem;
    }

    .form-row {
      grid-template-columns: 1fr;
    }
  }

  /* Tablet Portrait (768px - 991px) */
  @media (min-width: 768px) and (max-width: 991px) {
    .contact-grid {
      grid-template-columns: 1fr;
    }

    .contact-info-card {
      position: static;
    }

    .form-row {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  /* Tablet Landscape & Small Desktop (992px - 1199px) */
  @media (min-width: 992px) and (max-width: 1199px) {
    .contact-grid {
      grid-template-columns: 420px 1fr;
    }
  }

  /* Large Desktop (1200px+) */
  @media (min-width: 1200px) {
    .contact-grid {
      grid-template-columns: 450px 1fr;
    }
  }

  /* Landscape Orientation on Mobile */
  @media (max-height: 500px) and (orientation: landscape) {
    .contact-hero {
      padding: 3rem var(--spacing-md);
      background-attachment: scroll;
    }

    .contact-info-card {
      position: static;
    }
  }

  /* High DPI / Retina Displays */
  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .contact-hero {
      background-image: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                        url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?q=80&w=2074&auto=format&fit=crop&dpr=2');
    }
  }

  /* Reduced Motion for Accessibility */
  @media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
      animation-duration: 0.01ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.01ms !important;
    }
  }

  /* Print Styles */
  @media print {
    .contact-hero,
    .quick-contact {
      display: none;
    }

    .contact-form-card form {
      display: none;
    }

    .section {
      page-break-inside: avoid;
    }
  }

  /* Touch device optimizations */
  @media (hover: none) and (pointer: coarse) {
    .btn-submit:hover,
    .btn-quick:hover {
      transform: none;
    }

    .btn-submit:active {
      transform: scale(0.98);
    }

    .btn-quick:active {
      transform: scale(0.98);
    }
  }

  /* Success Message Styles */
  .form-success,
  .form-error {
    font-family: 'Inter', sans-serif;
    padding: clamp(0.875rem, 2vw, 1rem);
    border-radius: clamp(10px, 2vw, 12px);
    margin-bottom: clamp(1rem, 2vw, 1.25rem);
    font-size: clamp(0.938rem, 2vw, 1rem);
    font-weight: 600;
  }

  .form-success {
    background: #d1fae5;
    color: #065f46;
    border: 2px solid #10b981;
  }

  .form-error {
    background: #fee2e2;
    color: #991b1b;
    border: 2px solid #ef4444;
  }
</style>

<div class="w-full">
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="contact-hero-content">
            <h1>Contact Us</h1>
            <p>We are here to help. Reach out to us anytime.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Information -->
                <div class="contact-info-card">
                    <h4>Contact Details</h4>

                    <div class="contact-item">
                        <div class="contact-item-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Address
                        </div>
                        <div class="contact-item-value">
                            No 5 Harvard Road, Harben Park<br>
                            P.O. Box 1748, Gweru, Zimbabwe
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </div>
                        <div class="contact-item-value">
                            <a href="mailto:queenofpeace.org@gmail.com">queenofpeace.org@gmail.com</a><br>
                            <a href="mailto:qprehab@gmail.com">qprehab@gmail.com</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-label">
                            <i class="fas fa-phone"></i>
                            Phone
                        </div>
                        <div class="contact-item-value">
                            <a href="tel:+263777942996">+263 77 7942 996</a><br>
                            <a href="tel:+263719932695">+263 719 932 695</a>
                        </div>
                    </div>

                    <div class="contact-person">
                        <h5>Executive Director</h5>
                        <p>
                            <strong>Mrs Stella Khumalo Punungwe</strong>
                            <a href="tel:+263772600778">+263 772 600 778</a>
                        </p>
                    </div>

                    <div class="contact-person">
                        <h5>Other Contacts</h5>
                        <p>
                            <strong>Mr. T. Kupemba</strong>
                            <a href="tel:+263785296888">+263 785 296 888</a>
                        </p>
                        <p>
                            <strong>Mr. T. Marodza</strong>
                            <a href="tel:+263779341940">+263 779 341 940</a>
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-card">
                    <h4>Send a Message</h4>
                    <p>Thank you for contacting us. We will respond as soon as possible.</p>

                    @if(session('success'))
                        <div class="form-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="form-error">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="#" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Your Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subject *</label>
                            <input type="text" name="subject" class="form-control" placeholder="What is this about?" value="{{ old('subject') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+263 ___ ___ ___" value="{{ old('phone') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Your Message *</label>
                            <textarea name="message" class="form-control" rows="6" placeholder="Type your message here..." required>{{ old('message') }}</textarea>
                            <p class="form-note">Please provide as much detail as possible so we can assist you better.</p>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i>
                            <span>Send Message</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Map Section -->
            <div class="map-section">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3781.8614144729894!2d29.814774815036895!3d-19.44888998688785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ec5bc7f8f8f8f8f%3A0x1ec5bc7f8f8f8f8f!2sGweru%2C%20Zimbabwe!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Queen of Peace Location Map">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Quick Contact Section -->
    <section class="quick-contact">
        <div class="quick-contact-content">
            <h2>Need Immediate Help?</h2>
            <p>Our crisis intervention team is available 24/7 to provide support and guidance.</p>
            <div class="quick-contact-buttons">
                <a href="tel:+263777942996" class="btn-quick">
                    <i class="fas fa-phone"></i>
                    <span>Call Now</span>
                </a>
                <a href="https://wa.me/263777942996" class="btn-quick" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
                <a href="mailto:queenofpeace.org@gmail.com" class="btn-quick">
                    <i class="fas fa-envelope"></i>
                    <span>Email Us</span>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection