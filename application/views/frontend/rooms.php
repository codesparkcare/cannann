<!-- Inner Page Banner -->
<section class="inner-page-banner">
    <div class="container">
        <h1 class="font-serif">Rooms & Luxury Suites</h1>
        <div class="breadcrumb-luxury">
            <a href="<?php echo base_url(); ?>">Home</a>
            <span>/</span>
            <span>Rooms & Suites</span>
        </div>
    </div>
</section>

<!-- Rooms Listing Section with Category Filters -->
<section class="py-5">
    <div class="container py-lg-4">
        <!-- Category Filter Tabs -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5" data-aos="fade-up">
            <a href="<?php echo base_url('rooms'); ?>" class="btn <?php echo empty($selected_category) ? 'btn-luxury' : 'btn-outline-dark'; ?> rounded-pill px-4 py-2">
                All Suites
            </a>
            <?php if(!empty($categories)): foreach($categories as $cat): ?>
                <a href="<?php echo base_url('rooms?category=' . $cat['id']); ?>" class="btn <?php echo ($selected_category == $cat['id']) ? 'btn-luxury' : 'btn-outline-dark'; ?> rounded-pill px-4 py-2">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </a>
            <?php endforeach; endif; ?>
        </div>

        <!-- Rooms Grid -->
        <div class="row g-4">
            <?php if(!empty($rooms)): foreach($rooms as $idx => $room): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx % 3 + 1) * 100; ?>">
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
            <?php endforeach; else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-bed fs-1 text-muted mb-3"></i>
                    <h4>No rooms found in this category</h4>
                    <p class="text-muted">Please check back later or view all available luxury suites.</p>
                    <a href="<?php echo base_url('rooms'); ?>" class="btn btn-luxury mt-2">View All Rooms</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
