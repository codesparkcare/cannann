<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Restaurant Table Reservations</h3>
            <span class="text-muted">Manage table bookings, seating preferences, and guest party sizes.</span>
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
                        <th>Guest</th>
                        <th>Date & Time</th>
                        <th>Party Size</th>
                        <th>Seating Preference</th>
                        <th>Special Notes</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($reservations)): foreach($reservations as $r): ?>
                        <tr>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($r['guest_name']); ?></div>
                                <small class="text-muted d-block"><i class="fa-solid fa-envelope me-1"></i><?php echo htmlspecialchars($r['email']); ?></small>
                                <small class="text-muted d-block"><i class="fa-solid fa-phone me-1"></i><?php echo htmlspecialchars($r['phone']); ?></small>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark"><?php echo date('M d, Y', strtotime($r['reservation_date'])); ?></div>
                                <small class="text-muted"><i class="fa-regular fa-clock me-1"></i><?php echo date('h:i A', strtotime($r['reservation_time'])); ?></small>
                            </td>
                            <td><span class="badge bg-primary fs-6"><?php echo $r['guest_count']; ?> Guests</span></td>
                            <td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($r['table_preference']); ?></span></td>
                            <td><small class="text-muted"><?php echo htmlspecialchars($r['special_notes'] ?: '-'); ?></small></td>
                            <td>
                                <form action="<?php echo base_url('admin/update_reservation_status'); ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 120px;">
                                        <option value="pending" <?php echo $r['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="confirmed" <?php echo $r['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                        <option value="cancelled" <?php echo $r['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo base_url('admin/delete_reservation/' . $r['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this reservation?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">No table reservations recorded yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
