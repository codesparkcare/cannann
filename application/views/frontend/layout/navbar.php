<?php
$current_segment = $this->uri->segment(1);
?>
<!-- Topbar with Contact Information -->
<div class="topbar d-none d-lg-block">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <span><i class="fa-solid fa-location-dot text-primary me-2"></i><?php echo htmlspecialchars($settings['hotel_address'] ?? 'Marina Bay District, Chennai'); ?></span>
                <span><i class="fa-solid fa-phone text-primary me-2"></i><a href="tel:<?php echo htmlspecialchars($settings['hotel_phone'] ?? '+919876543210'); ?>"><?php echo htmlspecialchars($settings['hotel_phone'] ?? '+91 98765 43210'); ?></a></span>
                <span><i class="fa-solid fa-envelope text-primary me-2"></i><a href="mailto:<?php echo htmlspecialchars($settings['hotel_email'] ?? 'contact@grandcannann.com'); ?>"><?php echo htmlspecialchars($settings['hotel_email'] ?? 'contact@grandcannann.com'); ?></a></span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white-50 me-1">Follow Us:</span>
                <?php if(!empty($settings['facebook_url'])): ?><a href="<?php echo $settings['facebook_url']; ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a><?php endif; ?>
                <?php if(!empty($settings['instagram_url'])): ?><a href="<?php echo $settings['instagram_url']; ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a><?php endif; ?>
                <?php if(!empty($settings['twitter_url'])): ?><a href="<?php echo $settings['twitter_url']; ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a><?php endif; ?>
                <?php if(!empty($settings['tripadvisor_url'])): ?><a href="<?php echo $settings['tripadvisor_url']; ?>" target="_blank"><i class="fa-solid fa-shield-cat"></i></a><?php endif; ?>
                <a href="<?php echo base_url('admin'); ?>" class="btn btn-sm btn-outline-light ms-2 px-2 py-1" style="font-size: 0.72rem; border-radius: 4px;"><i class="fa-solid fa-lock me-1"></i> Admin Panel</a>
            </div>
        </div>
    </div>
</div>

<!-- Main Sticky Luxury Navigation -->
<?php
$site_logo = !empty($settings['hotel_logo']) ? (strpos($settings['hotel_logo'], 'http') === 0 ? $settings['hotel_logo'] : base_url(ltrim($settings['hotel_logo'], './'))) : '';
if (empty($site_logo) && file_exists(FCPATH . 'uploads/site_logo.png')) {
    $site_logo = base_url('uploads/site_logo.png');
}
$logo_version = !empty($settings['updated_at']) ? strtotime($settings['updated_at']) : time();
$site_logo_display = !empty($site_logo) ? $site_logo . (strpos($site_logo, '?') !== false ? '&' : '?') . 'v=' . $logo_version : '';
?>
<nav class="navbar navbar-expand-lg luxury-navbar">
    <div class="container">
        <a class="navbar-brand brand-logo" href="<?php echo base_url(); ?>">
            <?php if(!empty($site_logo_display)): ?>
                <img src="<?php echo htmlspecialchars($site_logo_display); ?>" alt="<?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?>" class="brand-logo-img">
            <?php else: ?>
                <div class="logo-icon-wrap">
                    <i class="fa-solid fa-crown"></i>
                </div>
                <span><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?></span>
            <?php endif; ?>
        </a>

        <button class="navbar-toggler border-0 shadow-none p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNavOffcanvas" aria-controls="mobileNavOffcanvas">
            <i class="fa-solid fa-bars-staggered fs-4 text-white"></i>
        </button>

        <div class="collapse navbar-collapse d-none d-lg-block">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo empty($current_segment) ? 'active' : ''; ?>" href="<?php echo base_url(); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_segment == 'about' ? 'active' : ''; ?>" href="<?php echo base_url('about'); ?>">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_segment == 'rooms' || $current_segment == 'room' ? 'active' : ''; ?>" href="<?php echo base_url('rooms'); ?>">Rooms & Suites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_segment == 'restaurant' ? 'active' : ''; ?>" href="<?php echo base_url('restaurant'); ?>">Restaurant & Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_segment == 'facilities' ? 'active' : ''; ?>" href="<?php echo base_url('facilities'); ?>">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_segment == 'gallery' ? 'active' : ''; ?>" href="<?php echo base_url('gallery'); ?>">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_segment == 'blogs' || $current_segment == 'blog' ? 'active' : ''; ?>" href="<?php echo base_url('blogs'); ?>">Tourist Guides</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_segment == 'contact' ? 'active' : ''; ?>" href="<?php echo base_url('contact'); ?>">Contact</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo base_url('rooms'); ?>" class="btn btn-luxury" data-bs-toggle="modal" data-bs-target="#quickBookingModal">
                    <i class="fa-solid fa-calendar-check me-1"></i> Book Now
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Offcanvas Navigation Drawer -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNavOffcanvas" aria-labelledby="mobileNavLabel" style="width: 300px;">
    <div class="offcanvas-header border-bottom">
        <a class="brand-logo" href="<?php echo base_url(); ?>">
            <?php if(!empty($site_logo_display)): ?>
                <img src="<?php echo htmlspecialchars($site_logo_display); ?>" alt="<?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?>" class="brand-logo-img">
            <?php else: ?>
                <div class="logo-icon-wrap"><i class="fa-solid fa-crown"></i></div>
                <span style="font-size: 1.25rem;"><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?></span>
            <?php endif; ?>
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4">
        <ul class="navbar-nav gap-2 mb-4">
            <li class="nav-item"><a class="nav-link fs-6 fw-semibold <?php echo empty($current_segment) ? 'text-primary' : ''; ?>" href="<?php echo base_url(); ?>">Home</a></li>
            <li class="nav-item"><a class="nav-link fs-6 fw-semibold <?php echo $current_segment == 'about' ? 'text-primary' : ''; ?>" href="<?php echo base_url('about'); ?>">About Us</a></li>
            <li class="nav-item"><a class="nav-link fs-6 fw-semibold <?php echo $current_segment == 'rooms' ? 'text-primary' : ''; ?>" href="<?php echo base_url('rooms'); ?>">Rooms & Suites</a></li>
            <li class="nav-item"><a class="nav-link fs-6 fw-semibold <?php echo $current_segment == 'restaurant' ? 'text-primary' : ''; ?>" href="<?php echo base_url('restaurant'); ?>">Restaurant & Menu</a></li>
            <li class="nav-item"><a class="nav-link fs-6 fw-semibold <?php echo $current_segment == 'facilities' ? 'text-primary' : ''; ?>" href="<?php echo base_url('facilities'); ?>">Hotel Facilities</a></li>
            <li class="nav-item"><a class="nav-link fs-6 fw-semibold <?php echo $current_segment == 'gallery' ? 'text-primary' : ''; ?>" href="<?php echo base_url('gallery'); ?>">Photo Gallery</a></li>
            <li class="nav-item"><a class="nav-link fs-6 fw-semibold <?php echo $current_segment == 'blogs' ? 'text-primary' : ''; ?>" href="<?php echo base_url('blogs'); ?>">Tourist Blogs</a></li>
            <li class="nav-item"><a class="nav-link fs-6 fw-semibold <?php echo $current_segment == 'contact' ? 'text-primary' : ''; ?>" href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
        </ul>
        <div class="d-grid gap-2">
            <button class="btn btn-luxury" data-bs-toggle="modal" data-bs-target="#quickBookingModal" data-bs-dismiss="offcanvas">
                <i class="fa-solid fa-calendar-check me-1"></i> Book A Room
            </button>
            <a href="<?php echo base_url('admin'); ?>" class="btn btn-outline-dark btn-sm mt-2">
                <i class="fa-solid fa-lock me-1"></i> Admin Portal
            </a>
        </div>
        <div class="mt-4 pt-4 border-top text-muted small">
            <p class="mb-1"><i class="fa-solid fa-phone text-primary me-2"></i><?php echo htmlspecialchars($settings['hotel_phone'] ?? '+91 98765 43210'); ?></p>
            <p class="mb-0"><i class="fa-solid fa-envelope text-primary me-2"></i><?php echo htmlspecialchars($settings['hotel_email'] ?? 'contact@grandcannann.com'); ?></p>
        </div>
    </div>
</div>
