<!-- Inner Page Banner -->
<section class="inner-page-banner">
    <div class="container">
        <h1 class="font-serif">Tourist Guides & Travel Stories</h1>
        <div class="breadcrumb-luxury">
            <a href="<?php echo base_url(); ?>">Home</a>
            <span>/</span>
            <span>Tourist Guides</span>
        </div>
    </div>
</section>

<!-- Blogs Listing Section -->
<section class="py-5">
    <div class="container py-lg-4">
        <div class="row g-4">
            <!-- Left: Articles List -->
            <div class="col-lg-8" data-aos="fade-right">
                <div class="row g-4">
                    <?php if(!empty($blogs)): foreach($blogs as $blog): ?>
                        <div class="col-md-6">
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
                                            Read Article <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; else: ?>
                        <div class="col-12 text-center py-5 text-muted">No travel articles published yet.</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Sidebar with Recent Posts & Concierge Banner -->
            <div class="col-lg-4" data-aos="fade-left">
                <!-- Concierge Desk Widget -->
                <div class="p-4 rounded-4 text-white mb-4 shadow-sm" style="background: linear-gradient(rgba(15, 23, 42, 0.88), rgba(15, 23, 42, 0.95)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=600&q=80') center/cover;">
                    <span class="badge bg-primary text-white mb-2">LOCAL CONCIERGE</span>
                    <h4 class="font-serif text-white mb-2">Need a Customized Sightseeing Itinerary?</h4>
                    <p class="small text-white-50 mb-3">Our concierge desk provides private catamarans, heritage guides, and luxury chauffeur transfers.</p>
                    <a href="<?php echo base_url('contact'); ?>" class="btn btn-sm btn-luxury">Inquire With Concierge</a>
                </div>

                <!-- Recent Posts List -->
                <div class="p-4 rounded-4 bg-white shadow-sm border border-light">
                    <h5 class="font-serif mb-3 pb-2 border-bottom">Popular Stories</h5>
                    <?php if(!empty($recent_blogs)): foreach($recent_blogs as $rblog): ?>
                        <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                            <img src="<?php echo htmlspecialchars($rblog['featured_image']); ?>" alt="<?php echo htmlspecialchars($rblog['title']); ?>" style="width: 70px; height: 70px; border-radius: 8px; object-fit: cover;">
                            <div>
                                <a href="<?php echo base_url('blog/' . $rblog['slug']); ?>" class="text-dark fw-semibold small d-block mb-1 font-serif hover-primary" style="line-height: 1.4;">
                                    <?php echo htmlspecialchars(substr($rblog['title'], 0, 60)); ?>...
                                </a>
                                <span class="small text-muted" style="font-size: 0.76rem;"><i class="fa-regular fa-calendar text-primary me-1"></i> <?php echo date('M d, Y', strtotime($rblog['created_at'])); ?></span>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
