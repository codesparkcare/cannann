<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Rooms & Suites Management</h3>
            <span class="text-muted">Manage hotel rooms, luxury suites, amenities, and nightly pricing.</span>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            <i class="fa-solid fa-plus me-1"></i> Add New Room
        </button>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Photo</th>
                        <th>Room Title</th>
                        <th>Category</th>
                        <th>Rate / Night</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($rooms)): foreach($rooms as $rm): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($rm['featured_image']); ?>" alt="Room" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($rm['title']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars($rm['bed_type']); ?> | <?php echo htmlspecialchars($rm['room_size']); ?></small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($rm['category_name'] ?? 'General'); ?></span></td>
                            <td>
                                <div class="fw-bold text-primary">₹<?php echo number_format($rm['discounted_price'] ?: $rm['price']); ?></div>
                                <?php if($rm['discounted_price'] > 0 && $rm['discounted_price'] < $rm['price']): ?>
                                    <small class="text-decoration-line-through text-muted">₹<?php echo number_format($rm['price']); ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $rm['max_adults']; ?> Adults, <?php echo $rm['max_children']; ?> Kids</td>
                            <td>
                                <?php if($rm['status'] == 'available'): ?>
                                    <span class="badge bg-success">Available</span>
                                <?php elseif($rm['status'] == 'booked'): ?>
                                    <span class="badge bg-danger">Booked</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Maintenance</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo base_url('room/' . $rm['slug']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="View on site"><i class="fa-solid fa-eye"></i></a>
                                <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editRoomModal<?php echo $rm['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <a href="<?php echo base_url('admin/delete_room/' . $rm['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this room?');"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editRoomModal<?php echo $rm['id']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo base_url('admin/edit_room'); ?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $rm['id']; ?>">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Suite: <?php echo htmlspecialchars($rm['title']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Category *</label>
                                                    <select name="category_id" class="form-select" required>
                                                        <?php foreach($categories as $cat): ?>
                                                            <option value="<?php echo $cat['id']; ?>" <?php echo $rm['category_id'] == $cat['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat['name']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Room Title *</label>
                                                    <input type="text" name="title" class="form-control" required value="<?php echo htmlspecialchars($rm['title']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Standard Price (₹) *</label>
                                                    <input type="number" step="0.01" name="price" class="form-control" required value="<?php echo $rm['price']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Discounted / Offer Price (₹)</label>
                                                    <input type="number" step="0.01" name="discounted_price" class="form-control" value="<?php echo $rm['discounted_price']; ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Max Adults</label>
                                                    <input type="number" name="max_adults" class="form-control" value="<?php echo $rm['max_adults']; ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Max Children</label>
                                                    <input type="number" name="max_children" class="form-control" value="<?php echo $rm['max_children']; ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Bed Type</label>
                                                    <input type="text" name="bed_type" class="form-control" value="<?php echo htmlspecialchars($rm['bed_type']); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Room Size</label>
                                                    <input type="text" name="room_size" class="form-control" value="<?php echo htmlspecialchars($rm['room_size']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">View Type</label>
                                                    <input type="text" name="view_type" class="form-control" value="<?php echo htmlspecialchars($rm['view_type']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Amenities (Comma-separated)</label>
                                                    <input type="text" name="amenities" class="form-control" value="<?php echo htmlspecialchars($rm['amenities']); ?>">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Short Summary</label>
                                                    <textarea name="short_description" class="form-control" rows="2"><?php echo htmlspecialchars($rm['short_description']); ?></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Detailed Long Description</label>
                                                    <textarea name="long_description" class="form-control" rows="4"><?php echo htmlspecialchars($rm['long_description']); ?></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Upload New Featured Image</label>
                                                    <input type="file" name="featured_image" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Or Featured Image URL</label>
                                                    <input type="text" name="featured_image_url" class="form-control" value="<?php echo htmlspecialchars($rm['featured_image']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="available" <?php echo $rm['status'] == 'available' ? 'selected' : ''; ?>>Available</option>
                                                        <option value="booked" <?php echo $rm['status'] == 'booked' ? 'selected' : ''; ?>>Booked</option>
                                                        <option value="maintenance" <?php echo $rm['status'] == 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 d-flex align-items-center mt-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="feat_<?php echo $rm['id']; ?>" <?php echo $rm['is_featured'] ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="feat_<?php echo $rm['id']; ?>">Show on Homepage as Featured Suite</label>
                                                    </div>
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
                        <tr><td colspan="7" class="text-center py-4 text-muted">No rooms created yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_room'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Luxury Room / Suite</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Category *</label>
                            <select name="category_id" class="form-select" required>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Room Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Presidential Ocean Penthouse" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Standard Price (₹) *</label>
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="15000" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Discounted / Offer Price (₹)</label>
                            <input type="number" step="0.01" name="discounted_price" class="form-control" placeholder="12500">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Max Adults</label>
                            <input type="number" name="max_adults" class="form-control" value="2">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Max Children</label>
                            <input type="number" name="max_children" class="form-control" value="1">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Bed Type</label>
                            <input type="text" name="bed_type" class="form-control" value="1 King Size Bed">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Room Size</label>
                            <input type="text" name="room_size" class="form-control" value="650 sq.ft">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">View Type</label>
                            <input type="text" name="view_type" class="form-control" value="Panoramic Ocean View">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Amenities (Comma-separated)</label>
                            <input type="text" name="amenities" class="form-control" value="Private Jacuzzi, Butler Service, Ocean Balcony, Free High-Speed Wi-Fi, 55-inch OLED TV">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Summary</label>
                            <textarea name="short_description" class="form-control" rows="2" placeholder="Brief 1-2 sentence highlight..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Detailed Long Description</label>
                            <textarea name="long_description" class="form-control" rows="4" placeholder="Full luxury description of the room experience..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Featured Photo</label>
                            <input type="file" name="featured_image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Or Featured Photo URL</label>
                            <input type="text" name="featured_image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_feat_new" checked>
                                <label class="form-check-label" for="is_feat_new">Show on Homepage as Featured Suite</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
