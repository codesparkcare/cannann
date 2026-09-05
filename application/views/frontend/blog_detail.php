<!-- Inner Page Banner -->
<section class="inner-page-banner" style="background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.9)), url('<?php echo htmlspecialchars($blog['featured_image']); ?>');">
    <div class="container">
        <span class="badge bg-primary text-white mb-2 px-3 py-2 text-uppercase"><?php echo htmlspecialchars($blog['category']); ?></span>
        <h1 class="font-serif"><?php echo htmlspecialchars($blog['title']); ?></h1>
        <div class="breadcrumb-luxury">
            <a href="<?php echo base_url(); ?>">Home</a>
            <span>/</span>
            <a href="<?php echo base_url('blogs'); ?>">Tourist Guides</a>
            <span>/</span>
            <span>Article</span>
        </div>
    </div>
</section>

<!-- Single Blog Post View -->
<section class="py-5">
    <div class="container py-lg-4">
        <div class="row g-5">
            <!-- Left Main Content -->
            <div class="col-lg-8" data-aos="fade-right">
                <!-- Meta Info Bar -->
                <div class="d-flex flex-wrap align-items-center gap-4 py-3 mb-4 border-bottom border-top text-muted small">
                    <span><i class="fa-solid fa-user text-primary me-2"></i> By <strong><?php echo htmlspecialchars($blog['author_name']); ?></strong></span>
                    <span><i class="fa-regular fa-calendar text-primary me-2"></i> Published: <?php echo date('F d, Y', strtotime($blog['created_at'])); ?></span>
                    <span><i class="fa-regular fa-clock text-primary me-2"></i> <?php echo htmlspecialchars($blog['read_time']); ?></span>
                    <span><i class="fa-regular fa-eye text-primary me-2"></i> <?php echo $blog['views_count']; ?> Views</span>
                </div>

                <!-- Featured Image -->
                <div class="rounded-4 overflow-hidden mb-4 shadow-sm">
                    <img src="<?php echo htmlspecialchars($blog['featured_image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="w-100" style="max-height: 480px; object-fit: cover;">
                </div>

                <!-- Article Content -->
                <div class="blog-article-body mb-5" style="line-height: 2; font-size: 1.05rem; color: #334155;">
                    <?php if(!empty($blog['summary'])): ?>
                        <div class="p-4 rounded-3 mb-4" style="background-color: var(--bg-cream); border-left: 4px solid var(--primary); font-style: italic;">
                            <?php echo htmlspecialchars($blog['summary']); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo $blog['content']; ?>
                </div>

                <!-- Keywords / SEO Tag Pills -->
                <?php if(!empty($blog['meta_keywords'])): 
                    $tags = explode(',', $blog['meta_keywords']);
                ?>
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-4 pb-3 border-bottom">
                        <span class="fw-bold small text-muted text-uppercase me-2"><i class="fa-solid fa-tags text-primary"></i> Tags:</span>
                        <?php foreach($tags as $tag): if(trim($tag)): ?>
                            <span class="badge bg-light text-dark border px-3 py-2 fw-normal small"><?php echo htmlspecialchars(trim($tag)); ?></span>
                        <?php endif; endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Share Bar -->
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-light mb-5">
                    <span class="fw-bold small text-dark"><i class="fa-solid fa-share-nodes text-primary me-2"></i> Share This Guide:</span>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(current_url()); ?>" target="_blank" class="btn btn-sm btn-outline-dark rounded-circle" style="width: 34px; height: 34px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(current_url()); ?>&text=<?php echo urlencode($blog['title']); ?>" target="_blank" class="btn btn-sm btn-outline-dark rounded-circle" style="width: 34px; height: 34px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($blog['title'] . ' ' . current_url()); ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-circle" style="width: 34px; height: 34px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar: Recent Posts & Room Booking Callout -->
            <div class="col-lg-4" data-aos="fade-left">
                <!-- Stay Reservation Callout -->
                <div class="p-4 rounded-4 text-white mb-4 shadow-sm" style="background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.95)), url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=600&q=80') center/cover;">
                    <span class="badge bg-primary text-white mb-2">STAY WITH US</span>
                    <h4 class="font-serif text-white mb-2">Book Your Luxury Ocean Retreat</h4>
                    <p class="small text-white-50 mb-3">Immerse yourself in authentic luxury and explore the wonders of the coast with Grand Cannann.</p>
                    <button class="btn btn-luxury w-100" onclick="openBookingForRoom()">Book A Suite Now</button>
                </div>

                <!-- Recent Stories -->
                <div class="p-4 rounded-4 bg-white shadow-sm border border-light">
                    <h5 class="font-serif mb-3 pb-2 border-bottom">Related Travel Guides</h5>
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
