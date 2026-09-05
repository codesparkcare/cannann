<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Inquiries & Contact Leads</h3>
            <span class="text-muted">Messages received through the website contact and inquiry form.</span>
        </div>
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
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($contacts)): foreach($contacts as $c): ?>
                        <tr>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($c['name']); ?></div>
                                <small class="text-muted d-block"><i class="fa-solid fa-envelope me-1"></i><a href="mailto:<?php echo htmlspecialchars($c['email']); ?>"><?php echo htmlspecialchars($c['email']); ?></a></small>
                                <?php if(!empty($c['phone'])): ?>
                                    <small class="text-muted d-block"><i class="fa-solid fa-phone me-1"></i><?php echo htmlspecialchars($c['phone']); ?></small>
                                <?php endif; ?>
                            </td>
                            <td><span class="fw-semibold text-dark"><?php echo htmlspecialchars($c['subject']); ?></span></td>
                            <td>
                                <small class="text-muted" style="max-width: 300px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?php echo htmlspecialchars($c['message']); ?>
                                </small>
                            </td>
                            <td><small class="text-muted"><?php echo date('M d, Y h:i A', strtotime($c['created_at'])); ?></small></td>
                            <td>
                                <form action="<?php echo base_url('admin/update_contact_status'); ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 110px;">
                                        <option value="unread" <?php echo $c['status'] == 'unread' ? 'selected' : ''; ?>>Unread</option>
                                        <option value="read" <?php echo $c['status'] == 'read' ? 'selected' : ''; ?>>Read</option>
                                        <option value="replied" <?php echo $c['status'] == 'replied' ? 'selected' : ''; ?>>Replied</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo base_url('admin/delete_contact/' . $c['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this inquiry?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">No contact messages received yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
