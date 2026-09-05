<!-- Inner Page Banner -->
<section class="inner-page-banner">
    <div class="container">
        <h1 class="font-serif">Hotel Facilities & Wellness</h1>
        <div class="breadcrumb-luxury">
            <a href="<?php echo base_url(); ?>">Home</a>
            <span>/</span>
            <span>Facilities</span>
        </div>
    </div>
</section>

<!-- Facilities Showcase -->
<section class="py-5">
    <div class="container py-lg-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge">INDULGENCE & RECREATION</span>
            <h2 class="section-title">Designed for Complete Leisure & Well-being</h2>
            <p class="section-subtitle">Every luxury facility at Grand Cannann has been crafted to elevate your holiday into a restorative and memorable escape.</p>
        </div>

        <div class="row g-4">
            <?php if(!empty($facilities)): foreach($facilities as $idx => $fac): ?>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?php echo ($idx + 1) * 100; ?>">
                    <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100" style="background: #ffffff; border: 1px solid var(--gray-200);">
                        <div class="row g-0 h-100 align-items-center">
                            <div class="col-md-5">
                                <img src="<?php echo htmlspecialchars($fac['image'] ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80'); ?>" alt="<?php echo htmlspecialchars($fac['title']); ?>" class="img-fluid h-100 w-100" style="min-height: 220px; object-fit: cover;">
                            </div>
                            <div class="col-md-7 p-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="<?php echo htmlspecialchars($fac['icon'] ?: 'fa-solid fa-hotel'); ?> text-primary fs-4"></i>
                                    <h4 class="font-serif fs-5 mb-0 text-dark"><?php echo htmlspecialchars($fac['title']); ?></h4>
                                </div>
                                <p class="text-muted small mb-3" style="line-height: 1.7;"><?php echo htmlspecialchars($fac['short_description']); ?></p>
                                <span class="badge bg-light text-dark border small"><i class="fa-solid fa-clock text-primary me-1"></i> Open Daily</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
