<?php
if (!isset($settings)) {
    $ci =& get_instance();
    $ci->load->model('Settings_model');
    $settings = $ci->Settings_model->get_settings();
}
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
    <title>Admin Login | <?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann Hotel'); ?></title>
    
    <!-- Dynamic Favicon -->
    <?php if(!empty($site_favicon_display)): ?>
        <link rel="icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>" type="image/png">
        <link rel="shortcut icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>" type="image/png">
        <link rel="apple-touch-icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>">
    <?php endif; ?>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #c5a880;
            --primary-dark: #a8895e;
            --bg-dark: #0b1120;
            --card-dark: #131d33;
            --border-dark: rgba(197, 168, 128, 0.18);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #070c18 0%, #0f172a 50%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #e2e8f0;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow Circles */
        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(197, 168, 128, 0.12) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            pointer-events: none;
        }
        body::after {
            content: '';
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
            bottom: -80px;
            left: -80px;
            pointer-events: none;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: rgba(19, 29, 51, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-dark);
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 40px rgba(197, 168, 128, 0.08);
            position: relative;
            z-index: 10;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-logo {
            max-height: 52px;
            max-width: 220px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }

        .brand-title {
            font-family: 'Playfair Display', serif;
            color: #ffffff;
            font-size: 1.65rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-top: 12px;
        }

        .brand-subtitle {
            color: var(--primary);
            font-size: 0.8rem;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group-custom .icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.95rem;
            transition: color 0.2s;
            z-index: 5;
        }

        .form-control-custom {
            width: 100%;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 13px 44px 13px 44px;
            font-size: 0.95rem;
            color: #ffffff;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control-custom:focus {
            background: rgba(15, 23, 42, 0.95);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(197, 168, 128, 0.2);
            color: #ffffff;
            outline: none;
        }

        .form-control-custom:focus + .icon,
        .input-group-custom:focus-within .icon {
            color: var(--primary);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 4px 8px;
            font-size: 0.95rem;
            transition: color 0.2s;
            z-index: 5;
        }
        .toggle-password:hover {
            color: #ffffff;
        }

        .btn-gold {
            width: 100%;
            background: linear-gradient(135deg, #c5a880 0%, #a8895e 100%);
            color: #0b1120;
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 8px 20px rgba(197, 168, 128, 0.25);
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #d3b791 0%, #b8986c 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(197, 168, 128, 0.35);
            color: #0b1120;
        }

        .btn-gold:active {
            transform: translateY(0);
        }

        .alert-custom {
            border-radius: 10px;
            font-size: 0.85rem;
            padding: 12px 16px;
            margin-bottom: 22px;
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-custom-danger {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
        .alert-custom-success {
            background: rgba(16, 185, 129, 0.15);
            border-color: rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
        }

        .portal-footer {
            text-align: center;
            margin-top: 28px;
            font-size: 0.78rem;
            color: #64748b;
        }
        .portal-footer a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s;
        }
        .portal-footer a:hover {
            color: #ffffff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-section">
            <?php if(!empty($site_logo)): ?>
                <img src="<?php echo htmlspecialchars($site_logo); ?>" alt="Grand Cannann" class="brand-logo mb-2">
            <?php else: ?>
                <div style="font-size: 2.2rem; color: var(--primary); margin-bottom: 6px;">
                    <i class="fa-solid fa-crown"></i>
                </div>
            <?php endif; ?>
            <h1 class="brand-title"><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann Hotel'); ?></h1>
            <div class="brand-subtitle">Management Control Center</div>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert-custom alert-custom-danger">
                <i class="fa-solid fa-circle-exclamation fs-6"></i>
                <div><?php echo $this->session->flashdata('error'); ?></div>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert-custom alert-custom-success">
                <i class="fa-solid fa-circle-check fs-6"></i>
                <div><?php echo $this->session->flashdata('success'); ?></div>
            </div>
        <?php endif; ?>

        <?php echo form_open('admin/login'); ?>
            <div class="input-group-custom">
                <label class="form-label" for="username">Username or Email</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-user icon"></i>
                    <input type="text" name="username" id="username" class="form-control-custom" placeholder="" required autofocus value="<?php echo htmlspecialchars($this->input->post('username') ?? ''); ?>">
                </div>
            </div>

            <div class="input-group-custom">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label mb-0" for="password">Password</label>
                </div>
                <div style="position: relative;">
                    <i class="fa-solid fa-lock icon"></i>
                    <input type="password" name="password" id="password" class="form-control-custom" placeholder="" required>
                    <button type="button" class="toggle-password" id="togglePasswordBtn" title="Toggle password visibility">
                        <i class="fa-regular fa-eye" id="toggleEye"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me" style="background-color: rgba(15,23,42,0.8); border-color: rgba(255,255,255,0.25);">
                    <label class="form-check-label small" for="remember_me" style="font-size: 0.85rem; color: #cbd5e1; cursor: pointer;">
                        Remember session
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-gold">
                <i class="fa-solid fa-right-to-bracket"></i> Sign In to Dashboard
            </button>
        <?php echo form_close(); ?>

        <div class="portal-footer">
            <div>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann Hotel'); ?></div>
            <div class="mt-1">
                <a href="<?php echo base_url(); ?>"><i class="fa-solid fa-arrow-left me-1"></i> Back to Main Website</a>
            </div>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passInput = document.getElementById('password');
        const toggleEye = document.getElementById('toggleEye');

        toggleBtn.addEventListener('click', function() {
            if (passInput.type === 'password') {
                passInput.type = 'text';
                toggleEye.classList.remove('fa-eye');
                toggleEye.classList.add('fa-eye-slash');
            } else {
                passInput.type = 'password';
                toggleEye.classList.remove('fa-eye-slash');
                toggleEye.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
