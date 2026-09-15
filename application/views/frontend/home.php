<!-- 1. Fullscreen Hero Slider Section with Animated Slides -->
<section class="hero-slider-container">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            <?php if (!empty($sliders)):
                foreach ($sliders as $slide):
                    $slide_img = $slide['image'];
                    if (!empty($slide_img) && strpos($slide_img, 'http') !== 0) {
                        $slide_img = base_url(ltrim($slide_img, '/'));
                    }
                    ?>
                    <div class="swiper-slide hero-slide-item"
                        style="background-image: url('<?php echo htmlspecialchars($slide_img); ?>');">
                        <div class="container">
                            <div class="hero-content">
                                <?php if (!empty($slide['tag'])): ?>
                                    <span class="hero-tag"><i class="fa-solid fa-star me-1 text-warning"></i>
                                        <?php echo htmlspecialchars($slide['tag']); ?></span>
                                <?php endif; ?>
                                <h1 class="hero-title"><?php echo htmlspecialchars($slide['title']); ?></h1>
                                <p class="hero-desc"><?php echo htmlspecialchars($slide['subtitle']); ?></p>
                                <div class="d-flex flex-wrap gap-3">
                                    <?php if (!empty($slide['button_text'])): ?>
                                        <a href="<?php echo base_url($slide['button_link'] ?: 'rooms'); ?>" class="btn btn-luxury">
                                            <?php echo htmlspecialchars($slide['button_text']); ?> <i
                                                class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($slide['secondary_btn_text'])): ?>
                                        <a href="<?php echo base_url($slide['secondary_btn_link'] ?: 'restaurant'); ?>"
                                            class="btn btn-luxury-outline">
                                            <?php echo htmlspecialchars($slide['secondary_btn_text']); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; else: ?>
                <div class="swiper-slide hero-slide-item"
                    style="background-image: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1920&q=85');">
                    <div class="container">
                        <div class="hero-content">
                            <span class="hero-tag">5-STAR BOUTIQUE RESORT</span>
                            <h1 class="hero-title">Experience Coastal Luxury & Sublime Comfort</h1>
                            <p class="hero-desc">Immerse yourself in panoramic seaside vistas, lavish bespoke suites, and
                                tailored five-star hospitality.</p>
                            <a href="<?php echo base_url('rooms'); ?>" class="btn btn-luxury">Explore Luxury Suites <i
                                    class="fa-solid fa-arrow-right ms-1"></i></a>
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
                    <label class="search-field-label"><i class="fa-solid fa-calendar-days text-primary"></i> Check-In
                        Date</label>
                    <input type="date" name="check_in" class="search-field-input" value="<?php echo date('Y-m-d'); ?>"
                        min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="search-field-label"><i class="fa-solid fa-calendar-check text-primary"></i> Check-Out
                        Date</label>
                    <input type="date" name="check_out" class="search-field-input"
                        value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                        min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                </div>
                <div class="col-lg-2 col-md-4">
                    <label class="search-field-label"><i class="fa-solid fa-layer-group text-primary"></i> Room
                        Category</label>
                    <select name="category" class="search-field-input">
                        <option value="">All Categories</option>
                        <?php if (!empty($room_categories)):
                            foreach ($room_categories as $rc): ?>
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
<section class="py-5 my-4 position-relative" style="background: #ffffff; border-top: 1px solid rgba(197, 168, 128, 0.15); border-bottom: 1px solid rgba(197, 168, 128, 0.15);">
    <div class="container py-lg-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <img src="<?php echo base_url('uploads/about_hotel.jpg'); ?>" alt="Canaan Hotel Architecture"
                        class="img-fluid rounded-4 shadow-lg w-100"
                        style="height: 480px; object-fit: cover; object-position: center 30%;">
                    <div class="position-absolute bottom-0 start-0 text-white p-4 rounded-4 m-3 shadow-lg d-none d-sm-block"
                        style="max-width: 270px; border-left: 4px solid var(--primary); background: rgba(15, 23, 42, 0.82); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-top: 1px solid rgba(255, 255, 255, 0.12); border-right: 1px solid rgba(255, 255, 255, 0.12); border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="fa-solid fa-hotel text-warning fs-3"></i>
                            <span class="fs-5 fw-bold font-serif" style="color:white !important">Canaan Hotel</span>
                        </div>
                        <p class="small text-white-50 mb-0">Comfortable Stays & Warm Hospitality in Nagercoil.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="section-badge" style="box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">ABOUT CANAAN
                    HOTEL</span>
                <h2 class="section-title">Comfortable Stays, Warm Hospitality</h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    Located in Nagercoil, Canaan Hotel offers a comfortable and welcoming stay for families, business
                    travellers, and guests exploring the beautiful surroundings of Kanyakumari. With well-maintained
                    rooms, convenient facilities, delicious dining options, and friendly hospitality, we strive to make
                    every stay relaxing and memorable.
                </p>

                <!-- Highlights / Statistics -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 h-100"
                            style="background-color: rgba(253, 251, 247, 0.85); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(197, 168, 128, 0.28); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);">
                            <i class="fa-solid fa-bed text-primary fs-3 mt-1"></i>
                            <div>
                                <h5 class="mb-1 fw-bold font-serif fs-6">Comfortable Rooms</h5>
                                <span class="small text-muted" style="line-height: 1.4; display: block;">Well-maintained
                                    rooms designed for a relaxing stay</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 h-100"
                            style="background-color: rgba(253, 251, 247, 0.85); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(197, 168, 128, 0.28); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);">
                            <i class="fa-solid fa-location-dot text-primary fs-3 mt-1"></i>
                            <div>
                                <h5 class="mb-1 fw-bold font-serif fs-6">Prime Nagercoil Location</h5>
                                <span class="small text-muted" style="line-height: 1.4; display: block;">Conveniently
                                    located for exploring Nagercoil and nearby destinations</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 h-100"
                            style="background-color: rgba(253, 251, 247, 0.85); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(197, 168, 128, 0.28); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);">
                            <i class="fa-solid fa-utensils text-primary fs-3 mt-1"></i>
                            <div>
                                <h5 class="mb-1 fw-bold font-serif fs-6">Delicious Dining</h5>
                                <span class="small text-muted" style="line-height: 1.4; display: block;">Tasty multi-cuisine
                                    food, coffee, juices, and refreshing beverages</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 h-100"
                            style="background-color: rgba(253, 251, 247, 0.85); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(197, 168, 128, 0.28); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);">
                            <i class="fa-solid fa-hand-holding-heart text-primary fs-3 mt-1"></i>
                            <div>
                                <h5 class="mb-1 fw-bold font-serif fs-6">Guest-Focused Hospitality</h5>
                                <span class="small text-muted" style="line-height: 1.4; display: block;">Dedicated to
                                    providing a pleasant and comfortable experience</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo base_url('about'); ?>" class="btn btn-luxury">
                        Discover Our Story <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                    <a href="<?php echo base_url('rooms'); ?>" class="btn btn-outline-dark px-4 py-2"
                        style="border-radius: 50px;">
                        View Our Rooms
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
            <span class="section-badge shadow-sm" style="background: #0f172a; color: #dfc295; border: 1px solid rgba(197, 168, 128, 0.45); font-size: 0.82rem; font-weight: 800; letter-spacing: 0.16em; padding: 7px 18px;">ACCOMMODATION & TARIFFS</span>
            <h2 class="section-title" style="color: #0f172a; font-weight: 700; margin-top: 14px; margin-bottom: 14px;">Rooms & Suites Tariff – Canaan Hotel, Nagercoil</h2>
            <p class="section-subtitle" style="color: #334155; font-size: 1.05rem; line-height: 1.7; max-width: 800px; margin: 0 auto; font-weight: 500;">Clean, well-maintained rooms with modern amenities and complimentary breakfast for online bookings. Extra bed available for ₹500.</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($featured_rooms)):
                foreach ($featured_rooms as $idx => $room): 
                    $room_img = $room['featured_image'];
                    if (!empty($room_img) && strpos($room_img, 'http') !== 0) {
                        $room_img = base_url(ltrim($room_img, '/'));
                    }
                ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx + 1) * 100; ?>">
                        <div class="luxury-card">
                            <div class="luxury-card-img-wrap">
                                <img src="<?php echo htmlspecialchars($room_img); ?>"
                                    alt="<?php echo htmlspecialchars($room['title']); ?>">
                                <span class="card-category-badge"><?php echo htmlspecialchars($room['category_name'] ?? 'Deluxe Room'); ?></span>
                                <div class="card-price-badge">
                                    ₹<?php echo number_format($room['price'], ($room['price'] == floor($room['price']) ? 0 : 2)); ?> <span class="fw-normal small">/ night</span>
                                </div>
                            </div>
                            <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                                <div>
                                    <div class="mb-2">
                                        <span class="badge" style="background: rgba(16, 185, 129, 0.12); color: #047857; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 0.72rem; font-weight: 700; padding: 5px 9px;">
                                            <i class="fa-solid fa-mug-hot me-1"></i> Complimentary Breakfast
                                        </span>
                                    </div>
                                    <h4 class="font-serif mb-2 fs-5">
                                        <a href="<?php echo base_url('room/' . $room['slug']); ?>"
                                            class="text-dark hover-primary"><?php echo htmlspecialchars($room['title']); ?></a>
                                    </h4>
                                    <p class="text-muted small mb-3">
                                        <?php echo htmlspecialchars(substr($room['short_description'], 0, 110)); ?>...
                                    </p>

                                    <div class="d-flex flex-wrap gap-2 mb-3 pb-3 border-bottom small text-muted">
                                        <span><i class="fa-solid fa-user-group text-primary me-1"></i>
                                            <?php echo $room['max_adults']; ?> <?php echo $room['max_adults'] == 1 ? 'Person' : 'Persons'; ?></span>
                                        <span>•</span>
                                        <span><i class="fa-solid fa-bed text-primary me-1"></i>
                                            <?php echo htmlspecialchars($room['bed_type']); ?></span>
                                        <span>•</span>
                                        <span><i class="fa-solid fa-maximize text-primary me-1"></i>
                                            <?php echo htmlspecialchars($room['room_size']); ?></span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <a href="<?php echo base_url('room/' . $room['slug']); ?>"
                                        class="text-dark fw-bold small text-uppercase">
                                        View Details <i class="fa-solid fa-arrow-right ms-1 text-primary"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-luxury"
                                        onclick="openBookingForRoom(<?php echo $room['id']; ?>, '<?php echo addslashes($room['title']); ?>', <?php echo $room['category_id']; ?>)">
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
<section class="py-5" id="facilities"
    style="background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%); border-top: 1px solid rgba(197, 168, 128, 0.15); border-bottom: 1px solid rgba(197, 168, 128, 0.15);">
    <div class="container py-lg-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge shadow-sm"
                style="background: #0f172a; color: #dfc295; border: 1px solid rgba(197, 168, 128, 0.45); font-size: 0.82rem; font-weight: 800; letter-spacing: 0.16em; padding: 7px 18px;">AMENITIES
                & FACILITIES</span>
            <h2 class="section-title" style="color: #0f172a; font-weight: 700; margin-bottom: 16px;">Everything You Need
                for a Comfortable Stay</h2>
            <p class="section-subtitle"
                style="color: #334155; font-size: 1.05rem; line-height: 1.7; max-width: 800px; margin: 0 auto; font-weight: 500;">
                Enjoy a relaxing and convenient experience at Canaan Hotel, Nagercoil, with thoughtfully provided
                facilities, comfortable accommodation, delicious dining, and attentive guest services.</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($facilities)):
                foreach ($facilities as $idx => $fac): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx + 1) * 100; ?>">
                        <div class="facility-box">
                            <div class="facility-icon-wrap">
                                <i class="<?php echo htmlspecialchars($fac['icon'] ?: 'fa-solid fa-hotel'); ?>"></i>
                            </div>
                            <h4 class="facility-card-title"><?php echo htmlspecialchars($fac['title']); ?></h4>
                            <p class="facility-card-desc"><?php echo htmlspecialchars($fac['short_description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<!-- 6. Restaurant & Dining Showcase Section -->
<section class="py-5 position-relative overflow-hidden" id="restaurant"
    style="background: radial-gradient(circle at 85% 15%, rgba(197, 168, 128, 0.14) 0%, transparent 45%), radial-gradient(circle at 10% 85%, rgba(30, 41, 59, 0.6) 0%, transparent 50%), #0b1120;">
    
    <!-- Subtle luxury decorative ambient pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100 pointer-events-none" style="background: radial-gradient(rgba(255,255,255,0.035) 1px, transparent 1px); background-size: 28px 28px; opacity: 0.6;"></div>

    <div class="container py-lg-4 position-relative" style="z-index: 2;">
        <!-- Top Row: Editorial Story & Featured Architectural Image Frame -->
        <div class="row align-items-center g-4 g-lg-5 mb-5">
            <!-- Left: Restaurant Narrative & Details -->
            <div class="col-lg-6" data-aos="fade-right">
                <span class="section-badge shadow-sm"
                    style="background: rgba(197, 168, 128, 0.12); color: #dfc295; border: 1px solid rgba(197, 168, 128, 0.4); font-size: 0.8rem; font-weight: 800; letter-spacing: 0.18em; padding: 7px 18px; border-radius: 50px; display: inline-flex; align-items: center; gap: 7px;">
                    <i class="fa-solid fa-utensils text-primary" style="font-size: 0.75rem;"></i> RESTAURANT & DINING
                </span>
                
                <h2 class="font-serif text-white display-6 fw-bold mt-3 mb-3" style="line-height: 1.25;">
                    A Delicious Taste for <span style="background: linear-gradient(135deg, #dfc295 0%, #c5a880 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Every Occasion</span>
                </h2>
                
                <p class="mb-4" style="color: #cbd5e1; font-size: 1.03rem; line-height: 1.85; font-weight: 400;">
                    Discover a delightful selection of dishes at Canaan Hotel, Nagercoil. From flavorful South Indian favorites and aromatic Chinese specialties to delicious vegetarian and non-vegetarian dishes, our restaurant brings together comforting flavors and satisfying meals for every guest.
                </p>

                <!-- Key Highlights & Hours Pill -->
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3 px-3 py-2 rounded-3"
                        style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(197, 168, 128, 0.25);">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px; background: rgba(197, 168, 128, 0.15); color: #dfc295; font-size: 1rem;">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <span class="d-block text-white-50" style="font-size: 0.72rem; letter-spacing: 0.06em; text-transform: uppercase;">Operating Hours</span>
                            <strong class="text-white small">Open Daily • Breakfast, Lunch & Dinner</strong>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 px-3 py-2 rounded-3"
                        style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(197, 168, 128, 0.25);">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px; background: rgba(197, 168, 128, 0.15); color: #dfc295; font-size: 1rem;">
                            <i class="fa-solid fa-mug-hot"></i>
                        </div>
                        <div>
                            <span class="d-block text-white-50" style="font-size: 0.72rem; letter-spacing: 0.06em; text-transform: uppercase;">Live Counter</span>
                            <strong class="text-white small">Hot Drinks, Juices & Falooda Bar</strong>
                        </div>
                    </div>
                </div>

                <!-- Action CTA Buttons -->
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo base_url('restaurant'); ?>" class="btn btn-luxury px-4 py-3 shadow-lg">
                        <i class="fa-solid fa-book-open me-2"></i> View Full Menu
                    </a>
                    <a href="<?php echo base_url('restaurant#reserve'); ?>" class="btn btn-outline-light px-4 py-3"
                        style="border-radius: 50px; border-color: rgba(197, 168, 128, 0.45); color: #dfc295; font-weight: 600; font-size: 0.88rem; letter-spacing: 0.04em;">
                        <i class="fa-regular fa-calendar-check me-2"></i> Reserve a Table
                    </a>
                </div>
            </div>

            <!-- Right: Architectural Featured Image Frame -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative p-2 rounded-4"
                    style="background: linear-gradient(135deg, rgba(197, 168, 128, 0.45) 0%, rgba(255, 255, 255, 0.05) 50%, rgba(197, 168, 128, 0.2) 100%);">
                    <div class="rounded-4 overflow-hidden position-relative shadow-2xl" style="height: 380px;">
                        <img src="<?php echo base_url('uploads/canaan_restaurant_counter.jpg'); ?>"
                            alt="Canaan Hotel Restaurant & Live Counter"
                            class="w-100 h-100 dining-hero-img"
                            style="object-fit: cover; object-position: center 35%; transition: transform 0.6s ease;">
                        
                        <!-- Gradient Vignette & Live Counter Tag -->
                        <div class="position-absolute bottom-0 start-0 w-100 p-4"
                            style="background: linear-gradient(to top, rgba(11, 17, 32, 0.95) 0%, rgba(11, 17, 32, 0.4) 60%, transparent 100%);">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge" style="background: rgba(197, 168, 128, 0.95); color: #0f172a; font-weight: 800; font-size: 0.72rem; letter-spacing: 0.08em; padding: 6px 12px; border-radius: 6px;">
                                        LIVE COUNTER
                                    </span>
                                    <span class="text-white small fw-semibold">Hot Drinks, Fresh Juices & Ice Creams</span>
                                </div>
                                <span class="badge bg-dark bg-opacity-75 text-white-50 border border-secondary border-opacity-50 small">
                                    <i class="fa-solid fa-location-dot text-primary me-1"></i> Nagercoil
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom: 4 Curated Cuisine Collections Grid -->
        <div class="row g-4 pt-2">
            <!-- 1. South Indian Specialties -->
            <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="dining-cuisine-card h-100 p-4 rounded-4 position-relative"
                    style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(197, 168, 128, 0.2); backdrop-filter: blur(10px); transition: all 0.35s ease;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="cuisine-icon-badge rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(197, 168, 128, 0.25) 0%, rgba(197, 168, 128, 0.08) 100%); border: 1px solid rgba(197, 168, 128, 0.4); color: #dfc295; font-size: 1.25rem;">
                            <i class="fa-solid fa-bowl-rice"></i>
                        </div>
                        <span class="badge" style="background: rgba(197, 168, 128, 0.12); color: #dfc295; border: 1px solid rgba(197, 168, 128, 0.25); font-size: 0.68rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;">
                            TRADITIONAL
                        </span>
                    </div>
                    <h5 class="font-serif text-white mb-2 fs-6 fw-bold">South Indian Specialties</h5>
                    <p class="small text-white-50 mb-3" style="line-height: 1.65; min-height: 54px;">
                        Experience authentic South Indian flavors with crispy dosa, soft idli, flaky parotta, aromatic biryani, curries, and traditional feasts.
                    </p>
                    <a href="<?php echo base_url('restaurant'); ?>" class="small fw-semibold text-primary text-decoration-none d-inline-flex align-items-center gap-1 hover-arrow">
                        Explore Dishes <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem;"></i>
                    </a>
                </div>
            </div>

            <!-- 2. Non-Vegetarian Delights -->
            <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="dining-cuisine-card h-100 p-4 rounded-4 position-relative"
                    style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(197, 168, 128, 0.2); backdrop-filter: blur(10px); transition: all 0.35s ease;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="cuisine-icon-badge rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(197, 168, 128, 0.25) 0%, rgba(197, 168, 128, 0.08) 100%); border: 1px solid rgba(197, 168, 128, 0.4); color: #dfc295; font-size: 1.25rem;">
                            <i class="fa-solid fa-drumstick-bite"></i>
                        </div>
                        <span class="badge" style="background: rgba(239, 68, 68, 0.12); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.25); font-size: 0.68rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;">
                            SIGNATURE
                        </span>
                    </div>
                    <h5 class="font-serif text-white mb-2 fs-6 fw-bold">Non-Vegetarian Delights</h5>
                    <p class="small text-white-50 mb-3" style="line-height: 1.65; min-height: 54px;">
                        Enjoy flavorful chicken, mutton, fresh coastal fish, and delicious non-vegetarian specialties cooked with rich spices and authentic recipes.
                    </p>
                    <a href="<?php echo base_url('restaurant'); ?>" class="small fw-semibold text-primary text-decoration-none d-inline-flex align-items-center gap-1 hover-arrow">
                        Explore Dishes <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem;"></i>
                    </a>
                </div>
            </div>

            <!-- 3. Chinese & Indo-Chinese Cuisine -->
            <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="dining-cuisine-card h-100 p-4 rounded-4 position-relative"
                    style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(197, 168, 128, 0.2); backdrop-filter: blur(10px); transition: all 0.35s ease;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="cuisine-icon-badge rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(197, 168, 128, 0.25) 0%, rgba(197, 168, 128, 0.08) 100%); border: 1px solid rgba(197, 168, 128, 0.4); color: #dfc295; font-size: 1.25rem;">
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <span class="badge" style="background: rgba(245, 158, 11, 0.12); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.25); font-size: 0.68rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;">
                            WOK-TOSSED
                        </span>
                    </div>
                    <h5 class="font-serif text-white mb-2 fs-6 fw-bold">Chinese Cuisine</h5>
                    <p class="small text-white-50 mb-3" style="line-height: 1.65; min-height: 54px;">
                        Savor popular Chinese favorites featuring aromatic noodles, wok-fried rice, crispy Manchurian, chili gravies, and delicious Indo-Chinese fusion.
                    </p>
                    <a href="<?php echo base_url('restaurant'); ?>" class="small fw-semibold text-primary text-decoration-none d-inline-flex align-items-center gap-1 hover-arrow">
                        Explore Dishes <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem;"></i>
                    </a>
                </div>
            </div>

            <!-- 4. Vegetarian Favorites -->
            <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="dining-cuisine-card h-100 p-4 rounded-4 position-relative"
                    style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(197, 168, 128, 0.2); backdrop-filter: blur(10px); transition: all 0.35s ease;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="cuisine-icon-badge rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(16, 185, 129, 0.06) 100%); border: 1px solid rgba(16, 185, 129, 0.35); color: #34d399; font-size: 1.25rem;">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <span class="badge" style="background: rgba(16, 185, 129, 0.12); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.25); font-size: 0.68rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;">
                            PURE VEG
                        </span>
                    </div>
                    <h5 class="font-serif text-white mb-2 fs-6 fw-bold">Vegetarian Favorites</h5>
                    <p class="small text-white-50 mb-3" style="line-height: 1.65; min-height: 54px;">
                        A tempting selection of wholesome, freshly prepared vegetarian curries, paneer specialties, dals, and vegetable dishes for a fulfilling meal.
                    </p>
                    <a href="<?php echo base_url('restaurant'); ?>" class="small fw-semibold text-primary text-decoration-none d-inline-flex align-items-center gap-1 hover-arrow">
                        Explore Dishes <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .dining-cuisine-card:hover {
        transform: translateY(-7px);
        background: rgba(255, 255, 255, 0.07) !important;
        border-color: rgba(197, 168, 128, 0.6) !important;
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.45), 0 0 20px rgba(197, 168, 128, 0.12) !important;
    }
    .dining-cuisine-card:hover .cuisine-icon-badge {
        transform: scale(1.1);
        border-color: #dfc295 !important;
        box-shadow: 0 0 15px rgba(197, 168, 128, 0.3);
    }
    .dining-cuisine-card:hover .hover-arrow i {
        transform: translateX(4px);
    }
    .dining-cuisine-card .hover-arrow i {
        transition: transform 0.25s ease;
    }
    .dining-cuisine-card .cuisine-icon-badge {
        transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .dining-hero-img:hover {
        transform: scale(1.04);
    }
</style>

<!-- 7. Special Offers & Promotions Banner -->
<?php if (!empty($promotions)): ?>
    <section class="py-5" style="background-color: var(--bg-cream);">
        <div class="container py-lg-3">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-badge shadow-sm"
                    style="background: #0f172a; color: #dfc295; border: 1px solid rgba(197, 168, 128, 0.45); font-size: 0.82rem; font-weight: 800; letter-spacing: 0.16em; padding: 7px 18px;">SPECIAL
                    PACKAGES</span>
                <h2 class="section-title" style="color: #0f172a; font-weight: 700; margin-top: 14px; margin-bottom: 14px;">
                    Special Stay Packages & Offers</h2>
                <p class="section-subtitle"
                    style="color: #334155; font-size: 1.05rem; line-height: 1.7; max-width: 800px; margin: 0 auto; font-weight: 500;">
                    Make your stay at Canaan Hotel even more enjoyable with our specially designed packages for families,
                    couples, and guests looking for a memorable getaway in Nagercoil.</p>
            </div>

            <div class="row g-4">
                <?php foreach ($promotions as $promo):
                    $promo_img = $promo['banner_image'];
                    if (!empty($promo_img) && strpos($promo_img, 'http') !== 0) {
                        $promo_img = base_url(ltrim($promo_img, '/'));
                    }
                    $is_family = (stripos($promo['badge'], 'FAMILY') !== false || stripos($promo['title'], 'FAMILY') !== false);
                    $btn_text = $is_family ? 'ENQUIRE NOW' : 'BOOK NOW';
                    $btn_action = $is_family ? "window.location.href='" . base_url('contact') . "'" : "openBookingForRoom()";
                    ?>
                    <div class="col-lg-6" data-aos="fade-up">
                        <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100"
                            style="background: #ffffff; border: 1px solid rgba(197, 168, 128, 0.25); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div class="row g-0 align-items-stretch h-100">
                                <div class="col-md-5">
                                    <img src="<?php echo htmlspecialchars($promo_img); ?>"
                                        alt="<?php echo htmlspecialchars($promo['title']); ?>" class="img-fluid w-100 h-100"
                                        style="min-height: 230px; object-fit: cover;">
                                </div>
                                <div class="col-md-7 p-3 p-sm-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="badge mb-2 px-3 py-2"
                                            style="background: #0f172a; color: #dfc295; border: 1px solid rgba(197, 168, 128, 0.4); font-size: 0.75rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase; border-radius: 6px;">
                                            <?php echo htmlspecialchars($promo['badge'] ?? 'SPECIAL PACKAGE'); ?>
                                        </span>
                                        <h4 class="font-serif fs-5 mb-2 fw-bold" style="color: #0f172a;">
                                            <?php echo htmlspecialchars($promo['title']); ?>
                                        </h4>
                                        <p class="text-muted small mb-3"
                                            style="line-height: 1.65; color: #475569 !important; font-size: 0.9rem;">
                                            <?php echo htmlspecialchars($promo['description']); ?>
                                        </p>
                                    </div>
                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap gap-2 pt-3 border-top mt-auto">
                                        <span class="badge"
                                            style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-weight: 700; letter-spacing: 0.05em; font-size: 0.72rem; padding: 7px 11px; border-radius: 6px; white-space: nowrap;">
                                            CODE: <?php echo htmlspecialchars($promo['promo_code']); ?>
                                        </span>
                                        <button type="button" class="btn btn-luxury" onclick="<?php echo $btn_action; ?>"
                                            style="white-space: nowrap !important; border-radius: 50px; font-weight: 700; font-size: 0.78rem; letter-spacing: 0.06em; padding: 8px 18px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 12px rgba(197, 168, 128, 0.35); flex-shrink: 0;">
                                            <span><?php echo $btn_text; ?></span>
                                            <i class="fa-solid fa-arrow-right fs-6"></i>
                                        </button>
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
            <?php if (!empty($blogs)):
                foreach ($blogs as $idx => $blog): 
                    $blog_img = $blog['featured_image'];
                    if (!empty($blog_img) && strpos($blog_img, 'http') !== 0) {
                        $blog_img = base_url(ltrim($blog_img, '/'));
                    }
            ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx + 1) * 100; ?>">
                        <div class="luxury-card">
                            <div class="luxury-card-img-wrap">
                                <img src="<?php echo htmlspecialchars($blog_img); ?>"
                                    alt="<?php echo htmlspecialchars($blog['title']); ?>">
                                <span class="card-category-badge"><?php echo htmlspecialchars($blog['category']); ?></span>
                            </div>
                            <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                                <div>
                                    <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                                        <span><i class="fa-regular fa-clock text-primary"></i>
                                            <?php echo htmlspecialchars($blog['read_time']); ?></span>
                                        <span>•</span>
                                        <span><i class="fa-regular fa-calendar text-primary"></i>
                                            <?php echo date('M d, Y', strtotime($blog['created_at'])); ?></span>
                                    </div>
                                    <h4 class="font-serif fs-5 mb-2">
                                        <a href="<?php echo base_url('blog/' . $blog['slug']); ?>"
                                            class="text-dark hover-primary"><?php echo htmlspecialchars($blog['title']); ?></a>
                                    </h4>
                                    <p class="text-muted small mb-3">
                                        <?php echo htmlspecialchars(substr($blog['summary'], 0, 110)); ?>...
                                    </p>
                                </div>
                                <div>
                                    <a href="<?php echo base_url('blog/' . $blog['slug']); ?>"
                                        class="text-primary fw-bold small text-uppercase">
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
            <span class="section-badge shadow-sm"
                style="background: #0f172a; color: #dfc295; border: 1px solid rgba(197, 168, 128, 0.45); font-size: 0.82rem; font-weight: 800; letter-spacing: 0.16em; padding: 7px 18px;">GUEST
                EXPERIENCES</span>
            <h2 class="section-title" style="color: #0f172a; font-weight: 700; margin-top: 14px; margin-bottom: 14px;">
                What Our Guests Say About Canaan Hotel</h2>
            <p class="section-subtitle"
                style="color: #475569; font-size: 1.05rem; line-height: 1.7; max-width: 800px; margin: 0 auto; font-weight: 500;">
                Real experiences and feedback from guests who stayed with us in Nagercoil.</p>
        </div>

        <div class="swiper testimonials-swiper pb-5" data-aos="fade-up">
            <div class="swiper-wrapper">
                <?php if (!empty($testimonials)):
                    foreach ($testimonials as $test): ?>
                        <div class="swiper-slide">
                            <div class="testimonial-card h-100 d-flex flex-column justify-content-between p-4 rounded-4 shadow-sm bg-white"
                                style="border: 1px solid rgba(197, 168, 128, 0.25);">
                                <div>
                                    <div class="text-warning mb-3" style="font-size: 0.95rem;">
                                        <?php for ($i = 0; $i < $test['rating']; $i++): ?>
                                            <i class="fa-solid fa-star text-warning"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="mb-0"
                                        style="font-style: italic; line-height: 1.8; font-size: 0.96rem; color: #334155;">
                                        “<?php echo htmlspecialchars($test['review']); ?>”
                                    </p>
                                </div>
                                <div class="mt-4 pt-3 border-top">
                                    <h6 class="mb-0 font-serif fw-bold text-dark fs-6" style="letter-spacing: 0.02em;">
                                        <?php echo htmlspecialchars($test['guest_name']); ?></h6>
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
            <span class="section-badge">MOMENTS AT CANAAN HOTEL</span>
            <h2 class="section-title">Visual Glimpses of Pure Elegance</h2>
        </div>

        <div class="row g-3" data-aos="fade-up">
            <?php if (!empty($gallery)):
                foreach ($gallery as $item):
                    $gallery_img = $item['image'];
                    if (!empty($gallery_img) && strpos($gallery_img, 'http') !== 0) {
                        $gallery_img = base_url(ltrim($gallery_img, '/'));
                    }
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-item shadow-sm">
                            <img src="<?php echo htmlspecialchars($gallery_img); ?>"
                                alt="<?php echo htmlspecialchars($item['title']); ?>">
                            <a href="<?php echo htmlspecialchars($gallery_img); ?>" class="gallery-overlay glightbox"
                                data-gallery="home-gallery" data-title="<?php echo htmlspecialchars($item['title']); ?>"
                                data-description="<?php echo htmlspecialchars($item['caption']); ?>">
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