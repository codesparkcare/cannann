<!-- 1. Fullscreen Hero Slider Section with Animated Slides -->
<section class="hero-slider-container">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            <?php if(!empty($sliders)): foreach($sliders as $slide): ?>
                <div class="swiper-slide hero-slide-item" style="background-image: url('<?php echo htmlspecialchars($slide['image']); ?>');">
                    <div class="container">
                        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                            <?php if(!empty($slide['tag'])): ?>
                                <span class="hero-tag"><i class="fa-solid fa-star me-1 text-warning"></i> <?php echo htmlspecialchars($slide['tag']); ?></span>
                            <?php endif; ?>
                            <h1 class="hero-title"><?php echo htmlspecialchars($slide['title']); ?></h1>
                            <p class="hero-desc"><?php echo htmlspecialchars($slide['subtitle']); ?></p>
                            <div class="d-flex flex-wrap gap-3">
                                <?php if(!empty($slide['button_text'])): ?>
                                    <a href="<?php echo base_url($slide['button_link'] ?: 'rooms'); ?>" class="btn btn-luxury">
                                        <?php echo htmlspecialchars($slide['button_text']); ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($slide['secondary_btn_text'])): ?>
                                    <a href="<?php echo base_url($slide['secondary_btn_link'] ?: 'facilities'); ?>" class="btn btn-luxury-outline">
                                        <?php echo htmlspecialchars($slide['secondary_btn_text']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <div class="swiper-slide hero-slide-item" style="background-image: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1920&q=85');">
                    <div class="container">
                        <div class="hero-content">
                            <span class="hero-tag">5-STAR BOUTIQUE RESORT</span>
                            <h1 class="hero-title">Experience Coastal Luxury & Sublime Comfort</h1>
                            <p class="hero-desc">Immerse yourself in panoramic seaside vistas, lavish bespoke suites, and tailored five-star hospitality.</p>
                            <a href="<?php echo base_url('rooms'); ?>" class="btn btn-luxury">Explore Luxury Suites <i class="fa-solid fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next d-none d-md-flex text-white"></div>
        <div class="swiper-button-prev d-none d-md-flex text-white"></div>
    </div>
</section>

<!-- 2. Overlapping Booking Search Bar -->
<div class="container" id="booking-search">
    <div class="booking-search-bar" data-aos="fade-up" data-aos-delay="200">
        <form action="<?php echo base_url('rooms'); ?>" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-lg-3 col-md-6">
                    <label class="search-field-label"><i class="fa-solid fa-calendar-days text-primary"></i> Check-In Date</label>
                    <input type="date" name="check_in" class="search-field-input" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="search-field-label"><i class="fa-solid fa-calendar-check text-primary"></i> Check-Out Date</label>
                    <input type="date" name="check_out" class="search-field-input" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                </div>
                <div class="col-lg-2 col-md-4">
                    <label class="search-field-label"><i class="fa-solid fa-layer-group text-primary"></i> Room Category</label>
                    <select name="category" class="search-field-input">
                        <option value="">All Categories</option>
                        <?php if(!empty($room_categories)): foreach($room_categories as $rc): ?>
                            <option value="<?php echo $rc['id']; ?>"><?php echo htmlspecialchars($rc['name']); ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <label class="search-field-label"><i class="fa-solid fa-user-group text-primary"></i> Guests</label>
                    <select name="guests" class="search-field-input">
                        <option value="1">1 Person</option>
                        <option value="2" selected>2 Persons</option>
                        <option value="3">3 Persons</option>
                        <option value="4">4+ Persons</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <button type="submit" class="btn btn-luxury w-100 py-3" style="border-radius: var(--radius-sm);">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Check Now
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- 3. Welcome & Heritage Section with Counter Stats -->
<section class="py-5 my-4">
    <div class="container py-lg-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80" alt="Hotel Architecture" class="img-fluid rounded-4 shadow-lg w-100" style="height: 480px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 bg-dark text-white p-4 rounded-4 m-3 shadow-lg d-none d-sm-block" style="max-width: 260px; border-left: 4px solid var(--primary);">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="fa-solid fa-award text-warning fs-3"></i>
                            <span class="fs-4 fw-bold font-serif">5 Stars</span>
                        </div>
                        <p class="small text-white-50 mb-0">Recognized as the Leading Coastal Luxury Resort of 2026.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="section-badge">ABOUT OUR SANCTUARY</span>
                <h2 class="section-title">Where Coastal Serenity Meets Bespoke Royalty</h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    Nestled upon pristine coastal sands, <strong>Grand Cannann Resort & Spa</strong> is a sanctuary of refined elegance. Designed for travelers seeking peace and indulgence, every corner of our property reflects our dedication to artisanal hospitality, Michelin-standard culinary excellence, and rejuvenating wellness therapies.
                </p>

                <!-- 4 Key Counter Badges -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: var(--bg-cream); border: 1px solid rgba(197, 168, 128, 0.25);">
                            <i class="fa-solid fa-bed text-primary fs-2"></i>
                            <div>
                                <h4 class="mb-0 fw-bold font-serif">45+</h4>
                                <span class="small text-muted">Luxury Suites & Villas</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: var(--bg-cream); border: 1px solid rgba(197, 168, 128, 0.25);">
                            <i class="fa-solid fa-users text-primary fs-2"></i>
                            <div>
                                <h4 class="mb-0 fw-bold font-serif">12,000+</h4>
                                <span class="small text-muted">Delighted VIP Guests</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: var(--bg-cream); border: 1px solid rgba(197, 168, 128, 0.25);">
                            <i class="fa-solid fa-utensils text-primary fs-2"></i>
                            <div>
                                <h4 class="mb-0 fw-bold font-serif">4</h4>
                                <span class="small text-muted">Signature Dining Venues</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: var(--bg-cream); border: 1px solid rgba(197, 168, 128, 0.25);">
                            <i class="fa-solid fa-shield-heart text-primary fs-2"></i>
                            <div>
                                <h4 class="mb-0 fw-bold font-serif">100%</h4>
                                <span class="small text-muted">Satisfaction Guarantee</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <a href="<?php echo base_url('about'); ?>" class="btn btn-luxury">
                        Discover Our Story <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                    <a href="<?php echo base_url('rooms'); ?>" class="btn btn-outline-dark px-4 py-2" style="border-radius: 50px;">
                        View All Rooms
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Room Categories & Featured Suites Section -->
<section class="py-5 bg-cream" style="background-color: var(--bg-cream);">
    <div class="container py-lg-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge">ACCOMMODATION</span>
            <h2 class="section-title">Rooms, Suites & Private Botanical Villas</h2>
            <p class="section-subtitle">Each suite is meticulously appointed with fine Egyptian cotton bedding, marble bathrooms, smart automation, and breathtaking coastal views.</p>
        </div>

        <div class="row g-4">
            <?php if(!empty($featured_rooms)): foreach($featured_rooms as $idx => $room): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx + 1) * 100; ?>">
                    <div class="luxury-card">
                        <div class="luxury-card-img-wrap">
                            <img src="<?php echo htmlspecialchars($room['featured_image']); ?>" alt="<?php echo htmlspecialchars($room['title']); ?>">
                            <span class="card-category-badge"><?php echo htmlspecialchars($room['category_name'] ?? 'Luxury Suite'); ?></span>
                            <div class="card-price-badge">
                                ₹<?php echo number_format($room['discounted_price'] ?: $room['price']); ?> <span class="fw-normal small">/ night</span>
                            </div>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                            <div>
                                <h4 class="font-serif mb-2 fs-5">
                                    <a href="<?php echo base_url('room/' . $room['slug']); ?>" class="text-dark hover-primary"><?php echo htmlspecialchars($room['title']); ?></a>
                                </h4>
                                <p class="text-muted small mb-3"><?php echo htmlspecialchars(substr($room['short_description'], 0, 110)); ?>...</p>

                                <div class="d-flex flex-wrap gap-2 mb-3 pb-3 border-bottom small text-muted">
                                    <span><i class="fa-solid fa-user-group text-primary me-1"></i> <?php echo $room['max_adults']; ?> Adults</span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-bed text-primary me-1"></i> <?php echo htmlspecialchars($room['bed_type']); ?></span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-maximize text-primary me-1"></i> <?php echo htmlspecialchars($room['room_size']); ?></span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <a href="<?php echo base_url('room/' . $room['slug']); ?>" class="text-dark fw-bold small text-uppercase">
                                    View Details <i class="fa-solid fa-arrow-right ms-1 text-primary"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-luxury" onclick="openBookingForRoom(<?php echo $room['id']; ?>, '<?php echo addslashes($room['title']); ?>', <?php echo $room['category_id']; ?>)">
                                    Book Room
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?php echo base_url('rooms'); ?>" class="btn btn-luxury-dark">
                Explore All Suites & Categories <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- 5. Hotel Facilities & Amenities Grid -->
<section class="py-5">
    <div class="container py-lg-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge">AMENITIES & WELLNESS</span>
            <h2 class="section-title">World-Class Facilities For Your Comfort</h2>
            <p class="section-subtitle">Indulge in tailored leisure activities, rejuvenating holistic therapies, and personalized 24/7 concierge services.</p>
        </div>

        <div class="row g-4">
            <?php if(!empty($facilities)): foreach($facilities as $idx => $fac): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx + 1) * 100; ?>">
                    <div class="facility-box">
                        <div class="facility-icon-wrap">
                            <i class="<?php echo htmlspecialchars($fac['icon'] ?: 'fa-solid fa-hotel'); ?>"></i>
                        </div>
                        <h4 class="font-serif fs-5 mb-2"><?php echo htmlspecialchars($fac['title']); ?></h4>
                        <p class="text-muted small mb-0"><?php echo htmlspecialchars($fac['short_description']); ?></p>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<!-- 6. Restaurant & Dining Showcase Section -->
<section class="py-5 text-white position-relative" style="background: linear-gradient(rgba(15, 23, 42, 0.92), rgba(15, 23, 42, 0.92)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1920&q=85') center/cover;">
    <div class="container py-lg-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <span class="section-badge" style="background: rgba(197, 168, 128, 0.2); color: var(--primary);">THE SAPPHIRE RESTAURANT</span>
                <h2 class="text-white section-title">Artisanal Coastal Gastronomy & Fine Wines</h2>
                <p class="text-white-50 mb-4" style="line-height: 1.8;">
                    Helmed by award-winning Executive Chefs, The Sapphire presents a culinary spectacle blending indigenous fresh coastal seafood with contemporary Michelin-standard techniques.
                </p>
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-clock text-primary fs-4"></i>
                        <div>
                            <h6 class="mb-0 text-white font-serif">Operating Hours</h6>
                            <span class="small text-white-50">Breakfast: 7:00 AM - 11:00 AM | Dinner: 7:00 PM - 11:30 PM</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-wine-glass text-primary fs-4"></i>
                        <div>
                            <h6 class="mb-0 text-white font-serif">Curated Cellar</h6>
                            <span class="small text-white-50">Over 150+ international vintage wines and signature mixologist cocktails.</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <a href="<?php echo base_url('restaurant'); ?>" class="btn btn-luxury">
                        View Full Menu <i class="fa-solid fa-book-open ms-1"></i>
                    </a>
                    <a href="<?php echo base_url('restaurant#reserve'); ?>" class="btn btn-luxury-outline">
                        Reserve A Table
                    </a>
                </div>
            </div>

            <!-- Dishes Showcase Grid -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="row g-3">
                    <?php if(!empty($special_dishes)): foreach(array_slice($special_dishes, 0, 4) as $dish): ?>
                        <div class="col-sm-6">
                            <div class="menu-dish-card" style="background: rgba(30, 41, 59, 0.7); border-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(8px);">
                                <img src="<?php echo htmlspecialchars($dish['image'] ?: 'https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?auto=format&fit=crop&w=600&q=80'); ?>" alt="<?php echo htmlspecialchars($dish['name']); ?>" class="menu-dish-img">
                                <div class="overflow-hidden">
                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <h6 class="text-white mb-0 font-serif text-truncate" style="font-size: 0.95rem;"><?php echo htmlspecialchars($dish['name']); ?></h6>
                                    </div>
                                    <span class="text-primary fw-bold small">₹<?php echo number_format($dish['price']); ?></span>
                                    <p class="text-white-50 small mb-0 text-truncate" style="font-size: 0.78rem;"><?php echo htmlspecialchars($dish['description']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. Special Offers & Promotions Banner -->
<?php if(!empty($promotions)): ?>
<section class="py-5" style="background-color: var(--bg-cream);">
    <div class="container py-lg-3">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge">LIMITED PACKAGES</span>
            <h2 class="section-title">Exclusive Seasonal Retreats & Deals</h2>
        </div>

        <div class="row g-4">
            <?php foreach($promotions as $promo): ?>
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="card border-0 rounded-4 overflow-hidden shadow-sm" style="background: #ffffff;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5">
                                <img src="<?php echo htmlspecialchars($promo['banner_image']); ?>" alt="<?php echo htmlspecialchars($promo['title']); ?>" class="img-fluid h-100 w-100" style="min-height: 220px; object-fit: cover;">
                            </div>
                            <div class="col-md-7 p-4">
                                <span class="badge bg-warning text-dark mb-2"><?php echo htmlspecialchars($promo['badge'] ?? 'Special Offer'); ?></span>
                                <h4 class="font-serif fs-5 mb-2"><?php echo htmlspecialchars($promo['title']); ?></h4>
                                <p class="text-muted small mb-3"><?php echo htmlspecialchars($promo['description']); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-dark px-3 py-2" style="letter-spacing: 0.08em;">CODE: <?php echo htmlspecialchars($promo['promo_code']); ?></span>
                                    <button class="btn btn-sm btn-luxury" onclick="openBookingForRoom()">Claim Offer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 8. Tourist Blogs & Travel Guides Section (FULL DYNAMIC SEO) -->
<section class="py-5">
    <div class="container py-lg-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5" data-aos="fade-up">
            <div>
                <span class="section-badge">TOURIST GUIDE & ARTICLES</span>
                <h2 class="section-title mb-0">Discover Local Wonders & Coastal Culture</h2>
            </div>
            <a href="<?php echo base_url('blogs'); ?>" class="btn btn-luxury-outline-dark mt-3 mt-md-0">
                View All Travel Guides <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            <?php if(!empty($blogs)): foreach($blogs as $idx => $blog): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx + 1) * 100; ?>">
                    <div class="luxury-card">
                        <div class="luxury-card-img-wrap">
                            <img src="<?php echo htmlspecialchars($blog['featured_image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>">
                            <span class="card-category-badge"><?php echo htmlspecialchars($blog['category']); ?></span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                                    <span><i class="fa-regular fa-clock text-primary"></i> <?php echo htmlspecialchars($blog['read_time']); ?></span>
                                    <span>•</span>
                                    <span><i class="fa-regular fa-calendar text-primary"></i> <?php echo date('M d, Y', strtotime($blog['created_at'])); ?></span>
                                </div>
                                <h4 class="font-serif fs-5 mb-2">
                                    <a href="<?php echo base_url('blog/' . $blog['slug']); ?>" class="text-dark hover-primary"><?php echo htmlspecialchars($blog['title']); ?></a>
                                </h4>
                                <p class="text-muted small mb-3"><?php echo htmlspecialchars(substr($blog['summary'], 0, 110)); ?>...</p>
                            </div>
                            <div>
                                <a href="<?php echo base_url('blog/' . $blog['slug']); ?>" class="text-primary fw-bold small text-uppercase">
                                    Read Complete Guide <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<!-- 9. Testimonials & Guest Reviews -->
<section class="py-5" style="background-color: var(--bg-cream);">
    <div class="container py-lg-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge">GUEST EXPERIENCES</span>
            <h2 class="section-title">Loved By Discerning Travelers Worldwide</h2>
            <p class="section-subtitle">Read verified testimonials from guests who experienced the authentic luxury of Grand Cannann.</p>
        </div>

        <div class="swiper testimonials-swiper pb-5" data-aos="fade-up">
            <div class="swiper-wrapper">
                <?php if(!empty($testimonials)): foreach($testimonials as $test): ?>
                    <div class="swiper-slide">
                        <div class="testimonial-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="text-warning mb-3">
                                    <?php for($i=0; $i<$test['rating']; $i++): ?>
                                        <i class="fa-solid fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-muted" style="font-style: italic; line-height: 1.8;">
                                    "<?php echo htmlspecialchars($test['review']); ?>"
                                </p>
                            </div>
                            <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top">
                                <img src="<?php echo htmlspecialchars($test['avatar'] ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80'); ?>" alt="<?php echo htmlspecialchars($test['guest_name']); ?>" class="testimonial-avatar">
                                <div>
                                    <h6 class="mb-0 font-serif fw-bold text-dark"><?php echo htmlspecialchars($test['guest_name']); ?></h6>
                                    <span class="small text-muted"><?php echo htmlspecialchars($test['designation']); ?> (<?php echo htmlspecialchars($test['location']); ?>)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
            </div>
            <div class="test-pagination text-center mt-4"></div>
        </div>
    </div>
</section>

<!-- 10. Resort Photo Gallery Strip with Lightbox -->
<section class="py-5">
    <div class="container py-lg-3">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge">MOMENTS AT CANNANN</span>
            <h2 class="section-title">Visual Glimpses of Pure Elegance</h2>
        </div>

        <div class="row g-3" data-aos="fade-up">
            <?php if(!empty($gallery)): foreach(array_slice($gallery, 0, 6) as $item): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                        <a href="<?php echo htmlspecialchars($item['image']); ?>" class="gallery-overlay glightbox" data-gallery="home-gallery" data-title="<?php echo htmlspecialchars($item['title']); ?>" data-description="<?php echo htmlspecialchars($item['caption']); ?>">
                            <i class="fa-solid fa-magnifying-glass-plus fs-2 mb-2 text-warning"></i>
                            <h5 class="text-white mb-1 font-serif"><?php echo htmlspecialchars($item['title']); ?></h5>
                            <span class="small text-white-50"><?php echo htmlspecialchars($item['caption']); ?></span>
                        </a>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?php echo base_url('gallery'); ?>" class="btn btn-luxury-dark">
                View Complete Photo Gallery <i class="fa-solid fa-images ms-1"></i>
            </a>
        </div>
    </div>
</section>
