<?php
// Database migration and seed script for Cannann Luxury Hotel
$mysqli = new mysqli('localhost', 'cannann', 'Rathi@123*', 'cannann');

if ($mysqli->connect_error) {
    die("Database Connection failed: " . $mysqli->connect_error);
}

$queries = [
    // 1. Site Settings Table
    "CREATE TABLE IF NOT EXISTS `site_settings` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `hotel_name` VARCHAR(255) DEFAULT 'Grand Cannann Resort & Spa',
        `hotel_tagline` VARCHAR(255) DEFAULT 'Luxury Stays & Unforgettable Memories',
        `hotel_logo` VARCHAR(255) DEFAULT '',
        `hotel_favicon` VARCHAR(255) DEFAULT '',
        `hotel_email` VARCHAR(150) DEFAULT 'contact@grandcannann.com',
        `hotel_phone` VARCHAR(50) DEFAULT '+91 98765 43210',
        `hotel_alt_phone` VARCHAR(50) DEFAULT '+91 44 2345 6789',
        `hotel_address` TEXT,
        `map_iframe` TEXT,
        `facebook_url` VARCHAR(255) DEFAULT 'https://facebook.com',
        `instagram_url` VARCHAR(255) DEFAULT 'https://instagram.com',
        `twitter_url` VARCHAR(255) DEFAULT 'https://twitter.com',
        `tripadvisor_url` VARCHAR(255) DEFAULT 'https://tripadvisor.com',
        `meta_title` VARCHAR(255) DEFAULT 'Grand Cannann | Luxury Hotel & Resort',
        `meta_description` TEXT,
        `meta_keywords` TEXT,
        `smtp_host` VARCHAR(150) DEFAULT 'smtp.gmail.com',
        `smtp_port` INT DEFAULT 587,
        `smtp_user` VARCHAR(150) DEFAULT '',
        `smtp_pass` VARCHAR(255) DEFAULT '',
        `smtp_crypto` VARCHAR(10) DEFAULT 'tls',
        `smtp_from_email` VARCHAR(150) DEFAULT 'reservations@grandcannann.com',
        `smtp_from_name` VARCHAR(150) DEFAULT 'Grand Cannann Hotel',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 2. Sliders Table
    "CREATE TABLE IF NOT EXISTS `sliders` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `subtitle` VARCHAR(255) DEFAULT NULL,
        `tag` VARCHAR(100) DEFAULT 'LUXURY EXPERIENCE',
        `button_text` VARCHAR(100) DEFAULT 'Book Your Stay',
        `button_link` VARCHAR(255) DEFAULT '#booking-search',
        `secondary_btn_text` VARCHAR(100) DEFAULT 'Explore Suites',
        `secondary_btn_link` VARCHAR(255) DEFAULT 'rooms',
        `image` VARCHAR(255) NOT NULL,
        `sort_order` INT DEFAULT 0,
        `status` ENUM('active', 'inactive') DEFAULT 'active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 3. Room Categories Table
    "CREATE TABLE IF NOT EXISTS `room_categories` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(150) NOT NULL,
        `slug` VARCHAR(150) NOT NULL,
        `description` TEXT,
        `badge` VARCHAR(50) DEFAULT 'Popular',
        `image` VARCHAR(255) DEFAULT '',
        `status` ENUM('active', 'inactive') DEFAULT 'active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 4. Rooms Table
    "CREATE TABLE IF NOT EXISTS `rooms` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `category_id` INT NOT NULL,
        `title` VARCHAR(255) NOT NULL,
        `slug` VARCHAR(255) NOT NULL,
        `price` DECIMAL(10,2) NOT NULL,
        `discounted_price` DECIMAL(10,2) DEFAULT NULL,
        `max_adults` INT DEFAULT 2,
        `max_children` INT DEFAULT 1,
        `bed_type` VARCHAR(100) DEFAULT 'King Size Bed',
        `room_size` VARCHAR(50) DEFAULT '450 sq.ft',
        `view_type` VARCHAR(100) DEFAULT 'Panoramic Ocean View',
        `amenities` TEXT,
        `featured_image` VARCHAR(255) NOT NULL,
        `gallery_images` TEXT,
        `short_description` VARCHAR(300) DEFAULT NULL,
        `long_description` LONGTEXT,
        `is_featured` TINYINT(1) DEFAULT 1,
        `status` ENUM('available', 'booked', 'maintenance') DEFAULT 'available',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 5. Facilities Table
    "CREATE TABLE IF NOT EXISTS `facilities` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(150) NOT NULL,
        `icon` VARCHAR(100) DEFAULT 'fa-solid fa-hotel',
        `short_description` VARCHAR(255) NOT NULL,
        `full_description` TEXT,
        `image` VARCHAR(255) DEFAULT '',
        `sort_order` INT DEFAULT 0,
        `status` ENUM('active', 'inactive') DEFAULT 'active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 6. Restaurant Categories
    "CREATE TABLE IF NOT EXISTS `restaurant_categories` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `slug` VARCHAR(100) NOT NULL,
        `description` VARCHAR(255) DEFAULT NULL,
        `sort_order` INT DEFAULT 0,
        `status` ENUM('active', 'inactive') DEFAULT 'active'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 7. Restaurant Items
    "CREATE TABLE IF NOT EXISTS `restaurant_items` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `category_id` INT NOT NULL,
        `name` VARCHAR(150) NOT NULL,
        `description` TEXT,
        `price` DECIMAL(10,2) NOT NULL,
        `dietary_type` ENUM('veg', 'non-veg', 'vegan') DEFAULT 'non-veg',
        `badge` VARCHAR(50) DEFAULT NULL,
        `image` VARCHAR(255) DEFAULT '',
        `is_special` TINYINT(1) DEFAULT 0,
        `status` ENUM('active', 'inactive') DEFAULT 'active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 8. Table Reservations
    "CREATE TABLE IF NOT EXISTS `table_reservations` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `guest_name` VARCHAR(150) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `phone` VARCHAR(50) NOT NULL,
        `reservation_date` DATE NOT NULL,
        `reservation_time` TIME NOT NULL,
        `guest_count` INT NOT NULL DEFAULT 2,
        `table_preference` VARCHAR(100) DEFAULT 'Indoor Romantic',
        `special_notes` TEXT,
        `status` ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 9. Promotions Table
    "CREATE TABLE IF NOT EXISTS `promotions` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `badge` VARCHAR(50) DEFAULT 'Special Offer',
        `discount_text` VARCHAR(100) DEFAULT 'Up to 30% Off',
        `promo_code` VARCHAR(50) DEFAULT 'LUXURY30',
        `banner_image` VARCHAR(255) NOT NULL,
        `description` TEXT,
        `valid_until` DATE DEFAULT NULL,
        `status` ENUM('active', 'inactive') DEFAULT 'active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 10. Tourist Blogs with Full SEO Meta Fields
    "CREATE TABLE IF NOT EXISTS `blogs` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `slug` VARCHAR(255) NOT NULL UNIQUE,
        `category` VARCHAR(100) DEFAULT 'Travel & Tourism',
        `featured_image` VARCHAR(255) NOT NULL,
        `author_name` VARCHAR(100) DEFAULT 'Chief Concierge',
        `read_time` VARCHAR(30) DEFAULT '5 min read',
        `summary` TEXT,
        `content` LONGTEXT NOT NULL,
        `meta_title` VARCHAR(255) NOT NULL,
        `meta_keywords` TEXT NOT NULL,
        `meta_description` TEXT NOT NULL,
        `views_count` INT DEFAULT 0,
        `is_featured` TINYINT(1) DEFAULT 1,
        `status` ENUM('published', 'draft') DEFAULT 'published',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 11. Photo Gallery Table
    "CREATE TABLE IF NOT EXISTS `gallery` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(150) NOT NULL,
        `category` ENUM('hotel', 'rooms', 'restaurant', 'spa', 'events') DEFAULT 'hotel',
        `image` VARCHAR(255) NOT NULL,
        `caption` VARCHAR(255) DEFAULT '',
        `sort_order` INT DEFAULT 0,
        `status` ENUM('active', 'inactive') DEFAULT 'active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 12. Room Bookings Table
    "CREATE TABLE IF NOT EXISTS `bookings` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `booking_number` VARCHAR(50) NOT NULL UNIQUE,
        `room_id` INT DEFAULT NULL,
        `room_category_id` INT DEFAULT NULL,
        `check_in` DATE NOT NULL,
        `check_out` DATE NOT NULL,
        `adults` INT DEFAULT 2,
        `children` INT DEFAULT 0,
        `guest_name` VARCHAR(150) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `phone` VARCHAR(50) NOT NULL,
        `total_amount` DECIMAL(10,2) DEFAULT 0.00,
        `special_requests` TEXT,
        `status` ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 13. Contact Inquiries Table
    "CREATE TABLE IF NOT EXISTS `contacts` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(150) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `phone` VARCHAR(50) DEFAULT NULL,
        `subject` VARCHAR(200) NOT NULL,
        `message` TEXT NOT NULL,
        `status` ENUM('unread', 'read', 'replied') DEFAULT 'unread',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // 14. Testimonials Table
    "CREATE TABLE IF NOT EXISTS `testimonials` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `guest_name` VARCHAR(150) NOT NULL,
        `designation` VARCHAR(100) DEFAULT 'Verified Guest',
        `location` VARCHAR(100) DEFAULT 'London, UK',
        `rating` INT DEFAULT 5,
        `review` TEXT NOT NULL,
        `avatar` VARCHAR(255) DEFAULT '',
        `status` ENUM('active', 'inactive') DEFAULT 'active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
];

foreach ($queries as $sql) {
    if (!$mysqli->query($sql)) {
        echo "Error creating table: " . $mysqli->error . "\n";
    }
}

// Check if settings exist, if not seed default
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM site_settings");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $hotel_addr = "124 Luxury Coastal Boulevard, Marina Bay District, Chennai, Tamil Nadu 600028";
    $map = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.985621453228!2d80.27847321532454!3d13.036577816965038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5267b2a6081ab5%3A0x6b10705f42c4b8e5!2sMarina%20Beach!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin";
    $m_desc = "Experience world-class luxury at Grand Cannann Hotel & Resort. Premium ocean view suites, Michelin-inspired dining, infinity pool, luxury spa, and bespoke coastal experiences.";
    $m_keys = "luxury hotel, resort, ocean suite, fine dining restaurant, infinity pool, hotel booking, boutique hotel chennai, tourist stay";
    
    $stmt = $mysqli->prepare("INSERT INTO site_settings (hotel_name, hotel_tagline, hotel_email, hotel_phone, hotel_address, map_iframe, meta_title, meta_description, meta_keywords, smtp_host, smtp_port, smtp_crypto, smtp_from_email, smtp_from_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $h_name = "Grand Cannann Resort & Luxury Suites";
    $h_tag = "Where Timeless Heritage Meets Contemporary Luxury";
    $h_email = "reservations@grandcannann.com";
    $h_phone = "+91 44 4890 1200";
    $m_title = "Grand Cannann Resort & Spa | Luxury Boutique Hotel & Suites";
    $smtp_host = "smtp.gmail.com";
    $smtp_port = 587;
    $smtp_crypto = "tls";
    $smtp_from_email = "reservations@grandcannann.com";
    $smtp_from_name = "Grand Cannann Hotel";
    $stmt->bind_param("sssssssssissss", $h_name, $h_tag, $h_email, $h_phone, $hotel_addr, $map, $m_title, $m_desc, $m_keys, $smtp_host, $smtp_port, $smtp_crypto, $smtp_from_email, $smtp_from_name);
    $stmt->execute();
}

// Seed Sliders
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM sliders");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $sliders = [
        [
            'title' => 'Experience Coastal Luxury & Sublime Comfort',
            'subtitle' => 'Immerse yourself in panoramic seaside vistas, lavish bespoke suites, and tailored five-star hospitality.',
            'tag' => '5-STAR BOUTIQUE RESORT',
            'button_text' => 'Explore Luxury Suites',
            'button_link' => 'rooms',
            'secondary_btn_text' => 'Reserve Dining Table',
            'secondary_btn_link' => 'restaurant',
            'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1920&q=85',
            'sort_order' => 1
        ],
        [
            'title' => 'Presidential Suites Crafted for Perfection',
            'subtitle' => 'Indulge in private heated plunge pools, 24/7 personal butler service, and Michelin-inspired in-room dining.',
            'tag' => 'EXCLUSIVE LUXURY SUITES',
            'button_text' => 'Book Your Stay',
            'button_link' => 'rooms',
            'secondary_btn_text' => 'View Amenities',
            'secondary_btn_link' => 'facilities',
            'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1920&q=85',
            'sort_order' => 2
        ],
        [
            'title' => 'Michelin-Standard Gourmet Culinary Journeys',
            'subtitle' => 'Savor artisanal seafood delicacies and curated vintage cellars under the starlit coastal sky.',
            'tag' => 'SIGNATURE FINE DINING',
            'button_text' => 'Discover The Menu',
            'button_link' => 'restaurant',
            'secondary_btn_text' => 'Book A Table',
            'secondary_btn_link' => 'restaurant',
            'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1920&q=85',
            'sort_order' => 3
        ]
    ];
    $stmt = $mysqli->prepare("INSERT INTO sliders (title, subtitle, tag, button_text, button_link, secondary_btn_text, secondary_btn_link, image, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($sliders as $s) {
        $stmt->bind_param("ssssssssi", $s['title'], $s['subtitle'], $s['tag'], $s['button_text'], $s['button_link'], $s['secondary_btn_text'], $s['secondary_btn_link'], $s['image'], $s['sort_order']);
        $stmt->execute();
    }
}

// Seed Room Categories
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM room_categories");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $cats = [
        ['Presidential & Royal Suites', 'presidential-royal-suites', 'The pinnacle of luxury with panoramic ocean views and private butler service.', 'Exclusive', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80'],
        ['Deluxe Ocean View Rooms', 'deluxe-ocean-view-rooms', 'Breathtaking sunrise horizons, plush king bedding, and private balcony lounge.', 'Popular', 'https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=800&q=80'],
        ['Executive Garden Villas', 'executive-garden-villas', 'Serene private sanctuaries nestled amidst tropical botanical gardens and plunge pools.', 'Featured', 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=800&q=80'],
        ['Classic Family Heritage Suites', 'classic-family-heritage-suites', 'Spacious interconnected suites tailored for royal family holidays with luxury comforts.', 'Family Choice', 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80']
    ];
    $stmt = $mysqli->prepare("INSERT INTO room_categories (name, slug, description, badge, image) VALUES (?, ?, ?, ?, ?)");
    foreach ($cats as $c) {
        $stmt->bind_param("sssss", $c[0], $c[1], $c[2], $c[3], $c[4]);
        $stmt->execute();
    }
}

// Seed Rooms
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM rooms");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $rooms = [
        [
            'category_id' => 1,
            'title' => 'The Grand Royal Ocean Penthouse',
            'slug' => 'grand-royal-ocean-penthouse',
            'price' => 24999.00,
            'discounted_price' => 19999.00,
            'max_adults' => 4,
            'max_children' => 2,
            'bed_type' => '2 Super King Beds',
            'room_size' => '1,450 sq.ft',
            'view_type' => '360° Infinite Ocean View',
            'amenities' => 'Private Jacuzzi, Butler Service, Ocean Balcony, Champagne on Arrival, Walk-in Dressing, Smart Automation, Nespresso Machine, Free High-Speed Wi-Fi, 65-inch OLED TV',
            'featured_image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1000&q=85',
            'gallery_images' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80,https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80,https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=800&q=80',
            'short_description' => 'Unsurpassed coastal opulence with private jacuzzi deck, floor-to-ceiling glass panoramic windows, and personal round-the-clock butler.',
            'long_description' => 'Perched on the top tier of Grand Cannann, the Royal Ocean Penthouse represents the gold standard of coastal hospitality. Boasting 1,450 square feet of curated architectural elegance, this master sanctuary features an oversized wrap-around balcony, a heated private whirlpool jacuzzi facing the ocean, bespoke Italian marble bathrooms with rainfall showers, and personalized round-the-clock concierge services.',
            'is_featured' => 1
        ],
        [
            'category_id' => 2,
            'title' => 'Deluxe Horizon Ocean Suite',
            'slug' => 'deluxe-horizon-ocean-suite',
            'price' => 14500.00,
            'discounted_price' => 11999.00,
            'max_adults' => 2,
            'max_children' => 1,
            'bed_type' => '1 Royal King Bed',
            'room_size' => '680 sq.ft',
            'view_type' => 'Direct Oceanfront View',
            'amenities' => 'Private Sea Balcony, Deep Soaking Tub, Free Breakfast Buffet, High-Speed Wi-Fi, 55-inch 4K TV, Mini Bar, Herbal Spa Toiletries, Room Service 24/7',
            'featured_image' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=1000&q=85',
            'gallery_images' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=800&q=80,https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=800&q=80',
            'short_description' => 'Wake up to golden sunrise horizons with an expansive private balcony and artisan handcrafted amenities.',
            'long_description' => 'Indulge in tranquility within our Deluxe Horizon Ocean Suite. Designed for discerning travelers seeking coastal calm, this spacious suite features a signature King plush bed with 600-thread-count Egyptian cotton linens, a private sunlit balcony, deep-soaking bathtub with ocean view, and daily breakfast served in-room or at our ocean terrace.',
            'is_featured' => 1
        ],
        [
            'category_id' => 3,
            'title' => 'Private Pool Botanical Villa',
            'slug' => 'private-pool-botanical-villa',
            'price' => 18500.00,
            'discounted_price' => 15500.00,
            'max_adults' => 2,
            'max_children' => 2,
            'bed_type' => '1 Emperor King Bed',
            'room_size' => '950 sq.ft',
            'view_type' => 'Private Garden & Pool',
            'amenities' => 'Private Plunge Pool, Sun Deck & Cabana, Outdoor Rain Shower, Espresso Bar, Free Wi-Fi, Floating Breakfast Available, Dedicated Villa Host',
            'featured_image' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1000&q=85',
            'gallery_images' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=800&q=80,https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
            'short_description' => 'Secluded tropical sanctuary with private courtyard, crystalline plunge pool, and lush garden cabana.',
            'long_description' => 'Escape into paradise within our Private Pool Botanical Villa. Nestled among blossoming tropical palms and aromatic jasmine gardens, this villa features an intimate temperature-controlled plunge pool, sun-drenched daybeds, an outdoor artisanal shower, and an open-concept living pavilion.',
            'is_featured' => 1
        ],
        [
            'category_id' => 4,
            'title' => 'Grand Heritage Family Suite',
            'slug' => 'grand-heritage-family-suite',
            'price' => 16000.00,
            'discounted_price' => 13499.00,
            'max_adults' => 4,
            'max_children' => 2,
            'bed_type' => '1 King Bed + 2 Queen Beds',
            'room_size' => '850 sq.ft',
            'view_type' => 'Courtyard & Pool View',
            'amenities' => '2 En-suite Bathrooms, Kids Welcome Kit, Gaming Console, Free Buffet Breakfast, Connecting Lounge, High-Speed Wi-Fi, 2 Smart TVs',
            'featured_image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85',
            'gallery_images' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80',
            'short_description' => 'Spacious two-bedroom interconnected suite built for effortless luxury family vacations.',
            'long_description' => 'Crafted especially for family holidays, the Grand Heritage Family Suite combines warm contemporary timber aesthetics with two sprawling private bedrooms, an expansive living area, multiple en-suite luxury bathrooms, and bespoke entertainment systems for both adults and children.',
            'is_featured' => 1
        ]
    ];
    $stmt = $mysqli->prepare("INSERT INTO rooms (category_id, title, slug, price, discounted_price, max_adults, max_children, bed_type, room_size, view_type, amenities, featured_image, gallery_images, short_description, long_description, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($rooms as $r) {
        $stmt->bind_param("issddiissssssssi", $r['category_id'], $r['title'], $r['slug'], $r['price'], $r['discounted_price'], $r['max_adults'], $r['max_children'], $r['bed_type'], $r['room_size'], $r['view_type'], $r['amenities'], $r['featured_image'], $r['gallery_images'], $r['short_description'], $r['long_description'], $r['is_featured']);
        $stmt->execute();
    }
}

// Seed Facilities
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM facilities");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $facs = [
        ['Infinity Oceanfront Pool', 'fa-solid fa-water-ladder', 'Temperature-controlled infinity pool overlooking the ocean with submerged lounge sunbeds.', 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?auto=format&fit=crop&w=800&q=80', 1],
        ['Ayurveda & Luxury Spa', 'fa-solid fa-spa', 'Holistic wellness treatments, aromatic steam baths, and organic revitalizing therapies.', 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80', 2],
        ['Fine Dining & Coastal Bar', 'fa-solid fa-utensils', 'Award-winning Michelin-trained chefs preparing fresh seafood and international delicacies.', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80', 3],
        ['24/7 Concierge & Valet', 'fa-solid fa-bell-concierge', 'Dedicated private assistance, luxury airport transfers, and customized local sightseeing.', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 4],
        ['Fitness & Yoga Pavilion', 'fa-solid fa-dumbbell', 'State-of-the-art cardiovascular studio with sunrise ocean yoga masters.', 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80', 5],
        ['Grand Banquet & Conference', 'fa-solid fa-champagne-glasses', 'Sophisticated ocean-view ballrooms for memorable weddings, galas, and VIP corporate summits.', 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=800&q=80', 6]
    ];
    $stmt = $mysqli->prepare("INSERT INTO facilities (title, icon, short_description, image, sort_order) VALUES (?, ?, ?, ?, ?)");
    foreach ($facs as $f) {
        $stmt->bind_param("ssssi", $f[0], $f[1], $f[2], $f[3], $f[4]);
        $stmt->execute();
    }
}

// Seed Restaurant Categories
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM restaurant_categories");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $rcats = [
        ['Signature Starters', 'starters', 'Artisan appetizers & freshly caught coastal delicacies', 1],
        ['Main Course & Steaks', 'main-course', 'Wood-fired specialties, prime steaks and curry heritage', 2],
        ['Decadent Desserts', 'desserts', 'Handcrafted pastries, molten treats and organic gelato', 3],
        ['Artisan Cocktails & Wines', 'beverages', 'Cellar vintage wines, single malts, and signature cocktails', 4]
    ];
    $stmt = $mysqli->prepare("INSERT INTO restaurant_categories (name, slug, description, sort_order) VALUES (?, ?, ?, ?)");
    foreach ($rcats as $rc) {
        $stmt->bind_param("sssi", $rc[0], $rc[1], $rc[2], $rc[3]);
        $stmt->execute();
    }
}

// Seed Restaurant Items
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM restaurant_items");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $items = [
        [1, 'Grilled Lobster with Herb Garlic Butter', 'Wild caught jumbo coastal lobster tail seared on charcoal with thyme infused French butter and roasted asparagus.', 1850.00, 'non-veg', 'Chef Special', 'https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?auto=format&fit=crop&w=600&q=80', 1],
        [1, 'Truffle Burrata & Heirloom Tomatoes', 'Fresh creamy burrata cheese served with organic heirloom tomatoes, aged balsamic reduction and basil crisp.', 850.00, 'veg', 'Popular', 'https://images.unsplash.com/photo-1592417817098-8f3d6eb22509?auto=format&fit=crop&w=600&q=80', 1],
        [2, 'Seared Norwegian Salmon Fillet', 'Crisp skin pan-seared salmon resting over saffron cauliflower puree, baby leeks, and lemon caper drizzle.', 1450.00, 'non-veg', 'Signature', 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?auto=format&fit=crop&w=600&q=80', 1],
        [2, 'Royal Saffron Paneer Lababdar', 'Charcoal-grilled cottage cheese in a rich velvet cashew, saffron and heirloom tomato gravy with truffle naan.', 790.00, 'veg', 'Must Try', 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=600&q=80', 1],
        [3, 'Valrhona Dark Chocolate Lava Tart', '70% French dark chocolate warm ganache center accompanied by Bourbon vanilla bean gelato.', 550.00, 'veg', 'Decadent', 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&fit=crop&w=600&q=80', 0],
        [4, 'Grand Sapphire Smoked Old Fashioned', '12-year single malt, aromatic Angostura bitters, flamed orange peel, and oak wood smoke dome infusion.', 950.00, 'veg', 'House Special', 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=600&q=80', 1]
    ];
    $stmt = $mysqli->prepare("INSERT INTO restaurant_items (category_id, name, description, price, dietary_type, badge, image, is_special) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($items as $it) {
        $stmt->bind_param("issdsssi", $it[0], $it[1], $it[2], $it[3], $it[4], $it[5], $it[6], $it[7]);
        $stmt->execute();
    }
}

// Seed Tourist Blogs with FULL SEO Setup
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM blogs");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $blogs = [
        [
            'title' => 'Top 7 Hidden Coastal Treasures & Beaches Around Grand Cannann',
            'slug' => 'top-7-hidden-coastal-treasures-and-beaches',
            'category' => 'Tourist Guide',
            'featured_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=85',
            'author_name' => 'Aditya Sharma, Travel Concierge',
            'read_time' => '6 min read',
            'summary' => 'Uncover secluded turquoise lagoons, pristine golden sand shores, and vibrant sea turtle nesting points just minutes from the resort.',
            'content' => '<p>The coastline surrounding Grand Cannann is one of the world’s best-kept secrets. While popular tourist hubs often draw large crowds, our boutique resort sits quietly adjacent to untouched sands and serene tidal coves where you can experience untouched natural beauty.</p><h3>1. Secret Cove of Kovalam Lighthouse</h3><p>Rising majestically above the coastline, the historic lighthouse offers 360-degree panoramic views across the turquoise bay. Take an early morning walking trail from our resort before the sun peaks to experience dolphins breaching the morning waves.</p><h3>2. Ancient Heritage Temple Trails</h3><p>Only a 20-minute drive from our private gates lies centuries-old UNESCO world heritage stone monuments, carved directly into seaside granite cliffs.</p><h3>3. Sunset Catamaran Cruises</h3><p>Grand Cannann concierge arranges private sunset catamaran voyages complete with sparkling wine, artisanal cheese platters, and experienced local skippers.</p>',
            'meta_title' => '7 Secret Coastal Spots & Beaches Near Grand Cannann | Luxury Travel Guide',
            'meta_keywords' => 'coastal beaches, tourist guide chennai, grand cannann travel, secret beach covelong, catamaran cruise, boutique resort attractions',
            'meta_description' => 'Explore the top 7 hidden beaches, historic lighthouses, and coastal nature trails near Grand Cannann Resort. Read our curated luxury travel guide.'
        ],
        [
            'title' => 'The Ultimate Guide to Coastal Seafood & Fine Dining Etiquette',
            'slug' => 'ultimate-guide-to-coastal-seafood-and-fine-dining',
            'category' => 'Culinary Experiences',
            'featured_image' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=1000&q=85',
            'author_name' => 'Executive Chef Laurent Petit',
            'read_time' => '5 min read',
            'summary' => 'Discover how our award-winning culinary masters source fresh seafood at daybreak to craft world-class gastronomic magic.',
            'content' => '<p>True luxury dining starts with impeccable ingredients. At Grand Cannann’s signature restaurant, our chefs work directly with generational local fishermen at 5:00 AM every morning to select only the finest tiger prawns, reef lobsters, and wild seabass.</p><h3>The Art of Seafood Pairing</h3><p>Pairing delicate fish with bold vintage wines requires deep mastery. Our in-house sommelier explains how crisp Sauvignon Blancs and vintage mineral Chardonnays bring out the sweet, briny notes of charcoal-grilled shellfish.</p>',
            'meta_title' => 'Coastal Fine Dining & Seafood Mastery at Grand Cannann Hotel',
            'meta_keywords' => 'fine dining seafood, michelin cuisine, wine pairing, grand cannann restaurant, fresh coastal food, luxury dining guide',
            'meta_description' => 'Discover the culinary secrets and wine pairings behind Grand Cannann’s award-winning coastal seafood restaurant. Curated by Executive Chef Laurent.'
        ],
        [
            'title' => 'Holistic Wellness: Ancient Ayurvedic Secrets for Modern Rejuvenation',
            'slug' => 'holistic-wellness-ancient-ayurvedic-secrets',
            'category' => 'Spa & Wellness',
            'featured_image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1000&q=85',
            'author_name' => 'Dr. Maya Varma, Lead Ayurveda Specialist',
            'read_time' => '4 min read',
            'summary' => 'Realign your mind, body, and soul through customized herbal oil therapies, sound bath healing, and sunrise ocean meditation.',
            'content' => '<p>In an age of constant digital notifications and urban hustle, genuine relaxation is the ultimate luxury. The Sanctuary Spa at Grand Cannann is dedicated to ancient Ayurvedic healing philosophies refined over 5,000 years.</p><h3>Signature Shirodhara Rituals</h3><p>Warm herbal oils infused with 24 rare botanical herbs gently cascade over the forehead, balancing energy points and releasing accumulated stress.</p>',
            'meta_title' => 'Ayurvedic Wellness & Spa Rejuvenation | Grand Cannann Spa',
            'meta_keywords' => 'ayurvedic spa, luxury wellness resort, shirodhara therapy, sunrise ocean yoga, sound bath meditation, detox retreat',
            'meta_description' => 'Experience transformative Ayurvedic spa treatments and sunrise ocean meditation at Grand Cannann Resort. Rejuvenate mind, body, and soul.'
        ]
    ];
    $stmt = $mysqli->prepare("INSERT INTO blogs (title, slug, category, featured_image, author_name, read_time, summary, content, meta_title, meta_keywords, meta_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($blogs as $b) {
        $stmt->bind_param("sssssssssss", $b['title'], $b['slug'], $b['category'], $b['featured_image'], $b['author_name'], $b['read_time'], $b['summary'], $b['content'], $b['meta_title'], $b['meta_keywords'], $b['meta_description']);
        $stmt->execute();
    }
}

// Seed Promotions
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM promotions");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $promos = [
        [
            'title' => 'Romantic Sunset & Honeymoon Escape',
            'badge' => 'SPECIAL RETREAT',
            'discount_text' => 'Complimentary Jacuzzi Spa + 25% Off',
            'promo_code' => 'ROMANCE25',
            'banner_image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1000&q=85',
            'description' => 'Includes luxury ocean suite upgrade, candlelit private beach dinner, bottle of Moët Champagne, and unlimited spa access for couples.',
            'valid_until' => '2026-12-31'
        ],
        [
            'title' => 'Weekend Extended Family Vacation Package',
            'badge' => 'FAMILY SPECIAL',
            'discount_text' => 'Stay 3 Nights, Pay for 2',
            'promo_code' => 'FAMILYSTAY',
            'banner_image' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=1000&q=85',
            'description' => 'Complimentary full English & South Indian breakfast buffet daily, kids club entry, and free airport luxury transfers.',
            'valid_until' => '2026-11-30'
        ]
    ];
    $stmt = $mysqli->prepare("INSERT INTO promotions (title, badge, discount_text, promo_code, banner_image, description, valid_until) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($promos as $p) {
        $stmt->bind_param("sssssss", $p['title'], $p['badge'], $p['discount_text'], $p['promo_code'], $p['banner_image'], $p['description'], $p['valid_until']);
        $stmt->execute();
    }
}

// Seed Gallery
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM gallery");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $gallery = [
        ['The Grand Aerial View', 'hotel', 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=800&q=80', 'Coastal resort grounds at dusk'],
        ['Presidential Ocean Suite', 'rooms', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80', 'Master bedroom with ocean panoramic glass'],
        ['The Sapphire Restaurant', 'restaurant', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80', 'Fine dining candlelit interior'],
        ['Infinity Ocean Pool', 'spa', 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?auto=format&fit=crop&w=800&q=80', 'Heated infinity pool facing the horizon'],
        ['Botanical Villa Courtyard', 'rooms', 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=800&q=80', 'Private villa with plunge pool'],
        ['Artisan Cocktail Bar', 'restaurant', 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=800&q=80', 'Curated cocktail creations by mixologists'],
        ['Grand Banquet & Wedding Lawn', 'events', 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=800&q=80', 'Luxury beachfront celebration setup'],
        ['Ayurveda Sanctuary Spa', 'spa', 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80', 'Aromatherapy treatment pavilions']
    ];
    $stmt = $mysqli->prepare("INSERT INTO gallery (title, category, image, caption) VALUES (?, ?, ?, ?)");
    foreach ($gallery as $g) {
        $stmt->bind_param("ssss", $g[0], $g[1], $g[2], $g[3]);
        $stmt->execute();
    }
}

// Seed Testimonials
$chk = $mysqli->query("SELECT COUNT(*) as cnt FROM testimonials");
$row = $chk->fetch_assoc();
if ($row['cnt'] == 0) {
    $tests = [
        ['Eleanor Vance', 'Luxury Travel Writer', 'London, United Kingdom', 5, 'Grand Cannann exceeded every expectation. From the personal butler service to the immaculate ocean sunsets from our suite balcony, it is truly one of the finest boutique properties in Asia.', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80'],
        ['David & Sarah Miller', 'Honeymoon Guests', 'Sydney, Australia', 5, 'The Private Pool Villa was like stepping into heaven on earth. The food at Sapphire Restaurant was Michelin-worthy, especially the grilled lobster and truffle burrata. Unforgettable experience!', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80'],
        ['Dr. Rajeshwari Sundaram', 'Corporate Executive', 'Bengaluru, India', 5, 'Our leadership summit here was executed flawlessly. High speed internet, world class banquet facilities, and calming spa sessions in the evening. Highly recommended!', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80']
    ];
    $stmt = $mysqli->prepare("INSERT INTO testimonials (guest_name, designation, location, rating, review, avatar) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($tests as $t) {
        $stmt->bind_param("sssiss", $t[0], $t[1], $t[2], $t[3], $t[4], $t[5]);
        $stmt->execute();
    }
}

echo "Database tables created and seeded successfully!\n";
