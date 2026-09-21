<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Hotel Facilities & Amenities</h3>
            <span class="text-muted">Manage the 6 hotel features & amenities displayed across the website.</span>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFacilityModal">
            <i class="fa-solid fa-plus me-1"></i> Add Facility
        </button>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if(!empty($facilities)): foreach($facilities as $fac): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 d-flex flex-column justify-content-between position-relative" style="background: #ffffff; border: 1px solid rgba(197, 168, 128, 0.25) !important;">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 58px; height: 58px; background: #071911; border: 1px solid rgba(197, 168, 128, 0.4); color: #dfc295; font-size: 1.4rem;">
                                <i class="<?php echo htmlspecialchars($fac['icon'] ?: 'fa-solid fa-hotel'); ?>"></i>
                            </div>
                            <div class="d-flex gap-1 align-items-center">
                                <span class="badge <?php echo ($fac['status'] == 'active' || empty($fac['status'])) ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-secondary-subtle text-secondary border border-secondary-subtle'; ?> rounded-pill px-2 py-1 small">
                                    <?php echo ($fac['status'] == 'active' || empty($fac['status'])) ? 'Active' : 'Inactive'; ?>
                                </span>
                                <span class="badge bg-light text-dark border rounded-pill px-2 py-1 small">
                                    #<?php echo (int)$fac['sort_order']; ?>
                                </span>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-2 font-serif text-dark"><?php echo htmlspecialchars($fac['title']); ?></h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;"><?php echo htmlspecialchars($fac['short_description']); ?></p>
                    </div>
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top mt-4">
                        <button class="btn btn-sm btn-outline-primary px-3" data-bs-toggle="modal" data-bs-target="#editFacilityModal<?php echo $fac['id']; ?>">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                        </button>
                        <a href="<?php echo base_url('admin/delete_facility/' . $fac['id']); ?>" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('Are you sure you want to delete this facility?');">
                            <i class="fa-solid fa-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editFacilityModal<?php echo $fac['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?php echo base_url('admin/edit_facility'); ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fac['id']; ?>">
                            <div class="modal-header">
                                <h5 class="modal-title font-serif">Edit Facility</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Facility Title *</label>
                                    <input type="text" name="title" class="form-control" required value="<?php echo htmlspecialchars($fac['title']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">FontAwesome Icon Class</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="<?php echo htmlspecialchars($fac['icon']); ?>"></i></span>
                                        <input type="text" name="icon" class="form-control" value="<?php echo htmlspecialchars($fac['icon']); ?>">
                                    </div>
                                    <small class="text-muted">e.g. <code>fa-solid fa-bed</code>, <code>fa-solid fa-utensils</code>, <code>fa-solid fa-users-rectangle</code></small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Short Description *</label>
                                    <textarea name="short_description" class="form-control" rows="3" required><?php echo htmlspecialchars($fac['short_description']); ?></textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">Display Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" <?php echo ($fac['status'] == 'active' || empty($fac['status'])) ? 'selected' : ''; ?>>Active (Visible on Frontend)</option>
                                            <option value="inactive" <?php echo ($fac['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive (Hidden)</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">Display Order</label>
                                        <input type="number" name="sort_order" class="form-control" value="<?php echo $fac['sort_order']; ?>">
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
            <div class="col-12 text-center py-5 text-muted">No facilities found.</div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addFacilityModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_facility'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title font-serif">Add Hotel Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Facility Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Spacious Meeting Hall" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">FontAwesome Icon Class</label>
                        <input type="text" name="icon" class="form-control" value="fa-solid fa-users-rectangle">
                        <small class="text-muted">e.g. <code>fa-solid fa-bed</code>, <code>fa-solid fa-utensils</code>, <code>fa-solid fa-users-rectangle</code></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Short Description *</label>
                        <textarea name="short_description" class="form-control" rows="3" placeholder="Brief highlight of facility / service..." required></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Display Status</label>
                            <select name="status" class="form-select">
                                <option value="active" selected>Active (Visible on Frontend)</option>
                                <option value="inactive">Inactive (Hidden)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Display Order</label>
                            <input type="number" name="sort_order" class="form-control" value="1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Facility</button>
                </div>
            </form>
        </div>
    </div>
</div>
