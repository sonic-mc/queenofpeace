@extends('layouts.app')

@section('title', 'Blog & Insights')

@section('content')
<style>
  /* Import Inter Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

  /* Hero Section */
  .blog-hero {
    position: relative;
    padding: 100px 20px;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                url('https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=2070&auto=format&fit=crop') center/cover;
    color: white;
    text-align: center;
    overflow: hidden;
  }

  .blog-hero::before {
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

  .blog-hero-content {
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

  .blog-hero h1 {
    font-family: 'Inter', sans-serif;
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 20px;
    text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.7);
    letter-spacing: -0.02em;
    color: white;
  }

  .blog-hero p {
    font-family: 'Inter', sans-serif;
    font-size: 1.3rem;
    opacity: 0.95;
    line-height: 1.7;
    color: white;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
  }

  /* Section */
  .section {
    padding: 80px 20px;
  }

  .container {
    max-width: 1400px;
    margin: 0 auto;
  }

  /* Category Filter */
  .category-filter {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 60px;
  }

  .category-btn {
    font-family: 'Inter', sans-serif;
    padding: 12px 30px;
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 50px;
    font-weight: 700;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 0.95rem;
  }

  .category-btn:hover {
    border-color: #0066FF;
    color: #0066FF;
    transform: translateY(-2px);
  }

  .category-btn.active {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-color: #0066FF;
    color: white;
    box-shadow: 0 5px 20px rgba(0, 102, 255, 0.3);
  }

  /* Blog Grid */
  .blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 35px;
  }

  .blog-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    animation: fadeInScale 0.6s ease-out;
    animation-fill-mode: both;
  }

  .blog-card:nth-child(1) { animation-delay: 0.05s; }
  .blog-card:nth-child(2) { animation-delay: 0.1s; }
  .blog-card:nth-child(3) { animation-delay: 0.15s; }
  .blog-card:nth-child(4) { animation-delay: 0.2s; }
  .blog-card:nth-child(5) { animation-delay: 0.25s; }
  .blog-card:nth-child(6) { animation-delay: 0.3s; }

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

  .blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 102, 255, 0.15);
    border-color: #0066FF;
  }

  .blog-image {
    position: relative;
    height: 250px;
    overflow: hidden;
  }

  .blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .blog-card:hover .blog-image img {
    transform: scale(1.1);
  }

  .blog-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    padding: 8px 18px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    box-shadow: 0 4px 15px rgba(0, 102, 255, 0.4);
  }

  .blog-content {
    padding: 30px;
  }

  .blog-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 18px;
    flex-wrap: wrap;
  }

  .blog-meta-item {
    font-family: 'Inter', sans-serif;
    display: flex;
    align-items: center;
    gap: 6px;
    color: #6b7280;
    font-size: 0.9rem;
  }

  .blog-meta-item i {
    color: #0066FF;
    font-size: 0.95rem;
  }

  .blog-content h3 {
    font-family: 'Inter', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 15px;
    line-height: 1.3;
    letter-spacing: -0.01em;
  }

  .blog-content p {
    font-family: 'Inter', sans-serif;
    color: #6b7280;
    line-height: 1.7;
    font-size: 1.05rem;
    margin-bottom: 25px;
  }

  .blog-btn {
    font-family: 'Inter', sans-serif;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 28px;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    font-weight: 700;
    border-radius: 50px;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
    text-decoration: none;
  }

  .blog-btn:hover {
    transform: translateX(5px);
    box-shadow: 0 6px 20px rgba(0, 102, 255, 0.4);
  }

  /* Featured Post */
  .featured-post {
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(51, 133, 255, 0.05) 100%);
    border-radius: 24px;
    padding: 50px;
    margin-bottom: 60px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    align-items: center;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
  }

  .featured-post::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0, 102, 255, 0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
  }

  @keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }

  .featured-badge {
    display: inline-block;
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
  }

  .featured-content {
    position: relative;
    z-index: 1;
  }

  .featured-content h2 {
    font-family: 'Inter', sans-serif;
    font-size: 2.5rem;
    font-weight: 900;
    color: #1f2937;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
  }

  .featured-content p {
    font-family: 'Inter', sans-serif;
    font-size: 1.15rem;
    color: #6b7280;
    line-height: 1.8;
    margin-bottom: 30px;
  }

  .featured-image {
    position: relative;
    z-index: 1;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  }

  .featured-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
  }

  /* Newsletter Section */
  .newsletter-section {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: 80px 20px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
  }

  .newsletter-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: rotate 25s linear infinite;
  }

  .newsletter-content {
    max-width: 700px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .newsletter-content h2 {
    font-family: 'Inter', sans-serif;
    font-size: 2.5rem;
    font-weight: 900;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
  }

  .newsletter-content p {
    font-family: 'Inter', sans-serif;
    font-size: 1.2rem;
    margin-bottom: 35px;
    opacity: 0.95;
    line-height: 1.7;
  }

  .newsletter-form {
    display: flex;
    gap: 15px;
    max-width: 500px;
    margin: 0 auto;
  }

  .newsletter-input {
    flex: 1;
    padding: 16px 24px;
    border-radius: 50px;
    border: none;
    font-size: 1rem;
    font-family: 'Inter', sans-serif;
  }

  .newsletter-btn {
    padding: 16px 35px;
    background: white;
    color: #0066FF;
    font-weight: 700;
    border-radius: 50px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Inter', sans-serif;
  }

  .newsletter-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    background: #3385FF;
    color: white;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .blog-hero {
      padding: 60px 20px;
    }

    .blog-hero h1 {
      font-size: 2rem;
    }

    .blog-hero p {
      font-size: 1.1rem;
    }

    .blog-grid {
      grid-template-columns: 1fr;
    }

    .featured-post {
      grid-template-columns: 1fr;
      padding: 30px;
    }

    .featured-content h2 {
      font-size: 1.8rem;
    }

    .newsletter-form {
      flex-direction: column;
    }
  }
</style>

<div class="w-full">
    <!-- Hero Section -->
    <section class="blog-hero">
        <div class="blog-hero-content">
            <h1>Blog & Insights</h1>
            <p>Stories, reflections, mental health insights, and community updates</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section">
        <div class="container">
            <!-- Featured Post -->
            <div class="featured-post">
                <div class="featured-content">
                    <span class="featured-badge">⭐ Featured Article</span>
                    <h2>World Suicide Prevention Month</h2>
                    <p>
                        September is #WorldSuicidePreventionMonth — Every life matters. Every conversation 
                        counts. This month we raise awareness, #breakthesilence, and reaffirm that hope is 
                        possible and help is real. Join us in spreading hope and supporting those in need.
                    </p>
                    <a href="#" class="blog-btn">
                        Read Full Article
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="featured-image">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=800&auto=format" alt="Suicide Prevention">
                </div>
            </div>

            <!-- Category Filter -->
            <div class="category-filter">
                <button class="category-btn active" onclick="filterCategory('all')">All Posts</button>
                <button class="category-btn" onclick="filterCategory('mental-health')">Mental Health</button>
                <button class="category-btn" onclick="filterCategory('campaigns')">Campaigns</button>
                <button class="category-btn" onclick="filterCategory('updates')">Updates</button>
            </div>

            <!-- Blog Grid -->
            <div class="blog-grid" id="blogGrid">
                <!-- Post 1 -->
                <div class="blog-card" data-category="campaigns">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&auto=format" alt="Changing the Narrative">
                        <span class="blog-badge">Campaign</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="blog-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>September 2025</span>
                            </div>
                            <div class="blog-meta-item">
                                <i class="fas fa-comments"></i>
                                <span>0 Comments</span>
                            </div>
                        </div>
                        <h3>Changing the Narrative on Suicide</h3>
                        <p>
                            September is #WorldSuicidePreventionMonth — Every life matters. Every conversation 
                            counts. This month we raise awareness, #breakthesilence, and reaffirm that hope is 
                            possible and help is real.
                        </p>
                        <a href="#" class="blog-btn">
                            Read More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Post 2 -->
                <div class="blog-card" data-category="mental-health">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1509100297676-1a18b3842dd6?w=800&auto=format" alt="Suicide Prevention">
                        <span class="blog-badge">Mental Health</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="blog-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>September 2025</span>
                            </div>
                            <div class="blog-meta-item">
                                <i class="fas fa-comments"></i>
                                <span>0 Comments</span>
                            </div>
                        </div>
                        <h3>Suicide is Preventable</h3>
                        <p>
                            Talking openly about mental health saves lives. A kind word, a listening ear, or 
                            a simple check-in can make all the difference. #Hope #breakthesilence
                        </p>
                        <a href="#" class="blog-btn">
                            Read More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Post 3 -->
                <div class="blog-card" data-category="mental-health">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1538023380698-a58563e71c59?w=800&auto=format" alt="Your Story">
                        <span class="blog-badge">Hope</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="blog-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>September 2025</span>
                            </div>
                            <div class="blog-meta-item">
                                <i class="fas fa-comments"></i>
                                <span>0 Comments</span>
                            </div>
                        </div>
                        <h3>Your Story Isn't Over Yet</h3>
                        <p>
                            There is strength in reaching out and healing in being heard. Let's walk this 
                            month together with compassion. #StayConnected #healing
                        </p>
                        <a href="#" class="blog-btn">
                            Read More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Post 4 -->
                <div class="blog-card" data-category="campaigns">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1608052026785-0bc249c733e3?q=80&w=800&auto=format" alt="World Mental Health Day">
                        <span class="blog-badge">Campaign</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="blog-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>October 10, 2020</span>
                            </div>
                            <div class="blog-meta-item">
                                <i class="fas fa-comments"></i>
                                <span>0 Comments</span>
                            </div>
                        </div>
                        <h3>World Mental Health Day</h3>
                        <p>
                            Join us in raising awareness about mental health and breaking the stigma 
                            surrounding mental illness. Together we can make a difference.
                        </p>
                        <a href="#" class="blog-btn">
                            Read More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Post 5 -->
                <div class="blog-card" data-category="campaigns">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1623399785391-6970a4e8d261?w=800&auto=format" alt="End Violence">
                        <span class="blog-badge">Advocacy</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="blog-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>Ongoing Campaign</span>
                            </div>
                            <div class="blog-meta-item">
                                <i class="fas fa-comments"></i>
                                <span>0 Comments</span>
                            </div>
                        </div>
                        <h3>#EndViolence For Every Woman</h3>
                        <p>
                            Supporting women and advocating for an end to violence against women in 
                            our communities. Stand with us in this important mission.
                        </p>
                        <a href="#" class="blog-btn">
                            Read More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Post 6 -->
                <div class="blog-card" data-category="updates">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.1.0&w=800" alt="Vocational Training">
                        <span class="blog-badge">Update</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="blog-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>Latest Update</span>
                            </div>
                            <div class="blog-meta-item">
                                <i class="fas fa-comments"></i>
                                <span>0 Comments</span>
                            </div>
                        </div>
                        <h3>Vocational Training Progress</h3>
                        <p>
                            Updates on our vocational training programs and inspiring success stories 
                            from our trainees. See how lives are being transformed.
                        </p>
                        <a href="#" class="blog-btn">
                            Read More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="newsletter-content">
            <h2>Subscribe to Our Newsletter</h2>
            <p>
                Stay updated with our latest stories, mental health tips, and community news.
            </p>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Enter your email address" required>
                <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
        </div>
    </section>
</div>

<script>
function filterCategory(category) {
    const cards = document.querySelectorAll('.blog-card');
    const buttons = document.querySelectorAll('.category-btn');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Filter cards
    cards.forEach((card, index) => {
        if (category === 'all' || card.dataset.category === category) {
            card.style.display = 'block';
            card.style.animation = 'none';
            setTimeout(() => {
                card.style.animation = `fadeInScale 0.6s ease-out ${index * 0.05}s both`;
            }, 10);
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
@endsection