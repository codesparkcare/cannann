<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Hero Sliders Management</h3>
            <span class="text-muted">Manage animated homepage background slides, texts, and CTA links.</span>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSliderModal">
            <i class="fa-solid fa-plus me-1"></i> Add New Slide
        </button>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if(!empty($sliders)): foreach($sliders as $s): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                    <img src="<?php echo htmlspecialchars($s['image']); ?>" alt="Slide" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-primary text-white mb-2"><?php echo htmlspecialchars($s['tag']); ?></span>
                            <h5 class="fw-bold mb-2"><?php echo htmlspecialchars($s['title']); ?></h5>
                            <p class="text-muted small mb-3"><?php echo htmlspecialchars($s['subtitle']); ?></p>
                            <div class="small text-muted mb-2">
                                <div><strong>Primary CTA:</strong> <?php echo htmlspecialchars($s['button_text']); ?> (<code><?php echo htmlspecialchars($s['button_link']); ?></code>)</div>
                                <div><strong>Order:</strong> <?php echo $s['sort_order']; ?> | <strong>Status:</strong> <span class="badge bg-<?php echo $s['status'] == 'active' ? 'success' : 'secondary'; ?>"><?php echo ucfirst($s['status']); ?></span></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top mt-3">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSliderModal<?php echo $s['id']; ?>">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            <a href="<?php echo base_url('admin/delete_slider/' . $s['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this slide?');">
                                <i class="fa-solid fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editSliderModal<?php echo $s['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="<?php echo base_url('admin/edit_slider'); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Slide</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Tag Badge</label>
                                        <input type="text" name="tag" class="form-control" value="<?php echo htmlspecialchars($s['tag']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Display Order</label>
                                        <input type="number" name="sort_order" class="form-control" value="<?php echo $s['sort_order']; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Slide Main Title *</label>
                                        <input type="text" name="title" class="form-control" required value="<?php echo htmlspecialchars($s['title']); ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Subtitle Description</label>
                                        <textarea name="subtitle" class="form-control" rows="2"><?php echo htmlspecialchars($s['subtitle']); ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Button Text</label>
                                        <input type="text" name="button_text" class="form-control" value="<?php echo htmlspecialchars($s['button_text']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Button Link URL</label>
                                        <input type="text" name="button_link" class="form-control" value="<?php echo htmlspecialchars($s['button_link']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Secondary Button Text</label>
                                        <input type="text" name="secondary_btn_text" class="form-control" value="<?php echo htmlspecialchars($s['secondary_btn_text']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Secondary Button Link</label>
                                        <input type="text" name="secondary_btn_link" class="form-control" value="<?php echo htmlspecialchars($s['secondary_btn_link']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Upload New Image File</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Or Image URL</label>
                                        <input type="text" name="image_url" class="form-control" value="<?php echo htmlspecialchars($s['image']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" <?php echo $s['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                            <option value="inactive" <?php echo $s['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; else: ?>
            <div class="col-12 text-center py-5 text-muted">No slides found. Click "Add New Slide" to create one.</div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addSliderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_slider'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Hero Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tag Badge</label>
                            <input type="text" name="tag" class="form-control" value="5-STAR BOUTIQUE RESORT">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="sort_order" class="form-control" value="1">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Slide Main Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Experience Coastal Luxury & Sublime Comfort" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Subtitle Description</label>
                            <textarea name="subtitle" class="form-control" rows="2" placeholder="Short description shown under title..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Primary Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="Explore Luxury Suites">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Primary Button Link</label>
                            <input type="text" name="button_link" class="form-control" value="rooms">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Secondary Button Text</label>
                            <input type="text" name="secondary_btn_text" class="form-control" value="Reserve Dining Table">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Secondary Button Link</label>
                            <input type="text" name="secondary_btn_link" class="form-control" value="restaurant">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Image File</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Or Image URL</label>
                            <input type="text" name="image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Slide</button>
                </div>
            </form>
        </div>
    </div>
</div>
