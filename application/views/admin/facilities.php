<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Hotel Facilities & Amenities</h3>
            <span class="text-muted">Manage hotel leisure amenities, spa, infinity pool, and concierge services.</span>
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
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                    <img src="<?php echo htmlspecialchars($fac['image'] ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80'); ?>" alt="Facility" style="height: 160px; object-fit: cover;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="<?php echo htmlspecialchars($fac['icon']); ?> text-primary fs-4"></i>
                                <h5 class="fw-bold mb-0"><?php echo htmlspecialchars($fac['title']); ?></h5>
                            </div>
                            <p class="text-muted small mb-0"><?php echo htmlspecialchars($fac['short_description']); ?></p>
                        </div>
                        <div class="d-flex justify-content-end gap-2 pt-3 border-top mt-3">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editFacilityModal<?php echo $fac['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                            <a href="<?php echo base_url('admin/delete_facility/' . $fac['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this facility?');"><i class="fa-solid fa-trash"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editFacilityModal<?php echo $fac['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?php echo base_url('admin/edit_facility'); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $fac['id']; ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Facility</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Facility Title *</label>
                                    <input type="text" name="title" class="form-control" required value="<?php echo htmlspecialchars($fac['title']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">FontAwesome Icon Class</label>
                                    <input type="text" name="icon" class="form-control" value="<?php echo htmlspecialchars($fac['icon']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control" rows="2"><?php echo htmlspecialchars($fac['short_description']); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Or Image URL</label>
                                    <input type="text" name="image_url" class="form-control" value="<?php echo htmlspecialchars($fac['image']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Display Order</label>
                                    <input type="number" name="sort_order" class="form-control" value="<?php echo $fac['sort_order']; ?>">
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
            <form action="<?php echo base_url('admin/add_facility'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Hotel Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Facility Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Infinity Oceanfront Pool" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="icon" class="form-control" value="fa-solid fa-water-ladder">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Short Description *</label>
                        <textarea name="short_description" class="form-control" rows="2" placeholder="Brief highlight of amenity..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Image File</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Or Image URL</label>
                        <input type="text" name="image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="sort_order" class="form-control" value="1">
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
