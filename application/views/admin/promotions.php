<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Promotions & Offers Management</h3>
            <span class="text-muted">Manage seasonal retreat packages, discount promo codes, and banners.</span>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPromoModal">
            <i class="fa-solid fa-plus me-1"></i> Add Promotion
        </button>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if(!empty($promotions)): foreach($promotions as $promo): ?>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-5">
                            <img src="<?php echo htmlspecialchars($promo['banner_image']); ?>" alt="Promo" class="img-fluid h-100 w-100" style="min-height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-7 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge bg-warning text-dark mb-2"><?php echo htmlspecialchars($promo['badge']); ?></span>
                                <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($promo['title']); ?></h5>
                                <div class="text-primary fw-bold small mb-2"><?php echo htmlspecialchars($promo['discount_text']); ?></div>
                                <p class="text-muted small mb-3"><?php echo htmlspecialchars($promo['description']); ?></p>
                                <span class="badge bg-dark">CODE: <?php echo htmlspecialchars($promo['promo_code']); ?></span>
                            </div>
                            <div class="d-flex justify-content-end gap-2 pt-3 border-top mt-3">
                                <a href="<?php echo base_url('admin/delete_promotion/' . $promo['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this promotion?');"><i class="fa-solid fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; else: ?>
            <div class="col-12 text-center py-5 text-muted">No promotions active.</div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addPromoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_promotion'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Seasonal Promotion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Promotion Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Romantic Sunset & Honeymoon Escape" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Badge Tag</label>
                            <input type="text" name="badge" class="form-control" value="SPECIAL RETREAT">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Discount Text</label>
                            <input type="text" name="discount_text" class="form-control" placeholder="e.g. 25% Off + Free Spa">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Promo Code</label>
                            <input type="text" name="promo_code" class="form-control" placeholder="e.g. ROMANCE25">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Banner Image</label>
                            <input type="file" name="banner_image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Or Banner Image URL</label>
                            <input type="text" name="banner_image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Package Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Includes champagne, beach dinner, etc."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Publish Offer</button>
                </div>
            </form>
        </div>
    </div>
</div>
