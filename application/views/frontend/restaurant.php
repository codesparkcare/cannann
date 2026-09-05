<!-- Inner Page Banner -->
<section class="inner-page-banner" style="background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1920&q=85');">
    <div class="container">
        <span class="badge bg-primary text-white mb-2 px-3 py-2 text-uppercase">MICHELIN-INSPIRED GASTRONOMY</span>
        <h1 class="font-serif">The Sapphire Restaurant & Bar</h1>
        <div class="breadcrumb-luxury">
            <a href="<?php echo base_url(); ?>">Home</a>
            <span>/</span>
            <span>Restaurant & Menu</span>
        </div>
    </div>
</section>

<!-- Restaurant Experience Intro -->
<section class="py-5">
    <div class="container py-lg-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="section-badge">CULINARY EXCELLENCE</span>
                <h2 class="section-title">Fresh Wild Coastal Seafood & World Flavors</h2>
                <p class="text-muted" style="line-height: 1.9;">
                    Overlooking the ocean horizon, <strong>The Sapphire</strong> brings together time-honored coastal grilling methods with contemporary French and Asian culinary techniques. Each morning, our chefs hand-select fresh catches from generational fishermen to craft daily degustation menus.
                </p>
                <div class="row g-3 my-3">
                    <div class="col-6">
                        <div class="p-3 rounded-3 bg-light border-start border-3 border-warning">
                            <h6 class="font-serif mb-1 text-dark">Breakfast Buffet</h6>
                            <span class="small text-muted">7:00 AM - 11:00 AM Daily</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3 bg-light border-start border-3 border-warning">
                            <h6 class="font-serif mb-1 text-dark">Dinner & Starlight Bar</h6>
                            <span class="small text-muted">7:00 PM - 11:30 PM Daily</span>
                        </div>
                    </div>
                </div>
                <a href="#reserve" class="btn btn-luxury mt-2">Reserve Your Table Below</a>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="row g-2">
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?auto=format&fit=crop&w=600&q=80" alt="Grilled Lobster" class="img-fluid rounded-4 shadow-sm w-100" style="height: 220px; object-fit: cover;">
                    </div>
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1467003909585-2f8a72700288?auto=format&fit=crop&w=600&q=80" alt="Salmon" class="img-fluid rounded-4 shadow-sm w-100" style="height: 220px; object-fit: cover;">
                    </div>
                    <div class="col-12">
                        <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=800&q=80" alt="Cocktail Bar" class="img-fluid rounded-4 shadow-sm w-100" style="height: 180px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categorized Menu Tabs Section -->
<section class="py-5" style="background-color: var(--bg-cream);">
    <div class="container py-lg-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge">ARTISAN DINING MENU</span>
            <h2 class="section-title">Explore Our Chef's Signature Creations</h2>
            <p class="section-subtitle">Categorized a la carte selections crafted with the finest organic and artisanal ingredients.</p>
        </div>

        <!-- Category Tabs -->
        <ul class="nav nav-pills justify-content-center mb-5 gap-2" id="menuTabs" role="tablist" data-aos="fade-up">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 py-2 fw-semibold" id="all-tab" data-bs-toggle="pill" data-bs-target="#tab-all" type="button" role="tab">All Selections</button>
            </li>
            <?php if(!empty($categories)): foreach($categories as $idx => $cat): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 py-2 fw-semibold" id="tab-btn-<?php echo $cat['id']; ?>" data-bs-toggle="pill" data-bs-target="#tab-<?php echo $cat['id']; ?>" type="button" role="tab">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </button>
                </li>
            <?php endforeach; endif; ?>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content" id="menuTabContent">
            <!-- All Items Tab -->
            <div class="tab-pane fade show active" id="tab-all" role="tabpanel">
                <div class="row g-4">
                    <?php if(!empty($all_items)): foreach($all_items as $item): ?>
                        <div class="col-lg-6" data-aos="fade-up">
                            <div class="card border-0 rounded-3 p-3 shadow-sm h-100" style="background: #ffffff;">
                                <div class="d-flex gap-3 align-items-center">
                                    <img src="<?php echo htmlspecialchars($item['image'] ?: 'https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?auto=format&fit=crop&w=600&q=80'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h5 class="font-serif fs-6 mb-0 text-dark"><?php echo htmlspecialchars($item['name']); ?></h5>
                                            <span class="text-primary fw-bold fs-6">₹<?php echo number_format($item['price']); ?></span>
                                        </div>
                                        <div class="mb-2">
                                            <?php if($item['dietary_type'] == 'veg'): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle py-1 px-2 small"><i class="fa-solid fa-leaf me-1"></i> Vegetarian</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle py-1 px-2 small"><i class="fa-solid fa-drumstick-bite me-1"></i> Non-Veg</span>
                                            <?php endif; ?>
                                            <?php if(!empty($item['badge'])): ?>
                                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle py-1 px-2 small"><?php echo htmlspecialchars($item['badge']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="text-muted small mb-0"><?php echo htmlspecialchars($item['description']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>

            <!-- Per Category Tabs -->
            <?php if(!empty($categories)): foreach($categories as $cat): ?>
                <div class="tab-pane fade" id="tab-<?php echo $cat['id']; ?>" role="tabpanel">
                    <div class="row g-4">
                        <?php 
                        $has_items = false;
                        if(!empty($all_items)): foreach($all_items as $item): 
                            if($item['category_id'] == $cat['id']):
                                $has_items = true;
                        ?>
                            <div class="col-lg-6">
                                <div class="card border-0 rounded-3 p-3 shadow-sm h-100" style="background: #ffffff;">
                                    <div class="d-flex gap-3 align-items-center">
                                        <img src="<?php echo htmlspecialchars($item['image'] ?: 'https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?auto=format&fit=crop&w=600&q=80'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h5 class="font-serif fs-6 mb-0 text-dark"><?php echo htmlspecialchars($item['name']); ?></h5>
                                                <span class="text-primary fw-bold fs-6">₹<?php echo number_format($item['price']); ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <?php if($item['dietary_type'] == 'veg'): ?>
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle py-1 px-2 small"><i class="fa-solid fa-leaf me-1"></i> Vegetarian</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle py-1 px-2 small"><i class="fa-solid fa-drumstick-bite me-1"></i> Non-Veg</span>
                                                <?php endif; ?>
                                                <?php if(!empty($item['badge'])): ?>
                                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle py-1 px-2 small"><?php echo htmlspecialchars($item['badge']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <p class="text-muted small mb-0"><?php echo htmlspecialchars($item['description']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; endforeach; endif; ?>
                        <?php if(!$has_items): ?>
                            <div class="col-12 text-center py-4 text-muted">No items currently listed in this category.</div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<!-- Table Reservation Section -->
<section class="py-5" id="reserve">
    <div class="container py-lg-4">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5" style="background: #ffffff; border: 1px solid rgba(197, 168, 128, 0.3);">
                    <div class="text-center mb-4">
                        <span class="section-badge">TABLE RESERVATIONS</span>
                        <h2 class="font-serif">Reserve A Table at The Sapphire</h2>
                        <p class="text-muted small">Special anniversary dinners, private seaside cabanas, and wine pairing tastings.</p>
                    </div>

                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('reserve-table'); ?>" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-user text-primary"></i> Guest Name *</label>
                                <input type="text" name="guest_name" class="search-field-input" placeholder="Your Full Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-envelope text-primary"></i> Email Address *</label>
                                <input type="email" name="email" class="search-field-input" placeholder="Your Email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-phone text-primary"></i> Phone Number *</label>
                                <input type="tel" name="phone" class="search-field-input" placeholder="+91 98765 43210" required>
                            </div>
                            <div class="col-md-3">
                                <label class="search-field-label"><i class="fa-solid fa-calendar text-primary"></i> Date *</label>
                                <input type="date" name="reservation_date" class="search-field-input" required min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="search-field-label"><i class="fa-solid fa-clock text-primary"></i> Time *</label>
                                <input type="time" name="reservation_time" class="search-field-input" required value="19:30">
                            </div>
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-user-group text-primary"></i> Number of Guests</label>
                                <select name="guest_count" class="search-field-input">
                                    <option value="1">1 Person</option>
                                    <option value="2" selected>2 Persons (Romantic Table)</option>
                                    <option value="4">4 Persons</option>
                                    <option value="6">6 Persons (Family Group)</option>
                                    <option value="8">8+ Persons (Private Dining)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-chair text-primary"></i> Seating Preference</label>
                                <select name="table_preference" class="search-field-input">
                                    <option value="Ocean View Terrace">Ocean View Terrace</option>
                                    <option value="Indoor Romantic Dining">Indoor Romantic Dining</option>
                                    <option value="Starlight Beach Cabana">Starlight Beach Cabana</option>
                                    <option value="Chef Table">Chef Table Experience</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="search-field-label"><i class="fa-solid fa-champagne-glasses text-primary"></i> Special Requests & Dietary Notes</label>
                                <textarea name="special_notes" class="search-field-input" rows="3" placeholder="Anniversary flower setup, vegan requirement, cake cutting, etc."></textarea>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-luxury py-3 fs-6">
                                <i class="fa-solid fa-utensils me-2"></i> Confirm Table Reservation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
