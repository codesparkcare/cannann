<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sync_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->dbforge();
        $this->load->dbutil();
    }

    /**
     * Get list of database tables and metadata
     */
    public function get_tables_overview() {
        $db_name = $this->db->database;
        $sql = "SELECT 
                    TABLE_NAME as name, 
                    ENGINE as engine, 
                    TABLE_ROWS as rows_count, 
                    DATA_LENGTH as data_length, 
                    INDEX_LENGTH as index_length, 
                    TABLE_COLLATION as collation, 
                    CREATE_TIME as created_at, 
                    UPDATE_TIME as updated_at 
                FROM information_schema.TABLES 
                WHERE TABLE_SCHEMA = ?";
        
        $query = $this->db->query($sql, array($db_name));
        return $query ? $query->result_array() : array();
    }

    /**
     * Run full schema synchronization: ensures all required tables exist
     */
    public function sync_all_schemas() {
        $results = array();

        $schemas = array(
            'site_settings' => "CREATE TABLE IF NOT EXISTS `site_settings` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `hotel_name` varchar(200) NOT NULL DEFAULT 'Grand Cannann Hotel',
                `hotel_tagline` varchar(255) DEFAULT 'Luxury Accommodation & Fine Dining',
                `hotel_email` varchar(150) DEFAULT 'info@hotelcanaann.com',
                `hotel_phone` varchar(50) DEFAULT '+91 98765 43210',
                `hotel_alt_phone` varchar(50) DEFAULT '',
                `hotel_address` text DEFAULT NULL,
                `map_iframe` text DEFAULT NULL,
                `facebook_url` varchar(255) DEFAULT '',
                `instagram_url` varchar(255) DEFAULT '',
                `twitter_url` varchar(255) DEFAULT '',
                `tripadvisor_url` varchar(255) DEFAULT '',
                `hotel_logo` varchar(255) DEFAULT '',
                `hotel_favicon` varchar(255) DEFAULT '',
                `meta_title` varchar(255) DEFAULT 'Grand Cannann | Luxury Boutique Hotel',
                `meta_description` text DEFAULT NULL,
                `meta_keywords` varchar(255) DEFAULT 'hotel, luxury stay, dining, resort',
                `smtp_host` varchar(150) DEFAULT '',
                `smtp_port` int(11) DEFAULT 587,
                `smtp_user` varchar(150) DEFAULT '',
                `smtp_pass` varchar(255) DEFAULT '',
                `smtp_crypto` varchar(20) DEFAULT 'tls',
                `smtp_from_email` varchar(150) DEFAULT 'reservations@hotelcanaann.com',
                `smtp_from_name` varchar(150) DEFAULT 'Grand Cannann Hotel',
                `currency_symbol` varchar(10) DEFAULT '₹',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'admin_users' => "CREATE TABLE IF NOT EXISTS `admin_users` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(100) NOT NULL,
                `email` varchar(150) NOT NULL,
                `password` varchar(255) NOT NULL,
                `name` varchar(150) DEFAULT 'Admin Manager',
                `role` varchar(50) DEFAULT 'superadmin',
                `status` enum('active','inactive') DEFAULT 'active',
                `last_login` datetime DEFAULT NULL,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_username` (`username`),
                UNIQUE KEY `uniq_email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'sliders' => "CREATE TABLE IF NOT EXISTS `sliders` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(255) NOT NULL,
                `subtitle` varchar(255) DEFAULT NULL,
                `button_text` varchar(100) DEFAULT 'Explore Rooms',
                `button_link` varchar(255) DEFAULT 'rooms',
                `image` varchar(255) NOT NULL,
                `sort_order` int(11) DEFAULT 0,
                `status` enum('active','inactive') DEFAULT 'active',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'room_categories' => "CREATE TABLE IF NOT EXISTS `room_categories` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(150) NOT NULL,
                `slug` varchar(150) NOT NULL,
                `description` text DEFAULT NULL,
                `image` varchar(255) DEFAULT NULL,
                `status` enum('active','inactive') DEFAULT 'active',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_slug` (`slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'rooms' => "CREATE TABLE IF NOT EXISTS `rooms` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `category_id` int(11) DEFAULT NULL,
                `title` varchar(200) NOT NULL,
                `slug` varchar(200) NOT NULL,
                `price_per_night` decimal(10,2) NOT NULL DEFAULT 0.00,
                `capacity` varchar(50) DEFAULT '2 Guests',
                `bed_type` varchar(100) DEFAULT 'King Size Bed',
                `room_size` varchar(50) DEFAULT '350 sq.ft',
                `view_type` varchar(100) DEFAULT 'City / Garden View',
                `short_description` text DEFAULT NULL,
                `description` longtext DEFAULT NULL,
                `featured_image` varchar(255) NOT NULL,
                `gallery_images` text DEFAULT NULL,
                `amenities` text DEFAULT NULL,
                `is_featured` tinyint(1) DEFAULT 0,
                `status` enum('available','booked','maintenance') DEFAULT 'available',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_room_slug` (`slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'facilities' => "CREATE TABLE IF NOT EXISTS `facilities` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(150) NOT NULL,
                `icon` varchar(100) DEFAULT 'fa-solid fa-star',
                `image` varchar(255) DEFAULT NULL,
                `description` text DEFAULT NULL,
                `is_featured` tinyint(1) DEFAULT 1,
                `status` enum('active','inactive') DEFAULT 'active',
                `sort_order` int(11) DEFAULT 0,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'restaurant_categories' => "CREATE TABLE IF NOT EXISTS `restaurant_categories` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(150) NOT NULL,
                `slug` varchar(150) NOT NULL,
                `description` text DEFAULT NULL,
                `status` enum('active','inactive') DEFAULT 'active',
                `sort_order` int(11) DEFAULT 0,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_rcat_slug` (`slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'restaurant_items' => "CREATE TABLE IF NOT EXISTS `restaurant_items` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `category_id` int(11) NOT NULL,
                `name` varchar(200) NOT NULL,
                `description` text DEFAULT NULL,
                `price` decimal(10,2) NOT NULL DEFAULT 0.00,
                `image` varchar(255) DEFAULT NULL,
                `is_vegetarian` tinyint(1) DEFAULT 0,
                `is_special` tinyint(1) DEFAULT 0,
                `is_available` tinyint(1) DEFAULT 1,
                `sort_order` int(11) DEFAULT 0,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'table_reservations' => "CREATE TABLE IF NOT EXISTS `table_reservations` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(150) NOT NULL,
                `email` varchar(150) NOT NULL,
                `phone` varchar(50) NOT NULL,
                `reservation_date` date NOT NULL,
                `reservation_time` varchar(50) NOT NULL,
                `guests` int(11) NOT NULL DEFAULT 2,
                `special_request` text DEFAULT NULL,
                `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'blogs' => "CREATE TABLE IF NOT EXISTS `blogs` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(255) NOT NULL,
                `slug` varchar(255) NOT NULL,
                `content` longtext NOT NULL,
                `excerpt` text DEFAULT NULL,
                `featured_image` varchar(255) NOT NULL,
                `author` varchar(150) DEFAULT 'Hotel Concierge',
                `tags` varchar(255) DEFAULT '',
                `meta_title` varchar(255) DEFAULT '',
                `meta_description` text DEFAULT NULL,
                `views` int(11) DEFAULT 0,
                `status` enum('published','draft') DEFAULT 'published',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_blog_slug` (`slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'gallery' => "CREATE TABLE IF NOT EXISTS `gallery` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(150) NOT NULL,
                `category` varchar(100) DEFAULT 'Rooms',
                `image` varchar(255) NOT NULL,
                `sort_order` int(11) DEFAULT 0,
                `status` enum('active','inactive') DEFAULT 'active',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'promotions' => "CREATE TABLE IF NOT EXISTS `promotions` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(200) NOT NULL,
                `slug` varchar(200) NOT NULL,
                `discount_percentage` int(11) DEFAULT 0,
                `promo_code` varchar(50) DEFAULT '',
                `valid_from` date DEFAULT NULL,
                `valid_until` date DEFAULT NULL,
                `image` varchar(255) DEFAULT NULL,
                `description` text DEFAULT NULL,
                `terms` text DEFAULT NULL,
                `status` enum('active','inactive') DEFAULT 'active',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_promo_slug` (`slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'bookings' => "CREATE TABLE IF NOT EXISTS `bookings` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `booking_code` varchar(50) NOT NULL,
                `room_id` int(11) NOT NULL,
                `guest_name` varchar(150) NOT NULL,
                `guest_email` varchar(150) NOT NULL,
                `guest_phone` varchar(50) NOT NULL,
                `check_in` date NOT NULL,
                `check_out` date NOT NULL,
                `adults` int(11) DEFAULT 1,
                `children` int(11) DEFAULT 0,
                `rooms_count` int(11) DEFAULT 1,
                `total_amount` decimal(10,2) DEFAULT 0.00,
                `special_requests` text DEFAULT NULL,
                `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
                `payment_status` enum('pending','paid','refunded') DEFAULT 'pending',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_booking_code` (`booking_code`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'contacts' => "CREATE TABLE IF NOT EXISTS `contacts` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(150) NOT NULL,
                `email` varchar(150) NOT NULL,
                `phone` varchar(50) DEFAULT '',
                `subject` varchar(200) DEFAULT '',
                `message` text NOT NULL,
                `status` enum('unread','read','replied') DEFAULT 'unread',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'testimonials' => "CREATE TABLE IF NOT EXISTS `testimonials` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `guest_name` varchar(150) NOT NULL,
                `guest_title` varchar(150) DEFAULT 'Verified Guest',
                `avatar` varchar(255) DEFAULT NULL,
                `rating` int(11) DEFAULT 5,
                `review` text NOT NULL,
                `status` enum('active','inactive') DEFAULT 'active',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'staff_table' => "CREATE TABLE IF NOT EXISTS `staff_table` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(150) NOT NULL,
                `role` varchar(100) DEFAULT 'Staff Member',
                `phone` varchar(50) DEFAULT '',
                `email` varchar(150) DEFAULT '',
                `address` text DEFAULT NULL,
                `salary` decimal(10,2) DEFAULT 0.00,
                `join_date` date DEFAULT NULL,
                `status` enum('active','inactive') DEFAULT 'active',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'hostel_table' => "CREATE TABLE IF NOT EXISTS `hostel_table` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `room_number` varchar(50) NOT NULL,
                `type` varchar(100) DEFAULT 'Standard Dorm',
                `capacity` int(11) DEFAULT 4,
                `price` decimal(10,2) DEFAULT 0.00,
                `status` enum('available','occupied','maintenance') DEFAULT 'available',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        foreach ($schemas as $table_name => $sql) {
            $table_existed = $this->db->table_exists($table_name);
            $this->db->query($sql);
            $results[] = array(
                'table'   => $table_name,
                'status'  => $table_existed ? 'Verified & In Sync' : 'Created & Synced',
                'existed' => $table_existed
            );
        }

        // Ensure default settings row exists
        $settings_count = $this->db->count_all('site_settings');
        if ($settings_count === 0) {
            $this->db->insert('site_settings', array(
                'id'            => 1,
                'hotel_name'    => 'Grand Cannann Hotel',
                'hotel_tagline' => 'Luxury Stay & Exquisite Culinary Experience',
                'hotel_email'   => 'info@hotelcanaann.com',
                'hotel_phone'   => '+91 98765 43210',
                'hotel_address' => 'Grand Cannann Highway Road, City Center',
                'created_at'    => date('Y-m-d H:i:s')
            ));
        }

        // Ensure default admin user exists
        $admin_count = $this->db->count_all('admin_users');
        if ($admin_count === 0) {
            $this->db->insert('admin_users', array(
                'username'   => 'admin',
                'email'      => 'admin@hotelcanaann.com',
                'password'   => password_hash('Admin@123', PASSWORD_BCRYPT),
                'name'       => 'Super Admin',
                'role'       => 'superadmin',
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ));
        }

        return $results;
    }

    /**
     * Optimize all tables in current database
     */
    public function optimize_all_tables() {
        $tables = $this->db->list_tables();
        $results = array();
        foreach ($tables as $table) {
            $this->dbutil->optimize_table($table);
            $results[] = $table;
        }
        return $results;
    }

    /**
     * Generate complete SQL Dump string
     */
    public function export_sql_dump() {
        $prefs = array(
            'format'             => 'txt',
            'filename'           => 'cannann_database_dump.sql',
            'add_drop'           => TRUE,
            'add_insert'         => TRUE,
            'newline'            => "\n",
            'foreign_key_checks' => FALSE
        );
        return $this->dbutil->backup($prefs);
    }

    /**
     * Import and execute SQL script
     */
    public function import_sql_script($sql_content) {
        // Strip comments and split by semicolon
        $lines = explode("\n", $sql_content);
        $clean_sql = '';
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (empty($trimmed) || strpos($trimmed, '--') === 0 || strpos($trimmed, '/*') === 0) {
                continue;
            }
            $clean_sql .= $line . "\n";
        }

        $statements = explode(";\n", $clean_sql);
        $executed = 0;
        $errors = array();

        $this->db->trans_start();
        foreach ($statements as $statement) {
            $statement = trim($statement);
            if (!empty($statement)) {
                $query = $this->db->query($statement);
                if ($query) {
                    $executed++;
                } else {
                    $err = $this->db->error();
                    if (!empty($err['message'])) {
                        $errors[] = $err['message'];
                    }
                }
            }
        }
        $this->db->trans_complete();

        return array(
            'success'  => $this->db->trans_status(),
            'executed' => $executed,
            'errors'   => $errors
        );
    }

    /**
     * Seed baseline sample data if tables are empty
     */
    public function seed_sample_data() {
        $seeded = array();

        // 1. Room Categories
        if ($this->db->count_all('room_categories') === 0) {
            $categories = array(
                array('name' => 'Deluxe Suite', 'slug' => 'deluxe-suite', 'description' => 'Luxurious spacious suite with panoramic city views and premium bedding.', 'status' => 'active'),
                array('name' => 'Executive Room', 'slug' => 'executive-room', 'description' => 'Designed for discerning travelers with high-speed internet and ergonomic workspace.', 'status' => 'active'),
                array('name' => 'Presidential Suite', 'slug' => 'presidential-suite', 'description' => 'The epitome of grandeur featuring private balcony, jacuzzi, and butler service.', 'status' => 'active'),
                array('name' => 'Family Premium', 'slug' => 'family-premium', 'description' => 'Interconnecting family rooms with comfortable twin and king arrangements.', 'status' => 'active')
            );
            $this->db->insert_batch('room_categories', $categories);
            $seeded[] = '4 Room Categories';
        }

        // 2. Facilities
        if ($this->db->count_all('facilities') === 0) {
            $facilities = array(
                array('title' => 'Fine Dining Restaurant', 'icon' => 'fa-solid fa-utensils', 'description' => 'Gourmet delicacies crafted by world-class master chefs.', 'is_featured' => 1, 'status' => 'active', 'sort_order' => 1),
                array('title' => 'Infinity Pool', 'icon' => 'fa-solid fa-person-swimming', 'description' => 'Temperature-controlled rooftop pool with sunset panorama.', 'is_featured' => 1, 'status' => 'active', 'sort_order' => 2),
                array('title' => 'Luxury Wellness Spa', 'icon' => 'fa-solid fa-spa', 'description' => 'Rejuvenating massages, aromatherapies, and holistic treatments.', 'is_featured' => 1, 'status' => 'active', 'sort_order' => 3),
                array('title' => '24/7 Concierge & Valet', 'icon' => 'fa-solid fa-bell-concierge', 'description' => 'Personalized travel planning, airport transfers, and luggage assistance.', 'is_featured' => 1, 'status' => 'active', 'sort_order' => 4)
            );
            $this->db->insert_batch('facilities', $facilities);
            $seeded[] = '4 Hotel Facilities';
        }

        // 3. Restaurant Categories
        if ($this->db->count_all('restaurant_categories') === 0) {
            $rcats = array(
                array('name' => 'Starters & Appetizers', 'slug' => 'starters-appetizers', 'description' => 'Fresh savory beginnings', 'status' => 'active', 'sort_order' => 1),
                array('name' => 'Chef Specials & Main Course', 'slug' => 'main-course', 'description' => 'Hearty gourmet entrees', 'status' => 'active', 'sort_order' => 2),
                array('name' => 'Artisanal Desserts', 'slug' => 'desserts', 'description' => 'Decadent sweet endings', 'status' => 'active', 'sort_order' => 3),
                array('name' => 'Signature Beverages', 'slug' => 'beverages', 'description' => 'Craft cocktails & brewed coffees', 'status' => 'active', 'sort_order' => 4)
            );
            $this->db->insert_batch('restaurant_categories', $rcats);
            $seeded[] = '4 Restaurant Categories';
        }

        return $seeded;
    }
}
