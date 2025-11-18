@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')
<style>
  /* Bootstrap Icons */
  @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');

  /* Hero Section */
  .faq-hero {
    position: relative;
    padding: 100px 20px;
    background: linear-gradient(135deg, rgba(0, 168, 107, 0.92) 0%, rgba(44, 62, 80, 0.88) 100%),
                url('https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1920') center/cover;
    color: white;
    text-align: center;
  }

  .faq-hero-content {
    max-width: 900px;
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
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 25px;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
  }

  .faq-hero p {
    font-size: 1.3rem;
    opacity: 0.95;
    line-height: 1.8;
  }

  /* Section */
  .section {
    padding: 80px 20px;
  }

  .container {
    max-width: 1000px;
    margin: 0 auto;
  }

  /* Category Tabs */
  .category-tabs {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 50px;
  }

  .category-tab {
    padding: 12px 30px;
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 50px;
    font-weight: 700;
    color: #7f8c8d;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .category-tab:hover {
    border-color: #00a86b;
    color: #00a86b;
    transform: translateY(-2px);
  }

  .category-tab.active {
    background: linear-gradient(135deg, #00a86b 0%, #008f5a 100%);
    border-color: #00a86b;
    color: white;
    box-shadow: 0 5px 20px rgba(0, 168, 107, 0.3);
  }

  /* FAQ Items */
  .faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .faq-item {
    background: white;
    border-radius: 15px;
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
    box-shadow: 0 10px 30px rgba(0, 168, 107, 0.15);
    transform: translateY(-5px);
  }

  .faq-question {
    padding: 25px 30px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
    position: relative;
  }

  .faq-question:hover {
    background: linear-gradient(to right, rgba(0, 168, 107, 0.05) 0%, transparent 100%);
  }

  .faq-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    background: linear-gradient(135deg, #00a86b 0%, #008f5a 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 5px 15px rgba(0, 168, 107, 0.3);
  }

  .faq-question-text {
    flex: 1;
  }

  .faq-question h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c3e50;
    line-height: 1.5;
    margin: 0;
  }

  .faq-toggle {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 50%;
    background: #f1f3f5;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }

  .faq-toggle i {
    font-size: 1.2rem;
    color: #00a86b;
    transition: transform 0.3s ease;
  }

  .faq-item.active .faq-toggle {
    background: linear-gradient(135deg, #00a86b 0%, #008f5a 100%);
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
    max-height: 1000px;
    border-top: 1px solid #e5e7eb;
  }

  .faq-answer-content {
    padding: 25px 30px 25px 100px;
    color: #7f8c8d;
    line-height: 1.9;
    font-size: 1.05rem;
  }

  /* Search Box */
  .faq-search {
    max-width: 600px;
    margin: 0 auto 50px;
    position: relative;
  }

  .faq-search input {
    width: 100%;
    padding: 18px 60px 18px 25px;
    border: 2px solid #e5e7eb;
    border-radius: 50px;
    font-size: 1.05rem;
    transition: all 0.3s ease;
  }

  .faq-search input:focus {
    outline: none;
    border-color: #00a86b;
    box-shadow: 0 5px 20px rgba(0, 168, 107, 0.15);
  }

  .faq-search button {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #00a86b 0%, #008f5a 100%);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }

  .faq-search button:hover {
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 168, 107, 0.4);
  }

  /* Stats Section */
  .faq-stats {
    background: linear-gradient(135deg, rgba(0, 168, 107, 0.05) 0%, rgba(255, 165, 0, 0.05) 100%);
    padding: 60px 20px;
    margin: 60px 0;
    border-radius: 20px;
  }

  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    max-width: 900px;
    margin: 0 auto;
  }

  .stat-item {
    text-align: center;
  }

  .stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: #00a86b;
    display: block;
    margin-bottom: 10px;
  }

  .stat-label {
    font-size: 1rem;
    color: #7f8c8d;
    font-weight: 600;
  }

  /* CTA Section */
  .cta-section {
    background: linear-gradient(135deg, #00a86b 0%, #008f5a 100%);
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
    color: #00a86b;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.15rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  }

  .btn-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    background: #ffa500;
    color: white;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .faq-hero h1 {
      font-size: 2rem;
    }

    .faq-answer-content {
      padding-left: 30px;
    }

    .stat-number {
      font-size: 2rem;
    }

    .cta-content h2 {
      font-size: 2rem;
    }

    .category-tabs {
      gap: 10px;
    }

    .category-tab {
      padding: 10px 20px;
      font-size: 0.9rem;
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
                    All Questions
                </button>
                <button class="category-tab" onclick="filterCategory('services')">
                    <i class="bi bi-hospital"></i>
                    Services
                </button>
                <button class="category-tab" onclick="filterCategory('mental-health')">
                    <i class="bi bi-heart-pulse"></i>
                    Mental Health
                </button>
                <button class="category-tab" onclick="filterCategory('admission')">
                    <i class="bi bi-person-check"></i>
                    Admission
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
                Contact Us
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
        noResults.style.cssText = 'text-align: center; padding: 40px; color: #7f8c8d; font-size: 1.1rem;';
        noResults.innerHTML = '<i class="bi bi-search" style="font-size: 3rem; display: block; margin-bottom: 20px; opacity: 0.3;"></i>No results found. Try different keywords.';
        document.getElementById('faqList').appendChild(noResults);
    }
}
</script>
@endsection