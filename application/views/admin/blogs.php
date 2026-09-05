<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Tourist Blogs & Full SEO Management</h3>
            <span class="text-muted">Publish travel guides with dynamic Meta Titles, Keywords, and Descriptions.</span>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal">
            <i class="fa-solid fa-plus me-1"></i> New Travel Article
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
                        <th>Cover</th>
                        <th>Title & Slug</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>SEO Meta Title</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($blogs)): foreach($blogs as $b): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($b['featured_image']); ?>" alt="Cover" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($b['title']); ?></div>
                                <small class="text-muted"><code>/blog/<?php echo htmlspecialchars($b['slug']); ?></code></small>
                            </td>
                            <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle"><?php echo htmlspecialchars($b['category']); ?></span></td>
                            <td><small class="text-dark"><?php echo htmlspecialchars($b['author_name']); ?></small></td>
                            <td>
                                <div class="small fw-semibold text-truncate" style="max-width: 200px;"><?php echo htmlspecialchars($b['meta_title']); ?></div>
                                <small class="text-muted text-truncate d-block" style="max-width: 200px;"><?php echo htmlspecialchars($b['meta_keywords']); ?></small>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo $b['status'] == 'published' ? 'success' : 'secondary'; ?>"><?php echo ucfirst($b['status']); ?></span>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo base_url('blog/' . $b['slug']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="Preview"><i class="fa-solid fa-eye"></i></a>
                                <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editBlogModal<?php echo $b['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <a href="<?php echo base_url('admin/delete_blog/' . $b['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this blog?');"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editBlogModal<?php echo $b['id']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <form action="<?php echo base_url('admin/edit_blog'); ?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Article: <?php echo htmlspecialchars($b['title']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-8">
                                                    <label class="form-label">Article Title *</label>
                                                    <input type="text" name="title" class="form-control" required value="<?php echo htmlspecialchars($b['title']); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Category</label>
                                                    <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($b['category']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Author Name</label>
                                                    <input type="text" name="author_name" class="form-control" value="<?php echo htmlspecialchars($b['author_name']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Read Time</label>
                                                    <input type="text" name="read_time" class="form-control" value="<?php echo htmlspecialchars($b['read_time']); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Upload New Cover Photo</label>
                                                    <input type="file" name="featured_image" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Or Cover Photo URL</label>
                                                    <input type="text" name="featured_image_url" class="form-control" value="<?php echo htmlspecialchars($b['featured_image']); ?>">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Summary / Excerpt</label>
                                                    <textarea name="summary" class="form-control" rows="2"><?php echo htmlspecialchars($b['summary']); ?></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Article HTML / Text Content *</label>
                                                    <textarea name="content" class="form-control" rows="8" required><?php echo htmlspecialchars($b['content']); ?></textarea>
                                                </div>

                                                <!-- Dedicated Dynamic SEO Box -->
                                                <div class="col-12">
                                                    <div class="p-3 rounded-3 border border-primary-subtle bg-light">
                                                        <h6 class="fw-bold text-primary mb-3"><i class="fa-solid fa-magnifying-glass-chart me-2"></i> Search Engine Optimization (SEO Setup)</h6>
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label small fw-bold">Meta Title *</label>
                                                                <input type="text" name="meta_title" class="form-control" required value="<?php echo htmlspecialchars($b['meta_title']); ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label small fw-bold">Meta Keywords (Comma-separated)</label>
                                                                <input type="text" name="meta_keywords" class="form-control" value="<?php echo htmlspecialchars($b['meta_keywords']); ?>">
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label small fw-bold">Meta Description</label>
                                                                <textarea name="meta_description" class="form-control" rows="2"><?php echo htmlspecialchars($b['meta_description']); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="published" <?php echo $b['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                                                        <option value="draft" <?php echo $b['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
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
                        <tr><td colspan="7" class="text-center py-4 text-muted">No blog articles found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/add_blog'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Publish New Tourist Blog (with Full SEO)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Article Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. 5 Hidden Beaches Near Grand Cannann" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" value="Tourist Guide">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Author Name</label>
                            <input type="text" name="author_name" class="form-control" value="Chief Concierge">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Read Time</label>
                            <input type="text" name="read_time" class="form-control" value="5 min read">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Cover Photo</label>
                            <input type="file" name="featured_image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Or Cover Photo URL</label>
                            <input type="text" name="featured_image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Summary / Excerpt</label>
                            <textarea name="summary" class="form-control" rows="2" placeholder="Brief hook of the article..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Article HTML / Text Content *</label>
                            <textarea name="content" class="form-control" rows="8" placeholder="<p>Full article body...</p>" required></textarea>
                        </div>

                        <!-- Dedicated Dynamic SEO Box -->
                        <div class="col-12">
                            <div class="p-3 rounded-3 border border-primary-subtle bg-light">
                                <h6 class="fw-bold text-primary mb-3"><i class="fa-solid fa-magnifying-glass-chart me-2"></i> Search Engine Optimization (SEO Setup)</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Meta Title *</label>
                                        <input type="text" name="meta_title" class="form-control" placeholder="Search engine title tag..." required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Meta Keywords (Comma-separated)</label>
                                        <input type="text" name="meta_keywords" class="form-control" placeholder="beaches, coastal tour, travel guide, hotel resort">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="2" placeholder="Search engine snippet description (max 160 characters)..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Publish Article</button>
                </div>
            </form>
        </div>
    </div>
</div>
