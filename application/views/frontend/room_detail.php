<!-- Inner Page Banner -->
<?php 
$banner_bg = $room['featured_image'];
if (!empty($banner_bg) && strpos($banner_bg, 'http') !== 0) {
    $banner_bg = base_url(ltrim($banner_bg, '/'));
}
?>
<section class="inner-page-banner" style="background-image: linear-gradient(rgba(7, 25, 17, 0.70), rgba(7, 25, 17, 0.88)), url('<?php echo htmlspecialchars($banner_bg); ?>');">
    <div class="container">
        <span class="badge bg-primary text-white mb-2 px-3 py-2 text-uppercase"><?php echo htmlspecialchars($room['category_name'] ?? 'Deluxe Room'); ?></span>
        <h1 class="font-serif"><?php echo htmlspecialchars($room['title']); ?></h1>
        <div class="breadcrumb-luxury">
            <a href="<?php echo base_url(); ?>">Home</a>
            <span>/</span>
            <a href="<?php echo base_url('rooms'); ?>">Rooms</a>
            <span>/</span>
            <span><?php echo htmlspecialchars($room['title']); ?></span>
        </div>
    </div>
</section>

<!-- Room Details Content -->
<section class="py-5">
    <div class="container py-lg-4">
        <div class="row g-5">
            <!-- Left Main Column: Photos, Details, Amenities -->
            <div class="col-lg-8" data-aos="fade-right">
                <!-- Main Featured Photo -->
                <div class="rounded-4 overflow-hidden shadow-sm mb-4 position-relative">
                    <img src="<?php echo htmlspecialchars($banner_bg); ?>" alt="<?php echo htmlspecialchars($room['title']); ?>" class="w-100" style="height: 480px; object-fit: cover;">
                </div>

                <!-- Gallery Thumbnails (if available) -->
                <?php if(!empty($room['gallery_images'])): 
                    $g_imgs = explode(',', $room['gallery_images']);
                ?>
                    <div class="row g-2 mb-4">
                        <?php foreach($g_imgs as $gimg): 
                            $thumb_src = trim($gimg);
                            if (!empty($thumb_src) && strpos($thumb_src, 'http') !== 0) {
                                $thumb_src = base_url(ltrim($thumb_src, '/'));
                            }
                            if($thumb_src): 
                        ?>
                            <div class="col-4">
                                <a href="<?php echo htmlspecialchars($thumb_src); ?>" class="glightbox" data-gallery="room-gallery">
                                    <img src="<?php echo htmlspecialchars($thumb_src); ?>" alt="Room photo" class="img-fluid rounded-3 w-100" style="height: 120px; object-fit: cover;">
                                </a>
                            </div>
                        <?php endif; endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Key Attributes Bar -->
                <div class="d-flex flex-wrap justify-content-between p-3 p-md-4 rounded-3 mb-4" style="background-color: var(--bg-cream); border: 1px solid rgba(197, 168, 128, 0.3);">
                    <div class="text-center p-2">
                        <i class="fa-solid fa-user-group text-primary fs-4 mb-1"></i>
                        <div class="small text-muted">Occupancy</div>
                        <div class="fw-bold text-dark"><?php echo $room['max_adults']; ?> Adults, <?php echo $room['max_children']; ?> Kids</div>
                    </div>
                    <div class="text-center p-2">
                        <i class="fa-solid fa-bed text-primary fs-4 mb-1"></i>
                        <div class="small text-muted">Bedding</div>
                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($room['bed_type']); ?></div>
                    </div>
                    <div class="text-center p-2">
                        <i class="fa-solid fa-maximize text-primary fs-4 mb-1"></i>
                        <div class="small text-muted">Room Size</div>
                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($room['room_size']); ?></div>
                    </div>
                    <div class="text-center p-2">
                        <i class="fa-solid fa-mountain-sun text-primary fs-4 mb-1"></i>
                        <div class="small text-muted">View</div>
                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($room['view_type']); ?></div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <h3 class="font-serif mb-3">Suite Overview & Experience</h3>
                    <div class="text-muted" style="line-height: 1.9;">
                        <?php echo nl2br($room['long_description'] ?: $room['short_description']); ?>
                    </div>
                </div>

                <!-- Luxury Amenities Checklist -->
                <?php if(!empty($room['amenities'])): 
                    $amenities = explode(',', $room['amenities']);
                ?>
                    <div class="mb-5">
                        <h3 class="font-serif mb-4">Suite Amenities & Services</h3>
                        <div class="row g-3">
                            <?php foreach($amenities as $amenity): if(trim($amenity)): ?>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center gap-2 p-2 rounded-2" style="background-color: var(--gray-100);">
                                        <i class="fa-solid fa-circle-check text-primary"></i>
                                        <span class="fw-medium text-dark small"><?php echo htmlspecialchars(trim($amenity)); ?></span>
                                    </div>
                                </div>
                            <?php endif; endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Hotel Policies -->
                <div class="p-4 rounded-4" style="background-color: #ffffff; border: 1px solid var(--gray-200);">
                    <h4 class="font-serif fs-5 mb-3">Stay Guidelines & Tariff Policies</h4>
                    <ul class="text-muted small mb-0 ps-3" style="line-height: 1.8;">
                        <li>Check-in time: <strong>12:00 PM</strong> | Check-out time: <strong>11:00 AM</strong></li>
                        <li><strong class="text-success">Complimentary Breakfast:</strong> Included with all online room tariff bookings.</li>
                        <li><strong>Tax:</strong> 5% GST is included in the online grand tariff.</li>
                        <li><strong>Extra Bed:</strong> Available at <strong>₹500 / night</strong> per person upon request.</li>
                        <li>Complimentary high-speed optical fiber Wi-Fi throughout the hotel.</li>
                        <li>24/7 Front Desk, room service, and travel desk assistance in Nagercoil.</li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Instant Booking Card -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-lg p-4 p-md-4 rounded-4 position-sticky" style="top: 110px; background: #ffffff; border: 1px solid rgba(197, 168, 128, 0.3);">
                    <div class="d-flex justify-content-between align-items-start mb-3 pb-3 border-bottom">
                        <div>
                            <span class="small text-muted text-uppercase fw-bold">Online Tariff (Sep 2026)</span>
                            <div class="d-flex align-items-baseline gap-2 mt-1">
                                <h2 class="font-serif text-dark mb-0">₹<?php echo number_format($room['price'], ($room['price'] == floor($room['price']) ? 0 : 2)); ?></h2>
                                <span class="text-muted small">/ night</span>
                            </div>
                            <div class="small text-muted mt-1">
                                <i class="fa-solid fa-circle-check text-success me-1"></i> Incl. 5% Tax &middot; Extra Bed: ₹500
                            </div>
                        </div>
                        <span class="badge bg-success px-3 py-2">Available</span>
                    </div>

                    <!-- Complimentary Breakfast Callout -->
                    <div class="mb-4 p-2 px-3 rounded-3 d-flex align-items-center gap-2" style="background: rgba(34, 197, 94, 0.08); border: 1px solid rgba(34, 197, 94, 0.25);">
                        <i class="fa-solid fa-mug-hot text-success fs-5"></i>
                        <div class="small fw-semibold text-success" style="line-height: 1.3;">Complimentary Breakfast<br><span class="fw-normal text-muted" style="font-size: 0.75rem;">Only Online Tariff</span></div>
                    </div>

                    <form action="<?php echo base_url('book-room'); ?>" method="POST">
                        <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                        <input type="hidden" name="room_category_id" value="<?php echo $room['category_id']; ?>">

                        <div class="mb-3">
                            <label class="search-field-label"><i class="fa-solid fa-calendar text-primary"></i> Check-In Date *</label>
                            <input type="date" name="check_in" class="search-field-input" required min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="search-field-label"><i class="fa-solid fa-calendar-check text-primary"></i> Check-Out Date *</label>
                            <input type="date" name="check_out" class="search-field-input" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="search-field-label"><i class="fa-solid fa-user-group text-primary"></i> Adults</label>
                                <select name="adults" class="search-field-input">
                                    <?php for($i = 1; $i <= max(4, $room['max_adults']); $i++): ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($i == min(2, $room['max_adults'])) ? 'selected' : ''; ?>><?php echo $i; ?> Adult<?php echo $i > 1 ? 's' : ''; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="search-field-label"><i class="fa-solid fa-child text-primary"></i> Children</label>
                                <select name="children" class="search-field-input">
                                    <option value="0" selected>0 Children</option>
                                    <option value="1">1 Child</option>
                                    <option value="2">2 Children</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="search-field-label"><i class="fa-solid fa-user text-primary"></i> Full Name *</label>
                            <input type="text" name="guest_name" class="search-field-input" placeholder="Your name" required>
                        </div>

                        <div class="mb-3">
                            <label class="search-field-label"><i class="fa-solid fa-envelope text-primary"></i> Email Address *</label>
                            <input type="email" name="email" class="search-field-input" placeholder="Your email" required>
                        </div>

                        <div class="mb-3">
                            <label class="search-field-label"><i class="fa-solid fa-phone text-primary"></i> Phone Number *</label>
                            <input type="tel" name="phone" class="search-field-input" placeholder="+91 98765 43210" required>
                        </div>

                        <div class="mb-4">
                            <label class="search-field-label"><i class="fa-solid fa-comment text-primary"></i> Special Requests</label>
                            <textarea name="special_requests" class="search-field-input" rows="2" placeholder="Late check-in, extra bed (₹500), etc."></textarea>
                        </div>

                        <button type="submit" class="btn btn-luxury w-100 py-3 fs-6">
                            <i class="fa-solid fa-calendar-check me-1"></i> Reserve Room
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Rooms Section -->
<?php if(!empty($related_rooms)): ?>
<section class="py-5" style="background-color: var(--bg-cream);">
    <div class="container py-lg-4">
        <h3 class="font-serif mb-4">Other Rooms You May Like</h3>
        <div class="row g-4">
            <?php foreach($related_rooms as $rroom): 
                $rimg = $rroom['featured_image'];
                if (!empty($rimg) && strpos($rimg, 'http') !== 0) {
                    $rimg = base_url(ltrim($rimg, '/'));
                }
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="luxury-card">
                        <div class="luxury-card-img-wrap">
                            <img src="<?php echo htmlspecialchars($rimg); ?>" alt="<?php echo htmlspecialchars($rroom['title']); ?>">
                            <span class="card-category-badge"><?php echo htmlspecialchars($rroom['category_name'] ?? 'Deluxe'); ?></span>
                            <div class="card-price-badge">
                                ₹<?php echo number_format($rroom['price'], ($rroom['price'] == floor($rroom['price']) ? 0 : 2)); ?> <span class="fw-normal small">/ night</span>
                            </div>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                            <div>
                                <div class="badge bg-success-subtle text-success border border-success-subtle mb-2 px-2 py-1 small">
                                    <i class="fa-solid fa-mug-hot me-1"></i> Breakfast Included
                                </div>
                                <h4 class="font-serif mb-2 fs-5">
                                    <a href="<?php echo base_url('room/' . $rroom['slug']); ?>" class="text-dark hover-primary"><?php echo htmlspecialchars($rroom['title']); ?></a>
                                </h4>
                                <p class="text-muted small mb-3"><?php echo htmlspecialchars(substr($rroom['short_description'], 0, 90)); ?>...</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <a href="<?php echo base_url('room/' . $rroom['slug']); ?>" class="text-dark fw-bold small text-uppercase">
                                    Details <i class="fa-solid fa-arrow-right ms-1 text-primary"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-luxury" onclick="openBookingForRoom(<?php echo $rroom['id']; ?>, '<?php echo addslashes($rroom['title']); ?>', <?php echo $rroom['category_id']; ?>)">
                                    Book
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
