@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')
<style>
  /* Bootstrap Icons */
  @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');

  /* CSS Variables for Consistency */
  :root {
    --primary-blue: #0066FF;
    --primary-blue-dark: #0052CC;
    --primary-blue-light: #3385FF;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
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
  .faq-hero {
    position: relative;
    padding: clamp(4rem, 10vw, 6.25rem) var(--spacing-md);
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                url('https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1920') center/cover;
    color: white;
    text-align: center;
    background-attachment: fixed;
    overflow: hidden;
  }

  .faq-hero-content {
    max-width: min(900px, 90vw);
    margin: 0 auto;
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

  .faq-hero h1 {
    font-family: 'Inter', sans-serif;
    font-size: var(--font-3xl);
    font-weight: 900;
    margin-bottom: clamp(1rem, 2vw, 1.5rem);
    text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.7);
    color: white;
    letter-spacing: -0.02em;
  }

  .faq-hero p {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.063rem, 2.5vw, 1.3rem);
    opacity: 0.95;
    line-height: 1.8;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    color: white;
  }

  /* Section */
  .section {
    padding: clamp(3rem, 8vw, 5rem) var(--spacing-md);
    width: 100%;
    overflow: hidden;
  }

  .container {
    max-width: 1000px;
    margin: 0 auto;
    width: 100%;
  }

  /* Search Box */
  .faq-search {
    max-width: min(600px, 100%);
    margin: 0 auto clamp(2rem, 5vw, 3rem);
    position: relative;
  }

  .faq-search input {
    width: 100%;
    padding: clamp(0.875rem, 2vw, 1.125rem) clamp(3rem, 8vw, 3.75rem) clamp(0.875rem, 2vw, 1.125rem) clamp(1.25rem, 3vw, 1.5rem);
    border: 2px solid #e5e7eb;
    border-radius: 50px;
    font-size: clamp(0.938rem, 2vw, 1.05rem);
    transition: all 0.3s ease;
    font-family: 'Inter', sans-serif;
  }

  .faq-search input:focus {
    outline: none;
    border-color: #0066FF;
    box-shadow: 0 5px 20px rgba(0, 102, 255, 0.15);
  }

  .faq-search button {
    position: absolute;
    right: clamp(0.375rem, 1vw, 0.5rem);
    top: 50%;
    transform: translateY(-50%);
    width: clamp(38px, 8vw, 45px);
    height: clamp(38px, 8vw, 45px);
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: clamp(1rem, 2vw, 1.125rem);
  }

  .faq-search button:hover {
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 102, 255, 0.4);
  }

  /* Category Tabs */
  .category-tabs {
    display: flex;
    gap: clamp(0.625rem, 2vw, 0.938rem);
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: clamp(2rem, 5vw, 3rem);
  }

  .category-tab {
    padding: clamp(0.625rem, 1.8vw, 0.75rem) clamp(1.25rem, 3vw, 1.875rem);
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 50px;
    font-weight: 700;
    color: #7f8c8d;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: clamp(0.375rem, 1.5vw, 0.625rem);
    font-size: clamp(0.813rem, 1.8vw, 0.938rem);
    font-family: 'Inter', sans-serif;
    white-space: nowrap;
  }

  .category-tab:hover {
    border-color: #0066FF;
    color: #0066FF;
    transform: translateY(-2px);
  }

  .category-tab.active {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-color: #0066FF;
    color: white;
    box-shadow: 0 5px 20px rgba(0, 102, 255, 0.3);
  }

  .category-tab i {
    font-size: clamp(0.875rem, 2vw, 1rem);
  }

  /* FAQ Items */
  .faq-list {
    display: flex;
    flex-direction: column;
    gap: clamp(1rem, 2.5vw, 1.25rem);
  }

  .faq-item {
    background: white;
    border-radius: clamp(12px, 2vw, 15px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    transition: all 0.3s ease;
    animation: slideIn 0.5s ease-out;
    animation-fill-mode: both;
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateX(-30px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .faq-item:nth-child(1) { animation-delay: 0.1s; }
  .faq-item:nth-child(2) { animation-delay: 0.2s; }
  .faq-item:nth-child(3) { animation-delay: 0.3s; }
  .faq-item:nth-child(4) { animation-delay: 0.4s; }
  .faq-item:nth-child(5) { animation-delay: 0.5s; }
  .faq-item:nth-child(6) { animation-delay: 0.6s; }
  .faq-item:nth-child(7) { animation-delay: 0.7s; }
  .faq-item:nth-child(8) { animation-delay: 0.8s; }
  .faq-item:nth-child(9) { animation-delay: 0.9s; }
  .faq-item:nth-child(10) { animation-delay: 1s; }
  .faq-item:nth-child(11) { animation-delay: 1.1s; }
  .faq-item:nth-child(12) { animation-delay: 1.2s; }

  .faq-item:hover {
    box-shadow: 0 10px 30px rgba(0, 102, 255, 0.15);
    transform: translateY(-5px);
  }

  .faq-question {
    padding: clamp(1rem, 3vw, 1.5rem) clamp(1rem, 3vw, 1.875rem);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: clamp(0.75rem, 2vw, 1.25rem);
    transition: all 0.3s ease;
    position: relative;
  }

  .faq-question:hover {
    background: linear-gradient(to right, rgba(0, 102, 255, 0.05) 0%, transparent 100%);
  }

  .faq-icon {
    width: clamp(40px, 8vw, 50px);
    height: clamp(40px, 8vw, 50px);
    min-width: clamp(40px, 8vw, 50px);
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: clamp(1.125rem, 2.5vw, 1.5rem);
    box-shadow: 0 5px 15px rgba(0, 102, 255, 0.3);
    flex-shrink: 0;
  }

  .faq-question-text {
    flex: 1;
    min-width: 0;
  }

  .faq-question h3 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1rem, 2.2vw, 1.25rem);
    font-weight: 700;
    color: #2c3e50;
    line-height: 1.5;
    margin: 0;
    word-wrap: break-word;
  }

  .faq-toggle {
    width: clamp(35px, 6vw, 40px);
    height: clamp(35px, 6vw, 40px);
    min-width: clamp(35px, 6vw, 40px);
    border-radius: 50%;
    background: #f1f3f5;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    flex-shrink: 0;
  }

  .faq-toggle i {
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: #0066FF;
    transition: transform 0.3s ease;
  }

  .faq-item.active .faq-toggle {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
  }

  .faq-item.active .faq-toggle i {
    color: white;
    transform: rotate(180deg);
  }

  .faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease, padding 0.4s ease;
  }

  .faq-item.active .faq-answer {
    max-height: 2000px;
    border-top: 1px solid #e5e7eb;
  }

  .faq-answer-content {
    padding: clamp(1rem, 3vw, 1.5rem) clamp(1rem, 3vw, 1.875rem) clamp(1rem, 3vw, 1.5rem) clamp(1rem, 3vw, 6.25rem);
    color: #7f8c8d;
    line-height: 1.9;
    font-size: clamp(0.938rem, 2vw, 1.05rem);
    font-family: 'Inter', sans-serif;
  }

  /* Stats Section */
  .faq-stats {
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(51, 133, 255, 0.05) 100%);
    padding: clamp(2.5rem, 6vw, 3.75rem) var(--spacing-md);
    margin: clamp(2.5rem, 6vw, 3.75rem) 0;
    border-radius: clamp(16px, 3vw, 20px);
  }

  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(150px, 100%), 1fr));
    gap: clamp(1.5rem, 4vw, 2.5rem);
    max-width: 900px;
    margin: 0 auto;
  }

  .stat-item {
    text-align: center;
  }

  .stat-number {
    font-family: 'Inter', sans-serif;
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 800;
    color: #0066FF;
    display: block;
    margin-bottom: clamp(0.5rem, 1.5vw, 0.625rem);
    letter-spacing: -0.02em;
  }

  .stat-label {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.875rem, 2vw, 1rem);
    color: #7f8c8d;
    font-weight: 600;
  }

  /* CTA Section */
  .cta-section {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: clamp(4rem, 10vw, 6.25rem) var(--spacing-md);
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
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
    animation: rotate 20s linear infinite;
  }

  @keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }

  .cta-content {
    max-width: min(800px, 90vw);
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .cta-content h2 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.875rem, 5vw, 3rem);
    font-weight: 900;
    margin-bottom: clamp(1rem, 2vw, 1.25rem);
    letter-spacing: -0.02em;
  }

  .cta-content p {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.063rem, 2.5vw, 1.3rem);
    margin-bottom: clamp(1.75rem, 4vw, 2.2rem);
    opacity: 0.95;
    line-height: 1.7;
  }

  .btn-cta {
    font-family: 'Inter', sans-serif;
    padding: clamp(0.875rem, 2vw, 1.125rem) clamp(2rem, 5vw, 3.125rem);
    background: white;
    color: #0066FF;
    font-weight: 700;
    border-radius: 50px;
    font-size: clamp(0.938rem, 2vw, 1.15rem);
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: clamp(0.5rem, 1.5vw, 0.75rem);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    white-space: nowrap;
  }

  .btn-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    background: #3385FF;
    color: white;
  }

  /* No Results Message */
  #noResultsMessage {
    text-align: center;
    padding: clamp(2rem, 5vw, 2.5rem);
    color: #7f8c8d;
    font-size: clamp(1rem, 2vw, 1.1rem);
    font-family: 'Inter', sans-serif;
  }

  #noResultsMessage i {
    font-size: clamp(2.5rem, 6vw, 3rem);
    display: block;
    margin-bottom: clamp(1rem, 2vw, 1.25rem);
    opacity: 0.3;
  }

  /* Responsive Breakpoints */
  
  /* Extra Small Mobile (320px - 479px) */
  @media (max-width: 479px) {
    .faq-hero {
      background-attachment: scroll;
    }

    .category-tabs {
      gap: 0.5rem;
    }

    .category-tab {
      padding: 0.625rem 1rem;
      font-size: 0.813rem;
    }

    .category-tab i {
      display: none;
    }

    .faq-answer-content {
      padding-left: 1rem;
    }

    .faq-icon {
      width: 35px;
      height: 35px;
      min-width: 35px;
      font-size: 1rem;
    }

    .faq-question {
      padding: 1rem;
      gap: 0.75rem;
    }
  }

  /* Mobile Landscape (480px - 767px) */
  @media (min-width: 480px) and (max-width: 767px) {
    .faq-hero {
      background-attachment: scroll;
    }

    .category-tab i {
      font-size: 0.875rem;
    }

    .faq-answer-content {
      padding-left: 1.25rem;
    }
  }

  /* Tablet Portrait (768px - 991px) */
  @media (min-width: 768px) and (max-width: 991px) {
    .faq-answer-content {
      padding-left: 4rem;
    }
  }

  /* Large Desktop (1200px+) */
  @media (min-width: 1200px) {
    .container {
      max-width: 1100px;
    }
  }

  /* Landscape Orientation on Mobile */
  @media (max-height: 500px) and (orientation: landscape) {
    .faq-hero {
      padding: 3rem var(--spacing-md);
      background-attachment: scroll;
    }

    .section {
      padding: 2.5rem var(--spacing-md);
    }
  }

  /* High DPI / Retina Displays */
  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .faq-hero {
      background-image: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                        url('https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1920&dpr=2');
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
    .faq-hero,
    .cta-section,
    .faq-search,
    .category-tabs,
    .faq-stats {
      display: none;
    }

    .faq-item {
      page-break-inside: avoid;
      box-shadow: none;
      border: 1px solid #e5e7eb;
    }

    .faq-answer {
      max-height: none !important;
    }
  }

  /* Touch device optimizations */
  @media (hover: none) and (pointer: coarse) {
    .faq-item:hover {
      transform: none;
    }

    .faq-item:active {
      transform: scale(0.98);
    }

    .btn-cta:hover {
      transform: none;
    }

    .btn-cta:active {
      transform: scale(0.98);
    }
  }
</style>

<!-- Include Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="w-full">
    <!-- Hero Section -->
    <section class="faq-hero">
        <div class="faq-hero-content">
            <h1>Frequently Asked Questions</h1>
            <p>
                Find answers to some of the most common questions about our rehabilitation programs,
                mental health services, and community initiatives.
            </p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section">
        <div class="container">
            <!-- Search Box -->
            <div class="faq-search">
                <input type="text" id="faqSearch" placeholder="Search for answers..." onkeyup="filterFAQs()">
                <button type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <!-- Category Tabs -->
            <div class="category-tabs">
                <button class="category-tab active" onclick="filterCategory('all')">
                    <i class="bi bi-grid"></i>
                    <span>All Questions</span>
                </button>
                <button class="category-tab" onclick="filterCategory('services')">
                    <i class="bi bi-hospital"></i>
                    <span>Services</span>
                </button>
                <button class="category-tab" onclick="filterCategory('mental-health')">
                    <i class="bi bi-heart-pulse"></i>
                    <span>Mental Health</span>
                </button>
                <button class="category-tab" onclick="filterCategory('admission')">
                    <i class="bi bi-person-check"></i>
                    <span>Admission</span>
                </button>
            </div>

            <!-- FAQ List -->
            <div class="faq-list" id="faqList">
                <!-- Services Category -->
                <div class="faq-item" data-category="services">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-hospital"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>What services does Queen of Peace Rehabilitation Centre offer?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            We offer drug addiction treatment, residential rehabilitation, crisis intervention,
                            psychosocial therapy, occupational therapy, community outreach, and reintegration programs
                            designed to support long-term recovery. Each program is tailored to meet individual needs 
                            with evidence-based treatment methods and compassionate care.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="services">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>Where are your rehabilitation homes located?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Our purpose-built rehabilitation homes are located in Gweru, Midlands Province, Zimbabwe,
                            offering a safe and structured environment for recovery. Our facilities are fully staffed 
                            with trained professionals and equipped with modern amenities to support healing and rehabilitation.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="services">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>Do you provide crisis intervention services?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Yes. We operate a 24/7 Residential Rehabilitation and Crisis Centre that offers immediate
                            support, stabilization, and intensive inpatient care to individuals in acute mental health crisis.
                            Our crisis response team is available around the clock to provide emergency intervention and support.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="services">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>Do you support reintegration after treatment?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Yes. Our Occupational and Community Reintegration Program equips clients with life skills,
                            vocational training, therapy, and community support to ensure long-term independence. We provide 
                            ongoing follow-up services and maintain connections with our graduates to support sustained recovery.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="services">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>Do you conduct community outreach?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Yes. We run community awareness campaigns, school sensitizations, church programs,
                            and mental health screening sessions across Midlands Province. Our outreach initiatives 
                            focus on destigmatizing mental illness and promoting early help-seeking behaviors.
                        </div>
                    </div>
                </div>

                <!-- Mental Health Category -->
                <div class="faq-item" data-category="mental-health">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>What is mental illness?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Mental illness is a general term for a group of illnesses that affect the mind or brain. These illnesses,
                            which include bipolar disorder, depression, schizophrenia, anxiety and personality disorders, affect the
                            way a person thinks, feels and acts. The exact cause of mental illness is unknown. What is known is
                            that mental illness is NOT a character fault, weakness or something inherently 'wrong' with a person. It
                            is an illness like any other and requires professional treatment and compassionate support.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="mental-health">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>What are the non-medication methods for treating mental health symptoms?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Non-medication approaches include psychotherapy (counseling), cognitive behavioral therapy (CBT), 
                            group therapy, occupational therapy, recreational activities, lifestyle modifications, mindfulness 
                            and meditation, exercise programs, nutritional support, and peer support groups. At Queen of Peace, 
                            we integrate these evidence-based approaches with traditional healing methods to provide holistic, 
                            culturally sensitive care that addresses the whole person—mind, body, and spirit.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="mental-health">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-arrow-left-right"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>How can mental health issues lead to addiction?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Mental health disorders and substance abuse often co-occur in what's called a dual diagnosis. 
                            Individuals may use drugs or alcohol as a form of self-medication to cope with symptoms of depression, 
                            anxiety, trauma, or other mental health conditions. This creates a dangerous cycle where substance use 
                            worsens mental health symptoms, which in turn leads to increased substance use. Our integrated treatment 
                            programs address both conditions simultaneously for effective, lasting recovery.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="mental-health">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-capsule"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>Can drug use cause a mental health condition?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Yes. Prolonged substance abuse can trigger or worsen mental health conditions such as depression, 
                            anxiety, psychosis, and paranoia. Certain substances can alter brain chemistry and structure, leading 
                            to lasting mental health problems. Some drugs, particularly stimulants and hallucinogens, can induce 
                            psychotic episodes or unmask underlying mental health conditions. Early intervention and comprehensive 
                            treatment are crucial for addressing both substance abuse and mental health concerns.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="mental-health">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-person-x"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>What can I do if my loved one with mental illness refuses treatment?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            This is a challenging situation many families face. We recommend: expressing your concerns with empathy 
                            and without judgment, educating yourself about their condition, offering to attend appointments with them, 
                            avoiding confrontation during crisis moments, connecting with our family support services, and in cases of 
                            immediate danger, contacting our crisis intervention team. Our professionals can provide guidance on 
                            motivational interviewing techniques and intervention strategies. Remember, recovery often begins when the 
                            person feels supported rather than pressured.
                        </div>
                    </div>
                </div>

                <!-- Admission Category -->
                <div class="faq-item" data-category="admission">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>Who can access your services?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Our programs are open to individuals struggling with substance abuse, mental health disorders,
                            homelessness, or psychosocial challenges, as well as families seeking help for loved ones. We provide 
                            services regardless of economic status and work with various stakeholders to ensure accessibility. 
                            Age-appropriate programs are available for adolescents, adults, and elderly individuals.
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="admission">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="faq-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="faq-question-text">
                            <h3>How can I get help or enroll a loved one?</h3>
                        </div>
                        <div class="faq-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            You can contact us directly via phone, WhatsApp, email, or through our website contact form.
                            Our team will guide you through the assessment and enrollment process. Initial consultations 
                            are confidential and designed to understand your specific needs. We'll explain available programs, 
                            answer all your questions, and develop a personalized treatment plan. Emergency admissions for 
                            crisis situations are available 24/7.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="faq-stats">
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-number">12</span>
                        <span class="stat-label">Common Questions</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Support Available</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Confidential</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Still Have Questions?</h2>
            <p>
                Reach out to us and our team will provide all the information you need. We're here to help you 
                every step of the way.
            </p>
            <a href="/contact" class="btn-cta">
                <i class="bi bi-envelope"></i>
                <span>Contact Us</span>
            </a>
        </div>
    </section>
</div>

<script>
// Toggle FAQ Item
function toggleFAQ(element) {
    const faqItem = element.closest('.faq-item');
    const wasActive = faqItem.classList.contains('active');
    
    // Close all FAQ items
    document.querySelectorAll('.faq-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Open clicked item if it wasn't active
    if (!wasActive) {
        faqItem.classList.add('active');
    }
}

// Filter by Category
function filterCategory(category) {
    const tabs = document.querySelectorAll('.category-tab');
    const items = document.querySelectorAll('.faq-item');
    
    // Update active tab
    tabs.forEach(tab => tab.classList.remove('active'));
    event.target.closest('.category-tab').classList.add('active');
    
    // Filter items
    items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    
    // Reset animations
    const visibleItems = document.querySelectorAll('.faq-item[style="display: block;"]');
    visibleItems.forEach((item, index) => {
        item.style.animation = 'none';
        setTimeout(() => {
            item.style.animation = '';
            item.style.animationDelay = `${index * 0.1}s`;
        }, 10);
    });
}

// Search FAQs
function filterFAQs() {
    const searchTerm = document.getElementById('faqSearch').value.toLowerCase();
    const items = document.querySelectorAll('.faq-item');
    let visibleCount = 0;
    
    items.forEach(item => {
        const question = item.querySelector('h3').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer-content').textContent.toLowerCase();
        
        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    // Show message if no results
    const existingMessage = document.getElementById('noResultsMessage');
    if (existingMessage) {
        existingMessage.remove();
    }

    if (visibleCount === 0 && searchTerm !== '') {
        const noResults = document.createElement('div');
        noResults.id = 'noResultsMessage';
        noResults.innerHTML = '<i class="bi bi-search"></i>No results found. Try different keywords.';
        document.getElementById('faqList').appendChild(noResults);
    }
}
</script>
@endsection