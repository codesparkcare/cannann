<!-- Inner Page Banner -->
<section class="inner-page-banner">
    <div class="container">
        <h1 class="font-serif">Photo Gallery</h1>
        <div class="breadcrumb-luxury">
            <a href="<?php echo base_url(); ?>">Home</a>
            <span>/</span>
            <span>Gallery</span>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-5">
    <div class="container py-lg-4">
        <!-- Filter Tabs -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5" data-aos="fade-up">
            <a href="<?php echo base_url('gallery'); ?>" class="btn <?php echo ($current_category == 'all') ? 'btn-luxury' : 'btn-outline-dark'; ?> rounded-pill px-4 py-2">
                All Photos
            </a>
            <a href="<?php echo base_url('gallery?category=hotel'); ?>" class="btn <?php echo ($current_category == 'hotel') ? 'btn-luxury' : 'btn-outline-dark'; ?> rounded-pill px-4 py-2">
                Resort & Grounds
            </a>
            <a href="<?php echo base_url('gallery?category=rooms'); ?>" class="btn <?php echo ($current_category == 'rooms') ? 'btn-luxury' : 'btn-outline-dark'; ?> rounded-pill px-4 py-2">
                Suites & Villas
            </a>
            <a href="<?php echo base_url('gallery?category=restaurant'); ?>" class="btn <?php echo ($current_category == 'restaurant') ? 'btn-luxury' : 'btn-outline-dark'; ?> rounded-pill px-4 py-2">
                Dining & Bar
            </a>
            <a href="<?php echo base_url('gallery?category=spa'); ?>" class="btn <?php echo ($current_category == 'spa') ? 'btn-luxury' : 'btn-outline-dark'; ?> rounded-pill px-4 py-2">
                Pool & Spa
            </a>
            <a href="<?php echo base_url('gallery?category=events'); ?>" class="btn <?php echo ($current_category == 'events') ? 'btn-luxury' : 'btn-outline-dark'; ?> rounded-pill px-4 py-2">
                Events & Weddings
            </a>
        </div>

        <!-- Gallery Grid -->
        <div class="row g-4">
            <?php if(!empty($gallery)): foreach($gallery as $idx => $item): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx % 3 + 1) * 100; ?>">
                    <div class="gallery-item shadow-sm rounded-3">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                        <a href="<?php echo htmlspecialchars($item['image']); ?>" class="gallery-overlay glightbox" data-gallery="page-gallery" data-title="<?php echo htmlspecialchars($item['title']); ?>" data-description="<?php echo htmlspecialchars($item['caption']); ?>">
                            <i class="fa-solid fa-magnifying-glass-plus fs-2 mb-2 text-warning"></i>
                            <h5 class="text-white mb-1 font-serif"><?php echo htmlspecialchars($item['title']); ?></h5>
                            <span class="small text-white-50"><?php echo htmlspecialchars($item['caption']); ?></span>
                        </a>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <div class="col-12 text-center py-5 text-muted">
                    No photos found in this category.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
