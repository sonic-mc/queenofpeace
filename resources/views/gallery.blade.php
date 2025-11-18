@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<style>
  /* Import Inter Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

  /* Hero Section */
  .gallery-hero {
    position: relative;
    padding: 100px 20px;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop') center/cover;
    color: white;
    text-align: center;
    overflow: hidden;
  }

  .gallery-hero::before {
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

  .gallery-hero-content {
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

  .gallery-hero h1 {
    font-family: 'Inter', sans-serif;
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 20px;
    text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.7);
    letter-spacing: -0.02em;
    color: white;
  }

  .gallery-hero p {
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

  /* Filter Buttons */
  .filter-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 50px;
  }

  .filter-btn {
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

  .filter-btn:hover {
    border-color: #0066FF;
    color: #0066FF;
    transform: translateY(-2px);
  }

  .filter-btn.active {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-color: #0066FF;
    color: white;
    box-shadow: 0 5px 20px rgba(0, 102, 255, 0.3);
  }

  /* Gallery Grid */
  .gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
  }

  .gallery-item {
    position: relative;
    height: 300px;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInScale 0.6s ease-out;
    animation-fill-mode: both;
  }

  .gallery-item:nth-child(1) { animation-delay: 0.05s; }
  .gallery-item:nth-child(2) { animation-delay: 0.1s; }
  .gallery-item:nth-child(3) { animation-delay: 0.15s; }
  .gallery-item:nth-child(4) { animation-delay: 0.2s; }
  .gallery-item:nth-child(5) { animation-delay: 0.25s; }
  .gallery-item:nth-child(6) { animation-delay: 0.3s; }
  .gallery-item:nth-child(7) { animation-delay: 0.35s; }
  .gallery-item:nth-child(8) { animation-delay: 0.4s; }
  .gallery-item:nth-child(9) { animation-delay: 0.45s; }

  @keyframes fadeInScale {
    from {
      opacity: 0;
      transform: scale(0.9);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .gallery-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 102, 255, 0.2);
  }

  .gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .gallery-item:hover .gallery-img {
    transform: scale(1.1);
  }

  .gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.85) 0%, rgba(0, 82, 204, 0.75) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 15px;
  }

  .gallery-item:hover .gallery-overlay {
    opacity: 1;
  }

  .gallery-overlay i {
    font-size: 3rem;
    color: white;
    animation: zoomPulse 1.5s infinite;
  }

  @keyframes zoomPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
  }

  .gallery-caption {
    font-family: 'Inter', sans-serif;
    color: white;
    font-size: 1.2rem;
    font-weight: 700;
    text-align: center;
    padding: 0 20px;
  }

  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.95);
    animation: fadeIn 0.3s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  .modal.active {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .modal-content {
    max-width: 90%;
    max-height: 90%;
    position: relative;
    animation: zoomIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  @keyframes zoomIn {
    from {
      transform: scale(0.8);
      opacity: 0;
    }
    to {
      transform: scale(1);
      opacity: 1;
    }
  }

  .modal-img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.5);
  }

  .modal-close {
    position: absolute;
    top: -50px;
    right: 0;
    color: white;
    font-size: 40px;
    font-weight: 300;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    backdrop-filter: blur(10px);
  }

  .modal-close:hover {
    transform: rotate(90deg) scale(1.1);
    background: rgba(255, 255, 255, 0.2);
  }

  .modal-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-size: 50px;
    cursor: pointer;
    padding: 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .modal-nav:hover {
    background: rgba(0, 102, 255, 0.8);
    transform: translateY(-50%) scale(1.1);
  }

  .modal-prev { left: 20px; }
  .modal-next { right: 20px; }

  /* Stats Section */
  .stats-section {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    padding: 70px 20px;
    margin-top: 80px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
  }

  .stats-section::before {
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

  .stats-content {
    position: relative;
    z-index: 1;
  }

  .stats-content h2 {
    font-family: 'Inter', sans-serif;
    font-size: 2.5rem;
    font-weight: 900;
    margin-bottom: 50px;
    letter-spacing: -0.02em;
  }

  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    max-width: 1000px;
    margin: 0 auto;
  }

  .stat-item {
    font-family: 'Inter', sans-serif;
  }

  .stat-number {
    font-size: 3rem;
    font-weight: 900;
    display: block;
    margin-bottom: 10px;
  }

  .stat-label {
    font-size: 1.1rem;
    opacity: 0.95;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .gallery-hero {
      padding: 60px 20px;
    }

    .gallery-hero h1 {
      font-size: 2rem;
    }

    .gallery-hero p {
      font-size: 1.1rem;
    }

    .gallery-grid {
      grid-template-columns: 1fr;
    }

    .modal-nav {
      width: 50px;
      height: 50px;
      font-size: 30px;
    }

    .modal-close {
      top: -40px;
      font-size: 30px;
    }
  }
</style>

<div class="w-full">
    <!-- Hero Section -->
    <section class="gallery-hero">
        <div class="gallery-hero-content">
            <h1>Our Gallery</h1>
            <p>A glimpse into our activities, programs, and community engagements.</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section">
        <div class="container">
            <!-- Filter Buttons -->
            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filterGallery('all')">All</button>
                <button class="filter-btn" onclick="filterGallery('community')">Community</button>
                <button class="filter-btn" onclick="filterGallery('programs')">Programs</button>
                <button class="filter-btn" onclick="filterGallery('events')">Events</button>
            </div>

            <!-- Gallery Grid -->
            <div class="gallery-grid" id="galleryGrid">
                <!-- Image 1 -->
                <div class="gallery-item" data-category="community" onclick="openModal(0)">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.1.0&w=800&q=80" 
                         class="gallery-img" 
                         alt="Community Care">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Community Care</span>
                    </div>
                </div>

                <!-- Image 2 -->
                <div class="gallery-item" data-category="programs" onclick="openModal(1)">
                    <img src="https://images.unsplash.com/photo-1608052026785-0bc249c733e3?q=80&w=800&auto=format" 
                         class="gallery-img" 
                         alt="Support Programs">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Support Programs</span>
                    </div>
                </div>

                <!-- Image 3 -->
                <div class="gallery-item" data-category="community" onclick="openModal(2)">
                    <img src="https://images.unsplash.com/photo-1683105436130-3f3b9e8fbabe?w=800&auto=format" 
                         class="gallery-img" 
                         alt="Unity & Support">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Unity & Support</span>
                    </div>
                </div>

                <!-- Image 4 -->
                <div class="gallery-item" data-category="events" onclick="openModal(3)">
                    <img src="https://images.unsplash.com/photo-1761918900832-b178aaf40916?w=800&auto=format" 
                         class="gallery-img" 
                         alt="Community Events">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Community Events</span>
                    </div>
                </div>

                <!-- Image 5 -->
                <div class="gallery-item" data-category="programs" onclick="openModal(4)">
                    <img src="https://images.unsplash.com/photo-1509100297676-1a18b3842dd6?w=800&auto=format" 
                         class="gallery-img" 
                         alt="Hope & Healing">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Hope & Healing</span>
                    </div>
                </div>

                <!-- Image 6 -->
                <div class="gallery-item" data-category="community" onclick="openModal(5)">
                    <img src="https://images.unsplash.com/photo-1538023380698-a58563e71c59?w=800&auto=format" 
                         class="gallery-img" 
                         alt="Group Support">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Group Support</span>
                    </div>
                </div>

                <!-- Image 7 -->
                <div class="gallery-item" data-category="events" onclick="openModal(6)">
                    <img src="https://images.unsplash.com/photo-1623399785391-6970a4e8d261?w=800&auto=format" 
                         class="gallery-img" 
                         alt="Helping Hands">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Helping Hands</span>
                    </div>
                </div>

                <!-- Image 8 -->
                <div class="gallery-item" data-category="programs" onclick="openModal(7)">
                    <img src="https://media.istockphoto.com/id/478010888/photo/zeandra-b-w.jpg?s=612x612&w=0&k=20&c=cz7sMNv4dDt6T-GQ7EifUtgbYjmenOkB_dzFvhh8KV8=" 
                         class="gallery-img" 
                         alt="Peace & Serenity">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Peace & Serenity</span>
                    </div>
                </div>

                <!-- Image 9 -->
                <div class="gallery-item" data-category="community" onclick="openModal(8)">
                    <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&auto=format" 
                         class="gallery-img" 
                         alt="Community Gathering">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                        <span class="gallery-caption">Community Gathering</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-content">
            <h2>Gallery Highlights</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Photos Captured</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Events Documented</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1000+</span>
                    <span class="stat-label">Stories Shared</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="imageModal" class="modal">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <span class="modal-nav modal-prev" onclick="changeImage(-1)">&#10094;</span>
        <div class="modal-content">
            <img id="modalImage" class="modal-img" src="" alt="Gallery Image">
        </div>
        <span class="modal-nav modal-next" onclick="changeImage(1)">&#10095;</span>
    </div>
</div>

<script>
// Gallery Images Array
const galleryImages = [
    "https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.1.0&w=1920&q=80",
    "https://images.unsplash.com/photo-1608052026785-0bc249c733e3?q=80&w=1920&auto=format",
    "https://images.unsplash.com/photo-1683105436130-3f3b9e8fbabe?w=1920&auto=format",
    "https://images.unsplash.com/photo-1761918900832-b178aaf40916?w=1920&auto=format",
    "https://images.unsplash.com/photo-1509100297676-1a18b3842dd6?w=1920&auto=format",
    "https://images.unsplash.com/photo-1538023380698-a58563e71c59?w=1920&auto=format",
    "https://images.unsplash.com/photo-1623399785391-6970a4e8d261?w=1920&auto=format",
    "https://media.istockphoto.com/id/478010888/photo/zeandra-b-w.jpg?s=612x612&w=0&k=20&c=cz7sMNv4dDt6T-GQ7EifUtgbYjmenOkB_dzFvhh8KV8=",
    "https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=1920&auto=format"
];

let currentImageIndex = 0;

// Open Modal
function openModal(index) {
    currentImageIndex = index;
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    
    modal.classList.add('active');
    modalImg.src = galleryImages[currentImageIndex];
    document.body.style.overflow = 'hidden';
}

// Close Modal
function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Change Image
function changeImage(direction) {
    currentImageIndex += direction;
    
    if (currentImageIndex >= galleryImages.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = galleryImages.length - 1;
    }
    
    const modalImg = document.getElementById('modalImage');
    modalImg.style.animation = 'none';
    setTimeout(() => {
        modalImg.src = galleryImages[currentImageIndex];
        modalImg.style.animation = 'zoomIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    }, 50);
}

// Filter Gallery
function filterGallery(category) {
    const items = document.querySelectorAll('.gallery-item');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Filter items
    items.forEach((item, index) => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            item.style.animation = 'none';
            setTimeout(() => {
                item.style.animation = `fadeInScale 0.6s ease-out ${index * 0.05}s both`;
            }, 10);
        } else {
            item.style.display = 'none';
        }
    });
}

// Keyboard Navigation
document.addEventListener('keydown', (e) => {
    const modal = document.getElementById('imageModal');
    if (modal.classList.contains('active')) {
        if (e.key === 'ArrowLeft') changeImage(-1);
        if (e.key === 'ArrowRight') changeImage(1);
        if (e.key === 'Escape') closeModal();
    }
});

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', (e) => {
    if (e.target.id === 'imageModal') {
        closeModal();
    }
});
</script>
@endsection