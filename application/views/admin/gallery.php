<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Photo Gallery Management</h3>
            <span class="text-muted">Upload and categorize high-resolution photos for the resort gallery.</span>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
            <i class="fa-solid fa-plus me-1"></i> Upload Photo
        </button>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if(!empty($gallery)): foreach($gallery as $img): ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                    <img src="<?php echo htmlspecialchars($img['image']); ?>" alt="<?php echo htmlspecialchars($img['title']); ?>" style="height: 180px; object-fit: cover;">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle mb-1 text-uppercase" style="font-size: 0.7rem;"><?php echo htmlspecialchars($img['category']); ?></span>
                            <h6 class="fw-bold mb-1 text-truncate"><?php echo htmlspecialchars($img['title']); ?></h6>
                            <small class="text-muted text-truncate d-block"><?php echo htmlspecialchars($img['caption']); ?></small>
                        </div>
                        <div class="text-end pt-2 border-top mt-2">
                            <a href="<?php echo base_url('admin/delete_gallery/' . $img['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this image?');">
                                <i class="fa-solid fa-trash me-1"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; else: ?>
            <div class="col-12 text-center py-5 text-muted">No photos uploaded to gallery yet.</div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addPhotoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_gallery'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Gallery Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Photo Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Sunset Infinity Pool View" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category *</label>
                        <select name="category" class="form-select" required>
                            <option value="hotel">Resort & Grounds</option>
                            <option value="rooms">Suites & Villas</option>
                            <option value="restaurant">Dining & Bar</option>
                            <option value="spa">Pool & Spa</option>
                            <option value="events">Events & Weddings</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Caption / Description</label>
                        <input type="text" name="caption" class="form-control" placeholder="Short photo description...">
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
                    <button type="submit" class="btn btn-primary">Save to Gallery</button>
                </div>
            </form>
        </div>
    </div>
</div>
