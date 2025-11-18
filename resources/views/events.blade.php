@extends('layouts.app')

@section('title', 'Events & Programs')

@section('content')
<style>
  /* Import Inter Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

  /* Hero Section */
  .events-hero {
    position: relative;
    padding: 100px 20px;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.92) 0%, rgba(5, 150, 105, 0.88) 100%),
                url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2070&auto=format&fit=crop') center/cover;
    color: white;
    text-align: center;
    overflow: hidden;
  }

  .events-hero::before {
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

  .events-hero-content {
    max-width: 900px;
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

  .events-hero h1 {
    font-family: 'Inter', sans-serif;
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 20px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.02em;
  }

  .breadcrumb {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    opacity: 0.95;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
  }

  .breadcrumb a {
    color: white;
    transition: opacity 0.3s ease;
  }

  .breadcrumb a:hover {
    opacity: 0.8;
  }

  /* Section */
  .section {
    padding: 80px 20px;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Featured Event */
  .featured-event {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 24px;
    padding: 50px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
    border: 2px solid rgba(16, 185, 129, 0.1);
    animation: slideIn 0.8s ease-out;
  }

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

  .featured-event::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
  }

  @keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }

  .featured-badge {
    display: inline-block;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
  }

  .featured-event h2 {
    font-family: 'Inter', sans-serif;
    font-size: 2.5rem;
    font-weight: 900;
    color: #1f2937;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
    letter-spacing: -0.02em;
  }

  .featured-event p {
    font-family: 'Inter', sans-serif;
    font-size: 1.15rem;
    color: #6b7280;
    line-height: 1.8;
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
  }

  .btn-primary {
    font-family: 'Inter', sans-serif;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 40px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.1rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    position: relative;
    z-index: 1;
  }

  .btn-primary:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 35px rgba(16, 185, 129, 0.5);
  }

  /* Events Grid */
  .events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap: 35px;
    margin-top: 60px;
  }

  .event-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    display: flex;
    animation: fadeInScale 0.6s ease-out;
    animation-fill-mode: both;
  }

  .event-card:nth-child(1) { animation-delay: 0.1s; }
  .event-card:nth-child(2) { animation-delay: 0.2s; }
  .event-card:nth-child(3) { animation-delay: 0.3s; }
  .event-card:nth-child(4) { animation-delay: 0.4s; }

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

  .event-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(16, 185, 129, 0.15);
    border-color: #10b981;
  }

  .event-date {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 40px 35px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-width: 160px;
    position: relative;
    overflow: hidden;
  }

  .event-date::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  }

  .event-date-day {
    font-family: 'Inter', sans-serif;
    font-size: 3rem;
    font-weight: 900;
    line-height: 1;
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  }

  .event-date-month {
    font-family: 'Inter', sans-serif;
    font-size: 1.4rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    position: relative;
    z-index: 1;
  }

  .event-content {
    padding: 35px 30px;
    flex: 1;
  }

  .event-content h3 {
    font-family: 'Inter', sans-serif;
    font-size: 1.6rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 15px;
    letter-spacing: -0.01em;
  }

  .event-meta {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f3f4f6;
  }

  .event-meta-item {
    font-family: 'Inter', sans-serif;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #6b7280;
    font-size: 0.95rem;
  }

  .event-meta-item i {
    color: #10b981;
    font-size: 1.1rem;
    width: 20px;
  }

  .event-content p {
    font-family: 'Inter', sans-serif;
    color: #6b7280;
    line-height: 1.7;
    font-size: 1.05rem;
  }

  /* Section Title */
  .section-title {
    font-family: 'Inter', sans-serif;
    text-align: center;
    font-size: 2.8rem;
    font-weight: 900;
    color: #1f2937;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
    position: relative;
    display: inline-block;
    width: 100%;
  }

  .section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, #10b981 0%, #f59e0b 100%);
    border-radius: 2px;
  }

  .section-subtitle {
    font-family: 'Inter', sans-serif;
    text-align: center;
    font-size: 1.2rem;
    color: #6b7280;
    max-width: 700px;
    margin: 0 auto 50px;
    line-height: 1.7;
  }

  /* CTA Section */
  .cta-section {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    padding: 100px 20px;
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

  .cta-content {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .cta-content h2 {
    font-family: 'Inter', sans-serif;
    font-size: 3rem;
    font-weight: 900;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
  }

  .cta-content p {
    font-family: 'Inter', sans-serif;
    font-size: 1.3rem;
    margin-bottom: 35px;
    opacity: 0.97;
    line-height: 1.7;
  }

  .btn-secondary {
    font-family: 'Inter', sans-serif;
    padding: 18px 45px;
    background: white;
    color: #10b981;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.15rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 12px;
  }

  .btn-secondary:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    background: #f59e0b;
    color: white;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .events-hero h1 {
      font-size: 2rem;
    }

    .featured-event {
      padding: 30px;
    }

    .featured-event h2 {
      font-size: 1.8rem;
    }

    .events-grid {
      grid-template-columns: 1fr;
    }

    .event-card {
      flex-direction: column;
    }

    .event-date {
      padding: 30px;
      min-width: auto;
      width: 100%;
    }

    .section-title {
      font-size: 2rem;
    }

    .cta-content h2 {
      font-size: 2rem;
    }
  }
</style>

<div class="w-full">
    <!-- Hero Section -->
    <section class="events-hero">
        <div class="events-hero-content">
            <h1>Events & Programs</h1>
            <div class="breadcrumb">
                <a href="/">Home</a>
                <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i>
                <span>Events</span>
            </div>
        </div>
    </section>

    <!-- Featured Event -->
    <section class="section">
        <div class="container">
            <div class="featured-event">
                <span class="featured-badge">🌟 Featured Event</span>
                <h2>Auction Day » This March 2025</h2>
                <p>
                    <strong>Theme:</strong> Vocational skills training — a step closer to community reintegration,
                    preventing stigma and discrimination. Join us for this transformative event where we showcase 
                    the incredible talents and skills developed by our program participants. Together, we can break 
                    barriers and build bridges to meaningful employment and community acceptance.
                </p>
                <a href="/contact" class="btn-primary">
                    <i class="fas fa-ticket-alt"></i>
                    Register Your Interest
                </a>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="section" style="background-color: #f9fafb;">
        <div class="container">
            <h2 class="section-title">Upcoming Events</h2>
            <p class="section-subtitle">
                Join us at our community events and be part of the transformation
            </p>

            <div class="events-grid">
                <!-- Event 1 -->
                <div class="event-card">
                    <div class="event-date">
                        <span class="event-date-day">THIS</span>
                        <span class="event-date-month">MARCH</span>
                    </div>
                    <div class="event-content">
                        <h3>Family Interactional Day</h3>
                        <div class="event-meta">
                            <div class="event-meta-item">
                                <i class="fas fa-clock"></i>
                                <span><strong>08:00 AM - 5:00 PM</strong></span>
                            </div>
                            <div class="event-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>No 5 Harvard, Harben Park, Gweru, Zimbabwe</span>
                            </div>
                        </div>
                        <p>
                            Queen Of Peace intends to pilot an interactional day where caregivers share experiences,
                            views and support each other toward rehabilitating our residential service users. This is 
                            a unique opportunity for families to connect, learn, and grow together.
                        </p>
                    </div>
                </div>

                <!-- Event 2 -->
                <div class="event-card">
                    <div class="event-date">
                        <span class="event-date-day">ALL</span>
                        <span class="event-date-month">YEAR</span>
                    </div>
                    <div class="event-content">
                        <h3>Youth Outreach Program</h3>
                        <div class="event-meta">
                            <div class="event-meta-item">
                                <i class="fas fa-clock"></i>
                                <span><strong>12:00 PM - 5:00 PM</strong></span>
                            </div>
                            <div class="event-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Venue will be announced — check itinerary</span>
                            </div>
                        </div>
                        <p>
                            The program aims to reach younger populations as they navigate decision-making,
                            identity development, and peer pressure challenges. We provide education, mentorship, 
                            and support to empower youth to make healthy choices.
                        </p>
                    </div>
                </div>

                <!-- Event 3 - Additional -->
                <div class="event-card">
                    <div class="event-date">
                        <span class="event-date-day">10</span>
                        <span class="event-date-month">OCT</span>
                    </div>
                    <div class="event-content">
                        <h3>World Mental Health Day</h3>
                        <div class="event-meta">
                            <div class="event-meta-item">
                                <i class="fas fa-clock"></i>
                                <span><strong>9:00 AM - 4:00 PM</strong></span>
                            </div>
                            <div class="event-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Queen of Peace Institute, Gweru</span>
                            </div>
                        </div>
                        <p>
                            Join us for a day of awareness, education, and community support. We'll host workshops, 
                            panel discussions, and activities focused on mental health awareness and breaking the stigma 
                            surrounding mental illness.
                        </p>
                    </div>
                </div>

                <!-- Event 4 - Additional -->
                <div class="event-card">
                    <div class="event-date">
                        <span class="event-date-day">26</span>
                        <span class="event-date-month">JUN</span>
                    </div>
                    <div class="event-content">
                        <h3>International Day Against Drug Abuse</h3>
                        <div class="event-meta">
                            <div class="event-meta-item">
                                <i class="fas fa-clock"></i>
                                <span><strong>8:00 AM - 6:00 PM</strong></span>
                            </div>
                            <div class="event-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Community Hall, Gweru City Center</span>
                            </div>
                        </div>
                        <p>
                            A community-wide event featuring educational sessions, testimonials from recovered individuals, 
                            and resources for families affected by substance abuse. Let's stand together against drug abuse 
                            and support recovery.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Want to Participate or Learn More?</h2>
            <p>
                Contact us to register for upcoming events or to learn how you can get involved in our community programs.
            </p>
            <a href="/contact" class="btn-secondary">
                <i class="fas fa-envelope"></i>
                Get in Touch
            </a>
        </div>
    </section>
</div>
@endsection