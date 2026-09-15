-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: cannann
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT 'Admin Manager',
  `role` varchar(50) NOT NULL DEFAULT 'superadmin',
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','admin@hotelcanaann.com','$2y$10$m63uogQNYoBVXfl75BYxBu3os7DwhlkTdVHRhea3MMmUsPT..zILS','Hotel General Manager','superadmin','active','2026-09-15 10:58:57','2026-09-05 02:58:13','2026-09-05 02:58:13');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT 'Travel & Tourism',
  `featured_image` varchar(255) NOT NULL,
  `author_name` varchar(100) DEFAULT 'Chief Concierge',
  `read_time` varchar(30) DEFAULT '5 min read',
  `summary` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `views_count` int(11) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 1,
  `status` enum('published','draft') DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,'Padmanabhapuram Palace ÔÇô A Journey Through Royal Heritage','padmanabhapuram-palace-a-journey-through-royal-heritage','Tourist Guide','uploads/blogs/padmanabhapuram-palace.jpg','Chief Concierge','5 min read','Discover the magnificent Padmanabhapuram Palace, an impressive heritage destination near Nagercoil known for its traditional architecture, intricate wood carvings, murals, historic halls, and connection to the Travancore royal family.','<p>Padmanabhapuram Palace is one of the most remarkable heritage attractions near Nagercoil and is an excellent destination for travellers interested in history, architecture, and South Indian culture. Located near Thuckalay, the palace was an important royal residence of the Travancore Kingdom and remains surrounded by the historic Padmanabhapuram Fort.</p><p>Visitors can explore beautifully designed halls, traditional wooden structures, carved ceilings, murals, and historic interiors that showcase the craftsmanship of an earlier era. The Mantrasala, dining hall, clock tower, and other sections of the palace provide an interesting glimpse into royal life and traditional architecture.</p><p>The palace is particularly appealing to guests looking for a peaceful cultural experience away from the busy city. Its historic atmosphere and beautiful surroundings make it a wonderful addition to a Nagercoil sightseeing itinerary.</p><p>For hotel guests planning a day trip, Padmanabhapuram Palace can be combined with other nearby attractions such as Udayagiri Fort and Thirparappu Waterfalls. The official district tourism information places the palace about 15 km from Nagercoil, while local tourism sources provide nearby-distance estimates.</p>','Padmanabhapuram Palace Near Nagercoil | Tourist Guide','Padmanabhapuram Palace, places near Nagercoil, Nagercoil tourist places, Nagercoil sightseeing','Explore Padmanabhapuram Palace near Nagercoil, a historic royal residence featuring traditional architecture, wood carvings, murals, and Travancore heritage.',1,1,'published','2026-09-15 05:48:06','2026-09-15 06:14:02'),(2,'Thirparappu Waterfalls ÔÇô A Refreshing Escape Near Nagercoil','thirparappu-waterfalls-a-refreshing-escape-near-nagercoil','Tourist Guide','uploads/blogs/thirparappu-waterfalls.jpg','Chief Concierge','5 min read','Experience the natural beauty of Thirparappu Waterfalls, a popular getaway near Nagercoil where flowing water, green landscapes, rocky surroundings, and peaceful scenery create a refreshing day-trip experience.','<p>Thirparappu Waterfalls is a popular natural attraction in Kanniyakumari District and an enjoyable destination for travellers staying in and around Nagercoil. Surrounded by greenery and rocky landscapes, the waterfall offers visitors an opportunity to enjoy nature away from the busy city environment.</p><p>The Kodayar River creates the waterfall, with water flowing over a rocky stretch and creating a scenic view. The area around the falls is especially attractive during periods when the water flow is good. Visitors can enjoy the surrounding landscape, spend time with family, and take photographs of the natural scenery.</p><p>A temple dedicated to Lord Shiva is located near the waterfall, adding a cultural element to the visit. A children\'s swimming pool is also available at the tourist area, making the destination suitable for families.</p><p>Thirparappu is a good choice for travellers looking for a combination of nature, relaxation, and sightseeing. Guests staying at your hotel can plan it as a half-day or full-day outing and explore other attractions in the surrounding region.</p><p>With its green surroundings and refreshing atmosphere, Thirparappu Waterfalls can be one of the memorable experiences during a Nagercoil holiday.</p>','Thirparappu Waterfalls Near Nagercoil | Travel Guide','Thirparappu Waterfalls, tourist places near Nagercoil, Nagercoil tourist guide, places to visit near Nagercoil','Visit Thirparappu Waterfalls near Nagercoil and enjoy beautiful natural scenery, flowing water, greenery, family-friendly surroundings, and nearby attractions.',1,1,'published','2026-09-15 05:48:06','2026-09-15 06:14:02'),(3,'Muttom Beach ÔÇô A Beautiful Coastal Escape Near Nagercoil','muttom-beach-a-beautiful-coastal-escape-near-nagercoil','Tourist Guide','uploads/blogs/muttom-beach.jpg','Chief Concierge','5 min read','Enjoy the beauty of Muttom Beach near Nagercoil, known for its rocky coastline, sea views, lighthouse heritage, and spectacular sunset scenery.','<p>Muttom Beach is a scenic coastal destination near Nagercoil and a wonderful choice for travellers who enjoy beaches, photography, sea views, and peaceful sunset experiences. Unlike beaches with long stretches of flat sand, Muttom is known for its distinctive rocky shoreline, which gives the destination a dramatic and beautiful appearance.</p><p>The beach is also associated with an historic lighthouse, adding a touch of heritage to the coastal landscape. According to the Nagercoil municipal tourism information, the lighthouse was originally built by the British in 1875. The area is also recognised for its panoramic sunset views.</p><p>Visitors can spend a relaxed evening walking along the coastline, enjoying the sound of the waves, photographing the rocks and sea, or simply watching the sunset. The combination of ocean views and rocky surroundings makes Muttom particularly attractive for couples, families, photographers, and travellers looking for a peaceful escape.</p><p>For guests staying in Nagercoil, Muttom Beach can be included in an itinerary covering other nearby attractions. It is an excellent option for an evening outing, especially for visitors who want to experience the coastal beauty of Kanniyakumari District.</p><p>A visit to Muttom Beach offers a simple but memorable travel experienceÔÇöfresh sea air, beautiful coastal scenery, and a relaxing sunset away from the city\'s busy atmosphere.</p>','Muttom Beach Near Nagercoil | Tourist Guide','Muttom Beach, Nagercoil tourist places, beaches near Nagercoil, Nagercoil sightseeing','Discover Muttom Beach near Nagercoil, known for its rocky coastline, historic lighthouse, beautiful sea views, and spectacular sunset scenery.',1,1,'published','2026-09-15 05:48:06','2026-09-15 06:14:02');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_number` varchar(50) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `room_category_id` int(11) DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `adults` int(11) DEFAULT 2,
  `children` int(11) DEFAULT 0,
  `guest_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `special_requests` text DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_number` (`booking_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'GC-8D35B9',1,NULL,'2026-09-06','2026-09-09',2,0,'Alexander Wright','alexander.wright@luxurytravel.com','+91 99887 76655',59997.00,'Sea facing floor, chilled champagne on arrival','pending','2026-09-03 07:59:52');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Lord Harrison','harrison@estate.co.uk','+44 7700 900077','VIP Suite Booking & Heli Transfer','We wish to book the Royal Penthouse for 7 days next month with private helicopter transfers.','unread','2026-09-03 08:00:14'),(2,'Kyree mkt','kyree.carey@gmail.com','2102102101','Free SEO Audit for hotelcanaann.com ÔÇô Opportunities to Increase Rankings & Traffic','Hello hotelcanaann.com,\r\n\r\nI was reviewing your website and noticed a few SEO and website performance issues that may be affecting your Google rankings, organic traffic, and lead generation.\r\n\r\nI\'d be happy to send you a FREE SEO Audit Report with screenshots and recommendations covering:\r\n\r\nÔÇó SEO errors and technical issues\r\nÔÇó On-page optimization opportunities\r\nÔÇó Website performance and user experience improvements\r\nÔÇó Keyword ranking opportunities\r\nÔÇó Competitor insights and growth recommendations\r\nÔÇó Pricing and implementation options\r\n\r\nThe report is easy to understand and outlines practical steps that could help improve your search engine rankings, increase website traffic, and generate more inquiries.\r\n\r\nIf you\'re interested, simply reply with \"Send the report\", and I\'ll prepare it for you.\r\n\r\nAlternatively, we can schedule a quick 10-minute Google Meet call to discuss the opportunities for hotelcanaann.com.\r\n\r\nBest regards,','unread','2026-09-05 03:31:19'),(3,'jhon','jhon@gmail.com','9876543210','test','test','unread','2026-09-15 10:27:44');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `icon` varchar(100) DEFAULT 'fa-solid fa-hotel',
  `short_description` varchar(255) NOT NULL,
  `full_description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facilities`
--

LOCK TABLES `facilities` WRITE;
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT INTO `facilities` VALUES (1,'Comfortable Rooms','fa-solid fa-bed','Clean, well-maintained rooms with essential amenities for a peaceful and comfortable stay.',NULL,'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?auto=format&fit=crop&w=800&q=80',1,'active','2026-09-03 07:51:53'),(2,'Restaurant & Dining','fa-solid fa-utensils','Enjoy delicious meals, refreshing juices, coffee, falooda, and other beverages at our in-house dining area.',NULL,'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',2,'active','2026-09-03 07:51:53'),(3,'24/7 Front Desk','fa-solid fa-bell-concierge','Our friendly team is available to assist guests with check-in, enquiries, and stay-related requirements.',NULL,'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80',3,'active','2026-09-03 07:51:53'),(4,'Ample Parking','fa-solid fa-square-parking','Convenient parking facilities for guests arriving by car or two-wheeler.',NULL,'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80',4,'active','2026-09-03 07:51:53'),(5,'Family-Friendly Stay','fa-solid fa-people-roof','A welcoming environment with comfortable accommodation suitable for families, couples, and business travellers.',NULL,'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80',5,'active','2026-09-03 07:51:53'),(6,'Convenient Location','fa-solid fa-location-dot','A convenient base for exploring Nagercoil, Kanyakumari, and nearby attractions.',NULL,'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=800&q=80',6,'active','2026-09-03 07:51:53');
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `category` enum('hotel','rooms','restaurant','spa','events') DEFAULT 'hotel',
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (1,'Comfortable Triple Suite','rooms','uploads/gallery/canaan_hotel_room_triple_1.png','Spacious room with three beds, red drapery, and comfortable seating',1,'active','2026-09-14 12:23:43'),(2,'Twin Beds & Custom Headboard','rooms','uploads/gallery/canaan_hotel_room_twin_headboard.png','Clean linens, branded Canaan Hotel pillows, and wooden paneling',2,'active','2026-09-14 12:23:43'),(3,'Prayer & Conference Assembly Hall','events','uploads/gallery/canaan_hotel_prayer_hall.jpg','Spacious auditorium with comfortable tiered seating and ambient art panels',3,'active','2026-09-14 12:23:43'),(4,'Executive Meeting & Seminar Hall','events','uploads/gallery/canaan_hotel_seminar_room.png','Air-conditioned conference space ideal for meetings, seminars, and group discussions',4,'active','2026-09-14 12:23:43'),(5,'In-Room Seating & Entertainment','rooms','uploads/gallery/canaan_hotel_room_seating_area.png','Wood armchairs, coffee table, vanity mirror, and wall TV',5,'active','2026-09-14 12:23:43'),(6,'Lobby & Guest Lounge Area','hotel','uploads/gallery/canaan_hotel_lobby_lounge.jpg','Welcoming lounge chairs and tea table in the main reception area',6,'active','2026-09-14 12:23:43'),(7,'Spotless Guest Corridors','hotel','uploads/gallery/canaan_hotel_corridor.png','Bright, polished corridors providing secure and quiet access to rooms',7,'active','2026-09-14 12:23:43'),(8,'Restaurant & Refreshment Counter','restaurant','uploads/gallery/canaan_hotel_restaurant_counter.jpg','Hot drinks, juices, coffee, falooda ice cream, and delicious dining',8,'active','2026-09-14 12:23:43'),(9,'Spacious Family Triple Room','rooms','uploads/gallery/canaan_hotel_room_triple_2.png','Well-maintained accommodation tailored for families and groups',9,'active','2026-09-14 12:23:43'),(10,'Triple Bedroom Full Layout','rooms','uploads/gallery/canaan_hotel_room_triple_3.png','Bright, peaceful, and clean room interior in Nagercoil',10,'active','2026-09-14 12:23:43'),(11,'Canaan Hotel Daytime Exterior','hotel','uploads/gallery/canaan_hotel_exterior.jpg','Conveniently located in Nagercoil with ample parking and modern architecture',11,'active','2026-09-14 12:23:43'),(12,'Evening Hotel Illumination','hotel','uploads/gallery/canaan_hotel_facade_evening.jpg','Warmly illuminated hotel facade and front entrance',12,'active','2026-09-14 12:23:43');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hostel_table`
--

DROP TABLE IF EXISTS `hostel_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hostel_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` varchar(50) NOT NULL,
  `type` varchar(100) DEFAULT 'Standard Dorm',
  `capacity` int(11) DEFAULT 4,
  `price` decimal(10,2) DEFAULT 0.00,
  `status` enum('available','occupied','maintenance') DEFAULT 'available',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hostel_table`
--

LOCK TABLES `hostel_table` WRITE;
/*!40000 ALTER TABLE `hostel_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `hostel_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `badge` varchar(50) DEFAULT 'Special Offer',
  `discount_text` varchar(100) DEFAULT 'Up to 30% Off',
  `promo_code` varchar(50) DEFAULT 'LUXURY30',
  `banner_image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (1,'Couple & Weekend Getaway','SPECIAL STAY','Peaceful Getaway & Warm Hospitality','WEEKENDSTAY','uploads/gallery/canaan_hotel_room_seating_area.png','Enjoy a peaceful getaway at Canaan Hotel with comfortable rooms, delicious dining, and warm hospitality. A perfect choice for couples and guests looking for a relaxing weekend stay.','2026-12-31','active','2026-09-14 12:35:24'),(2,'Family Stay Package','FAMILY SPECIAL','Comfortable Accommodation & Delicious Meals','FAMILYCANAAN','uploads/gallery/canaan_hotel_room_triple_2.png','Enjoy a comfortable family stay with spacious accommodation, delicious meals, and a relaxing atmosphere. Perfect for families visiting Nagercoil and nearby destinations.','2026-12-31','active','2026-09-14 12:35:24');
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_categories`
--

DROP TABLE IF EXISTS `restaurant_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_categories`
--

LOCK TABLES `restaurant_categories` WRITE;
/*!40000 ALTER TABLE `restaurant_categories` DISABLE KEYS */;
INSERT INTO `restaurant_categories` VALUES (1,'Non-Vegetarian Delights','non-vegetarian','Enjoy flavorful chicken, mutton, fish, and other delicious non-vegetarian specialties prepared with rich spices and authentic flavors.',1,'active'),(2,'Vegetarian Favorites','vegetarian','A tempting selection of fresh and flavorful vegetarian dishes, perfect for a wholesome and satisfying meal.',2,'active'),(3,'Chinese Cuisine','chinese-cuisine','Enjoy popular Chinese favorites featuring flavorful noodles, fried rice, Manchurian dishes, and delicious Indo-Chinese specialties.',3,'active'),(4,'South Indian Specialties','south-indian','Experience authentic South Indian flavors with dosa, idli, parotta, biryani, meals, curries, and other traditional favorites.',4,'active');
/*!40000 ALTER TABLE `restaurant_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_items`
--

DROP TABLE IF EXISTS `restaurant_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `dietary_type` enum('veg','non-veg','vegan') DEFAULT 'non-veg',
  `badge` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT '',
  `is_special` tinyint(1) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_items`
--

LOCK TABLES `restaurant_items` WRITE;
/*!40000 ALTER TABLE `restaurant_items` DISABLE KEYS */;
INSERT INTO `restaurant_items` VALUES (1,1,'Grilled Lobster with Herb Garlic Butter','Wild caught jumbo coastal lobster tail seared on charcoal with thyme infused French butter and roasted asparagus.',1850.00,'non-veg','Chef Special','https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?auto=format&fit=crop&w=600&q=80',1,'active','2026-09-03 07:51:53'),(2,1,'Truffle Burrata & Heirloom Tomatoes','Fresh creamy burrata cheese served with organic heirloom tomatoes, aged balsamic reduction and basil crisp.',850.00,'veg','Popular','https://images.unsplash.com/photo-1592417817098-8f3d6eb22509?auto=format&fit=crop&w=600&q=80',1,'active','2026-09-03 07:51:53'),(3,2,'Seared Norwegian Salmon Fillet','Crisp skin pan-seared salmon resting over saffron cauliflower puree, baby leeks, and lemon caper drizzle.',1450.00,'non-veg','Signature','https://images.unsplash.com/photo-1467003909585-2f8a72700288?auto=format&fit=crop&w=600&q=80',1,'active','2026-09-03 07:51:53'),(4,2,'Royal Saffron Paneer Lababdar','Charcoal-grilled cottage cheese in a rich velvet cashew, saffron and heirloom tomato gravy with truffle naan.',790.00,'veg','Must Try','https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=600&q=80',1,'active','2026-09-03 07:51:53'),(5,3,'Valrhona Dark Chocolate Lava Tart','70% French dark chocolate warm ganache center accompanied by Bourbon vanilla bean gelato.',550.00,'veg','Decadent','https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&fit=crop&w=600&q=80',0,'active','2026-09-03 07:51:53'),(6,4,'Grand Sapphire Smoked Old Fashioned','12-year single malt, aromatic Angostura bitters, flamed orange peel, and oak wood smoke dome infusion.',950.00,'veg','House Special','https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=600&q=80',1,'active','2026-09-03 07:51:53');
/*!40000 ALTER TABLE `restaurant_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_categories`
--

DROP TABLE IF EXISTS `room_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `badge` varchar(50) DEFAULT 'Popular',
  `image` varchar(255) DEFAULT '',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_categories`
--

LOCK TABLES `room_categories` WRITE;
/*!40000 ALTER TABLE `room_categories` DISABLE KEYS */;
INSERT INTO `room_categories` VALUES (1,'Deluxe Rooms','deluxe-rooms','Comfortable Single and Double Deluxe rooms with air conditioning and essential amenities.','Popular','uploads/sliders/79d0bc75dffd2603d547f91443af3493.png','active','2026-09-14 12:52:11'),(2,'Super Deluxe','super-deluxe','Upgraded room with comfortable seating area, coffee table, and modern comforts.','Best Value','uploads/gallery/canaan_hotel_room_seating_area.png','active','2026-09-14 12:52:11'),(3,'Superior Deluxe','superior-deluxe','Spacious room with three individual beds, ideal for friends and small families.','Recommended','uploads/gallery/canaan_hotel_room_triple_1.png','active','2026-09-14 12:52:11'),(4,'Suites','suites','Premium luxury suite with elegant bedroom, parlor seating, and personalized hospitality.','Luxury','uploads/gallery/canaan_hotel_room_triple_2.png','active','2026-09-14 12:52:11'),(5,'Family Deluxe','family-deluxe','Expansive accommodation hosting up to 8 persons with multiple beds for large families.','Family Choice','uploads/gallery/canaan_hotel_room_triple_3.png','active','2026-09-14 12:52:11');
/*!40000 ALTER TABLE `room_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) DEFAULT NULL,
  `max_adults` int(11) DEFAULT 2,
  `max_children` int(11) DEFAULT 1,
  `bed_type` varchar(100) DEFAULT 'King Size Bed',
  `room_size` varchar(50) DEFAULT '450 sq.ft',
  `view_type` varchar(100) DEFAULT 'Panoramic Ocean View',
  `amenities` text DEFAULT NULL,
  `featured_image` varchar(255) NOT NULL,
  `gallery_images` text DEFAULT NULL,
  `short_description` varchar(300) DEFAULT NULL,
  `long_description` longtext DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 1,
  `status` enum('available','booked','maintenance') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,1,'Single Deluxe','single-deluxe',1575.00,1500.00,1,0,'1 Single Bed','220 sq.ft','City View','Complimentary Breakfast, Air Conditioning, Free High-Speed Wi-Fi, Flat-Screen TV, Clean Linens, 24/7 Room Service, Attached Bathroom with Hot Water','uploads/gallery/canaan_hotel_room_twin_headboard.png','uploads/gallery/canaan_hotel_room_twin_headboard.png,uploads/gallery/canaan_hotel_corridor.png','Ideal for solo business travellers and visitors to Nagercoil. Clean, air-conditioned room with complimentary breakfast.','The Single Deluxe Room at Canaan Hotel offers a quiet and peaceful environment designed for solo travellers, business executives, and pilgrims visiting Nagercoil. Featuring comfortable bedding, high-speed Wi-Fi, air conditioning, and complimentary breakfast for online bookings. Extra bed available upon request for Ôé╣500.',1,'available','2026-09-14 12:52:11'),(2,1,'Double Deluxe','double-deluxe',2058.00,1960.00,2,1,'1 Double Bed or 2 Twin Beds','280 sq.ft','City View','Complimentary Breakfast, Air Conditioning, Free High-Speed Wi-Fi, Flat-Screen TV, Tea/Coffee Service, Daily Housekeeping, Hot Water','uploads/sliders/79d0bc75dffd2603d547f91443af3493.png','uploads/sliders/79d0bc75dffd2603d547f91443af3493.png,uploads/gallery/canaan_hotel_room_twin_headboard.png','Comfortable air-conditioned double room for two guests. Includes complimentary breakfast and modern amenities.','Experience cozy comfort in our Double Deluxe Room at Canaan Hotel, Nagercoil. Accommodating up to two persons, this room features clean bedding, pleasant interiors, air conditioning, fast Wi-Fi, and complimentary breakfast for online bookings. Extra bed available for Ôé╣500.',1,'available','2026-09-14 12:52:11'),(3,2,'Super Deluxe','super-deluxe',2362.50,2250.00,2,1,'1 King Bed + Seating Lounge','320 sq.ft','Courtyard View','Complimentary Breakfast, Air Conditioning, Free Wi-Fi, LED TV, Sitting Lounge with Table, Refrigerator, Hot & Cold Water','uploads/gallery/canaan_hotel_room_seating_area.png','uploads/gallery/canaan_hotel_room_seating_area.png,uploads/gallery/canaan_hotel_room_triple_1.png','Spacious accommodation with dedicated armchair seating area, coffee table, and complimentary breakfast.','The Super Deluxe Room offers extra living space and comfort for up to two guests. Relax in the dedicated seating lounge with tea/coffee, enjoy chilled beverages from the in-room refrigerator, and start your day with our complimentary online breakfast. Extra bed available for Ôé╣500.',1,'available','2026-09-14 12:52:11'),(4,3,'Superior Deluxe','superior-deluxe',2677.50,2550.00,3,1,'3 Individual Beds','380 sq.ft','City & Garden View','Complimentary Breakfast, Air Conditioning, Free Wi-Fi, Flat-Screen TV, Triple Bed Setup, Refrigerator, Coffee Table, Extra Bed on Request','uploads/gallery/canaan_hotel_room_triple_1.png','uploads/gallery/canaan_hotel_room_triple_1.png,uploads/gallery/canaan_hotel_room_triple_2.png','Tailored for three guests with three individual comfortable beds, air conditioning, and complimentary breakfast.','The Superior Deluxe Room at Canaan Hotel is perfectly arranged for three adults travelling together for business, vacation, or family functions. Features three separate well-dressed beds, in-room seating, refrigerator, and complimentary online breakfast. Extra bed available for Ôé╣500.',1,'available','2026-09-14 12:52:11'),(5,4,'Suite','suite',3675.00,3500.00,2,2,'1 Grand King Bed + Sofa Suite','450 sq.ft','Panoramic Nagercoil View','Complimentary Breakfast, Air Conditioning, Premium Wi-Fi, Smart TV, Luxurious Seating Area, Refrigerator, Wardrobe, Room Service','uploads/gallery/canaan_hotel_room_triple_2.png','uploads/gallery/canaan_hotel_room_triple_2.png,uploads/gallery/canaan_hotel_room_seating_area.png','Premium suite experience with king bedding, spacious lounge, warm hospitality, and complimentary breakfast.','Our flagship Suite provides an elevated hospitality experience in Nagercoil. Designed for couples and VIP guests seeking spacious elegance, it offers a luxurious bedroom, comfortable parlor seating, modern amenities, and complimentary breakfast. Extra bed available for Ôé╣500.',1,'available','2026-09-14 12:52:12'),(6,5,'Family Deluxe','family-deluxe',6300.00,6000.00,8,2,'Family Setup (Up to 8 Persons)','650 sq.ft','City & Mountain View','Complimentary Breakfast, Air Conditioning, Free Wi-Fi, Multiple Beds, Large Seating Area, Two Attached Bathrooms, Extra Bed on Request','uploads/gallery/canaan_hotel_room_triple_3.png','uploads/gallery/canaan_hotel_room_triple_3.png,uploads/gallery/canaan_hotel_room_triple_1.png','Expansive family accommodation hosting up to 8 guests. Perfect for family reunions, weddings, and group stays.','Designed specially for large families and tourist groups visiting Kanyakumari and Nagercoil, the Family Deluxe Room comfortably accommodates up to 8 persons with multiple beds, air conditioning, ample space, and complimentary breakfast. Extra bed available for Ôé╣500.',1,'available','2026-09-14 12:52:12');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(255) DEFAULT 'Grand Cannann Resort & Spa',
  `hotel_tagline` varchar(255) DEFAULT 'Luxury Stays & Unforgettable Memories',
  `hotel_logo` varchar(255) DEFAULT '',
  `hotel_favicon` varchar(255) DEFAULT '',
  `hotel_email` varchar(150) DEFAULT 'contact@grandcannann.com',
  `hotel_phone` varchar(50) DEFAULT '+91 98765 43210',
  `hotel_alt_phone` varchar(50) DEFAULT '+91 44 2345 6789',
  `hotel_address` text DEFAULT NULL,
  `map_iframe` text DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT 'https://facebook.com',
  `instagram_url` varchar(255) DEFAULT 'https://instagram.com',
  `twitter_url` varchar(255) DEFAULT 'https://twitter.com',
  `tripadvisor_url` varchar(255) DEFAULT 'https://tripadvisor.com',
  `meta_title` varchar(255) DEFAULT 'Grand Cannann | Luxury Hotel & Resort',
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `smtp_host` varchar(150) DEFAULT 'smtp.gmail.com',
  `smtp_port` int(11) DEFAULT 587,
  `smtp_user` varchar(150) DEFAULT '',
  `smtp_pass` varchar(255) DEFAULT '',
  `smtp_crypto` varchar(10) DEFAULT 'tls',
  `smtp_from_email` varchar(150) DEFAULT 'reservations@grandcannann.com',
  `smtp_from_name` varchar(150) DEFAULT 'Grand Cannann Hotel',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_opening_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `opening_date` datetime DEFAULT '2026-09-12 09:00:00',
  `opening_mode` varchar(50) NOT NULL DEFAULT 'countdown_page',
  `opening_title` varchar(255) NOT NULL DEFAULT 'Grand Opening ÔÇö September 12, 2026',
  `opening_subtitle` text DEFAULT NULL,
  `opening_banner_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'Grand Cannann Resort & Luxury Suites','Where Timeless Heritage Meets Contemporary Luxury','uploads/site_logo.png','uploads/favicon.png','reservations@grandcannann.com','+91 99949 99695','+91 99949 99695','105A, Court Road, Advocate Gnaniah Complex, Veppamoodu Junction, Nagercoil, Tamil Nadu 629001, India','https://maps.google.com/maps?q=Advocate+Gnaniah+Complex,+Court+Road,+Veppamoodu+Junction,+Nagercoil,+Tamil+Nadu+629001&t=&z=16&ie=UTF8&iwloc=&output=embed','https://www.facebook.com/share/1MoP3i1NQu/','https://www.instagram.com/hotelcanaannofficial?stkn=YWFjb3FkMHY4aXM0','https://twitter.com','https://tripadvisor.com','Grand Cannann Resort & Spa | Luxury Boutique Hotel & Suites','Experience world-class luxury at Grand Cannann Hotel & Resort. Premium ocean view suites, Michelin-inspired dining, infinity pool, luxury spa, and bespoke coastal experiences.','luxury hotel, resort, ocean suite, fine dining restaurant, infinity pool, hotel booking, boutique hotel chennai, tourist stay','195.201.164.20',587,'reservations@grandcannann.com','07Bmk86@h','tls','reservations@grandcannann.com','Grand Cannann Hotel','2026-09-03 07:51:53','2026-09-15 11:11:50',0,'2026-09-17 09:00:00','countdown_page','Grand Opening ÔÇö September 12, 2026','A new sanctuary of coastal luxury, bespoke suites, and Michelin-inspired culinary artistry arrives soon in Nagercoil.','Grand Opening on September 17, 2026 ÔÇö Pre-Bookings Now Open!');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `tag` varchar(100) DEFAULT 'LUXURY EXPERIENCE',
  `button_text` varchar(100) DEFAULT 'Book Your Stay',
  `button_link` varchar(255) DEFAULT '#booking-search',
  `secondary_btn_text` varchar(100) DEFAULT 'Explore Suites',
  `secondary_btn_link` varchar(255) DEFAULT 'rooms',
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (4,'A Comfortable Stay at Canaan Hotel','Experience warm hospitality, comfortable rooms, and convenient accommodation in the heart of Nagercoil. Whether visiting for business or exploring Kanyakumari, Canaan Hotel offers a welcoming stay for everyone.','Welcome to Nagercoil','Explore Our Rooms','rooms','Book Your Stay','restaurant','http://localhost/cannann/uploads/sliders/a01a056c68872fc4628bc85e951a5ee4.png',1,'active','2026-09-14 10:56:15'),(5,'Relax in Comfort at Canaan Hotel','Enjoy a peaceful and comfortable stay at Canaan Hotel, Nagercoil. Thoughtfully designed rooms featuring cozy interiors, clean surroundings, and essential amenities ├╣ perfect for families and travelers.','Comfort & Relaxation','View Our Rooms','rooms','Book Your Room','restaurant','http://localhost/cannann/uploads/sliders/79d0bc75dffd2603d547f91443af3493.png',2,'active','2026-09-14 11:05:05');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_table`
--

DROP TABLE IF EXISTS `staff_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `role` varchar(100) DEFAULT 'Staff Member',
  `phone` varchar(50) DEFAULT '',
  `email` varchar(150) DEFAULT '',
  `address` text DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT 0.00,
  `join_date` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_table`
--

LOCK TABLES `staff_table` WRITE;
/*!40000 ALTER TABLE `staff_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_reservations`
--

DROP TABLE IF EXISTS `table_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `guest_count` int(11) NOT NULL DEFAULT 2,
  `table_preference` varchar(100) DEFAULT 'Indoor Romantic',
  `special_notes` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_reservations`
--

LOCK TABLES `table_reservations` WRITE;
/*!40000 ALTER TABLE `table_reservations` DISABLE KEYS */;
INSERT INTO `table_reservations` VALUES (1,'Sophia Montgomery','sophia.m@domain.com','+91 91234 56789','2026-09-04','20:00:00',2,'Ocean View Terrace','Anniversary candlelit table','pending','2026-09-03 08:00:03'),(2,'jhon','jhon@gmail.com','9876543210','2026-09-15','19:30:00',4,'Ocean View Terrace','','pending','2026-09-15 10:29:26');
/*!40000 ALTER TABLE `table_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_name` varchar(150) NOT NULL,
  `designation` varchar(100) DEFAULT 'Verified Guest',
  `location` varchar(100) DEFAULT 'London, UK',
  `rating` int(11) DEFAULT 5,
  `review` text NOT NULL,
  `avatar` varchar(255) DEFAULT '',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Mohammed Rahman','','',5,'Good hospitality and a peaceful atmosphere. I especially enjoyed the restaurant and the refreshing drinks. Overall, it was a comfortable and satisfying stay.','','active','2026-09-14 12:39:20'),(2,'Priya S.','','',5,'We had a pleasant family stay at Canaan Hotel. The rooms were comfortable, the service was good, and the food was enjoyable. A nice choice for families visiting Nagercoil.','','active','2026-09-14 12:39:20'),(3,'Arun Kumar','','',5,'A very comfortable place to stay in Nagercoil. The room was clean and spacious, and the staff were friendly and helpful. The location was also convenient for visiting nearby places.','','active','2026-09-14 12:39:20');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-15 17:55:41
