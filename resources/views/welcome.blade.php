@extends('layouts.app')

@section('content')
<style>
  /* Import Inter Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

  /* Hero Slider Styles */
  .hero-slider {
    position: relative;
    height: 90vh;
    overflow: hidden;
  }

  .slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 2s ease-in-out;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

  .slide.active {
    opacity: 1;
  }

  /* Enhanced overlay with blue theme */
  .slide::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
      135deg, 
      rgba(0, 102, 255, 0.55) 0%, 
      rgba(0, 82, 204, 0.45) 50%,
      rgba(31, 41, 55, 0.5) 100%
    );
  }

  /* Animated pattern overlay */
  .slide::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.15;
    animation: patternMove 20s linear infinite;
  }

  @keyframes patternMove {
    0% { background-position: 0 0; }
    100% { background-position: 60px 60px; }
  }

  .hero-content {
    position: relative;
    z-index: 10;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    animation: fadeInUp 1.2s ease-out;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(40px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .hero-text {
    max-width: 950px;
    padding: 50px 45px;
  }

  .hero-text h1 {
    font-family: 'Inter', sans-serif;
    font-size: 3.8rem;
    font-weight: 900;
    margin-bottom: 1.8rem;
    color: white !important;
    line-height: 1.15;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.8), 0 2px 4px rgba(0, 0, 0, 0.6);
    letter-spacing: -0.02em;
  }

  .hero-text p {
    font-family: 'Inter', sans-serif;
    font-size: 1.4rem;
    margin-bottom: 2.5rem;
    color: white !important;
    line-height: 1.7;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
    font-weight: 400;
  }

  .hero-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
  }

  .btn-primary {
    padding: 18px 45px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.15rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 10px 25px rgba(0, 102, 255, 0.5);
    border: none;
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.01em;
    text-decoration: none;
    display: inline-block;
  }

  .btn-primary:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 35px rgba(0, 102, 255, 0.6);
    color: white;
  }

  .btn-secondary {
    padding: 18px 45px;
    background: rgba(255, 255, 255, 0.25);
    color: white;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.15rem;
    border: 2px solid rgba(255, 255, 255, 0.9);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.01em;
    text-decoration: none;
    display: inline-block;
  }

  .btn-secondary:hover {
    background: white;
    color: #0066FF;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 35px rgba(255, 255, 255, 0.4);
  }

  /* Slider Navigation */
  .slider-nav {
    position: absolute;
    bottom: 50px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 20;
    display: flex;
    gap: 14px;
  }

  .slider-dot {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid white;
  }

  .slider-dot:hover {
    background: rgba(255, 255, 255, 0.7);
    transform: scale(1.2);
  }

  .slider-dot.active {
    background: white;
    width: 45px;
    border-radius: 12px;
  }

  /* Arrow Navigation */
  .slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    background: rgba(255, 255, 255, 0.25);
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
  }

  .slider-arrow:hover {
    background: rgba(255, 255, 255, 0.4);
    transform: translateY(-50%) scale(1.15);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  }

  .slider-arrow.prev { left: 40px; }
  .slider-arrow.next { right: 40px; }

  /* Animated Stats Section */
  .stats-section {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: 70px 20px;
    margin-top: -60px;
    position: relative;
    z-index: 10;
    overflow: hidden;
  }

  .stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    animation: shimmer 4s infinite;
  }

  @keyframes shimmer {
    0% { left: -100%; }
    100% { left: 200%; }
  }

  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 50px;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .stat-item {
    text-align: center;
    color: white;
    animation: fadeInScale 0.8s ease-out;
    animation-fill-mode: both;
  }

  .stat-item:nth-child(1) { animation-delay: 0.1s; }
  .stat-item:nth-child(2) { animation-delay: 0.2s; }
  .stat-item:nth-child(3) { animation-delay: 0.3s; }
  .stat-item:nth-child(4) { animation-delay: 0.4s; }

  @keyframes fadeInScale {
    from {
      opacity: 0;
      transform: scale(0.8) translateY(20px);
    }
    to {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }

  .stat-number {
    font-family: 'Inter', sans-serif;
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 12px;
    display: block;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    letter-spacing: -0.02em;
  }

  .stat-label {
    font-family: 'Inter', sans-serif;
    font-size: 1.15rem;
    opacity: 0.95;
    font-weight: 600;
  }

  /* Counter Animation */
  .stat-number.counting {
    animation: pulse 2s ease-out;
  }

  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
  }

  /* Section Styles */
  .section {
    padding: 90px 20px;
  }

  .section-title {
    font-family: 'Inter', sans-serif;
    text-align: center;
    font-size: 2.8rem;
    font-weight: 900;
    color: #1f2937;
    margin-bottom: 24px;
    letter-spacing: -0.02em;
  }

  .section-subtitle {
    font-family: 'Inter', sans-serif;
    text-align: center;
    font-size: 1.25rem;
    color: #6b7280;
    max-width: 750px;
    margin: 0 auto 60px;
    line-height: 1.7;
  }

  /* Programs Cards */
  .programs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 35px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .program-card {
    background: white;
    border-radius: 20px;
    padding: 45px 35px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
  }

  .program-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 50px rgba(0, 102, 255, 0.2);
    border-color: #0066FF;
  }

  .program-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 2.2rem;
    color: white;
    box-shadow: 0 8px 25px rgba(0, 102, 255, 0.3);
    transition: all 0.4s ease;
  }

  .program-card:hover .program-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 35px rgba(0, 102, 255, 0.4);
  }

  .program-card h3 {
    font-family: 'Inter', sans-serif;
    font-size: 1.6rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 18px;
    letter-spacing: -0.01em;
  }

  .program-card p {
    font-family: 'Inter', sans-serif;
    color: #6b7280;
    line-height: 1.7;
    font-size: 1.05rem;
  }

  /* Gallery Grid */
  .gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 0 auto 50px;
  }

  .gallery-item {
    position: relative;
    height: 320px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    cursor: pointer;
  }

  .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .gallery-item:hover img {
    transform: scale(1.15);
  }

  .gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.85) 0%, rgba(31, 41, 55, 0.75) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.6rem;
    font-weight: 800;
    font-family: 'Inter', sans-serif;
  }

  .gallery-item:hover .gallery-overlay {
    opacity: 1;
  }

  /* Partners Section */
  .partners-section {
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(0, 82, 204, 0.05) 100%);
    padding: 80px 20px;
  }

  .partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
    align-items: center;
  }

  .partner-logo {
    background: white;
    padding: 30px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 140px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInScale 0.6s ease-out;
    animation-fill-mode: both;
  }

  .partner-logo:nth-child(1) { animation-delay: 0.1s; }
  .partner-logo:nth-child(2) { animation-delay: 0.2s; }
  .partner-logo:nth-child(3) { animation-delay: 0.3s; }
  .partner-logo:nth-child(4) { animation-delay: 0.4s; }
  .partner-logo:nth-child(5) { animation-delay: 0.5s; }
  .partner-logo:nth-child(6) { animation-delay: 0.6s; }

  .partner-logo:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0, 102, 255, 0.15);
  }

  .partner-logo img {
    max-width: 100%;
    max-height: 80px;
    object-fit: contain;
    filter: grayscale(100%);
    transition: all 0.4s ease;
  }

  .partner-logo:hover img {
    filter: grayscale(0%);
  }

  /* CTA Section */
  .cta-section {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: 110px 20px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
  }

  .cta-section::before {
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

  .cta-section h2 {
    font-family: 'Inter', sans-serif;
    font-size: 3.2rem;
    font-weight: 900;
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
    letter-spacing: -0.02em;
  }

  .cta-section p {
    font-family: 'Inter', sans-serif;
    font-size: 1.35rem;
    max-width: 850px;
    margin: 0 auto 45px;
    opacity: 0.97;
    position: relative;
    z-index: 1;
    line-height: 1.7;
  }

  /* About Section with Image */
  .about-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 70px;
    max-width: 1200px;
    margin: 0 auto;
    align-items: center;
  }

  .about-content h2 {
    font-family: 'Inter', sans-serif;
    font-size: 2.8rem;
    font-weight: 900;
    color: #0066FF;
    margin-bottom: 24px;
    letter-spacing: -0.02em;
  }

  .about-content p {
    font-family: 'Inter', sans-serif;
    color: #6b7280;
    line-height: 1.8;
    font-size: 1.15rem;
    margin-bottom: 32px;
  }

  .about-image {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.15);
  }

  .about-image img {
    width: 100%;
    height: 550px;
    object-fit: cover;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .hero-slider {
      height: 75vh;
    }

    .hero-text {
      padding: 35px 28px;
    }

    .hero-text h1 {
      font-size: 2.2rem;
    }

    .hero-text p {
      font-size: 1.05rem;
    }

    .hero-buttons {
      flex-direction: column;
    }

    .slider-arrow {
      width: 50px;
      height: 50px;
    }

    .slider-arrow.prev { left: 15px; }
    .slider-arrow.next { right: 15px; }

    .stat-number {
      font-size: 2.5rem;
    }

    .about-grid {
      grid-template-columns: 1fr;
    }

    .section-title {
      font-size: 2.2rem;
    }

    .cta-section h2 {
      font-size: 2.2rem;
    }

    .partners-grid {
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 20px;
    }
  }
</style>

<div class="w-full">
    <!-- Hero Slider Section -->
    <section class="hero-slider">
        <!-- Slide 1 - Children NGO -->
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bmdvfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000')">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Restoring Lives Through Compassion</h1>
                    <p>Welcome to Queen of Peace Rehabilitation Centre — offering hope, healing, and transformation for individuals battling addiction.</p>
                    <div class="hero-buttons">
                        <a href="/donate" class="btn-primary">💝 Donate Now</a>
                        <a href="/about" class="btn-secondary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 - Community Support -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1608052026785-0bc249c733e3?q=80&w=1218&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Building Brighter Futures Together</h1>
                    <p>Every life matters. Join us in our mission to restore hope and dignity to those seeking recovery and rehabilitation.</p>
                    <div class="hero-buttons">
                        <a href="/services" class="btn-primary">Our Services</a>
                        <a href="/contact" class="btn-secondary">Get Help Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 - Hands Together -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1683105436130-3f3b9e8fbabe?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDJ8fHxlbnwwfHx8fHw%3D')">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Finding Peace in Recovery</h1>
                    <p>We provide a safe, supportive environment where healing begins and transformation takes root.</p>
                    <div class="hero-buttons">
                        <a href="/services" class="btn-primary">View Programs</a>
                        <a href="/about" class="btn-secondary">Success Stories</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 4 - Caring Hands -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1761918900832-b178aaf40916?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDMxfHx8ZW58MHx8fHx8')">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Compassionate Care & Support</h1>
                    <p>Break free from addiction and embrace a life of freedom, purpose, and renewed hope with our dedicated team.</p>
                    <div class="hero-buttons">
                        <a href="/contact" class="btn-primary">Reach Out Today</a>
                        <a href="/about" class="btn-secondary">Our Story</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 5 - Hope & Healing -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1509100297676-1a18b3842dd6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDM1fHx8ZW58MHx8fHx8')">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Faith, Hope & Renewal</h1>
                    <p>Together we can overcome addiction through faith, professional care, and unwavering support.</p>
                    <div class="hero-buttons">
                        <a href="/donate" class="btn-primary">Support Our Mission</a>
                        <a href="/events" class="btn-secondary">Upcoming Events</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 6 - Community Gathering -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1538023380698-a58563e71c59?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDZ8fHxlbnwwfHx8fHx8')">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Together We Rise</h1>
                    <p>Join our community of healing and support. Recovery is stronger together.</p>
                    <div class="hero-buttons">
                        <a href="/contact" class="btn-primary">Join Our Community</a>
                        <a href="/events" class="btn-secondary">Community Events</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 7 - Helping Hands -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1623399785391-6970a4e8d261?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDI1fHx8ZW58MHx8fHx8')">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Empowering Change</h1>
                    <p>Professional guidance and compassionate care to help you reclaim your life and build a brighter future.</p>
                    <div class="hero-buttons">
                        <a href="/services" class="btn-primary">Explore Services</a>
                        <a href="/contact" class="btn-secondary">Schedule Consultation</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 8 - Peace & Serenity -->
        <div class="slide" style="background-image: url('https://media.istockphoto.com/id/478010888/photo/zeandra-b-w.jpg?s=612x612&w=0&k=20&c=cz7sMNv4dDt6T-GQ7EifUtgbYjmenOkB_dzFvhh8KV8=')">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>A Journey to Peace</h1>
                    <p>Discover tranquility and strength in your recovery journey with Queen of Peace Rehabilitation Centre.</p>
                    <div class="hero-buttons">
                        <a href="/about" class="btn-primary">Our Approach</a>
                        <a href="/contact" class="btn-secondary">Start Your Journey</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <div class="slider-arrow prev" onclick="changeSlide(-1)">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="slider-arrow next" onclick="changeSlide(1)">
            <i class="fas fa-chevron-right"></i>
        </div>

        <!-- Navigation Dots -->
        <div class="slider-nav">
            <span class="slider-dot active" onclick="currentSlide(0)"></span>
            <span class="slider-dot" onclick="currentSlide(1)"></span>
            <span class="slider-dot" onclick="currentSlide(2)"></span>
            <span class="slider-dot" onclick="currentSlide(3)"></span>
            <span class="slider-dot" onclick="currentSlide(4)"></span>
            <span class="slider-dot" onclick="currentSlide(5)"></span>
            <span class="slider-dot" onclick="currentSlide(6)"></span>
            <span class="slider-dot" onclick="currentSlide(7)"></span>
        </div>
    </section>

    <!-- Animated Stats Section -->
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number" data-target="500">0</span>
                <span class="stat-label">Lives Transformed</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-target="19">0</span>
                <span class="stat-label">Years of Service</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-target="95">0</span>
                <span class="stat-label">Success Rate</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Support Available</span>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section" style="background-color: #f9fafb;">
        <div class="about-grid">
            <div class="about-content">
                <h2>Who We Are</h2>
                <p>
                    Queen of Peace Institute for Community Mental Health Innovations and Rehabilitation is a registered Private Voluntary Organization dedicated to providing comprehensive drug and alcohol rehabilitation services. We offer guidance, professional counseling, and unwavering support to individuals and families affected by addiction.
                </p>
                <p>
                    Our holistic approach combines evidence-based treatment methods with compassionate care, creating a nurturing environment where recovery is possible and lasting change begins.
                </p>
                <a href="/about" class="btn-primary" style="display: inline-block; margin-top: 20px;">
                    Discover Our Mission →
                </a>
            </div>

            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1608052026785-0bc249c733e3?q=80&w=1218&auto=format&fit=crop" alt="About Us">
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="section">
        <h2 class="section-title">Our Programs & Services</h2>
        <p class="section-subtitle">Comprehensive care tailored to meet your unique recovery needs</p>

        <div class="programs-grid">
            <div class="program-card">
                <div class="program-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <h3>Rehabilitation</h3>
                <p>Comprehensive residential and outpatient rehabilitation programs designed for sustainable recovery and long-term success.</p>
            </div>

            <div class="program-card">
                <div class="program-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3>Counselling</h3>
                <p>Professional therapy services including individual, group, and family counseling to address the root causes of addiction.</p>
            </div>

            <div class="program-card">
                <div class="program-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3>Community Outreach</h3>
                <p>Educational programs and community initiatives focused on prevention, awareness, and breaking the stigma of addiction.</p>
            </div>

            <div class="program-card">
                <div class="program-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3>Aftercare Support</h3>
                <p>Ongoing support and resources to help maintain sobriety and prevent relapse after completing treatment.</p>
            </div>

            <div class="program-card">
                <div class="program-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h3>Family Programs</h3>
                <p>Support groups and education for families to understand addiction and learn how to support their loved ones.</p>
            </div>

            <div class="program-card">
                <div class="program-icon">
                    <i class="fas fa-clinic-medical"></i>
                </div>
                <h3>Medical Care</h3>
                <p>Comprehensive medical assessment and care including detoxification services under professional supervision.</p>
            </div>
        </div>
    </section>

    <!-- Gallery Preview Section -->
    <section class="section" style="background-color: #f9fafb;">
        <h2 class="section-title">Our Gallery</h2>
        <p class="section-subtitle">Moments of hope, healing, and transformation</p>

        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.1.0&w=800" alt="Gallery 1">
                <div class="gallery-overlay">
                    <span>Community Care</span>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1538023380698-a58563e71c59?w=800&auto=format" alt="Gallery 2">
                <div class="gallery-overlay">
                    <span>Group Support</span>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1623399785391-6970a4e8d261?w=800&auto=format" alt="Gallery 3">
                <div class="gallery-overlay">
                    <span>Healing Journey</span>
                </div>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="/gallery" class="btn-primary">View Full Gallery →</a>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <div class="container">
            <h2 class="section-title">Our Partners</h2>
            <p class="section-subtitle">Working together to create lasting impact in our community</p>

            <div class="partners-grid">
                <div class="partner-logo">
                    <img src="{{ asset('images/Partner Logos-01.png') }}" alt="The Village Lodge Gweru">
                </div>

                <div class="partner-logo">
                    <img src="{{ asset('images/Partner Logos-02.png') }}" alt="City of Gweru">
                </div>

                <div class="partner-logo">
                    <img src="{{ asset('images/Partner Logos-03.png') }}" alt="The Church of Jesus Christ of Latter-day Saints">
                </div>

                <div class="partner-logo">
                    <img src="{{ asset('images/Partner Logos-04.png') }}" alt="NetOne">
                </div>

                <div class="partner-logo">
                    <img src="{{ asset('images/Partner Logos-05.png') }}" alt="Thornhill Airforce Zimbabwe">
                </div>

                <div class="partner-logo">
                    <img src="{{ asset('images/Partner Logos-06.png') }}" alt="Bata">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="cta-section">
        <h2>Need Help? We're Here For You.</h2>
        <p>Reach out to us anytime for support, guidance, or admissions information. Your journey to recovery starts with a single step.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1;">
            <a href="/contact" class="btn-primary" style="background: white; color: #0066FF; box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);">
                📞 Contact Us Now
            </a>
            <a href="/faq" class="btn-secondary">
                ❓ Frequently Asked Questions
            </a>
        </div>
    </section>
</div>

<script>
let currentSlideIndex = 0;
let slideInterval;
let statsAnimated = false;

// Initialize slider
document.addEventListener('DOMContentLoaded', function() {
    startAutoSlide();
    
    // Animate stats on scroll
    window.addEventListener('scroll', animateStatsOnScroll);
});

function startAutoSlide() {
    slideInterval = setInterval(() => {
        changeSlide(1);
    }, 7000);
}

function changeSlide(direction) {
    clearInterval(slideInterval);
    
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    
    slides[currentSlideIndex].classList.remove('active');
    dots[currentSlideIndex].classList.remove('active');
    
    currentSlideIndex += direction;
    
    if (currentSlideIndex >= slides.length) {
        currentSlideIndex = 0;
    } else if (currentSlideIndex < 0) {
        currentSlideIndex = slides.length - 1;
    }
    
    slides[currentSlideIndex].classList.add('active');
    dots[currentSlideIndex].classList.add('active');
    
    startAutoSlide();
}

function currentSlide(index) {
    clearInterval(slideInterval);
    
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    
    slides[currentSlideIndex].classList.remove('active');
    dots[currentSlideIndex].classList.remove('active');
    
    currentSlideIndex = index;
    
    slides[currentSlideIndex].classList.add('active');
    dots[currentSlideIndex].classList.add('active');
    
    startAutoSlide();
}

// Pause auto-slide on hover
document.querySelector('.hero-slider').addEventListener('mouseenter', function() {
    clearInterval(slideInterval);
});

document.querySelector('.hero-slider').addEventListener('mouseleave', function() {
    startAutoSlide();
});

// Animate Stats Counter
function animateStatsOnScroll() {
    if (statsAnimated) return;
    
    const statsSection = document.querySelector('.stats-section');
    const sectionPos = statsSection.getBoundingClientRect().top;
    const screenPos = window.innerHeight / 1.3;
    
    if (sectionPos < screenPos) {
        statsAnimated = true;
        animateCounters();
    }
}

function animateCounters() {
    const counters = document.querySelectorAll('.stat-number[data-target]');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        counter.classList.add('counting');
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target + (target === 95 ? '%' : '+');
            }
        };
        
        updateCounter();
    });
}
</script>
@endsection