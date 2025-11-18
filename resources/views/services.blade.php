@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
<style>
  /* Bootstrap Icons CDN is included in head */
  @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');

  /* Hero Section */
  .services-hero {
    position: relative;
    height: 50vh;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                url('https://images.unsplash.com/photo-1608052026785-0bc249c733e3?q=80&w=1920') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
  }

  .services-hero-content {
    max-width: 900px;
    padding: 40px;
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

  .services-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.7);
    color: white !important;
  }

  .breadcrumb {
    font-size: 1.1rem;
    opacity: 0.95;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    color: white !important;
  }

  .breadcrumb a {
    color: white !important;
    transition: opacity 0.3s ease;
    text-decoration: none;
  }

  .breadcrumb a:hover {
    opacity: 0.8;
  }

  .breadcrumb span {
    color: white !important;
  }

  .breadcrumb i {
    color: white !important;
  }

  /* Section Styles */
  .section {
    padding: 80px 20px;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .intro-text {
    max-width: 1000px;
    margin: 0 auto 60px;
    text-align: center;
  }

  .intro-text p {
    font-size: 1.15rem;
    line-height: 1.9;
    color: #7f8c8d;
    margin-bottom: 20px;
  }

  /* Services Grid */
  .services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 35px;
    margin-top: 60px;
  }

  .service-card {
    background: white;
    border-radius: 20px;
    padding: 0;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    overflow: hidden;
    border: 2px solid transparent;
    opacity: 0;
    animation: fadeInScale 0.6s ease-out forwards;
  }

  .service-card:nth-child(1) { animation-delay: 0.1s; }
  .service-card:nth-child(2) { animation-delay: 0.2s; }
  .service-card:nth-child(3) { animation-delay: 0.3s; }

  @keyframes fadeInScale {
    from {
      opacity: 0;
      transform: scale(0.9) translateY(20px);
    }
    to {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }

  .service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 102, 255, 0.15);
    border-color: #0066FF;
  }

  .service-header {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: 40px 30px;
    color: white;
    position: relative;
    overflow: hidden;
  }

  .service-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: pulse 4s infinite;
  }

  @keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.8; }
  }

  .service-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin-bottom: 20px;
    backdrop-filter: blur(10px);
  }

  .service-header h3 {
    font-size: 1.6rem;
    font-weight: 800;
    margin: 0;
    position: relative;
    z-index: 1;
    line-height: 1.3;
  }

  .service-body {
    padding: 30px;
  }

  .service-body p {
    color: #7f8c8d;
    line-height: 1.8;
    font-size: 1.05rem;
  }

  /* Programs Section */
  .programs-section {
    background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
  }

  .section-title {
    text-align: center;
    font-size: 2.8rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 20px;
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
    background: linear-gradient(135deg, #0066FF 0%, #3385FF 100%);
    border-radius: 2px;
  }

  .programs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 30px;
    margin-top: 60px;
  }

  .program-card {
    background: white;
    border-radius: 15px;
    padding: 35px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    border-left: 5px solid #0066FF;
    display: flex;
    gap: 20px;
  }

  .program-card:hover {
    transform: translateX(10px);
    box-shadow: 0 12px 35px rgba(0, 102, 255, 0.12);
  }

  .program-number {
    width: 50px;
    height: 50px;
    min-width: 50px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.3rem;
    box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
  }

  .program-content h3 {
    color: #0066FF;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.3;
  }

  .program-content p {
    color: #7f8c8d;
    line-height: 1.8;
    font-size: 1.05rem;
  }

  /* Approach Section */
  .approach-section {
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(51, 133, 255, 0.05) 100%);
  }

  .approach-content {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
  }

  .approach-content h2 {
    color: #2c3e50;
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 25px;
  }

  .approach-content p {
    color: #7f8c8d;
    line-height: 1.9;
    font-size: 1.15rem;
  }

  .approach-pillars {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    margin-top: 40px;
  }

  .pillar {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    padding: 25px 20px;
    border-radius: 15px;
    text-align: center;
    font-weight: 700;
    font-size: 1rem;
    box-shadow: 0 8px 20px rgba(0, 102, 255, 0.3);
    transition: all 0.3s ease;
    opacity: 0;
    animation: fadeInUp 0.6s ease-out forwards;
  }

  .pillar:nth-child(1) { animation-delay: 0.1s; }
  .pillar:nth-child(2) { animation-delay: 0.2s; }
  .pillar:nth-child(3) { animation-delay: 0.3s; }
  .pillar:nth-child(4) { animation-delay: 0.4s; }
  .pillar:nth-child(5) { animation-delay: 0.5s; }

  .pillar:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 102, 255, 0.4);
  }

  .pillar i {
    font-size: 1.8rem;
    margin-bottom: 10px;
    display: block;
  }

  /* CTA Section */
  .cta-section {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: 80px 20px;
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
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .cta-content h3 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 20px;
  }

  .cta-content p {
    font-size: 1.25rem;
    margin-bottom: 35px;
    opacity: 0.95;
    line-height: 1.7;
  }

  .btn-cta {
    padding: 18px 50px;
    background: white;
    color: #0066FF;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.15rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    text-decoration: none;
  }

  .btn-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    background: #3385FF;
    color: white;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .services-hero {
      height: auto;
      min-height: 50vh;
      padding: 60px 20px;
    }

    .services-hero-content {
      padding: 30px 25px;
    }

    .services-hero h1 {
      font-size: 2rem;
    }

    .section-title {
      font-size: 2rem;
    }

    .services-grid {
      grid-template-columns: 1fr;
    }

    .programs-grid {
      grid-template-columns: 1fr;
    }

    .approach-content {
      padding: 30px 25px;
    }

    .cta-content h3 {
      font-size: 1.8rem;
    }

    .approach-pillars {
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    }
  }
</style>

<!-- Include Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="w-full">
    <!-- Hero Section -->
    <section class="services-hero">
        <div class="services-hero-content">
            <h1>Our Services & Programs</h1>
            <div class="breadcrumb">
                <a href="/">Home</a>
                <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i>
                <span>Services</span>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="section">
        <div class="container">
            <div class="intro-text">
                <p>
                    Queen of Peace Institute for Community Mental Health Innovations and Rehabilitation operates purpose-built,
                    fully staffed rehabilitation homes located in Gweru, Midlands Province, Zimbabwe. These facilities provide a
                    safe, structured, and healing environment for individuals battling addiction, mental health challenges, and
                    social dislocation.
                </p>
                <p>
                    Each home is designed to offer holistic, client-centered care focused on long-term recovery, reintegration, and
                    personal transformation. Our rehabilitation homes are anchored in our belief that recovery is not only
                    possible, but sustainable when individuals are provided with evidence-based treatment, compassionate support,
                    and meaningful opportunities for personal growth.
                </p>
            </div>

            <!-- Main Services Grid -->
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="bi bi-capsule"></i>
                        </div>
                        <h3>Drug Addiction Treatment Centre</h3>
                    </div>
                    <div class="service-body">
                        <p>
                            A medically informed, psychologically grounded program designed to treat substance use disorders through
                            detoxification, therapy, and relapse prevention.
                        </p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="bi bi-hospital"></i>
                        </div>
                        <h3>Residential Rehabilitation and Crisis Centre</h3>
                    </div>
                    <div class="service-body">
                        <p>
                            A 24/7 safe haven offering intensive inpatient treatment and crisis intervention services for individuals
                            facing acute mental health or psychosocial crises.
                        </p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Occupational and Community Reintegration & Therapeutic Centre</h3>
                    </div>
                    <div class="service-body">
                        <p>
                            Focused on preparing clients for independent living, this program offers skill-building, psychosocial
                            therapy, and reintegration services to support long-term recovery and self-sufficiency.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="section programs-section">
        <div class="container">
            <h2 class="section-title">Key Programs & Interventions</h2>

            <div class="programs-grid">
                <div class="program-card">
                    <div class="program-number">1</div>
                    <div class="program-content">
                        <h3>Community Awareness and Outreach</h3>
                        <p>
                            We conduct extensive awareness campaigns in rural communities and hotspot areas across Midlands Province. 
                            Our efforts focus on destigmatizing mental illness, educating the public on the dangers of substance abuse, 
                            and encouraging early help-seeking behaviors. These include community clean-up campaigns, school engagements, 
                            church-based sensitizations, and mental health screening sessions in Gweru and surrounding districts.
                        </p>
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-number">2</div>
                    <div class="program-content">
                        <h3>Training of Village Community Health Workers</h3>
                        <p>
                            We strengthen grassroots capacity by training primary-level caregivers and village health workers in the 
                            identification, basic management, and referral of drug and substance-related disorders. This ensures that 
                            care is accessible even in remote, underserved communities.
                        </p>
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-number">3</div>
                    <div class="program-content">
                        <h3>Restoring Mental Wellbeing for Street-Dwelling Populations</h3>
                        <p>
                            We run specialized programs targeting homeless individuals living with psychosocial disabilities and substance 
                            dependency. These programs focus on removal from the streets, clinical treatment, rehabilitation, and community 
                            reintegration, ensuring every individual has a pathway to dignity and recovery.
                        </p>
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-number">4</div>
                    <div class="program-content">
                        <h3>Follow-Up and Continuity of Care</h3>
                        <p>
                            To address poor medication adherence and treatment dropouts, we offer structured follow-up services and 
                            home-based support to people recovering from addiction and mental health crisis. This enhances treatment 
                            retention and improves long-term outcomes.
                        </p>
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-number">5</div>
                    <div class="program-content">
                        <h3>Psychosocial Resilience and Prevention of Psychological Morbidity</h3>
                        <p>
                            We aim to build psychological resilience in individuals, families, and communities through therapy, 
                            psychoeducation, group activities, and trauma-informed care. Our goal is to reduce the prevalence and 
                            impact of mental health disorders at a community level.
                        </p>
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-number">6</div>
                    <div class="program-content">
                        <h3>Economic Empowerment and Occupational Therapy</h3>
                        <p>
                            We believe in rehabilitation beyond treatment. Our programs include life skills training, vocational skills 
                            development, recreational therapy, and structured occupational therapy. These initiatives foster self-reliance 
                            and help rehabilitated individuals reintegrate into society as productive citizens.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Approach Section -->
    <section class="section approach-section">
        <div class="container">
            <div class="approach-content">
                <h2>Our Approach</h2>
                <p>
                    At Queen of Peace, we take a holistic, community-rooted, and evidence-based approach to addressing mental
                    health and substance use disorders. Our model is anchored in prevention, treatment, rehabilitation, reintegration,
                    and long-term recovery support.
                </p>
                <p style="margin-top: 20px;">
                    We focus not only on healing individuals but also on empowering families and transforming communities through 
                    inclusive and sustainable mental health interventions.
                </p>

                <div class="approach-pillars">
                    <div class="pillar">
                        <i class="bi bi-shield-check"></i>
                        Prevention
                    </div>
                    <div class="pillar">
                        <i class="bi bi-heart-pulse"></i>
                        Treatment
                    </div>
                    <div class="pillar">
                        <i class="bi bi-person-check"></i>
                        Rehabilitation
                    </div>
                    <div class="pillar">
                        <i class="bi bi-arrow-repeat"></i>
                        Reintegration
                    </div>
                    <div class="pillar">
                        <i class="bi bi-hand-thumbs-up"></i>
                        Long-term Support
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h3>Need Our Services?</h3>
            <p>
                Contact us to learn more about our programs and how we can help you or your loved ones.
            </p>
            <a href="/contact" class="btn-cta">
                <i class="bi bi-envelope"></i>
                Contact Us Today
            </a>
        </div>
    </section>
</div>
@endsection
