<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Room Categories Management</h3>
            <span class="text-muted">Create and manage luxury suite categories.</span>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fa-solid fa-plus me-1"></i> Add Category
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
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Badge</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($categories)): foreach($categories as $cat): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($cat['image'] ?: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=150&q=80'); ?>" alt="Category" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($cat['name']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars(substr($cat['description'], 0, 80)); ?>...</small>
                            </td>
                            <td><code><?php echo htmlspecialchars($cat['slug']); ?></code></td>
                            <td><span class="badge bg-warning text-dark"><?php echo htmlspecialchars($cat['badge']); ?></span></td>
                            <td><span class="badge bg-<?php echo $cat['status'] == 'active' ? 'success' : 'secondary'; ?>"><?php echo ucfirst($cat['status']); ?></span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?php echo $cat['id']; ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <a href="<?php echo base_url('admin/delete_category/' . $cat['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this category?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editCategoryModal<?php echo $cat['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="<?php echo base_url('admin/edit_category'); ?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Category Name *</label>
                                                <input type="text" name="name" class="form-control" required value="<?php echo htmlspecialchars($cat['name']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Badge</label>
                                                <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($cat['badge']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($cat['description']); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Upload New Image</label>
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Or Image URL</label>
                                                <input type="text" name="image_url" class="form-control" value="<?php echo htmlspecialchars($cat['image']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="active" <?php echo $cat['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                                    <option value="inactive" <?php echo $cat['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                                </select>
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
                        <tr><td colspan="6" class="text-center py-4 text-muted">No room categories found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_category'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Room Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Presidential & Royal Suites" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Badge</label>
                        <input type="text" name="badge" class="form-control" value="Popular">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Brief category summary..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Image File</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Or Image URL</label>
                        <input type="text" name="image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
