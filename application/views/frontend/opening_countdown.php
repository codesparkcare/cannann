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
$opening_subtitle = !empty($settings['opening_subtitle']) ? $settings['opening_subtitle'] : 'A new sanctuary of coastal luxury, bespoke suites, and Michelin-inspired culinary artistry arrives soon in Chennai.';
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,900;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #c5a880;
            --primary-dark: #a8895e;
            --primary-light: #f5d79e;
            --dark-emerald: #061810;
            --bg-gradient: radial-gradient(circle at center, #0a2e1f 0%, #061810 60%, #020906 100%);
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
        }

        /* Ambient Glow & Background Elements */
        .bg-glow-1 {
            position: absolute;
            top: -150px;
            right: -100px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(197, 168, 128, 0.15) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
        }
        .bg-glow-2 {
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
        }

        /* Admin Preview Ribbon */
        .admin-ribbon {
            background: rgba(197, 168, 128, 0.95);
            color: #0b1120;
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            position: relative;
            z-index: 100;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        .admin-ribbon a {
            color: #0b1120;
            text-decoration: underline;
            font-weight: 700;
        }

        .main-container {
            position: relative;
            z-index: 10;
            padding: 50px 20px 40px;
            max-width: 960px;
            margin: 0 auto;
            text-align: center;
            width: 100%;
        }

        /* Header Logo */
        .logo-wrap {
            margin-bottom: 28px;
        }
        .brand-logo-img {
            max-width: 320px;
            max-height: 120px;
            object-fit: contain;
            filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.8)) drop-shadow(0 0 20px rgba(197, 168, 128, 0.4));
            animation: floatLogo 3s ease-in-out infinite alternate;
        }

        @keyframes floatLogo {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-8px); }
        }

        .badge-opening {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(197, 168, 128, 0.15);
            border: 1px solid rgba(197, 168, 128, 0.4);
            color: var(--primary-light);
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-bottom: 22px;
            box-shadow: 0 0 25px rgba(197, 168, 128, 0.2);
        }

        .grand-heading {
            font-family: 'Playfair Display', serif;
            font-size: 3.4rem;
            font-weight: 800;
            line-height: 1.15;
            background: linear-gradient(135deg, #ffffff 30%, #f5d79e 70%, #c5a880 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 18px;
            letter-spacing: -0.5px;
        }

        .grand-subtext {
            font-size: 1.15rem;
            color: #cbd5e1;
            max-width: 680px;
            margin: 0 auto 40px;
            line-height: 1.7;
            font-weight: 400;
        }

        /* Countdown Box Grid */
        .countdown-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 680px;
            margin: 0 auto 45px;
        }

        .timer-card {
            background: rgba(10, 38, 26, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(197, 168, 128, 0.35);
            border-radius: 18px;
            padding: 24px 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4), inset 0 0 20px rgba(197, 168, 128, 0.08);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .timer-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-light);
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
            font-size: 3rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1;
            margin-bottom: 6px;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.5), 0 0 20px rgba(197, 168, 128, 0.4);
        }

        .timer-label {
            font-size: 0.75rem;
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
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 45px;
        }

        .btn-gold-action {
            background: linear-gradient(135deg, #c5a880 0%, #a8895e 100%);
            color: #061810 !important;
            padding: 15px 36px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            box-shadow: 0 10px 30px rgba(197, 168, 128, 0.35);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .btn-gold-action:hover {
            background: linear-gradient(135deg, #f5d79e 0%, #c5a880 100%);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(197, 168, 128, 0.5);
            color: #061810 !important;
        }

        .btn-whatsapp-action {
            background: #25d366;
            color: #ffffff !important;
            padding: 15px 32px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-decoration: none;
            border: none;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .btn-whatsapp-action:hover {
            background: #20ba59;
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(37, 211, 102, 0.5);
            color: #ffffff !important;
        }

        /* Contact Info Cards */
        .info-pills {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .info-pill {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 0.88rem;
            color: #e2e8f0;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s;
        }
        .info-pill:hover {
            background: rgba(197, 168, 128, 0.18);
            border-color: var(--primary);
            color: #ffffff;
            transform: translateY(-2px);
        }
        .info-pill i {
            color: var(--primary-light);
        }

        /* Footer */
        .opening-footer {
            position: relative;
            z-index: 10;
            padding: 24px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            font-size: 0.82rem;
            color: #94a3b8;
        }
        .opening-footer a {
            color: var(--primary-light);
            text-decoration: none;
        }
        .opening-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .grand-heading {
                font-size: 2.2rem;
            }
            .grand-subtext {
                font-size: 0.95rem;
                margin-bottom: 30px;
            }
            .countdown-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            .timer-number {
                font-size: 2.3rem;
            }
            .brand-logo-img {
                max-width: 220px;
            }
            .action-group {
                flex-direction: column;
                width: 100%;
            }
            .btn-gold-action, .btn-whatsapp-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <div class="main-container">
        <!-- Logo -->
        <div class="logo-wrap">
            <?php if(!empty($site_logo)): ?>
                <img src="<?php echo htmlspecialchars($site_logo); ?>" alt="<?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?>" class="brand-logo-img">
            <?php else: ?>
                <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 8px;">
                    <i class="fa-solid fa-crown"></i>
                </div>
                <h2 class="fw-bold mb-0 text-white"><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann'); ?></h2>
            <?php endif; ?>
        </div>

        <!-- Opening Badge -->
        <div class="badge-opening">
            <i class="fa-solid fa-champagne-glasses"></i> Official Grand Opening
        </div>

        <!-- Headline -->
        <h1 class="grand-heading"><?php echo htmlspecialchars($opening_title); ?></h1>
        <p class="grand-subtext"><?php echo nl2br(htmlspecialchars($opening_subtitle)); ?></p>

        <!-- Live Countdown Timer -->
        <div class="countdown-grid">
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
        <div class="action-group">
            <button class="btn-gold-action" data-bs-toggle="modal" data-bs-target="#vipInquiryModal">
                <i class="fa-solid fa-calendar-check"></i> VIP Pre-Booking Request
            </button>
            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $settings['hotel_phone'] ?? '919876543210'); ?>?text=Hello%20Grand%20Cannann%20Team%2C%20I%20would%20like%20to%20inquire%20about%20Grand%20Opening%20Pre-Bookings." target="_blank" class="btn-whatsapp-action">
                <i class="fa-brands fa-whatsapp fs-5"></i> Chat on WhatsApp
            </a>
        </div>

        <!-- Direct Contact Pills -->
        <div class="info-pills">
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
            <?php if(!empty($settings['hotel_address'])): ?>
                <div class="info-pill">
                    <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($settings['hotel_address']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- VIP Pre-Booking Inquiry Modal -->
    <div class="modal fade" id="vipInquiryModal" tabindex="-1" aria-labelledby="vipInquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #0d2218; border: 1px solid rgba(197,168,128,0.4); border-radius: 20px; color: #fff;">
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
        // Real-Time Countdown Engine
        const targetDateStr = "<?php echo $opening_date; ?>".replace(/-/g, "/");
        const targetTime = new Date(targetDateStr).getTime();

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

            document.getElementById('daysCount').innerText = days < 10 ? "0" + days : days;
            document.getElementById('hoursCount').innerText = hours < 10 ? "0" + hours : hours;
            document.getElementById('minutesCount').innerText = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById('secondsCount').innerText = seconds < 10 ? "0" + seconds : seconds;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        // AJAX VIP Inquiry Form
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
