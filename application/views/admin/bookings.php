<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Room Bookings & Inquiries</h3>
            <span class="text-muted">Manage guest room reservations, dates, and reservation status.</span>
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
                        <th>Booking Ref</th>
                        <th>Guest Details</th>
                        <th>Suite / Category</th>
                        <th>Dates & Guests</th>
                        <th>Total (₹)</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($bookings)): foreach($bookings as $b): ?>
                        <tr>
                            <td><span class="badge bg-dark fs-6"><?php echo $b['booking_number']; ?></span></td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($b['guest_name']); ?></div>
                                <small class="text-muted d-block"><i class="fa-solid fa-envelope me-1"></i><?php echo htmlspecialchars($b['email']); ?></small>
                                <small class="text-muted d-block"><i class="fa-solid fa-phone me-1"></i><?php echo htmlspecialchars($b['phone']); ?></small>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark"><?php echo htmlspecialchars($b['room_title'] ?: ($b['category_name'] ?: 'Any Suite')); ?></div>
                                <?php if(!empty($b['special_requests'])): ?>
                                    <small class="text-muted d-block fst-italic">"<?php echo htmlspecialchars($b['special_requests']); ?>"</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div><strong>In:</strong> <?php echo date('M d, Y', strtotime($b['check_in'])); ?></div>
                                <div><strong>Out:</strong> <?php echo date('M d, Y', strtotime($b['check_out'])); ?></div>
                                <small class="text-muted"><?php echo $b['adults']; ?> Adults, <?php echo $b['children']; ?> Kids</small>
                            </td>
                            <td class="fw-bold text-primary">₹<?php echo number_format($b['total_amount'], 2); ?></td>
                            <td>
                                <form action="<?php echo base_url('admin/update_booking_status'); ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 120px;">
                                        <option value="pending" <?php echo $b['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="confirmed" <?php echo $b['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                        <option value="completed" <?php echo $b['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                        <option value="cancelled" <?php echo $b['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo base_url('admin/delete_booking/' . $b['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this booking?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">No room bookings recorded yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
