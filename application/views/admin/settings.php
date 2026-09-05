<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Site & SMTP Configuration</h3>
            <span class="text-muted">Manage hotel identity, contact information, social links, SEO defaults, and email SMTP parameters.</span>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fa-solid fa-triangle-exclamation me-2"></i><?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Main Settings Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <form action="<?php echo base_url('admin/update_settings'); ?>" method="POST" enctype="multipart/form-data">
                    <!-- Grand Opening & Launch Countdown Section -->
                    <div class="p-3 mb-4 rounded-3 border" style="background: #0f1e16; border-color: rgba(197,168,128,0.3) !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <h5 class="fw-bold text-warning mb-0"><i class="fa-solid fa-champagne-glasses me-2"></i> Grand Opening & Countdown Control</h5>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" name="is_opening_enabled" value="1" id="switchOpening" <?php echo !empty($settings['is_opening_enabled']) ? 'checked' : ''; ?> style="cursor: pointer;">
                                <label class="form-check-label fs-6 fw-bold text-white ms-1" for="switchOpening">
                                    <?php echo !empty($settings['is_opening_enabled']) ? '<span class="text-success">ACTIVE (ON)</span>' : '<span class="text-white-50">DISABLED (OFF)</span>'; ?>
                                </label>
                            </div>
                        </div>
                        <p class="text-white-50 small mb-3">When enabled, visitors will see the official Grand Opening teaser & real-time countdown for September 12. (Admins can preview both the full site and opening screen anytime).</p>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-white">Target Opening Date & Time</label>
                                <?php
                                    $raw_op_date = !empty($settings['opening_date']) ? date('Y-m-d\TH:i', strtotime($settings['opening_date'])) : '2026-09-12T09:00';
                                ?>
                                <input type="datetime-local" name="opening_date" class="form-control form-control-sm" value="<?php echo htmlspecialchars($raw_op_date); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-white">Display Experience Mode</label>
                                <select name="opening_mode" class="form-select form-select-sm">
                                    <option value="countdown_page" <?php echo ($settings['opening_mode'] ?? '') === 'countdown_page' ? 'selected' : ''; ?>>Full-Screen Luxury Countdown Page (Coming Soon)</option>
                                    <option value="banner_widget" <?php echo ($settings['opening_mode'] ?? '') === 'banner_widget' ? 'selected' : ''; ?>>Top Sticky Announcement Banner (Keep Site Browseable)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-white">Main Opening Headline / Title</label>
                                <input type="text" name="opening_title" class="form-control form-control-sm" value="<?php echo htmlspecialchars($settings['opening_title'] ?? 'Grand Opening — September 12, 2026'); ?>" placeholder="Grand Opening — September 12, 2026">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-white">Opening Subtitle / Teaser Message</label>
                                <textarea name="opening_subtitle" class="form-control form-control-sm" rows="2" placeholder="Experience coastal luxury, bespoke suites, and fine dining..."><?php echo htmlspecialchars($settings['opening_subtitle'] ?? 'A new sanctuary of coastal luxury, bespoke suites, and Michelin-inspired culinary artistry arrives soon in Nagercoil.'); ?></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-white">Banner Mode Text (Used in Banner Mode)</label>
                                <input type="text" name="opening_banner_text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($settings['opening_banner_text'] ?? '🎉 Grand Opening on September 12, 2026 — Pre-Bookings Now Open!'); ?>">
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom"><i class="fa-solid fa-paintbrush me-2"></i> Site Branding & Logo / Favicon</h5>
                    <div class="row g-4 mb-4">
                        <!-- Site Logo -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <label class="form-label fw-bold d-flex justify-content-between align-items-center mb-2">
                                    <span><i class="fa-solid fa-image text-primary me-1"></i> Site Header Logo</span>
                                    <span class="badge bg-secondary">PNG / SVG / WEBP / JPG</span>
                                </label>
                                
                                <div class="mb-3 d-flex align-items-center gap-3">
                                    <?php 
                                        $logo_src = !empty($settings['hotel_logo']) ? (strpos($settings['hotel_logo'], 'http') === 0 ? $settings['hotel_logo'] : base_url(ltrim($settings['hotel_logo'], './'))) : '';
                                        if (empty($logo_src) && file_exists(FCPATH . 'uploads/site_logo.png')) {
                                            $logo_src = base_url('uploads/site_logo.png');
                                        }
                                    ?>
                                    <div class="border rounded p-2 bg-white text-center d-flex align-items-center justify-content-center shadow-sm" style="width: 120px; height: 70px; overflow: hidden;">
                                        <?php if(!empty($logo_src)): ?>
                                            <img src="<?php echo htmlspecialchars($logo_src); ?>" alt="Site Logo" id="logoPreview" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        <?php else: ?>
                                            <span class="text-muted small" id="logoPreviewPlaceholder"><i class="fa-solid fa-image text-secondary d-block fs-4 mb-1"></i> No Logo</span>
                                            <img src="" alt="Site Logo" id="logoPreview" style="max-height: 100%; max-width: 100%; object-fit: contain; display:none;">
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <small class="text-muted d-block mb-1">Upload a transparent PNG/SVG logo to represent your brand across headers, footers & metadata.</small>
                                        <?php if(!empty($settings['hotel_logo'])): ?>
                                            <div class="form-check form-check-inline mt-1">
                                                <input class="form-check-input" type="checkbox" name="remove_hotel_logo" value="1" id="removeLogoCheck">
                                                <label class="form-check-label small text-danger fw-semibold" for="removeLogoCheck">Remove custom logo</label>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <input type="file" name="hotel_logo" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'logoPreview', 'logoPreviewPlaceholder')">
                            </div>
                        </div>

                        <!-- Site Favicon -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <label class="form-label fw-bold d-flex justify-content-between align-items-center mb-2">
                                    <span><i class="fa-solid fa-icons text-primary me-1"></i> Site Favicon (Browser Icon)</span>
                                    <span class="badge bg-secondary">ICO / PNG / SVG</span>
                                </label>
                                
                                <div class="mb-3 d-flex align-items-center gap-3">
                                    <?php 
                                        $favicon_src = !empty($settings['hotel_favicon']) ? (strpos($settings['hotel_favicon'], 'http') === 0 ? $settings['hotel_favicon'] : base_url(ltrim($settings['hotel_favicon'], './'))) : '';
                                        if (empty($favicon_src) && !empty($logo_src)) {
                                            $favicon_src = $logo_src;
                                        }
                                    ?>
                                    <!-- Browser Tab Simulation Preview -->
                                    <div class="border rounded p-2 bg-white d-flex align-items-center gap-2 shadow-sm" style="min-width: 130px; height: 70px;">
                                        <div class="p-1 rounded border bg-light d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                            <?php if(!empty($favicon_src)): ?>
                                                <img src="<?php echo htmlspecialchars($favicon_src); ?>" alt="Favicon" id="favPreview" style="width: 24px; height: 24px; object-fit: contain;">
                                            <?php else: ?>
                                                <span class="text-muted small" id="favPreviewPlaceholder"><i class="fa-solid fa-globe fs-5"></i></span>
                                                <img src="" alt="Favicon" id="favPreview" style="width: 24px; height: 24px; object-fit: contain; display:none;">
                                            <?php endif; ?>
                                        </div>
                                        <div class="overflow-hidden">
                                            <span class="small fw-semibold d-block text-truncate" style="font-size: 0.72rem;">Browser Tab</span>
                                            <span class="text-muted" style="font-size: 0.65rem;">16x16 / 32x32</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <small class="text-muted d-block mb-1">Small square icon displayed on browser tabs and bookmarks bar.</small>
                                        <?php if(!empty($settings['hotel_favicon'])): ?>
                                            <div class="form-check form-check-inline mt-1">
                                                <input class="form-check-input" type="checkbox" name="remove_hotel_favicon" value="1" id="removeFavCheck">
                                                <label class="form-check-label small text-danger fw-semibold" for="removeFavCheck">Remove custom favicon</label>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <input type="file" name="hotel_favicon" class="form-control form-control-sm" accept=".ico,image/png,image/x-icon,image/svg+xml,image/jpeg" onchange="previewImage(this, 'favPreview', 'favPreviewPlaceholder')">
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom"><i class="fa-solid fa-hotel me-2"></i> General Hotel Identity</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hotel Name *</label>
                            <input type="text" name="hotel_name" class="form-control" required value="<?php echo htmlspecialchars($settings['hotel_name'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Slogan / Tagline</label>
                            <input type="text" name="hotel_tagline" class="form-control" value="<?php echo htmlspecialchars($settings['hotel_tagline'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Primary Contact Email *</label>
                            <input type="email" name="hotel_email" class="form-control" required value="<?php echo htmlspecialchars($settings['hotel_email'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Primary Telephone *</label>
                            <input type="text" name="hotel_phone" class="form-control" required value="<?php echo htmlspecialchars($settings['hotel_phone'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alternative Phone</label>
                            <input type="text" name="hotel_alt_phone" class="form-control" value="<?php echo htmlspecialchars($settings['hotel_alt_phone'] ?? ''); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Physical Postal Address</label>
                            <textarea name="hotel_address" class="form-control" rows="2"><?php echo htmlspecialchars($settings['hotel_address'] ?? ''); ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Google Maps Embed URL / Iframe Src</label>
                            <input type="text" name="map_iframe" class="form-control" value="<?php echo htmlspecialchars($settings['map_iframe'] ?? ''); ?>">
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom"><i class="fa-solid fa-share-nodes me-2"></i> Social Media Profiles</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Facebook URL</label>
                            <input type="url" name="facebook_url" class="form-control" value="<?php echo htmlspecialchars($settings['facebook_url'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Instagram URL</label>
                            <input type="url" name="instagram_url" class="form-control" value="<?php echo htmlspecialchars($settings['instagram_url'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Twitter URL</label>
                            <input type="url" name="twitter_url" class="form-control" value="<?php echo htmlspecialchars($settings['twitter_url'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">TripAdvisor URL</label>
                            <input type="url" name="tripadvisor_url" class="form-control" value="<?php echo htmlspecialchars($settings['tripadvisor_url'] ?? ''); ?>">
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom"><i class="fa-solid fa-envelope-circle-check me-2"></i> SMTP Email Configuration</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">SMTP Host</label>
                            <input type="text" name="smtp_host" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_host'] ?? 'smtp.gmail.com'); ?>" placeholder="smtp.gmail.com">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">SMTP Port</label>
                            <input type="number" name="smtp_port" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_port'] ?? '587'); ?>" placeholder="587">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Encryption</label>
                            <select name="smtp_crypto" class="form-select">
                                <option value="tls" <?php echo ($settings['smtp_crypto'] ?? '') == 'tls' ? 'selected' : ''; ?>>TLS (Port 587)</option>
                                <option value="ssl" <?php echo ($settings['smtp_crypto'] ?? '') == 'ssl' ? 'selected' : ''; ?>>SSL (Port 465)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">SMTP Username / Email</label>
                            <input type="text" name="smtp_user" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_user'] ?? ''); ?>" placeholder="your-email@gmail.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">SMTP App Password</label>
                            <input type="password" name="smtp_pass" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_pass'] ?? ''); ?>" placeholder="••••••••••••">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">From Email Address</label>
                            <input type="email" name="smtp_from_email" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_from_email'] ?? ''); ?>" placeholder="reservations@grandcannann.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">From Display Name</label>
                            <input type="text" name="smtp_from_name" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_from_name'] ?? 'Grand Cannann Hotel'); ?>">
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom"><i class="fa-solid fa-globe me-2"></i> Global SEO Defaults</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Default Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="<?php echo htmlspecialchars($settings['meta_title'] ?? ''); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Default Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" value="<?php echo htmlspecialchars($settings['meta_keywords'] ?? ''); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Default Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3"><?php echo htmlspecialchars($settings['meta_description'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary py-2 px-4 fs-6">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Save All Settings
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Side: Profile Security & SMTP Tester -->
        <div class="col-lg-4 d-flex flex-column gap-4">
            <!-- Admin Account Security -->
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-user-shield text-primary me-2"></i> Admin Security & Login</h5>
                <p class="text-muted small mb-3">Update your login username, email, and dashboard access credentials.</p>

                <form action="<?php echo base_url('admin/update_admin_profile'); ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Admin Display Name</label>
                        <input type="text" name="admin_name" class="form-control form-control-sm" value="<?php echo htmlspecialchars($admin_user['name'] ?? $this->session->userdata('admin_name') ?? 'Admin Manager'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Login Username</label>
                        <input type="text" name="admin_username" class="form-control form-control-sm" value="<?php echo htmlspecialchars($admin_user['username'] ?? $this->session->userdata('admin_username') ?? 'admin'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Login Email</label>
                        <input type="email" name="admin_email" class="form-control form-control-sm" value="<?php echo htmlspecialchars($admin_user['email'] ?? $this->session->userdata('admin_email') ?? 'admin@hotelcanaann.com'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">New Password <small class="text-muted fw-normal">(leave blank to keep current)</small></label>
                        <input type="password" name="new_password" class="form-control form-control-sm" placeholder="••••••••">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control form-control-sm" placeholder="••••••••">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100 py-2">
                        <i class="fa-solid fa-lock me-1"></i> Update Admin Credentials
                    </button>
                </form>
            </div>

            <!-- SMTP Tester -->
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-paper-plane text-primary me-2"></i> Send Test Email</h5>
                <p class="text-muted small mb-3">Verify that your SMTP host, port, username, and password are communicating properly with the mail server.</p>

                <form action="<?php echo base_url('admin/send_test_email'); ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Recipient Email</label>
                        <input type="email" name="test_email" class="form-control form-control-sm" placeholder="your-personal@email.com" required>
                    </div>
                    <button type="submit" class="btn btn-outline-dark btn-sm w-100 py-2">
                        <i class="fa-solid fa-paper-plane me-1"></i> Send Test Email
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top small text-muted">
                    <h6 class="fw-bold text-dark small mb-2"><i class="fa-solid fa-circle-info text-primary me-1"></i> Quick Tips for Gmail SMTP:</h6>
                    <ul class="ps-3 mb-0" style="line-height: 1.7;">
                        <li>Host: <code>smtp.gmail.com</code></li>
                        <li>Port: <code>587</code> (TLS)</li>
                        <li>Password: Use a 16-character <strong>Google App Password</strong> (not your regular Gmail password).</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input, imgId, placeholderId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.getElementById(imgId);
            img.src = e.target.result;
            img.style.display = 'inline-block';
            if (placeholderId) {
                var ph = document.getElementById(placeholderId);
                if (ph) ph.style.display = 'none';
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
