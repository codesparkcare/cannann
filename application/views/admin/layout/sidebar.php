<?php
$seg = $this->uri->segment(2) ?: 'index';
if (!isset($settings)) {
    $ci =& get_instance();
    $ci->load->model('Settings_model');
    $settings = $ci->Settings_model->get_settings();
}
$site_logo = !empty($settings['hotel_logo']) ? (strpos($settings['hotel_logo'], 'http') === 0 ? $settings['hotel_logo'] : base_url(ltrim($settings['hotel_logo'], './'))) : '';
if (empty($site_logo) && file_exists(FCPATH . 'uploads/site_logo.png')) {
    $site_logo = base_url('uploads/site_logo.png');
}
?>
<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <?php if(!empty($site_logo)): ?>
            <a href="<?php echo base_url('admin/index'); ?>" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="<?php echo htmlspecialchars($site_logo); ?>" alt="<?php echo htmlspecialchars($settings['hotel_name'] ?? 'Logo'); ?>" style="max-height: 38px; max-width: 170px; object-fit: contain;">
            </a>
        <?php else: ?>
            <div class="logo-icon"><i class="fa-solid fa-crown text-warning"></i></div>
            <div>
                <h5 class="mb-0 fw-bold text-white"><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?></h5>
                <span class="small text-white-50" style="font-size: 0.72rem;">Admin Management</span>
            </div>
        <?php endif; ?>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-title">Main</li>
        <li>
            <a href="<?php echo base_url('admin/index'); ?>" class="<?php echo $seg == 'index' ? 'active' : ''; ?>">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>" target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Website
            </a>
        </li>

        <li class="menu-title">Hotel Accommodations</li>
        <li>
            <a href="<?php echo base_url('admin/categories'); ?>" class="<?php echo $seg == 'room_categories' || $seg == 'categories' ? 'active' : ''; ?>">
                <i class="fa-solid fa-layer-group"></i> Room Categories
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/rooms'); ?>" class="<?php echo $seg == 'rooms' ? 'active' : ''; ?>">
                <i class="fa-solid fa-bed"></i> Rooms & Suites
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/facilities'); ?>" class="<?php echo $seg == 'facilities' ? 'active' : ''; ?>">
                <i class="fa-solid fa-spa"></i> Hotel Facilities
            </a>
        </li>

        <li class="menu-title">Dining & Restaurant</li>
        <li>
            <a href="<?php echo base_url('admin/restaurant'); ?>" class="<?php echo $seg == 'restaurant' ? 'active' : ''; ?>">
                <i class="fa-solid fa-utensils"></i> Menus & Dishes
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/reservations'); ?>" class="<?php echo $seg == 'reservations' ? 'active' : ''; ?>">
                <i class="fa-solid fa-chair"></i> Table Reservations
            </a>
        </li>

        <li class="menu-title">Guest Reservations</li>
        <li>
            <a href="<?php echo base_url('admin/bookings'); ?>" class="<?php echo $seg == 'bookings' ? 'active' : ''; ?>">
                <i class="fa-solid fa-calendar-check"></i> Room Bookings
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/contacts'); ?>" class="<?php echo $seg == 'contacts' ? 'active' : ''; ?>">
                <i class="fa-solid fa-envelope"></i> Inquiries & Leads
            </a>
        </li>

        <li class="menu-title">Content & SEO Marketing</li>
        <li>
            <a href="<?php echo base_url('admin/sliders'); ?>" class="<?php echo $seg == 'sliders' ? 'active' : ''; ?>">
                <i class="fa-solid fa-images"></i> Hero Sliders
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/blogs'); ?>" class="<?php echo $seg == 'blogs' ? 'active' : ''; ?>">
                <i class="fa-solid fa-newspaper"></i> Tourist Blogs (SEO)
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/gallery'); ?>" class="<?php echo $seg == 'gallery' ? 'active' : ''; ?>">
                <i class="fa-solid fa-camera-retro"></i> Photo Gallery
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/promotions'); ?>" class="<?php echo $seg == 'promotions' ? 'active' : ''; ?>">
                <i class="fa-solid fa-tags"></i> Offers & Promotions
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/testimonials'); ?>" class="<?php echo $seg == 'testimonials' ? 'active' : ''; ?>">
                <i class="fa-solid fa-star"></i> Guest Reviews
            </a>
        </li>

        <li class="menu-title">System & Settings</li>
        <li>
            <a href="<?php echo base_url('admin/settings'); ?>" class="<?php echo $seg == 'settings' ? 'active' : ''; ?>">
                <i class="fa-solid fa-sliders"></i> Site & SMTP Settings
            </a>
        </li>
    </ul>
</nav>

<!-- Page Content Holder -->
<div id="content">
    <!-- Top Navbar -->
    <header class="top-navbar">
        <div class="d-flex align-items-center">
            <button type="button" id="sidebarCollapse" class="navbar-btn">
                <i class="fa-solid fa-bars"></i>
            </button>
            <span class="ms-3 fw-semibold text-dark">Grand Cannann Management Portal</span>
        </div>

        <div class="d-flex align-items-center gap-3">
            <a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                <i class="fa-solid fa-globe me-1"></i> View Live Site
            </a>

            <div class="user-profile dropdown">
                <div class="d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="info text-end d-none d-md-flex">
                        <span class="name">Super Admin</span>
                        <span class="role text-muted">Hotel Manager</span>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin+Manager&background=c5a880&color=fff" alt="Admin">
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li><a class="dropdown-item py-2" href="<?php echo base_url('admin/settings'); ?>"><i class="fa-solid fa-gear me-2"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2 text-danger" href="<?php echo base_url(); ?>"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Return to Site</a></li>
                </ul>
            </div>
        </div>
    </header>