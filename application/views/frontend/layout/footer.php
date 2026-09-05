<!-- Luxury Hotel Footer -->
<?php
$site_logo = !empty($settings['hotel_logo']) ? (strpos($settings['hotel_logo'], 'http') === 0 ? $settings['hotel_logo'] : base_url(ltrim($settings['hotel_logo'], './'))) : '';
if (empty($site_logo) && file_exists(FCPATH . 'uploads/site_logo.png')) {
    $site_logo = base_url('uploads/site_logo.png');
}
$logo_version = !empty($settings['updated_at']) ? strtotime($settings['updated_at']) : time();
$site_logo_display = !empty($site_logo) ? $site_logo . (strpos($site_logo, '?') !== false ? '&' : '?') . 'v=' . $logo_version : '';
?>
<footer class="luxury-footer">
    <div class="container pb-5">
        <div class="row g-4">
            <!-- Col 1: Hotel Brand Info -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <?php if(!empty($site_logo_display)): ?>
                        <img src="<?php echo htmlspecialchars($site_logo_display); ?>" alt="<?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?>" class="brand-logo-img">
                    <?php else: ?>
                        <div class="logo-icon-wrap" style="width: 36px; height: 36px; font-size: 1rem;"><i class="fa-solid fa-crown text-white"></i></div>
                        <h4 class="text-white mb-0 font-serif"><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?></h4>
                    <?php endif; ?>
                </div>
                <p class="text-white-50 mb-4" style="line-height: 1.8; font-size: 0.92rem;">
                    <?php echo htmlspecialchars($settings['hotel_tagline'] ?? 'Where Timeless Heritage Meets Contemporary Luxury.'); ?> Designed to offer discerning travelers an unforgettable escape of coastal calm, Michelin dining, and regal hospitality.
                </p>
                <div class="d-flex gap-2">
                    <?php if(!empty($settings['facebook_url'])): ?>
                        <a href="<?php echo $settings['facebook_url']; ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($settings['instagram_url'])): ?>
                        <a href="<?php echo $settings['instagram_url']; ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($settings['twitter_url'])): ?>
                        <a href="<?php echo $settings['twitter_url']; ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-brands fa-twitter"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($settings['tripadvisor_url'])): ?>
                        <a href="<?php echo $settings['tripadvisor_url']; ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-solid fa-shield-cat"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url('about'); ?>">About Us</a></li>
                    <li><a href="<?php echo base_url('rooms'); ?>">Luxury Suites</a></li>
                    <li><a href="<?php echo base_url('restaurant'); ?>">The Sapphire Dining</a></li>
                    <li><a href="<?php echo base_url('facilities'); ?>">Resort Facilities</a></li>
                    <li><a href="<?php echo base_url('gallery'); ?>">Photo Gallery</a></li>
                </ul>
            </div>

            <!-- Col 3: Tourist & Guides -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <h5>Experiences & Guides</h5>
                <ul class="footer-links">
                    <li><a href="<?php echo base_url('blogs'); ?>">Tourist Attractions</a></li>
                    <li><a href="<?php echo base_url('blogs'); ?>">Ayurveda & Spa Rituals</a></li>
                    <li><a href="<?php echo base_url('restaurant'); ?>">Coastal Seafood Menu</a></li>
                    <li><a href="<?php echo base_url('contact'); ?>">Concierge & Transfers</a></li>
                    <li><a href="<?php echo base_url('contact'); ?>">Weddings & Banquets</a></li>
                    <li><a href="<?php echo base_url('contact'); ?>">Contact Help Desk</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact & Newsletter -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <h5>Contact Concierge</h5>
                <p class="text-white-50 mb-2 small"><i class="fa-solid fa-location-dot text-primary me-2"></i><?php echo htmlspecialchars($settings['hotel_address'] ?? 'Marina Bay District, Chennai'); ?></p>
                <p class="text-white-50 mb-2 small"><i class="fa-solid fa-phone text-primary me-2"></i><?php echo htmlspecialchars($settings['hotel_phone'] ?? '+91 98765 43210'); ?></p>
                <p class="text-white-50 mb-4 small"><i class="fa-solid fa-envelope text-primary me-2"></i><?php echo htmlspecialchars($settings['hotel_email'] ?? 'contact@grandcannann.com'); ?></p>
                
                <h6 class="text-white small fw-bold text-uppercase mb-2" style="letter-spacing: 0.08em;">VIP Newsletter</h6>
                <div class="input-group">
                    <input type="email" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Your email address...">
                    <button class="btn btn-luxury btn-sm" type="button"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright -->
    <div class="footer-bottom">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div class="text-white-50">
                &copy; <?php echo date('Y'); ?> <strong><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?></strong>. All Rights Reserved. Luxury Hotel Management.
            </div>
            <div class="text-white-50 small">
                <span>Designed for Timeless Hospitality Excellence</span>
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Action -->
<a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $settings['hotel_phone'] ?? '919876543210'); ?>" target="_blank" class="whatsapp-float" title="Chat with Concierge on WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- Universal Room Booking Modal -->
<div class="modal fade" id="quickBookingModal" tabindex="-1" aria-labelledby="quickBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: var(--radius-md); overflow: hidden;">
            <div class="modal-header bg-dark text-white p-4">
                <div>
                    <span class="badge bg-primary text-white mb-1">RESERVATIONS</span>
                    <h4 class="modal-title font-serif mb-0 text-white" id="quickBookingModalLabel">Book Your Luxury Stay</h4>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <form id="bookingForm" action="<?php echo base_url('book-room'); ?>" method="POST">
                    <div id="bookingAlert"></div>
                    <input type="hidden" name="room_id" id="modal_room_id" value="">
                    <input type="hidden" name="room_category_id" id="modal_category_id" value="">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="search-field-label"><i class="fa-solid fa-calendar text-primary"></i> Check-In Date *</label>
                            <input type="date" name="check_in" id="modal_check_in" class="search-field-input" required min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="search-field-label"><i class="fa-solid fa-calendar text-primary"></i> Check-Out Date *</label>
                            <input type="date" name="check_out" id="modal_check_out" class="search-field-input" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="search-field-label"><i class="fa-solid fa-bed text-primary"></i> Preferred Room / Suite</label>
                            <select name="selected_room_title" id="modal_room_select" class="search-field-input">
                                <option value="">Any Available Luxury Suite</option>
                                <?php if(!empty($featured_rooms)): foreach($featured_rooms as $rm): ?>
                                    <option value="<?php echo $rm['id']; ?>"><?php echo htmlspecialchars($rm['title']); ?> (₹<?php echo number_format($rm['price']); ?>/night)</option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="search-field-label"><i class="fa-solid fa-user-group text-primary"></i> Adults</label>
                            <select name="adults" class="search-field-input">
                                <option value="1">1 Adult</option>
                                <option value="2" selected>2 Adults</option>
                                <option value="3">3 Adults</option>
                                <option value="4">4 Adults</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="search-field-label"><i class="fa-solid fa-child text-primary"></i> Children</label>
                            <select name="children" class="search-field-input">
                                <option value="0" selected>0 Children</option>
                                <option value="1">1 Child</option>
                                <option value="2">2 Children</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="search-field-label"><i class="fa-solid fa-user text-primary"></i> Full Name *</label>
                            <input type="text" name="guest_name" class="search-field-input" placeholder="e.g. John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="search-field-label"><i class="fa-solid fa-envelope text-primary"></i> Email Address *</label>
                            <input type="email" name="email" class="search-field-input" placeholder="e.g. john@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="search-field-label"><i class="fa-solid fa-phone text-primary"></i> Phone Number *</label>
                            <input type="tel" name="phone" class="search-field-input" placeholder="e.g. +91 98765 43210" required>
                        </div>
                        <div class="col-md-6">
                            <label class="search-field-label"><i class="fa-solid fa-comment-dots text-primary"></i> Special Requests</label>
                            <input type="text" name="special_requests" class="search-field-input" placeholder="Airport pickup, floral arrangement, etc.">
                        </div>
                    </div>

                    <div class="d-grid mt-4 pt-2">
                        <button type="submit" id="btnSubmitBooking" class="btn btn-luxury py-3 fs-6">
                            <i class="fa-solid fa-check-circle me-2"></i> Confirm & Submit Reservation Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script>
    // Initialize AOS Scroll Animations
    AOS.init({
        duration: 900,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80
    });

    // Initialize Hero Swiper Slider with Smooth Fade
    if (document.querySelector('.hero-swiper')) {
        const heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            effect: 'fade',
            fadeEffect: { crossFade: true },
            speed: 1200,
            autoplay: {
                delay: 5500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    // Initialize Testimonials Swiper
    if (document.querySelector('.testimonials-swiper')) {
        const testSwiper = new Swiper('.testimonials-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: { delay: 4500 },
            pagination: { el: '.test-pagination', clickable: true },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 }
            }
        });
    }

    // Initialize GLightbox for Photo Gallery
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });

    // Quick Book Modal Population Helper
    function openBookingForRoom(roomId, roomTitle, categoryId) {
        document.getElementById('modal_room_id').value = roomId || '';
        document.getElementById('modal_category_id').value = categoryId || '';
        const selectElem = document.getElementById('modal_room_select');
        if (selectElem && roomId) {
            selectElem.value = roomId;
        }
        const modal = new bootstrap.Modal(document.getElementById('quickBookingModal'));
        modal.show();
    }

    // AJAX Booking Submission
    document.getElementById('bookingForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const btn = document.getElementById('btnSubmitBooking');
        const alertBox = document.getElementById('bookingAlert');
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Processing...';

        const formData = new FormData(form);

        fetch('<?php echo base_url("book-room"); ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-check-circle me-2"></i> Confirm & Submit Reservation Request';
            if (data.status === 'success') {
                alertBox.innerHTML = '<div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i>' + data.message + '</div>';
                form.reset();
                setTimeout(() => {
                    const modalEl = document.getElementById('quickBookingModal');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                    alertBox.innerHTML = '';
                }, 4000);
            } else {
                alertBox.innerHTML = '<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>' + data.message + '</div>';
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-check-circle me-2"></i> Confirm & Submit Reservation Request';
            form.submit();
        });
    });
</script>
</body>
</html>
