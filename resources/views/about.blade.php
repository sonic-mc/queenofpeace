@extends('layouts.app')

@section('content')
<style>
  /* Hero Section */
  .about-hero {
    position: relative;
    height: 65vh;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.1.0&w=1920') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
  }

  .about-hero-content {
    max-width: 1000px;
    padding: 40px;
    animation: fadeInUp 1s ease-out;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    border-radius: 20px;
    border: 2px solid rgba(255, 255, 255, 0.2);
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

  .about-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 25px;
    line-height: 1.2;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
  }

  .about-hero p {
    font-size: 1.25rem;
    line-height: 1.8;
    opacity: 0.95;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
  }

  /* Section Styles */
  .section {
    padding: 80px 20px;
  }

  .section-alt {
    background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .section-header {
    text-align: center;
    margin-bottom: 60px;
  }

  .section-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
  }

  .section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, #0066FF 0%, #3385FF 100%);
    border-radius: 2px;
  }

  .section-subtitle {
    font-size: 1.2rem;
    color: #7f8c8d;
    max-width: 700px;
    margin: 20px auto 0;
    line-height: 1.6;
  }

  /* History Timeline */
  .timeline {
    position: relative;
    padding: 40px 0;
  }

  .timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #0066FF 0%, #3385FF 100%);
    transform: translateX(-50%);
  }

  .timeline-item {
    display: flex;
    align-items: center;
    margin-bottom: 60px;
    position: relative;
    opacity: 0;
    animation: slideIn 0.6s ease-out forwards;
  }

  .timeline-item:nth-child(1) { animation-delay: 0.1s; }
  .timeline-item:nth-child(2) { animation-delay: 0.2s; }
  .timeline-item:nth-child(3) { animation-delay: 0.3s; }
  .timeline-item:nth-child(4) { animation-delay: 0.4s; }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .timeline-item:nth-child(odd) {
    flex-direction: row;
  }

  .timeline-item:nth-child(even) {
    flex-direction: row-reverse;
  }

  .timeline-content {
    width: 45%;
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: all 0.3s ease;
  }

  .timeline-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 102, 255, 0.2);
  }

  .timeline-year {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 800;
    font-size: 1.2rem;
    box-shadow: 0 5px 20px rgba(0, 102, 255, 0.4);
    z-index: 2;
  }

  .timeline-content h3 {
    color: #0066FF;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 15px;
  }

  .timeline-content p {
    color: #7f8c8d;
    line-height: 1.8;
  }

  /* Vision & Mission Cards */
  .vm-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap: 40px;
    margin-top: 40px;
  }

  .vm-card {
    background: white;
    border-radius: 20px;
    padding: 50px 40px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .vm-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(135deg, #0066FF 0%, #3385FF 100%);
  }

  .vm-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 102, 255, 0.15);
  }

  .vm-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    margin-bottom: 25px;
    box-shadow: 0 8px 20px rgba(0, 102, 255, 0.3);
  }

  .vm-card h3 {
    font-size: 2rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 20px;
  }

  .vm-card p {
    color: #7f8c8d;
    line-height: 1.9;
    font-size: 1.05rem;
  }

  /* Values Grid */
  .values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 50px;
  }

  .value-card {
    background: white;
    padding: 35px 25px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    opacity: 0;
    animation: fadeInScale 0.6s ease-out forwards;
  }

  .value-card:nth-child(1) { animation-delay: 0.1s; }
  .value-card:nth-child(2) { animation-delay: 0.2s; }
  .value-card:nth-child(3) { animation-delay: 0.3s; }
  .value-card:nth-child(4) { animation-delay: 0.4s; }
  .value-card:nth-child(5) { animation-delay: 0.5s; }
  .value-card:nth-child(6) { animation-delay: 0.6s; }

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

  .value-card:hover {
    border-color: #0066FF;
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0, 102, 255, 0.2);
  }

  .value-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.8rem;
    color: white;
  }

  .value-card h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
  }

  .value-card p {
    color: #7f8c8d;
    line-height: 1.6;
    font-size: 0.95rem;
  }

  /* Stats Section */
  .stats-section {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: 80px 20px;
    color: white;
    position: relative;
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
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .stat-item {
    text-align: center;
    opacity: 0;
    animation: fadeInUp 0.8s ease-out forwards;
  }

  .stat-item:nth-child(1) { animation-delay: 0.1s; }
  .stat-item:nth-child(2) { animation-delay: 0.2s; }
  .stat-item:nth-child(3) { animation-delay: 0.3s; }
  .stat-item:nth-child(4) { animation-delay: 0.4s; }

  .stat-number {
    font-size: 3.5rem;
    font-weight: 800;
    display: block;
    margin-bottom: 10px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
  }

  .stat-number.counting {
    animation: pulse 2s ease-out;
  }

  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
  }

  .stat-label {
    font-size: 1.1rem;
    opacity: 0.95;
  }

  /* CTA Section */
  .cta-section {
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(51, 133, 255, 0.05) 100%);
    padding: 100px 20px;
    text-align: center;
  }

  .cta-content {
    max-width: 800px;
    margin: 0 auto;
  }

  .cta-content h2 {
    font-size: 3rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 25px;
  }

  .cta-content p {
    font-size: 1.3rem;
    color: #7f8c8d;
    margin-bottom: 40px;
    line-height: 1.8;
  }

  .cta-buttons {
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
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 102, 255, 0.4);
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
  }

  .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0, 102, 255, 0.6);
  }

  .btn-secondary {
    padding: 18px 45px;
    background: white;
    color: #0066FF;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.1rem;
    border: 2px solid #0066FF;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
  }

  .btn-secondary:hover {
    background: #0066FF;
    color: white;
    transform: translateY(-3px);
  }

  /* Why Choose Us Cards */
  .choose-us-cards {
    margin-top: 40px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
  }

  .choose-card {
    text-align: center;
  }

  .choose-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #0066FF, #0052CC);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: white;
    font-size: 1.5rem;
    transition: all 0.3s ease;
  }

  .choose-card:hover .choose-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 8px 20px rgba(0, 102, 255, 0.4);
  }

  .choose-card h4 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 8px;
  }

  .choose-card p {
    color: #7f8c8d;
    font-size: 0.95rem;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .about-hero {
      height: auto;
      min-height: 60vh;
      padding: 60px 20px;
    }

    .about-hero-content {
      padding: 30px 25px;
    }

    .about-hero h1 {
      font-size: 2rem;
    }

    .about-hero p {
      font-size: 1rem;
    }

    .section-title {
      font-size: 2rem;
    }

    .timeline::before {
      left: 30px;
    }

    .timeline-item {
      flex-direction: column !important;
      padding-left: 60px;
    }

    .timeline-content {
      width: 100%;
    }

    .timeline-year {
      left: 30px;
      width: 60px;
      height: 60px;
      font-size: 1rem;
    }

    .vm-grid {
      grid-template-columns: 1fr;
    }

    .cta-content h2 {
      font-size: 2rem;
    }

    .stat-number {
      font-size: 2.5rem;
    }
  }
</style>

<div class="w-full">
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>About Queen of Peace Institute</h1>
            <p>
                Queen of Peace Institute for Community Mental Health Innovations and Rehabilitation—formerly known as Queen of Peace Rehabilitation and Crisis Centre—is a registered Private Voluntary Organization (PVO 28/13) established in January 2006 by Dr. Stella Khumalo Punungwe. We are committed to delivering comprehensive mental health interventions and empowering individuals toward self-reliance.
            </p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number" data-target="19">0</span>
                <span class="stat-label">Years of Service</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-target="2006">0</span>
                <span class="stat-label">Year Founded</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-target="1000">0</span>
                <span class="stat-label">Lives Impacted</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-text="24/7">24/7</span>
                <span class="stat-label">Crisis Support</span>
            </div>
        </div>
    </section>

    <!-- History Timeline Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Journey</h2>
                <p class="section-subtitle">
                    From humble beginnings to becoming a beacon of hope for mental health care in Zimbabwe
                </p>
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3>The Beginning</h3>
                        <p>
                            Founded in January 2006 by Dr. Stella Khumalo Punungwe as a halfway home for children and adults with mental challenges, providing temporal shelter and basic care for patients with mental health needs.
                        </p>
                    </div>
                    <div class="timeline-year">2006</div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3>Official Registration</h3>
                        <p>
                            Officially incorporated and registered as a Private Voluntary Organization (PVO 28/13), solidifying our commitment to serve the community with professional mental health services.
                        </p>
                    </div>
                    <div class="timeline-year">2016</div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3>Expansion of Services</h3>
                        <p>
                            Expanded our programs to include structured residential rehabilitation, community-based rehabilitation, day care services, crisis intervention, and reintegration support for individuals with psychosocial disabilities.
                        </p>
                    </div>
                    <div class="timeline-year">2018</div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3>Present Day</h3>
                        <p>
                            Continuing to lead innovation in mental health care, substance abuse treatment, and community empowerment, serving as a model for comprehensive mental health interventions in Zimbabwe and beyond.
                        </p>
                    </div>
                    <div class="timeline-year">2025</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="section section-alt">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Vision & Mission</h2>
                <p class="section-subtitle">
                    Guided by compassion, driven by excellence
                </p>
            </div>

            <div class="vm-grid">
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>
                        We envision a mentally healthy, resilient, and inclusive society where every individual has access to quality, compassionate mental health care and the opportunity to live a life of dignity, purpose, and connection.
                    </p>
                    <p style="margin-top: 20px;">
                        We aim to position Midlands Province as a model for Zimbabwe and the region by championing holistic, community-rooted mental health interventions. Ultimately, we aspire to build a future where mental health is recognized as a fundamental component of public health, community development, and sustainable nation-building.
                    </p>
                </div>

                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>
                        To provide comprehensive, evidence-based mental health interventions that promote recovery, resilience, and reintegration. We are committed to:
                    </p>
                    <ul style="margin-top: 20px; text-align: left; color: #7f8c8d; line-height: 1.9;">
                        <li>✓ Delivering quality residential and community-based rehabilitation</li>
                        <li>✓ Offering crisis intervention and ongoing support services</li>
                        <li>✓ Empowering individuals toward self-reliance and dignity</li>
                        <li>✓ Advocating for mental health awareness and stigma reduction</li>
                        <li>✓ Building partnerships for sustainable community impact</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Core Values</h2>
                <p class="section-subtitle">
                    The principles that guide our work and define our commitment
                </p>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Compassion</h4>
                    <p>We treat every individual with empathy, dignity, and respect, understanding that recovery begins with care.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4>Excellence</h4>
                    <p>We maintain the highest standards in mental health care, continuously improving our services and approaches.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h4>Integrity</h4>
                    <p>We operate with transparency, accountability, and ethical practices in all our programs and partnerships.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Inclusion</h4>
                    <p>We embrace diversity and ensure that our services are accessible to all, regardless of background or circumstances.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4>Innovation</h4>
                    <p>We pioneer new approaches to mental health care, adapting to community needs and emerging challenges.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h4>Empowerment</h4>
                    <p>We equip individuals with tools, skills, and support to reclaim their lives and achieve lasting recovery.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section section-alt">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Why Choose Us?</h2>
                <p class="section-subtitle">
                    Our commitment to comprehensive, compassionate care sets us apart
                </p>
            </div>

            <div style="max-width: 900px; margin: 0 auto;">
                <div style="background: white; padding: 50px 40px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.08);">
                    <p style="color: #7f8c8d; line-height: 1.9; font-size: 1.1rem; margin-bottom: 25px;">
                        In environments where mental health is not valued, persons affected by mental health disorders often cannot access appropriate care and social support in time to recover. This creates a cycle of vulnerability and marginalization.
                    </p>
                    <p style="color: #7f8c8d; line-height: 1.9; font-size: 1.1rem; margin-bottom: 25px;">
                        Our primary goal is to <strong style="color: #0066FF;">reduce vulnerability</strong> for mentally challenged people, children in difficult circumstances like orphans, abused children, and children with mental challenges.
                    </p>
                    <p style="color: #7f8c8d; line-height: 1.9; font-size: 1.1rem;">
                        Through our comprehensive programs—including residential rehabilitation, crisis intervention, community-based support, and aftercare services—we provide a continuum of care that addresses the complex needs of our beneficiaries and their families.
                    </p>

                    <div class="choose-us-cards">
                        <div class="choose-card">
                            <div class="choose-icon">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <h4>Professional Team</h4>
                            <p>Experienced mental health professionals</p>
                        </div>

                        <div class="choose-card">
                            <div class="choose-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <h4>Safe Environment</h4>
                            <p>Secure, supportive facilities</p>
                        </div>

                        <div class="choose-card">
                            <div class="choose-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h4>Proven Results</h4>
                            <p>Evidence-based interventions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Join Us in Making a Difference</h2>
            <p>
                Join your hand with us for a better life and a beautiful future. Together, we can make a lasting impact in the lives of those we serve and build a mentally healthy, inclusive society for all.
            </p>
            <div class="cta-buttons">
                <a href="/contact" class="btn-primary">
                    <i class="fas fa-envelope"></i>
                    Contact Us
                </a>
                <a href="/donate" class="btn-secondary">
                    <i class="fas fa-heart"></i>
                    Support Our Mission
                </a>
            </div>
        </div>
    </section>
</div>

<script>
// Animated Counter for Stats
let statsAnimated = false;

document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('scroll', animateStatsOnScroll);
    // Trigger once in case stats are already visible
    animateStatsOnScroll();
});

function animateStatsOnScroll() {
    if (statsAnimated) return;
    
    const statsSection = document.querySelector('.stats-section');
    if (!statsSection) return;
    
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
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        counter.classList.add('counting');
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                // Format final number
                if (target === 1000) {
                    counter.textContent = '1000+';
                } else if (target === 19) {
                    counter.textContent = '19+';
                } else {
                    counter.textContent = target;
                }
            }
        };
        
        updateCounter();
    });
}
</script>
@endsection