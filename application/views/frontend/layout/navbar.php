<?php
$current_segment = $this->uri->segment(1);
$is_admin = $this->session->userdata('admin_logged_in');
$is_opening_on = !empty($settings['is_opening_enabled']) && $settings['is_opening_enabled'] == 1;
?>

<!-- Admin Preview Ribbon if Admin is Viewing Site with Opening Mode Active -->
<?php if($is_admin && $is_opening_on): ?>
    <div style="background: #c5a880; color: #0b1120; padding: 6px 16px; font-size: 0.82rem; font-weight: 700; text-align: center; display: flex; justify-content: center; align-items: center; gap: 15px; position: sticky; top: 0; z-index: 999999;">
        <span><i class="fa-solid fa-user-shield me-1"></i> Admin Site Preview (Grand Opening Mode is Active for Public)</span>
        <a href="<?php echo base_url('home/preview_opening_page'); ?>" style="color: #0b1120; text-decoration: underline;"><i class="fa-solid fa-eye me-1"></i> View Opening Countdown Page</a>
        <a href="<?php echo base_url('admin/settings'); ?>" style="color: #0b1120; text-decoration: underline;"><i class="fa-solid fa-gear me-1"></i> Admin Settings</a>
    </div>
<?php endif; ?>

<!-- Grand Opening Announcement Ribbon (if Banner Mode Enabled) -->
<?php if($is_opening_on && ($settings['opening_mode'] ?? '') === 'banner_widget'): ?>
    <div style="background: linear-gradient(90deg, #071911, #0f3d2a, #071911); border-bottom: 1px solid rgba(197,168,128,0.4); color: #f5d79e; padding: 10px 16px; font-size: 0.88rem; font-weight: 600; text-align: center;">
        <div class="container d-flex justify-content-center align-items-center gap-3 flex-wrap">
            <span><i class="fa-solid fa-champagne-glasses text-warning me-1"></i> <?php echo htmlspecialchars($settings['opening_banner_text'] ?? '🎉 Grand Opening on September 12, 2026 — Pre-Bookings Now Open!'); ?></span>
            <button class="btn btn-sm btn-luxury py-1 px-3" data-bs-toggle="modal" data-bs-target="#quickBookingModal" style="font-size: 0.75rem; border-radius: 20px;">
                Pre-Book Now
            </button>
        </div>
    </div>
<?php endif; ?>

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
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNavOffcanvas" aria-labelledby="mobileNavLabel" style="width: 310px; max-width: 85vw;">
    <div class="offcanvas-header">
        <a class="brand-logo text-decoration-none" href="<?php echo base_url(); ?>">
            <?php if(!empty($site_logo_display)): ?>
                <img src="<?php echo htmlspecialchars($site_logo_display); ?>" alt="<?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?>" class="brand-logo-img">
            <?php else: ?>
                <div class="logo-icon-wrap"><i class="fa-solid fa-crown"></i></div>
                <span class="text-white fw-bold" style="font-size: 1.15rem;"><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?></span>
            <?php endif; ?>
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column p-4">
        <!-- Main Navigation Links -->
        <ul class="navbar-nav gap-1 mb-4">
            <li class="nav-item">
                <a class="nav-link <?php echo empty($current_segment) ? 'active' : ''; ?>" href="<?php echo base_url(); ?>">
                    <span>Home</span><i class="fa-solid fa-chevron-right small text-white-50" style="font-size: 0.7rem;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_segment == 'about' ? 'active' : ''; ?>" href="<?php echo base_url('about'); ?>">
                    <span>About Us</span><i class="fa-solid fa-chevron-right small text-white-50" style="font-size: 0.7rem;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_segment == 'rooms' || $current_segment == 'room' ? 'active' : ''; ?>" href="<?php echo base_url('rooms'); ?>">
                    <span>Rooms & Suites</span><i class="fa-solid fa-chevron-right small text-white-50" style="font-size: 0.7rem;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_segment == 'restaurant' ? 'active' : ''; ?>" href="<?php echo base_url('restaurant'); ?>">
                    <span>Restaurant & Menu</span><i class="fa-solid fa-chevron-right small text-white-50" style="font-size: 0.7rem;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_segment == 'facilities' ? 'active' : ''; ?>" href="<?php echo base_url('facilities'); ?>">
                    <span>Hotel Facilities</span><i class="fa-solid fa-chevron-right small text-white-50" style="font-size: 0.7rem;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_segment == 'gallery' ? 'active' : ''; ?>" href="<?php echo base_url('gallery'); ?>">
                    <span>Photo Gallery</span><i class="fa-solid fa-chevron-right small text-white-50" style="font-size: 0.7rem;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_segment == 'blogs' || $current_segment == 'blog' ? 'active' : ''; ?>" href="<?php echo base_url('blogs'); ?>">
                    <span>Tourist Blogs</span><i class="fa-solid fa-chevron-right small text-white-50" style="font-size: 0.7rem;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_segment == 'contact' ? 'active' : ''; ?>" href="<?php echo base_url('contact'); ?>">
                    <span>Contact Us</span><i class="fa-solid fa-chevron-right small text-white-50" style="font-size: 0.7rem;"></i>
                </a>
            </li>
        </ul>

        <!-- Action Buttons -->
        <div class="d-grid gap-2 mb-4">
            <button class="btn btn-luxury w-100 py-3 text-uppercase fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#quickBookingModal" data-bs-dismiss="offcanvas">
                <i class="fa-solid fa-calendar-check me-2"></i> Book A Room
            </button>
        </div>

        <!-- High-Contrast Contact Information Footer -->
        <div class="mt-auto pt-3 border-top border-secondary border-opacity-25">
            <div class="d-flex flex-column gap-2 mb-3">
                <a href="tel:<?php echo htmlspecialchars($settings['hotel_phone'] ?? '+919876543210'); ?>" class="text-decoration-none d-flex align-items-center gap-2 py-1 text-hover-gold">
                    <span class="contact-drawer-icon"><i class="fa-solid fa-phone text-warning"></i></span>
                    <span class="text-white fw-semibold small"><?php echo htmlspecialchars($settings['hotel_phone'] ?? '+91 98765 43210'); ?></span>
                </a>
                <a href="mailto:<?php echo htmlspecialchars($settings['hotel_email'] ?? 'contact@grandcannann.com'); ?>" class="text-decoration-none d-flex align-items-center gap-2 py-1 text-hover-gold">
                    <span class="contact-drawer-icon"><i class="fa-solid fa-envelope text-warning"></i></span>
                    <span class="text-white fw-semibold small"><?php echo htmlspecialchars($settings['hotel_email'] ?? 'contact@grandcannann.com'); ?></span>
                </a>
                <?php if(!empty($settings['hotel_address'])): ?>
                    <div class="d-flex align-items-start gap-2 py-1">
                        <span class="contact-drawer-icon"><i class="fa-solid fa-location-dot text-warning"></i></span>
                        <span class="text-white-50 small" style="line-height: 1.4;"><?php echo htmlspecialchars($settings['hotel_address']); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Social Links in Drawer -->
            <div class="d-flex align-items-center gap-2 pt-2 border-top border-secondary border-opacity-25">
                <span class="small text-white-50 me-1">Connect:</span>
                <?php if(!empty($settings['facebook_url'])): ?>
                    <a href="<?php echo $settings['facebook_url']; ?>" target="_blank" class="drawer-social-btn" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if(!empty($settings['instagram_url'])): ?>
                    <a href="<?php echo $settings['instagram_url']; ?>" target="_blank" class="drawer-social-btn" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <?php endif; ?>
                <?php if(!empty($settings['twitter_url'])): ?>
                    <a href="<?php echo $settings['twitter_url']; ?>" target="_blank" class="drawer-social-btn" title="Twitter"><i class="fa-brands fa-twitter"></i></a>
                <?php endif; ?>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $settings['hotel_phone'] ?? '919876543210'); ?>" target="_blank" class="drawer-social-btn text-success" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
</div>
