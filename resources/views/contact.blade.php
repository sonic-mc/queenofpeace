@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<style>
  /* Import Inter Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

  /* Hero Section */
  .contact-hero {
    position: relative;
    padding: 100px 20px;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.92) 0%, rgba(5, 150, 105, 0.88) 100%),
                url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?q=80&w=2074&auto=format&fit=crop') center/cover;
    color: white;
    text-align: center;
    overflow: hidden;
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

  .contact-hero h1 {
    font-family: 'Inter', sans-serif;
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 20px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.02em;
  }

  .contact-hero p {
    font-family: 'Inter', sans-serif;
    font-size: 1.3rem;
    opacity: 0.95;
    line-height: 1.7;
  }

  /* Section */
  .section {
    padding: 80px 20px;
  }

  .container {
    max-width: 1400px;
    margin: 0 auto;
  }

  /* Contact Grid */
  .contact-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 40px;
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

  /* Contact Info Card */
  .contact-info-card {
    background: white;
    border-radius: 24px;
    padding: 45px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    height: 100%;
  }

  .contact-info-card h4 {
    font-family: 'Inter', sans-serif;
    font-size: 1.8rem;
    font-weight: 900;
    color: #1f2937;
    margin-bottom: 30px;
    letter-spacing: -0.02em;
  }

  .contact-item {
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 2px solid #f3f4f6;
  }

  .contact-item:last-child {
    border-bottom: none;
  }

  .contact-item-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    font-weight: 700;
    color: #10b981;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .contact-item-label i {
    font-size: 1.1rem;
  }

  .contact-item-value {
    font-family: 'Inter', sans-serif;
    font-size: 1.05rem;
    color: #6b7280;
    line-height: 1.7;
  }

  .contact-person {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 16px;
    padding: 20px;
    margin-top: 30px;
  }

  .contact-person h5 {
    font-family: 'Inter', sans-serif;
    font-size: 1.2rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 8px;
  }

  .contact-person p {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    color: #6b7280;
    margin-bottom: 5px;
    line-height: 1.6;
  }

  .contact-person strong {
    color: #10b981;
  }

  /* Contact Form Card */
  .contact-form-card {
    background: white;
    border-radius: 24px;
    padding: 45px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
  }

  .contact-form-card h4 {
    font-family: 'Inter', sans-serif;
    font-size: 1.8rem;
    font-weight: 900;
    color: #1f2937;
    margin-bottom: 15px;
    letter-spacing: -0.02em;
  }

  .contact-form-card > p {
    font-family: 'Inter', sans-serif;
    font-size: 1.05rem;
    color: #6b7280;
    margin-bottom: 35px;
  }

  .form-group {
    margin-bottom: 25px;
  }

  .form-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 10px;
    display: block;
  }

  .form-control {
    font-family: 'Inter', sans-serif;
    width: 100%;
    padding: 14px 20px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
  }

  textarea.form-control {
    resize: vertical;
    min-height: 150px;
  }

  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  .form-note {
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    color: #6b7280;
    margin-top: 8px;
    font-style: italic;
  }

  .btn-submit {
    font-family: 'Inter', sans-serif;
    padding: 16px 45px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.1rem;
    border: none;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .btn-submit:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 35px rgba(16, 185, 129, 0.5);
  }

  /* Map Section */
  .map-section {
    margin-top: 60px;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
  }

  .map-section iframe {
    width: 100%;
    height: 450px;
    border: none;
  }

  /* Quick Contact */
  .quick-contact {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    padding: 80px 20px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
    margin-top: 80px;
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
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .quick-contact h2 {
    font-family: 'Inter', sans-serif;
    font-size: 2.5rem;
    font-weight: 900;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
  }

  .quick-contact p {
    font-family: 'Inter', sans-serif;
    font-size: 1.2rem;
    margin-bottom: 35px;
    opacity: 0.95;
  }

  .quick-contact-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
  }

  .btn-quick {
    font-family: 'Inter', sans-serif;
    padding: 16px 35px;
    background: white;
    color: #10b981;
    font-weight: 700;
    border-radius: 50px;
    font-size: 1.05rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
  }

  .btn-quick:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
    background: #f59e0b;
    color: white;
  }

  /* Responsive */
  @media (max-width: 968px) {
    .contact-grid {
      grid-template-columns: 1fr;
    }

    .form-row {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 768px) {
    .contact-hero h1 {
      font-size: 2rem;
    }

    .contact-info-card,
    .contact-form-card {
      padding: 30px;
    }

    .quick-contact h2 {
      font-size: 1.8rem;
    }
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
                            <a href="mailto:queenofpeace.org@gmail.com" style="color: #10b981; text-decoration: none;">queenofpeace.org@gmail.com</a><br>
                            <a href="mailto:queenofpeace21@yahoo.com" style="color: #10b981; text-decoration: none;">queenofpeace21@yahoo.com</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-label">
                            <i class="fas fa-phone"></i>
                            Phone
                        </div>
                        <div class="contact-item-value">
                            <a href="tel:+263714375268" style="color: #10b981; text-decoration: none;">+263 71 437 5268</a><br>
                            <a href="tel:+263719932695" style="color: #10b981; text-decoration: none;">+263 71 993 2695</a>
                        </div>
                    </div>

                    <div class="contact-person">
                        <h5>Executive Director</h5>
                        <p>
                            <strong>Mrs Stella Khumalo Gaihai Punungwe</strong><br>
                            <a href="tel:+263772600778" style="color: #10b981; text-decoration: none;">+263 772 600 778</a>
                        </p>
                    </div>

                    <div class="contact-person">
                        <h5>Other Contacts</h5>
                        <p>
                            <strong>Mr. T. Kupemba</strong><br>
                            <a href="tel:+263785296888" style="color: #10b981; text-decoration: none;">+263 785 296 888</a>
                        </p>
                        <p>
                            <strong>Mr. T. Marodza</strong><br>
                            <a href="tel:+263779341940" style="color: #10b981; text-decoration: none;">+263 779 341 940</a>
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-card">
                    <h4>Send a Message</h4>
                    <p>Thank you for contacting us. We will respond as soon as possible.</p>

                    <form action="#" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Your Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subject *</label>
                            <input type="text" name="subject" class="form-control" placeholder="What is this about?" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+263 ___ ___ ___" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Your Message *</label>
                            <textarea name="message" class="form-control" rows="6" placeholder="Type your message here..." required></textarea>
                            <p class="form-note">Please provide as much detail as possible so we can assist you better.</p>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i>
                            Send Message
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
                    referrerpolicy="no-referrer-when-downgrade">
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
                <a href="tel:+263714375268" class="btn-quick">
                    <i class="fas fa-phone"></i>
                    Call Now
                </a>
                <a href="https://wa.me/263714375268" class="btn-quick" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp
                </a>
                <a href="mailto:queenofpeace.org@gmail.com" class="btn-quick">
                    <i class="fas fa-envelope"></i>
                    Email Us
                </a>
            </div>
        </div>
    </section>
</div>
@endsection