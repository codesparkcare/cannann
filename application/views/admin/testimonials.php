<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Guest Testimonials Management</h3>
            <span class="text-muted">Manage guest reviews, ratings, designations, and display status.</span>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestModal">
            <i class="fa-solid fa-plus me-1"></i> Add Review
        </button>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if(!empty($testimonials)): foreach($testimonials as $t): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="<?php echo htmlspecialchars($t['avatar'] ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80'); ?>" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-0"><?php echo htmlspecialchars($t['guest_name']); ?></h6>
                                <small class="text-muted"><?php echo htmlspecialchars($t['designation']); ?> (<?php echo htmlspecialchars($t['location']); ?>)</small>
                            </div>
                        </div>
                        <div class="text-warning small mb-2">
                            <?php for($i=0; $i<$t['rating']; $i++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
                        </div>
                        <p class="text-muted small mb-0" style="font-style: italic;">"<?php echo htmlspecialchars($t['review']); ?>"</p>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top mt-3">
                        <a href="<?php echo base_url('admin/delete_testimonial/' . $t['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this review?');">
                            <i class="fa-solid fa-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; else: ?>
            <div class="col-12 text-center py-5 text-muted">No testimonials found.</div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addTestModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_testimonial'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Guest Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Guest Name *</label>
                        <input type="text" name="guest_name" class="form-control" placeholder="e.g. Eleanor Vance" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Designation / Title</label>
                        <input type="text" name="designation" class="form-control" value="Verified Guest">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City / Country</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g. London, UK">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating (1 to 5 Stars)</label>
                        <select name="rating" class="form-select">
                            <option value="5" selected>5 Stars (Excellent)</option>
                            <option value="4">4 Stars (Very Good)</option>
                            <option value="3">3 Stars (Good)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Review Text *</label>
                        <textarea name="review" class="form-control" rows="4" placeholder="Guest quote and comments..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Or Avatar URL</label>
                        <input type="text" name="avatar_url" class="form-control" placeholder="https://images.unsplash.com/...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>
