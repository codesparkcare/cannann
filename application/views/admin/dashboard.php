<div class="p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Hotel Management Dashboard</h3>
            <span class="text-muted">Welcome to Grand Cannann Administration & Operations Portal</span>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo base_url('admin/rooms'); ?>" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Room</a>
            <a href="<?php echo base_url('admin/blogs'); ?>" class="btn btn-outline-dark"><i class="fa-solid fa-pen-nib me-1"></i> New Blog</a>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- 5 Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon bg-primary text-white">
                    <i class="fa-solid fa-bed"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Suites</span>
                    <h3 class="fw-bold mb-0"><?php echo $total_rooms; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon bg-success text-white">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Room Bookings</span>
                    <h3 class="fw-bold mb-0"><?php echo $total_bookings; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon bg-warning text-white">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Dining Reservations</span>
                    <h3 class="fw-bold mb-0"><?php echo $total_reservations; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon bg-info text-white">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Tourist Articles</span>
                    <h3 class="fw-bold mb-0"><?php echo $total_blogs; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tables Row -->
    <div class="row g-4">
        <!-- Recent Bookings Table -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-bell-concierge text-primary me-2"></i> Recent Room Bookings</h5>
                    <a href="<?php echo base_url('admin/bookings'); ?>" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Booking Ref</th>
                                <th>Guest</th>
                                <th>Dates</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recent_bookings)): foreach($recent_bookings as $b): ?>
                                <tr>
                                    <td><span class="badge bg-dark"><?php echo $b['booking_number']; ?></span></td>
                                    <td>
                                        <div class="fw-semibold"><?php echo htmlspecialchars($b['guest_name']); ?></div>
                                        <small class="text-muted"><?php echo htmlspecialchars($b['phone']); ?></small>
                                    </td>
                                    <td>
                                        <small><?php echo date('M d', strtotime($b['check_in'])); ?> - <?php echo date('M d, Y', strtotime($b['check_out'])); ?></small>
                                    </td>
                                    <td>
                                        <?php if($b['status'] == 'confirmed'): ?>
                                            <span class="badge bg-success">Confirmed</span>
                                        <?php elseif($b['status'] == 'cancelled'): ?>
                                            <span class="badge bg-danger">Cancelled</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="4" class="text-center py-3 text-muted">No booking records yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Dining Reservations -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-chair text-primary me-2"></i> Table Reservations</h5>
                    <a href="<?php echo base_url('admin/reservations'); ?>" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Guest</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recent_reservations)): foreach($recent_reservations as $res): ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold"><?php echo htmlspecialchars($res['guest_name']); ?></div>
                                        <small class="text-muted"><?php echo $res['guest_count']; ?> Guests (<?php echo htmlspecialchars($res['table_preference']); ?>)</small>
                                    </td>
                                    <td>
                                        <small><?php echo date('M d', strtotime($res['reservation_date'])); ?> at <?php echo date('h:i A', strtotime($res['reservation_time'])); ?></small>
                                    </td>
                                    <td>
                                        <?php if($res['status'] == 'confirmed'): ?>
                                            <span class="badge bg-success">Confirmed</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="3" class="text-center py-3 text-muted">No reservations yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
