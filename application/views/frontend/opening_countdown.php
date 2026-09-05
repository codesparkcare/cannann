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

$opening_date = !empty($settings['opening_date']) ? $settings['opening_date'] : '2026-09-12 09:00:00';
$opening_title = !empty($settings['opening_title']) ? $settings['opening_title'] : 'Grand Opening — September 12, 2026';

$raw_subtitle = !empty($settings['opening_subtitle']) ? $settings['opening_subtitle'] : 'A new sanctuary of coastal luxury, bespoke suites, and Michelin-inspired culinary artistry arrives soon in Nagercoil.';
$opening_subtitle = str_ireplace('Chennai', 'Nagercoil', $raw_subtitle);

$raw_address = !empty($settings['hotel_address']) ? $settings['hotel_address'] : '124 Luxury Coastal Boulevard, Nagercoil, Tamil Nadu';
$hotel_address = str_ireplace('Chennai', 'Nagercoil', $raw_address);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($opening_title); ?> | <?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann Hotel'); ?></title>
    
    <!-- Favicon -->
    <?php if(!empty($site_favicon)): ?>
        <link rel="icon" href="<?php echo htmlspecialchars($site_favicon); ?>" type="image/png">
        <link rel="shortcut icon" href="<?php echo htmlspecialchars($site_favicon); ?>" type="image/png">
    <?php endif; ?>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;0,900;1,400;1,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #c5a880;
            --primary-dark: #a8895e;
            --primary-light: #f5d79e;
            --dark-emerald: #061810;
            --bg-gradient: radial-gradient(circle at 50% 25%, #0c3322 0%, #061810 55%, #020906 100%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-gradient);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow-x: hidden;
            background-attachment: fixed;
        }

        /* Ambient Dynamic Cursor Spotlight */
        #cursorSpotlight {
            position: fixed;
            width: 650px;
            height: 650px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(197, 168, 128, 0.08) 0%, rgba(16, 185, 129, 0.04) 40%, transparent 70%);
            pointer-events: none;
            z-index: 1;
            transform: translate(-50%, -50%);
            transition: opacity 0.3s ease;
            mix-blend-mode: screen;
        }

        /* Floating Golden Particle Canvas */
        #particleCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }

        /* Background Glow Orbs */
        .bg-glow-1 {
            position: absolute;
            top: -100px;
            right: -80px;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(197, 168, 128, 0.15) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
            animation: orbFloat1 12s ease-in-out infinite alternate;
        }
        .bg-glow-2 {
            position: absolute;
            bottom: -120px;
            left: -80px;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.14) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
            animation: orbFloat2 14s ease-in-out infinite alternate;
        }

        @keyframes orbFloat1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-30px, 40px) scale(1.08); }
        }
        @keyframes orbFloat2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, -30px) scale(1.1); }
        }

        .main-container {
            position: relative;
            z-index: 10;
            padding: 24px 20px 20px;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            width: 100%;
        }

        /* Staggered Cinematic Reveal */
        .reveal-item {
            opacity: 0;
            transform: translateY(20px);
            animation: revealUp 0.85s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .reveal-delay-1 { animation-delay: 0.1s; }
        .reveal-delay-2 { animation-delay: 0.25s; }
        .reveal-delay-3 { animation-delay: 0.4s; }
        .reveal-delay-4 { animation-delay: 0.55s; }
        .reveal-delay-5 { animation-delay: 0.7s; }
        .reveal-delay-6 { animation-delay: 0.85s; }

        @keyframes revealUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header Logo with Luxury Float & Shimmer */
        .logo-wrap {
            margin-bottom: 14px;
            position: relative;
            display: inline-block;
        }
        .brand-logo-img {
            max-width: 260px;
            max-height: 95px;
            object-fit: contain;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.85)) drop-shadow(0 0 20px rgba(197, 168, 128, 0.4));
            animation: floatLogo 4s ease-in-out infinite alternate;
            transition: transform 0.4s ease;
        }
        .brand-logo-img:hover {
            transform: scale(1.03);
        }

        @keyframes floatLogo {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-5px); }
        }

        /* Official Badge */
        .badge-opening {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(197, 168, 128, 0.12);
            border: 1px solid rgba(197, 168, 128, 0.4);
            color: var(--primary-light);
            padding: 6px 20px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 12px;
            box-shadow: 0 0 20px rgba(197, 168, 128, 0.2), inset 0 0 12px rgba(197, 168, 128, 0.1);
            position: relative;
            overflow: hidden;
        }
        .badge-opening::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(245, 215, 158, 0.4), transparent);
            animation: badgeShine 4s infinite;
        }

        @keyframes badgeShine {
            0% { left: -100%; }
            25% { left: 100%; }
            100% { left: 100%; }
        }

        /* Headline with Guaranteed Visibility & Golden Foil Shimmer */
        .grand-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            font-weight: 800;
            line-height: 1.15;
            color: #f5d79e;
            background: linear-gradient(110deg, #f5d79e 0%, #ffffff 30%, #c5a880 60%, #ffffff 85%, #f5d79e 100%);
            background-size: 250% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            letter-spacing: -0.3px;
            animation: goldGleam 9s linear infinite;
        }

        @keyframes goldGleam {
            0% { background-position: 250% 0; }
            100% { background-position: -250% 0; }
        }

        .grand-subtext {
            font-size: 1.05rem;
            color: #d1d9e2;
            max-width: 650px;
            margin: 0 auto 24px;
            line-height: 1.6;
            font-weight: 400;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        /* Countdown Box Grid */
        .countdown-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            max-width: 620px;
            margin: 0 auto 24px;
            perspective: 1000px;
        }

        .timer-card {
            background: rgba(10, 38, 26, 0.72);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(197, 168, 128, 0.38);
            border-radius: 16px;
            padding: 16px 8px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.45), inset 0 0 20px rgba(197, 168, 128, 0.08);
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            transform-style: preserve-3d;
        }
        .timer-card:hover {
            transform: translateY(-5px) scale(1.02);
            border-color: var(--primary-light);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 25px rgba(197, 168, 128, 0.3);
        }
        .timer-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .timer-number {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1;
            margin-bottom: 4px;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.6), 0 0 20px rgba(197, 168, 128, 0.4);
            display: inline-block;
            transition: transform 0.25s ease, color 0.25s ease;
        }

        .timer-number.tick-flash {
            animation: numberTick 0.5s ease-out;
        }

        @keyframes numberTick {
            0% { transform: scale(1.12); color: #f5d79e; text-shadow: 0 0 30px rgba(245, 215, 158, 0.9); }
            100% { transform: scale(1); color: #ffffff; }
        }

        .timer-label {
            font-size: 0.72rem;
            color: var(--primary-light);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .btn-gold-action {
            background: linear-gradient(135deg, #c5a880 0%, #a8895e 100%);
            color: #061810 !important;
            padding: 13px 32px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            box-shadow: 0 8px 25px rgba(197, 168, 128, 0.35);
            transition: all 0.35s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            animation: goldPulse 3.5s infinite ease-in-out;
        }
        .btn-gold-action::after {
            content: '';
            position: absolute;
            top: 0;
            left: -120%;
            width: 80%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
            transform: skewX(-25deg);
            animation: btnSweep 4.5s infinite;
        }
        .btn-gold-action:hover {
            background: linear-gradient(135deg, #f5d79e 0%, #c5a880 100%);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(197, 168, 128, 0.55);
            color: #061810 !important;
        }

        @keyframes goldPulse {
            0%, 100% { box-shadow: 0 8px 25px rgba(197, 168, 128, 0.35); }
            50% { box-shadow: 0 10px 35px rgba(245, 215, 158, 0.6), 0 0 20px rgba(197, 168, 128, 0.35); }
        }
        @keyframes btnSweep {
            0%, 70% { left: -120%; }
            100% { left: 160%; }
        }

        .btn-whatsapp-action {
            background: linear-gradient(135deg, #25d366 0%, #1ea952 100%);
            color: #ffffff !important;
            padding: 13px 28px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-decoration: none;
            border: none;
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.35);
            transition: all 0.35s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            animation: waPulse 3.5s infinite ease-in-out 1.5s;
        }
        .btn-whatsapp-action:hover {
            background: linear-gradient(135deg, #2bf075 0%, #20ba59 100%);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 32px rgba(37, 211, 102, 0.5);
            color: #ffffff !important;
        }

        @keyframes waPulse {
            0%, 100% { box-shadow: 0 8px 24px rgba(37, 211, 102, 0.35); }
            50% { box-shadow: 0 10px 32px rgba(37, 211, 102, 0.55), 0 0 18px rgba(37, 211, 102, 0.3); }
        }

        /* Contact Info Cards */
        .info-pills {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }
        .info-pill {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.84rem;
            color: #e2e8f0;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .info-pill:hover {
            background: rgba(197, 168, 128, 0.2);
            border-color: var(--primary);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .info-pill i {
            color: var(--primary-light);
            transition: transform 0.3s ease;
        }
        .info-pill:hover i {
            transform: scale(1.15);
        }

        /* Footer */
        .opening-footer {
            position: relative;
            z-index: 10;
            padding: 18px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            font-size: 0.82rem;
            color: #94a3b8;
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 16px 14px 16px;
            }
            .grand-heading {
                font-size: 1.85rem;
            }
            .grand-subtext {
                font-size: 0.92rem;
                margin-bottom: 18px;
            }
            .countdown-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                margin-bottom: 18px;
            }
            .timer-number {
                font-size: 2.1rem;
            }
            .brand-logo-img {
                max-width: 200px;
            }
            .action-group {
                flex-direction: column;
                width: 100%;
                gap: 10px;
                margin-bottom: 18px;
            }
            .btn-gold-action, .btn-whatsapp-action {
                width: 100%;
                justify-content: center;
                padding: 12px 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Floating Particles Canvas -->
    <canvas id="particleCanvas"></canvas>

    <!-- Cursor Spotlight Tracker -->
    <div id="cursorSpotlight"></div>

    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <div class="main-container">
        <!-- Logo -->
        <div class="logo-wrap reveal-item reveal-delay-1">
            <?php if(!empty($site_logo)): ?>
                <img src="<?php echo htmlspecialchars($site_logo); ?>" alt="<?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?>" class="brand-logo-img">
            <?php else: ?>
                <div style="font-size: 2.4rem; color: var(--primary); margin-bottom: 4px;">
                    <i class="fa-solid fa-crown"></i>
                </div>
                <h2 class="fw-bold mb-0 text-white font-serif"><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?></h2>
            <?php endif; ?>
        </div>

        <!-- Opening Badge -->
        <div class="reveal-item reveal-delay-2">
            <div class="badge-opening">
                <i class="fa-solid fa-champagne-glasses"></i> Official Grand Opening
            </div>
        </div>

        <!-- Headline -->
        <h1 class="grand-heading reveal-item reveal-delay-3"><?php echo htmlspecialchars($opening_title); ?></h1>
        <p class="grand-subtext reveal-item reveal-delay-4"><?php echo nl2br(htmlspecialchars($opening_subtitle)); ?></p>

        <!-- Live Countdown Timer -->
        <div class="countdown-grid reveal-item reveal-delay-5" id="countdownGrid">
            <div class="timer-card">
                <div class="timer-number" id="daysCount">00</div>
                <div class="timer-label">Days</div>
            </div>
            <div class="timer-card">
                <div class="timer-number" id="hoursCount">00</div>
                <div class="timer-label">Hours</div>
            </div>
            <div class="timer-card">
                <div class="timer-number" id="minutesCount">00</div>
                <div class="timer-label">Minutes</div>
            </div>
            <div class="timer-card">
                <div class="timer-number" id="secondsCount">00</div>
                <div class="timer-label">Seconds</div>
            </div>
        </div>

        <!-- Call to Action Buttons -->
        <div class="action-group reveal-item reveal-delay-6">
            <button class="btn-gold-action" data-bs-toggle="modal" data-bs-target="#vipInquiryModal">
                <i class="fa-solid fa-calendar-check"></i> VIP Pre-Booking Request
            </button>
            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $settings['hotel_phone'] ?? '919876543210'); ?>?text=Hello%20Grand%20Cannann%20Team%2C%20I%20would%20like%20to%20inquire%20about%20Grand%20Opening%20Pre-Bookings." target="_blank" class="btn-whatsapp-action">
                <i class="fa-brands fa-whatsapp fs-5"></i> Chat on WhatsApp
            </a>
        </div>

        <!-- Direct Contact Pills -->
        <div class="info-pills reveal-item reveal-delay-6">
            <?php if(!empty($settings['hotel_phone'])): ?>
                <a href="tel:<?php echo htmlspecialchars($settings['hotel_phone']); ?>" class="info-pill">
                    <i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($settings['hotel_phone']); ?>
                </a>
            <?php endif; ?>
            <?php if(!empty($settings['hotel_email'])): ?>
                <a href="mailto:<?php echo htmlspecialchars($settings['hotel_email']); ?>" class="info-pill">
                    <i class="fa-solid fa-envelope"></i> <?php echo htmlspecialchars($settings['hotel_email']); ?>
                </a>
            <?php endif; ?>
            <?php if(!empty($hotel_address)): ?>
                <div class="info-pill">
                    <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($hotel_address); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- VIP Pre-Booking Inquiry Modal -->
    <div class="modal fade" id="vipInquiryModal" tabindex="-1" aria-labelledby="vipInquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #0d2218; border: 1px solid rgba(197,168,128,0.4); border-radius: 20px; color: #fff; box-shadow: 0 25px 60px rgba(0,0,0,0.8);">
                <div class="modal-header border-bottom border-secondary border-opacity-25 p-4">
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-1" id="vipInquiryModalLabel">
                            <i class="fa-solid fa-crown text-warning me-2"></i> VIP Pre-Booking Priority Pass
                        </h5>
                        <small class="text-white-50">Be among the first privileged guests to experience Grand Cannann.</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="vipAlert"></div>
                    <form id="vipInquiryForm">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-white-50">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required style="background: rgba(0,0,0,0.4); border-color: rgba(255,255,255,0.15); color: #fff;">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-white-50">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="name@email.com" required style="background: rgba(0,0,0,0.4); border-color: rgba(255,255,255,0.15); color: #fff;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-white-50">Phone / WhatsApp</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+91..." required style="background: rgba(0,0,0,0.4); border-color: rgba(255,255,255,0.15); color: #fff;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-white-50">Preferred Room Type & Estimated Dates</label>
                            <input type="text" name="subject" class="form-control" placeholder="e.g. Deluxe Suite / Mid September" style="background: rgba(0,0,0,0.4); border-color: rgba(255,255,255,0.15); color: #fff;">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-white-50">Special Requirements or Message</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Tell us about your stay preferences..." style="background: rgba(0,0,0,0.4); border-color: rgba(255,255,255,0.15); color: #fff;"></textarea>
                        </div>
                        <button type="submit" id="btnSubmitVip" class="btn-gold-action w-100 py-3 justify-content-center">
                            <i class="fa-solid fa-paper-plane me-2"></i> Submit Priority Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="opening-footer">
        <div>&copy; <?php echo date('Y'); ?> <strong><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann Hotel'); ?></strong>. All Rights Reserved.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ----------------------------------------------------
        // 1. High Performance Golden Particles Background
        // ----------------------------------------------------
        (function() {
            const canvas = document.getElementById('particleCanvas');
            const ctx = canvas.getContext('2d');
            let width, height;
            let particles = [];
            const particleCount = window.innerWidth < 768 ? 22 : 45;

            function resize() {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            }
            window.addEventListener('resize', resize);
            resize();

            class Particle {
                constructor() {
                    this.reset(true);
                }

                reset(initial = false) {
                    this.x = Math.random() * width;
                    this.y = initial ? Math.random() * height : height + 10;
                    this.size = Math.random() * 2.5 + 0.8;
                    this.speedY = Math.random() * 0.4 + 0.15;
                    this.speedX = (Math.random() - 0.5) * 0.3;
                    this.opacity = Math.random() * 0.6 + 0.2;
                    this.fadeSpeed = Math.random() * 0.008 + 0.003;
                    this.fadeDir = Math.random() > 0.5 ? 1 : -1;
                    const colors = [
                        'rgba(245, 215, 158, ',
                        'rgba(197, 168, 128, ',
                        'rgba(255, 255, 255, ',
                        'rgba(168, 137, 94, '
                    ];
                    this.colorBase = colors[Math.floor(Math.random() * colors.length)];
                }

                update() {
                    this.y -= this.speedY;
                    this.x += this.speedX;

                    this.opacity += this.fadeSpeed * this.fadeDir;
                    if (this.opacity > 0.8) this.fadeDir = -1;
                    if (this.opacity < 0.1) this.fadeDir = 1;

                    if (this.y < -10 || this.x < -10 || this.x > width + 10) {
                        this.reset();
                    }
                }

                draw() {
                    ctx.save();
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fillStyle = this.colorBase + this.opacity + ')';
                    ctx.shadowColor = 'rgba(245, 215, 158, 0.8)';
                    ctx.shadowBlur = this.size * 3;
                    ctx.fill();
                    ctx.restore();
                }
            }

            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }

            function animateParticles() {
                ctx.clearRect(0, 0, width, height);
                for (let i = 0; i < particles.length; i++) {
                    particles[i].update();
                    particles[i].draw();
                }
                requestAnimationFrame(animateParticles);
            }
            animateParticles();
        })();

        // ----------------------------------------------------
        // 2. Cursor Spotlight Follower
        // ----------------------------------------------------
        const spotlight = document.getElementById('cursorSpotlight');
        if (window.innerWidth > 768 && spotlight) {
            window.addEventListener('mousemove', (e) => {
                spotlight.style.left = e.clientX + 'px';
                spotlight.style.top = e.clientY + 'px';
            });
        }

        // ----------------------------------------------------
        // 3. Interactive 3D Tilt on Countdown Cards
        // ----------------------------------------------------
        const cards = document.querySelectorAll('.timer-card');
        if (window.innerWidth > 768) {
            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    const rotateX = -(y / rect.height) * 10;
                    const rotateY = (x / rect.width) * 10;
                    card.style.transform = `perspective(600px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px) scale(1.02)`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'perspective(600px) rotateX(0deg) rotateY(0deg) translateY(0) scale(1)';
                });
            });
        }

        // ----------------------------------------------------
        // 4. Real-Time Countdown Engine with Number Tick Animations
        // ----------------------------------------------------
        const targetDateStr = "<?php echo $opening_date; ?>".replace(/-/g, "/");
        const targetTime = new Date(targetDateStr).getTime();

        function setAnimatedValue(elemId, newVal) {
            const elem = document.getElementById(elemId);
            if (!elem) return;
            if (elem.innerText !== newVal) {
                elem.innerText = newVal;
                elem.classList.remove('tick-flash');
                void elem.offsetWidth;
                elem.classList.add('tick-flash');
            }
        }

        function updateCountdown() {
            const now = new Date().getTime();
            const difference = targetTime - now;

            if (difference <= 0) {
                document.getElementById('daysCount').innerText = "00";
                document.getElementById('hoursCount').innerText = "00";
                document.getElementById('minutesCount').innerText = "00";
                document.getElementById('secondsCount').innerText = "00";
                return;
            }

            const days = Math.floor(difference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((difference % (1000 * 60)) / 1000);

            const strDays = days < 10 ? "0" + days : "" + days;
            const strHours = hours < 10 ? "0" + hours : "" + hours;
            const strMinutes = minutes < 10 ? "0" + minutes : "" + minutes;
            const strSeconds = seconds < 10 ? "0" + seconds : "" + seconds;

            setAnimatedValue('daysCount', strDays);
            setAnimatedValue('hoursCount', strHours);
            setAnimatedValue('minutesCount', strMinutes);
            setAnimatedValue('secondsCount', strSeconds);
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        // ----------------------------------------------------
        // 5. AJAX VIP Inquiry Form
        // ----------------------------------------------------
        document.getElementById('vipInquiryForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const btn = document.getElementById('btnSubmitVip');
            const alertBox = document.getElementById('vipAlert');

            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Submitting...';

            const formData = new FormData(form);

            fetch('<?php echo base_url("submit-contact"); ?>', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-paper-plane me-2"></i> Submit Priority Inquiry';
                if (data.status === 'success') {
                    alertBox.innerHTML = '<div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i>' + data.message + '</div>';
                    form.reset();
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('vipInquiryModal'));
                        if (modal) modal.hide();
                        alertBox.innerHTML = '';
                    }, 3500);
                } else {
                    alertBox.innerHTML = '<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>' + data.message + '</div>';
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-paper-plane me-2"></i> Submit Priority Inquiry';
                alertBox.innerHTML = '<div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i>Thank you! Your VIP inquiry has been received. Our team will contact you shortly.</div>';
                form.reset();
            });
        });
    </script>
</body>
</html>
