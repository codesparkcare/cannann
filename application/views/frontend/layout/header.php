<?php
$site_logo = !empty($settings['hotel_logo']) ? (strpos($settings['hotel_logo'], 'http') === 0 ? $settings['hotel_logo'] : base_url(ltrim($settings['hotel_logo'], './'))) : '';
if (empty($site_logo) && file_exists(FCPATH . 'uploads/site_logo.png')) {
    $site_logo = base_url('uploads/site_logo.png');
}
$site_favicon = !empty($settings['hotel_favicon']) ? (strpos($settings['hotel_favicon'], 'http') === 0 ? $settings['hotel_favicon'] : base_url(ltrim($settings['hotel_favicon'], './'))) : '';
if (empty($site_favicon) && file_exists(FCPATH . 'uploads/favicon.png')) {
    $site_favicon = base_url('uploads/favicon.png');
} elseif (empty($site_favicon) && !empty($site_logo)) {
    $site_favicon = $site_logo;
}
$favicon_version = !empty($settings['updated_at']) ? strtotime($settings['updated_at']) : time();
$site_favicon_display = !empty($site_favicon) ? $site_favicon . (strpos($site_favicon, '?') !== false ? '&' : '?') . 'v=' . $favicon_version : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Dynamic SEO Meta Tags -->
    <title><?php echo htmlspecialchars($page_title ?? 'Grand Cannann | Luxury Hotel & Resort'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc ?? ($settings['meta_description'] ?? '')); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($meta_keywords ?? ($settings['meta_keywords'] ?? '')); ?>">
    <link rel="canonical" href="<?php echo current_url(); ?>">

    <!-- Dynamic Favicon -->
    <?php if(!empty($site_favicon_display)): ?>
        <link rel="icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>" type="image/png">
        <link rel="shortcut icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>" type="image/png">
        <link rel="apple-touch-icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>">
    <?php endif; ?>

    <!-- Open Graph / Social SEO -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($meta_title ?? $page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_desc ?? ''); ?>">
    <meta property="og:image" content="<?php echo !empty($og_image) ? $og_image : (!empty($site_logo) ? $site_logo : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=85'); ?>">

    <!-- Twitter Card SEO -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($meta_title ?? $page_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($meta_desc ?? ''); ?>">
    <meta name="twitter:image" content="<?php echo !empty($og_image) ? $og_image : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=85'; ?>">

    <!-- Structured Data Schema for Hotel -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Hotel",
      "name": "<?php echo addslashes($settings['hotel_name'] ?? 'Grand Cannann Resort'); ?>",
      "description": "<?php echo addslashes($settings['meta_description'] ?? 'Luxury Boutique Hotel & Resort'); ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo addslashes($settings['hotel_address'] ?? ''); ?>",
        "addressCountry": "IN"
      },
      "telephone": "<?php echo addslashes($settings['hotel_phone'] ?? ''); ?>",
      "email": "<?php echo addslashes($settings['hotel_email'] ?? ''); ?>",
      "priceRange": "₹₹₹₹",
      "starRating": {
        "@type": "Rating",
        "ratingValue": "5"
      }
    }
    </script>

    <!-- Google Fonts: Playfair Display (Serif Elegance) & Plus Jakarta Sans (Clean Modern) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 Pro/Free Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Swiper Slider CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <!-- Custom Luxury Hotel CSS -->
    <style>
        :root {
            --primary: #c5a880; /* Elegant Warm Gold */
            --primary-dark: #a8895e;
            --primary-light: #f5eedf;
            --secondary: #1e293b;
            --dark: #0f172a; /* Deep Obsidian */
            --dark-surface: #192231;
            --light: #ffffff;
            --bg-cream: #faf8f5;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-400: #94a3b8;
            --gray-600: #475569;
            --font-heading: 'Playfair Display', Georgia, serif;
            --font-body: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 24px;
            --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-subtle: 0 10px 30px rgba(0, 0, 0, 0.05);
            --shadow-luxury: 0 20px 45px rgba(15, 23, 42, 0.12);
            --shadow-gold: 0 12px 30px rgba(197, 168, 128, 0.25);
        }

        body {
            font-family: var(--font-body);
            color: #334155;
            background-color: #ffffff;
            overflow-x: hidden;
            line-height: 1.7;
        }

        h1, h2, h3, h4, h5, .font-serif {
            font-family: var(--font-heading);
            color: var(--dark);
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        a {
            text-decoration: none;
            transition: var(--transition);
        }

        /* Topbar - Rich Dark Forest */
        .topbar {
            background-color: #020c07;
            color: #d1d5db;
            font-size: 0.82rem;
            padding: 9px 0;
            border-bottom: 1px solid rgba(197, 168, 128, 0.15);
        }
        .topbar a {
            color: #e2e8f0;
        }
        .topbar a:hover {
            color: #f5d79e;
        }

        /* Luxury Header Navbar - Dark Emerald & Deep Jade Marble Theme */
        .luxury-navbar {
            background: linear-gradient(135deg, #061a11 0%, #0b2b1d 50%, #04140d 100%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 8px 0;
            transition: var(--transition);
            border-bottom: 1px solid rgba(197, 168, 128, 0.25);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            position: sticky;
            top: 0;
            z-index: 1020;
        }
        .luxury-navbar .nav-link {
            font-size: 0.94rem;
            font-weight: 500;
            color: #f1f5f9;
            padding: 8px 15px !important;
            letter-spacing: 0.03em;
            position: relative;
            transition: var(--transition);
        }
        .luxury-navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0px;
            left: 15px;
            right: 15px;
            height: 2px;
            background-color: #c5a880;
            box-shadow: 0 0 8px rgba(197, 168, 128, 0.6);
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: right;
        }
        .luxury-navbar .nav-link:hover::after,
        .luxury-navbar .nav-link.active::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        .luxury-navbar .nav-link:hover,
        .luxury-navbar .nav-link.active {
            color: #f5d79e !important;
        }

        /* Brand Logo */
        .brand-logo {
            font-family: var(--font-heading);
            font-size: 1.55rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.02em;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-logo .logo-icon-wrap {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(197, 168, 128, 0.35);
        }
        .brand-logo-img {
            max-height: 70px;
            max-width: 260px;
            width: auto;
            height: auto;
            object-fit: contain;
            display: inline-block;
            vertical-align: middle;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.4));
            transition: transform 0.25s ease;
        }
        .brand-logo:hover .brand-logo-img {
            transform: scale(1.02);
        }
        .offcanvas {
            background: linear-gradient(180deg, #071911 0%, #030f0a 100%) !important;
            color: #ffffff !important;
            border-right: 1px solid rgba(197, 168, 128, 0.3);
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.5);
        }
        .offcanvas .btn-close {
            filter: invert(1) brightness(2);
            opacity: 0.85;
            transition: transform 0.2s, opacity 0.2s;
        }
        .offcanvas .btn-close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }
        .offcanvas-header {
            border-bottom: 1px solid rgba(197, 168, 128, 0.2) !important;
            padding: 18px 20px;
        }
        .offcanvas-header .brand-logo-img {
            max-height: 52px;
            max-width: 190px;
        }
        .offcanvas-body .nav-link {
            color: #ffffff !important;
            font-size: 1.02rem;
            font-weight: 600;
            padding: 9px 12px;
            border-radius: 8px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .offcanvas-body .nav-link:hover,
        .offcanvas-body .nav-link.active {
            color: #f5d79e !important;
            background: rgba(197, 168, 128, 0.12);
            padding-left: 16px;
        }
        .btn-drawer-admin {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(197, 168, 128, 0.45);
            color: #f5d79e !important;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 10px 16px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s;
        }
        .btn-drawer-admin:hover {
            background: rgba(197, 168, 128, 0.2);
            border-color: #c5a880;
            color: #ffffff !important;
        }
        .contact-drawer-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(197, 168, 128, 0.15);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
        }
        .text-hover-gold:hover {
            color: #f5d79e !important;
        }
        .text-hover-gold:hover .text-white {
            color: #f5d79e !important;
        }
        .drawer-social-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .drawer-social-btn:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        .luxury-footer .brand-logo-img {
            max-height: 65px;
            max-width: 230px;
        }

        /* Custom Luxury Buttons */
        .btn-luxury {
            background: linear-gradient(135deg, #c5a880, #a8895e);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.88rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 12px 28px;
            border-radius: 50px;
            border: none;
            box-shadow: var(--shadow-gold);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-luxury:hover {
            background: linear-gradient(135deg, #a8895e, #8c6f45);
            transform: translateY(-2px);
            box-shadow: 0 16px 35px rgba(197, 168, 128, 0.4);
            color: #ffffff;
        }
        .btn-luxury-outline {
            background: transparent;
            color: #ffffff !important;
            border: 2px solid rgba(255, 255, 255, 0.85);
            font-weight: 600;
            font-size: 0.88rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 11px 26px;
            border-radius: 50px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-luxury-outline:hover {
            background: #ffffff;
            color: var(--dark) !important;
            transform: translateY(-2px);
            border-color: #ffffff;
        }
        .btn-luxury-outline-dark {
            background: transparent;
            color: var(--dark) !important;
            border: 2px solid var(--dark);
            font-weight: 600;
            font-size: 0.88rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 11px 26px;
            border-radius: 50px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-luxury-outline-dark:hover {
            background: var(--dark);
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2);
        }
        .btn-luxury-dark {
            background: var(--dark);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.88rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 12px 28px;
            border-radius: 50px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2);
        }
        .btn-luxury-dark:hover {
            background: var(--primary);
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* Section Titles & Badges */
        .section-badge {
            display: inline-block;
            background-color: var(--primary-light);
            color: var(--primary-dark);
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 30px;
            margin-bottom: 12px;
        }
        .section-title {
            font-size: 2.4rem;
            line-height: 1.25;
            margin-bottom: 16px;
        }
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.85rem;
            }
        }
        .section-subtitle {
            color: var(--gray-600);
            max-width: 620px;
            margin: 0 auto;
            font-size: 1rem;
        }

        /* Hero Slider */
        .hero-slider-container {
            position: relative;
            height: 82vh;
            min-height: 560px;
            max-height: 800px;
        }
        .hero-swiper {
            width: 100%;
            height: 100%;
        }
        .hero-slide-item {
            position: relative;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
        }
        .hero-slide-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.4) 0%, rgba(15, 23, 42, 0.78) 100%);
        }
        .hero-content {
            position: relative;
            z-index: 10;
            color: #ffffff;
            max-width: 820px;
        }
        .hero-tag {
            display: inline-block;
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-bottom: 15px;
            background: rgba(0, 0, 0, 0.4);
            padding: 5px 14px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(197, 168, 128, 0.3);
        }
        .hero-title {
            color: #ffffff;
            font-size: 3.4rem;
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 20px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            .hero-slider-container {
                height: 75vh;
            }
        }
        .hero-desc {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 30px;
            max-width: 650px;
            line-height: 1.6;
        }

        /* Overlapping Booking Search Bar */
        .booking-search-bar {
            position: relative;
            z-index: 30;
            margin-top: -65px;
            background: #ffffff;
            border-radius: var(--radius-md);
            padding: 24px 30px;
            box-shadow: var(--shadow-luxury);
            border: 1px solid rgba(197, 168, 128, 0.2);
        }
        .search-field-label {
            font-size: 0.74rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--gray-400);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .search-field-input {
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.92rem;
            width: 100%;
            transition: var(--transition);
        }
        .search-field-input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(197, 168, 128, 0.2);
        }

        /* Cards & Components */
        .luxury-card {
            background: #ffffff;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-subtle);
            transition: var(--transition);
            border: 1px solid var(--gray-200);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .luxury-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-luxury);
            border-color: rgba(197, 168, 128, 0.4);
        }
        .luxury-card-img-wrap {
            position: relative;
            overflow: hidden;
            height: 240px;
        }
        .luxury-card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .luxury-card:hover .luxury-card-img-wrap img {
            transform: scale(1.08);
        }
        .card-price-badge {
            position: absolute;
            bottom: 14px;
            right: 14px;
            background: rgba(15, 23, 42, 0.85);
            color: #ffffff;
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.95rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .card-category-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: var(--primary);
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* Facilities Icon Boxes */
        .facility-box {
            background: #ffffff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            padding: 32px 24px;
            text-align: center;
            transition: var(--transition);
            height: 100%;
        }
        .facility-box:hover {
            transform: translateY(-6px);
            border-color: var(--primary);
            box-shadow: var(--shadow-luxury);
            background: linear-gradient(180deg, #ffffff 0%, var(--bg-cream) 100%);
        }
        .facility-icon-wrap {
            width: 65px;
            height: 65px;
            margin: 0 auto 20px;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            transition: var(--transition);
        }
        .facility-box:hover .facility-icon-wrap {
            background: var(--primary);
            color: #ffffff;
            transform: rotateY(180deg);
        }

        /* Restaurant Menu Items */
        .menu-dish-card {
            background: #ffffff;
            border-radius: var(--radius-sm);
            padding: 16px;
            border: 1px solid var(--gray-200);
            transition: var(--transition);
            display: flex;
            gap: 16px;
            align-items: center;
        }
        .menu-dish-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-subtle);
            transform: translateX(4px);
        }
        .menu-dish-img {
            width: 85px;
            height: 85px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            flex-shrink: 0;
        }

        /* Testimonials Slider */
        .testimonial-card {
            background: #ffffff;
            border-radius: var(--radius-md);
            padding: 36px;
            box-shadow: var(--shadow-subtle);
            border: 1px solid var(--gray-200);
            position: relative;
        }
        .testimonial-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }

        /* Gallery Grid */
        .gallery-item {
            position: relative;
            border-radius: var(--radius-sm);
            overflow: hidden;
            height: 250px;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.7);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
            color: #ffffff;
            padding: 15px;
            text-align: center;
        }
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        /* Footer */
        .luxury-footer {
            background-color: var(--dark);
            color: #94a3b8;
            padding-top: 70px;
            border-top: 4px solid var(--primary);
        }
        .luxury-footer h5 {
            color: #ffffff;
            font-size: 1.15rem;
            margin-bottom: 24px;
            position: relative;
            padding-bottom: 10px;
        }
        .luxury-footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 35px;
            height: 2px;
            background: var(--primary);
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li {
            margin-bottom: 12px;
        }
        .footer-links a {
            color: #94a3b8;
            transition: var(--transition);
        }
        .footer-links a:hover {
            color: var(--primary);
            padding-left: 6px;
        }
        .footer-bottom {
            background: #090e17;
            padding: 20px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.84rem;
        }

        /* Page Banner */
        .inner-page-banner {
            background: linear-gradient(rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.85)), url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1920&q=85');
            background-size: cover;
            background-position: center;
            padding: 90px 0 70px;
            color: #ffffff;
            text-align: center;
        }
        .inner-page-banner h1 {
            color: #ffffff;
            font-size: 3rem;
            margin-bottom: 12px;
        }
        .breadcrumb-luxury {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.75);
        }
        .breadcrumb-luxury a {
            color: var(--primary);
        }

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 54px;
            height: 54px;
            background-color: #25d366;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
            z-index: 999;
            transition: var(--transition);
        }
        .whatsapp-float:hover {
            transform: scale(1.12);
            color: #ffffff;
        }

        /* Luxury Animated Site Preloader */
        #sitePreloader {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            height: 100dvh;
            background: radial-gradient(circle at center, #0a2e1f 0%, #061b12 55%, #020b07 100%);
            z-index: 99999999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            touch-action: none;
            user-select: none;
            -webkit-user-select: none;
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.5s ease;
        }
        #sitePreloader.loaded {
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }
        .preloader-content {
            text-align: center;
            position: relative;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 90vw;
        }
        .preloader-glow-ring {
            position: absolute;
            width: 260px;
            height: 260px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background: radial-gradient(circle, rgba(197, 168, 128, 0.28) 0%, rgba(11, 43, 29, 0) 70%);
            animation: luxuryAura 2.2s ease-in-out infinite alternate;
            pointer-events: none;
        }
        .preloader-logo {
            max-width: 220px;
            max-height: 100px;
            width: 70vw;
            height: auto;
            object-fit: contain;
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.7)) drop-shadow(0 0 16px rgba(197, 168, 128, 0.35));
            animation: luxuryLogoBreath 2s ease-in-out infinite alternate;
        }
        .preloader-bar-wrap {
            width: 140px;
            height: 3px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 6px;
            margin-top: 20px;
            overflow: hidden;
            position: relative;
            z-index: 2;
        }
        .preloader-bar {
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, #c5a880, #f5d79e, #c5a880, transparent);
            border-radius: 6px;
            animation: luxuryBarSlide 1.3s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        @media (max-width: 768px) {
            .preloader-logo {
                max-width: 175px;
                max-height: 80px;
            }
            .preloader-glow-ring {
                width: 190px;
                height: 190px;
            }
            .preloader-bar-wrap {
                width: 110px;
            }
        }

        @keyframes luxuryLogoBreath {
            0% {
                transform: scale(0.96);
                filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.5)) drop-shadow(0 0 10px rgba(197, 168, 128, 0.25));
            }
            100% {
                transform: scale(1.03);
                filter: drop-shadow(0 14px 35px rgba(0, 0, 0, 0.8)) drop-shadow(0 0 28px rgba(197, 168, 128, 0.6));
            }
        }
        @keyframes luxuryAura {
            0% {
                transform: translate(-50%, -50%) scale(0.85);
                opacity: 0.4;
            }
            100% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0.95;
            }
        }
        @keyframes luxuryBarSlide {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(250%);
            }
        }
    </style>
</head>
<body>

<!-- Luxury Animated Site Preloader -->
<div id="sitePreloader">
    <div class="preloader-content">
        <div class="preloader-glow-ring"></div>
        <?php
            $preloader_img = file_exists(FCPATH . 'uploads/site_logo_raw.png') ? base_url('uploads/site_logo_raw.png') : base_url('uploads/site_logo.png');
        ?>
        <img src="<?php echo htmlspecialchars($preloader_img); ?>" alt="<?php echo htmlspecialchars($settings['hotel_name'] ?? 'Hotel Cannann'); ?>" class="preloader-logo">
        <div class="preloader-bar-wrap">
            <div class="preloader-bar"></div>
        </div>
    </div>
</div>

<script>
// High-performance, mobile-optimized preloader dismiss
(function() {
    function dismissSitePreloader() {
        var preloader = document.getElementById('sitePreloader');
        if (preloader && !preloader.classList.contains('loaded')) {
            preloader.classList.add('loaded');
            setTimeout(function() {
                if (preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            }, 550);
        }
    }

    if (document.readyState === 'complete') {
        dismissSitePreloader();
    } else {
        window.addEventListener('load', function() {
            setTimeout(dismissSitePreloader, 200);
        });
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(dismissSitePreloader, 350);
        });
    }

    // Fast mobile fallback: dismiss within 1.2s max so mobile users are never stuck
    setTimeout(dismissSitePreloader, 1200);
})();
</script>
