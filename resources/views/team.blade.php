@extends('layouts.app')

@section('title', 'Our Team')

@section('content')
<style>
  /* Bootstrap Icons */
  @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');

  /* Hero Section */
  .team-hero {
    position: relative;
    height: 50vh;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1920') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
  }

  .team-hero-content {
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

  .team-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.7);
    color: white !important;
  }

  .team-hero p {
    font-size: 1.3rem;
    opacity: 0.95;
    line-height: 1.7;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    color: white !important;
  }

  /* Section Styles */
  .section {
    padding: 80px 20px;
  }

  .container {
    max-width: 1400px;
    margin: 0 auto;
  }

  /* Team Carousel */
  .team-carousel {
    position: relative;
    overflow: hidden;
    padding: 40px 0;
  }

  .team-carousel-inner {
    display: flex;
    transition: transform 0.5s ease;
  }

  .team-slide {
    min-width: 100%;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap: 40px;
    padding: 0 20px;
  }

  /* Team Card */
  .team-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    position: relative;
    opacity: 0;
    animation: fadeInScale 0.6s ease-out forwards;
  }

  .team-card:nth-child(1) { animation-delay: 0.1s; }
  .team-card:nth-child(2) { animation-delay: 0.2s; }

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

  .team-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 20px 60px rgba(0, 102, 255, 0.15);
  }

  .team-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(135deg, #0066FF 0%, #3385FF 100%);
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }

  .team-card:hover::before {
    transform: scaleX(1);
  }

  .team-card-header {
    position: relative;
    height: 300px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .team-card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: pulse 4s infinite;
  }

  @keyframes pulse {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.1) rotate(180deg); }
  }

  .team-profile-img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    border: 6px solid white;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 2;
    transition: all 0.4s ease;
  }

  .team-card:hover .team-profile-img {
    transform: scale(1.1);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
  }

  .team-card-body {
    padding: 35px 30px;
  }

  .team-name {
    font-size: 1.8rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 10px;
  }

  .team-role {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0066FF;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .team-bio {
    color: #7f8c8d;
    line-height: 1.8;
    font-size: 1.05rem;
    margin-bottom: 25px;
  }

  .team-social {
    display: flex;
    gap: 12px;
    justify-content: center;
    padding-top: 20px;
    border-top: 2px solid #f1f1f1;
  }

  .social-link {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
    text-decoration: none;
  }

  .social-link:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 102, 255, 0.5);
  }

  .social-link.linkedin:hover {
    background: #0077b5;
  }

  .social-link.twitter:hover {
    background: #1da1f2;
  }

  .social-link.email:hover {
    background: #3385FF;
  }

  /* Carousel Controls */
  .carousel-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 40px;
  }

  .carousel-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(0, 102, 255, 0.3);
  }

  .carousel-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 30px rgba(0, 102, 255, 0.5);
  }

  .carousel-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .carousel-indicators {
    display: flex;
    gap: 10px;
  }

  .carousel-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #d1d5db;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .carousel-dot.active {
    background: #0066FF;
    width: 35px;
    border-radius: 10px;
  }

  /* CTA Section */
  .cta-section {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
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

  .cta-content h2 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 20px;
  }

  .cta-content p {
    font-size: 1.3rem;
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
    .team-hero {
      height: auto;
      min-height: 50vh;
      padding: 60px 20px;
    }

    .team-hero-content {
      padding: 30px 25px;
    }

    .team-hero h1 {
      font-size: 2rem;
    }

    .team-hero p {
      font-size: 1.1rem;
    }

    .team-slide {
      grid-template-columns: 1fr;
    }

    .cta-content h2 {
      font-size: 2rem;
    }
  }
</style>

<!-- Include Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="w-full">
    <!-- Hero Section -->
    <section class="team-hero">
        <div class="team-hero-content">
            <h1>Meet Our Team</h1>
            <p>
                The strength of our organisation is backed by our mature and well-seasoned team of dedicated professionals.
            </p>
        </div>
    </section>

    <!-- Team Members Carousel -->
    <section class="section">
      <div class="container">
          <div class="team-carousel">
              <div class="team-carousel-inner" id="teamCarousel">
                  <!-- Slide 1 -->
                  <div class="team-slide">
                      <!-- Dr Stella -->
                      <div class="team-card">
                          <div class="team-card-header">
                              <img src="{{ asset('images/directors/stella (1).jpeg') }}" 
                                   alt="Dr. Stella Khumalo Punungwe" 
                                   class="team-profile-img">
                          </div>
                          <div class="team-card-body">
                              <h3 class="team-name">Dr. Stella Khumalo Punungwe</h3>
                              <p class="team-role">
                                  <i class="bi bi-award"></i>
                                  Public Mental Health Specialist
                              </p>
                              <p class="team-bio">
                                  Dr. Stella Punungwe Khumalo is the Founder of Queen of Peace Institute for Community Mental Health
                                  Innovations and Rehabilitation (PVO 28/13). She holds a Doctorate in Public Mental Health, an
                                  Honorary DSci from Open Christian University, an MSc in Mental Health Nursing, a Bachelor's in
                                  Psychology, and diplomas in General and Mental Health Nursing.
                                  <br><br>
                                  She has coordinated the removal and rehabilitation of over 70 mentally ill individuals from the
                                  streets of Gweru, hosted the global 2009 World Mental Health Day, and leads large-scale community
                                  campaigns against substance abuse.
                              </p>
                              <div class="team-social">
                                  <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                                      <i class="bi bi-linkedin"></i>
                                  </a>
                                  <a href="#" class="social-link twitter" aria-label="Twitter">
                                      <i class="bi bi-twitter"></i>
                                  </a>
                                  <a href="mailto:stella@queenofpeace.org" class="social-link email" aria-label="Email">
                                      <i class="bi bi-envelope"></i>
                                  </a>
                              </div>
                          </div>
                      </div>
  
                      <!-- Dr Blazio -->
                      <div class="team-card">
                          <div class="team-card-header">
                              <img src="{{ asset('images/directors/dr-manobo.jpeg') }}" 
                                   alt="Dr. Blazio M. Manobo" 
                                   class="team-profile-img">
                          </div>
                          <div class="team-card-body">
                              <h3 class="team-name">Dr. Blazio M. Manobo</h3>
                              <p class="team-role">
                                  <i class="bi bi-person-badge"></i>
                                  Vice Chairman
                              </p>
                              <p class="team-bio">
                                  Dr Blazio M Manobo is a Social Scientist, Researcher, and Development Practitioner specializing in
                                  inclusivity research and programming. He has published several articles in theology and development
                                  and contributes to multiple Boards of Directors, advancing mental health programs nationwide.
                                  <br><br>
                                  He is a senior lecturer and strategist for youth-focused programs.
                              </p>
                              <div class="team-social">
                                  <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                                      <i class="bi bi-linkedin"></i>
                                  </a>
                                  <a href="#" class="social-link twitter" aria-label="Twitter">
                                      <i class="bi bi-twitter"></i>
                                  </a>
                                  <a href="mailto:blazio@queenofpeace.org" class="social-link email" aria-label="Email">
                                      <i class="bi bi-envelope"></i>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
  
                  <!-- Slide 2 -->
                  <div class="team-slide">
                      <!-- Trevor Punungwe -->
                      <div class="team-card">
                          <div class="team-card-header">
                              <img src="{{ asset('images/directors/trevor-m.jpeg') }}" 
                                   alt="Trevor M. Punungwe" 
                                   class="team-profile-img">
                          </div>
                          <div class="team-card-body">
                              <h3 class="team-name">Trevor M. Punungwe</h3>
                              <p class="team-role">
                                  <i class="bi bi-laptop"></i>
                                  Director – IT & Youth Engagement
                              </p>
                              <p class="team-bio">
                                  Trevor oversees digital transformation and youth-centered programming, ensuring mental health
                                  services are accessible through technology. With a background in Data Science and Informatics, he
                                  leads innovation, digital strategy, and youth engagement initiatives that empower young people
                                  through modern wellness interventions.
                              </p>
                              <div class="team-social">
                                  <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                                      <i class="bi bi-linkedin"></i>
                                  </a>
                                  <a href="#" class="social-link twitter" aria-label="Twitter">
                                      <i class="bi bi-twitter"></i>
                                  </a>
                                  <a href="mailto:trevor@queenofpeace.org" class="social-link email" aria-label="Email">
                                      <i class="bi bi-envelope"></i>
                                  </a>
                              </div>
                          </div>
                      </div>
  
                      <!-- Alington Mudzingwa -->
                      <div class="team-card">
                          <div class="team-card-header">
                              <img src="{{ asset('images/directors/a-mudzingwa.jpg') }}" 
                                   alt="Alington Mudzingwa" 
                                   class="team-profile-img">
                          </div>
                          <div class="team-card-body">
                              <h3 class="team-name">Alington Mudzingwa</h3>
                              <p class="team-role">
                                  <i class="bi bi-briefcase"></i>
                                  Board Member
                              </p>
                              <p class="team-bio">
                                  Alington is a development strategist and advocate for inclusive mental health integration. As a
                                  Board Member, he supports governance, strategic planning, and evidence-based interventions.
                                  <br><br>
                                  He is the Founder & CEO of ALIEUM Investments and has served on the Board of Gweru Polytechnic.
                                  Currently pursuing a Master's in Public Policy in Thailand, he brings expertise spanning mental
                                  health, education, and economic empowerment.
                              </p>
                              <div class="team-social">
                                  <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                                      <i class="bi bi-linkedin"></i>
                                  </a>
                                  <a href="#" class="social-link twitter" aria-label="Twitter">
                                      <i class="bi bi-twitter"></i>
                                  </a>
                                  <a href="mailto:alington@queenofpeace.org" class="social-link email" aria-label="Email">
                                      <i class="bi bi-envelope"></i>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
  
              <!-- Carousel Controls -->
              <div class="carousel-controls">
                  <button class="carousel-btn" id="prevBtn" onclick="changeSlide(-1)">
                      <i class="bi bi-chevron-left"></i>
                  </button>
                  
                  <div class="carousel-indicators">
                      <span class="carousel-dot active" onclick="goToSlide(0)"></span>
                      <span class="carousel-dot" onclick="goToSlide(1)"></span>
                  </div>
                  
                  <button class="carousel-btn" id="nextBtn" onclick="changeSlide(1)">
                      <i class="bi bi-chevron-right"></i>
                  </button>
              </div>
          </div>
      </div>
  </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Join Our Team?</h2>
            <p>
                Join your hand with us for a better life and a beautiful future. Together, we can make a lasting impact.
            </p>
            <a href="/contact" class="btn-cta">
                <i class="bi bi-envelope"></i>
                Contact Us
            </a>
        </div>
    </section>
</div>

<script>
let currentSlide = 0;
const totalSlides = 2;

function updateCarousel() {
    const carousel = document.getElementById('teamCarousel');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
    
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });
    
    prevBtn.disabled = currentSlide === 0;
    nextBtn.disabled = currentSlide === totalSlides - 1;
}

function changeSlide(direction) {
    currentSlide += direction;
    if (currentSlide < 0) currentSlide = 0;
    if (currentSlide >= totalSlides) currentSlide = totalSlides - 1;
    updateCarousel();
}

function goToSlide(index) {
    currentSlide = index;
    updateCarousel();
}

// Auto-play carousel (optional)
setInterval(() => {
    if (currentSlide < totalSlides - 1) {
        changeSlide(1);
    } else {
        currentSlide = -1;
        changeSlide(1);
    }
}, 8000);

// Initialize
updateCarousel();
</script>
@endsection