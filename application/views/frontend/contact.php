<!-- Inner Page Banner -->
<section class="inner-page-banner">
    <div class="container">
        <h1 class="font-serif">Contact Concierge & Location</h1>
        <div class="breadcrumb-luxury">
            <a href="<?php echo base_url(); ?>">Home</a>
            <span>/</span>
            <span>Contact Us</span>
        </div>
    </div>
</section>

<!-- Contact Form & Info Section -->
<section class="py-5">
    <div class="container py-lg-4">
        <div class="row g-5 align-items-stretch">
            <!-- Contact Details & Map Column -->
            <div class="col-lg-5" data-aos="fade-right">
                <div class="p-4 p-md-5 rounded-4 text-white h-100 d-flex flex-column justify-content-between" style="background-color: var(--dark); border-top: 4px solid var(--primary);">
                    <div>
                        <span class="section-badge" style="background: rgba(197, 168, 128, 0.2); color: var(--primary);">GET IN TOUCH</span>
                        <h3 class="font-serif text-white mb-4">Concierge & Front Desk</h3>
                        <p class="text-white-50 mb-4" style="line-height: 1.8;">
                            Our 24/7 dedicated hospitality team is always on hand to assist you with suite bookings, private dining reservations, and airport chauffeur transfers.
                        </p>

                        <div class="d-flex flex-column gap-3 mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-location-dot text-primary fs-5 mt-1"></i>
                                <div>
                                    <h6 class="text-white font-serif mb-1">Hotel Location</h6>
                                    <span class="small text-white-50"><?php echo htmlspecialchars($settings['hotel_address'] ?? 'Marina Bay District, Chennai, Tamil Nadu'); ?></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-phone text-primary fs-5 mt-1"></i>
                                <div>
                                    <h6 class="text-white font-serif mb-1">Telephone Lines</h6>
                                    <span class="small text-white-50"><?php echo htmlspecialchars($settings['hotel_phone'] ?? '+91 98765 43210'); ?> / <?php echo htmlspecialchars($settings['hotel_alt_phone'] ?? ''); ?></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-envelope text-primary fs-5 mt-1"></i>
                                <div>
                                    <h6 class="text-white font-serif mb-1">Direct Inquiries</h6>
                                    <span class="small text-white-50"><?php echo htmlspecialchars($settings['hotel_email'] ?? 'contact@grandcannann.com'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Icons -->
                    <div class="pt-3 border-top border-secondary">
                        <span class="small text-white-50 d-block mb-2">Connect With Us:</span>
                        <div class="d-flex gap-2">
                            <?php if(!empty($settings['facebook_url'])): ?><a href="<?php echo $settings['facebook_url']; ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-facebook-f"></i></a><?php endif; ?>
                            <?php if(!empty($settings['instagram_url'])): ?><a href="<?php echo $settings['instagram_url']; ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-instagram"></i></a><?php endif; ?>
                            <?php if(!empty($settings['twitter_url'])): ?><a href="<?php echo $settings['twitter_url']; ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-twitter"></i></a><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form Column -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 h-100" style="background: #ffffff; border: 1px solid var(--gray-200);">
                    <div class="mb-4">
                        <span class="section-badge">SEND AN INQUIRY</span>
                        <h3 class="font-serif text-dark">We Would Love To Hear From You</h3>
                        <p class="text-muted small">Fill in your inquiry below and our concierge team will respond promptly.</p>
                    </div>

                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('submit-contact'); ?>" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-user text-primary"></i> Your Name *</label>
                                <input type="text" name="name" class="search-field-input" placeholder="e.g. John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-envelope text-primary"></i> Email Address *</label>
                                <input type="email" name="email" class="search-field-input" placeholder="e.g. john@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-phone text-primary"></i> Phone Number</label>
                                <input type="tel" name="phone" class="search-field-input" placeholder="+91 98765 43210">
                            </div>
                            <div class="col-md-6">
                                <label class="search-field-label"><i class="fa-solid fa-tag text-primary"></i> Subject *</label>
                                <input type="text" name="subject" class="search-field-input" placeholder="Suite inquiry, banquet, etc." required>
                            </div>
                            <div class="col-12">
                                <label class="search-field-label"><i class="fa-solid fa-comment-dots text-primary"></i> Your Message *</label>
                                <textarea name="message" class="search-field-input" rows="5" placeholder="How can our concierge assist you?" required></textarea>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-luxury py-3 px-5">
                                <i class="fa-solid fa-paper-plane me-2"></i> Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Google Maps Embed Section -->
        <?php if(!empty($settings['map_iframe'])): ?>
            <div class="mt-5 rounded-4 overflow-hidden shadow-sm border border-light" data-aos="fade-up">
                <iframe src="<?php echo htmlspecialchars($settings['map_iframe']); ?>" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        <?php endif; ?>
    </div>
</section>
