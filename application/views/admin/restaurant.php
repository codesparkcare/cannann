<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Restaurant & Dining Menus</h3>
            <span class="text-muted">Manage dining food categories, menu dishes, prices, and dietary tags.</span>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addMenuCatModal">
                <i class="fa-solid fa-folder-plus me-1"></i> Add Category
            </button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDishModal">
                <i class="fa-solid fa-plus me-1"></i> Add Menu Dish
            </button>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Menu Items Table -->
    <div class="card border-0 shadow-sm rounded-3 mb-5">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-utensils text-primary me-2"></i> Menu Dishes List</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Dish Photo</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price (₹)</th>
                        <th>Dietary</th>
                        <th>Badge</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($items)): foreach($items as $it): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($it['image'] ?: 'https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?auto=format&fit=crop&w=150&q=80'); ?>" alt="Dish" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($it['name']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars(substr($it['description'], 0, 80)); ?>...</small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($it['category_name'] ?? 'General'); ?></span></td>
                            <td class="fw-bold text-primary">₹<?php echo number_format($it['price']); ?></td>
                            <td>
                                <?php if($it['dietary_type'] == 'veg'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Veg</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Non-Veg</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(!empty($it['badge'])): ?>
                                    <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($it['badge']); ?></span>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editDishModal<?php echo $it['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <a href="<?php echo base_url('admin/delete_menu_item/' . $it['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this menu item?');"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editDishModal<?php echo $it['id']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo base_url('admin/edit_menu_item'); ?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $it['id']; ?>">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Dish: <?php echo htmlspecialchars($it['name']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Category *</label>
                                                    <select name="category_id" class="form-select" required>
                                                        <?php foreach($categories as $c): ?>
                                                            <option value="<?php echo $c['id']; ?>" <?php echo $it['category_id'] == $c['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($c['name']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Dish Name *</label>
                                                    <input type="text" name="name" class="form-control" required value="<?php echo htmlspecialchars($it['name']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Price (₹) *</label>
                                                    <input type="number" step="0.01" name="price" class="form-control" required value="<?php echo $it['price']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Dietary Type</label>
                                                    <select name="dietary_type" class="form-select">
                                                        <option value="non-veg" <?php echo $it['dietary_type'] == 'non-veg' ? 'selected' : ''; ?>>Non-Vegetarian</option>
                                                        <option value="veg" <?php echo $it['dietary_type'] == 'veg' ? 'selected' : ''; ?>>Vegetarian</option>
                                                        <option value="vegan" <?php echo $it['dietary_type'] == 'vegan' ? 'selected' : ''; ?>>Vegan</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Badge Tag</label>
                                                    <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($it['badge']); ?>" placeholder="Chef Special, Must Try, etc.">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Upload New Photo</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Or Photo URL</label>
                                                    <input type="text" name="image_url" class="form-control" value="<?php echo htmlspecialchars($it['image']); ?>">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Description & Ingredients</label>
                                                    <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($it['description']); ?></textarea>
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
                        <tr><td colspan="7" class="text-center py-4 text-muted">No menu items found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Dish Modal -->
<div class="modal fade" id="addDishModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_menu_item'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Menu Dish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Category *</label>
                            <select name="category_id" class="form-select" required>
                                <?php foreach($categories as $c): ?>
                                    <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Dish Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Grilled Lobster with Herb Butter" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price (₹) *</label>
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="1850" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Dietary Type</label>
                            <select name="dietary_type" class="form-select">
                                <option value="non-veg">Non-Vegetarian</option>
                                <option value="veg">Vegetarian</option>
                                <option value="vegan">Vegan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Badge Tag</label>
                            <input type="text" name="badge" class="form-control" placeholder="e.g. Chef Special, Signature">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Dish Photo</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Or Photo URL</label>
                            <input type="text" name="image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description & Ingredients</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Artisan preparation details..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Dish</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addMenuCatModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_restaurant_category'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add Menu Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Decadent Desserts" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Brief summary of category..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="sort_order" class="form-control" value="1">
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
