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
    <title><?php echo htmlspecialchars($settings['hotel_name'] ?? 'Grand Cannann Hotel'); ?> | Admin Management</title>
    
    <!-- Dynamic Favicon -->
    <?php if(!empty($site_favicon_display)): ?>
        <link rel="icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>" type="image/png">
        <link rel="shortcut icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>" type="image/png">
        <link rel="apple-touch-icon" href="<?php echo htmlspecialchars($site_favicon_display); ?>">
    <?php endif; ?>

    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #c5a880; /* Warm Gold */
            --primary-hover: #1e293b;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #0f172a;
            --dark-menu: #1e293b;
            --light: #ffffff;
            --gray-100: #f8fafc;
            --gray-200: #e2e8f0;
            
            /* Sidebar Theme */
            --sidebar-bg: #0f172a;
            --sidebar-header: #020617;
            --sidebar-hover: #1e293b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--gray-100);
            color: #334155;
            overflow-x: hidden;
        }

        .text-primary { color: #a8895e !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .border-primary { border-color: var(--primary) !important; }
        .btn-primary { 
            background-color: #a8895e !important; 
            border-color: #a8895e !important; 
            color: #ffffff !important;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: var(--dark) !important;
            border-color: var(--dark) !important;
            color: #ffffff !important;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }

        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: var(--sidebar-bg);
            color: #fff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1000;
        }

        #sidebar.collapsed {
            margin-left: -260px;
        }

        .sidebar-header {
            padding: 22px;
            background: var(--sidebar-header);
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }
        
        .sidebar-header .logo-icon {
            font-size: 22px;
            background: rgba(197, 168, 128, 0.15);
            padding: 8px 12px;
            border-radius: 8px;
        }

        .sidebar-menu {
            padding: 10px 0 40px;
            list-style: none;
            margin: 0;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .sidebar-menu li {
            padding: 3px 16px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            color: #94a3b8;
            padding: 10px 14px;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.25s;
            font-weight: 500;
            font-size: 0.88rem;
            gap: 12px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--sidebar-hover);
            color: #ffffff;
            border-left: 3px solid var(--primary);
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .menu-title {
            color: #64748b;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 16px 16px 6px;
            font-weight: 700;
        }

        #content {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: white;
            padding: 14px 25px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--secondary);
            cursor: pointer;
            padding: 6px 10px;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .navbar-btn:hover {
            background: var(--gray-100);
            color: var(--dark);
        }

        .stat-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 18px;
            transition: transform 0.25s;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
