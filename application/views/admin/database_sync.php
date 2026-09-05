<div class="p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1"><i class="fa-solid fa-database text-primary me-2"></i> Database Sync & Maintenance Tool</h3>
            <span class="text-muted">Synchronize database tables, export/import SQL backups, optimize tables, and ensure live/local environment consistency.</span>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo base_url('admin/export_database'); ?>" class="btn btn-outline-dark">
                <i class="fa-solid fa-download me-1"></i> Export SQL Backup
            </a>
            <a href="<?php echo base_url('admin/sync_database_schema'); ?>" class="btn btn-primary">
                <i class="fa-solid fa-arrows-rotate me-1"></i> Sync & Repair All Tables
            </a>
        </div>
    </div>

    <!-- Flash Notifications -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4">
            <i class="fa-solid fa-circle-check me-2 fs-5 align-middle"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4">
            <i class="fa-solid fa-triangle-exclamation me-2 fs-5 align-middle"></i><?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Metrics Cards -->
    <?php
    $total_tables = count($tables_overview);
    $total_rows = 0;
    $total_bytes = 0;
    foreach ($tables_overview as $t) {
        $total_rows += (int)($t['rows_count'] ?? 0);
        $total_bytes += ((int)($t['data_length'] ?? 0) + (int)($t['index_length'] ?? 0));
    }
    $total_size_mb = round($total_bytes / (1024 * 1024), 2);
    ?>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fa-solid fa-table-list"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase fw-bold">Active Tables</h6>
                    <h3 class="mb-0 fw-bold"><?php echo $total_tables; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-server"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase fw-bold">Database Storage</h6>
                    <h3 class="mb-0 fw-bold"><?php echo $total_size_mb; ?> <span class="fs-6 fw-normal text-muted">MB</span></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase fw-bold">Total Stored Records</h6>
                    <h3 class="mb-0 fw-bold"><?php echo number_format($total_rows); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Operations Grid -->
    <div class="row g-4 mb-4">
        <!-- 1. Schema Sync & Health -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3 h-100 p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                        <i class="fa-solid fa-arrows-spin fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">1-Click Schema Synchronization</h5>
                        <small class="text-muted">Checks all 17 required hotel tables and automatically creates missing structures without deleting any existing data.</small>
                    </div>
                </div>
                <p class="small text-secondary mb-4">
                    Ensures tables like <code>admin_users</code>, <code>site_settings</code>, <code>rooms</code>, <code>bookings</code>, <code>restaurant_items</code>, <code>facilities</code>, and <code>promotions</code> exist with complete columns and UTF-8 charset.
                </p>
                <div class="mt-auto pt-3 border-top">
                    <a href="<?php echo base_url('admin/sync_database_schema'); ?>" class="btn btn-primary w-100 py-2">
                        <i class="fa-solid fa-rotate me-2"></i> Run Schema Sync Now
                    </a>
                </div>
            </div>
        </div>

        <!-- 2. SQL Import & Restore -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3 h-100 p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-3 bg-success bg-opacity-10 text-success rounded-3">
                        <i class="fa-solid fa-file-import fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Import / Restore SQL Dump</h5>
                        <small class="text-muted">Upload a <code>.sql</code> file to execute and import data directly into your active database.</small>
                    </div>
                </div>
                
                <form action="<?php echo base_url('admin/import_database_sql'); ?>" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Executing an imported SQL dump will execute commands in your database. Do you wish to continue?');">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select .SQL File</label>
                        <input type="file" name="sql_file" class="form-control form-control-sm" accept=".sql" required>
                    </div>
                    <button type="submit" class="btn btn-outline-dark w-100 py-2">
                        <i class="fa-solid fa-upload me-2"></i> Upload & Execute SQL Dump
                    </button>
                </form>
            </div>
        </div>

        <!-- 3. Table Optimization -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3 h-100 p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-3">
                        <i class="fa-solid fa-gauge-high fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Optimize & Defragment Tables</h5>
                        <small class="text-muted">Reclaims unused space and defragments all MySQL data files for faster queries.</small>
                    </div>
                </div>
                <p class="small text-secondary mb-4">
                    Runs MySQL <code>OPTIMIZE TABLE</code> command across all tables in the active schema to optimize indexes and release disk overhead.
                </p>
                <div class="mt-auto pt-3 border-top">
                    <a href="<?php echo base_url('admin/optimize_database_tables'); ?>" class="btn btn-outline-warning text-dark w-100 py-2 fw-semibold">
                        <i class="fa-solid fa-bolt me-2"></i> Optimize All Tables
                    </a>
                </div>
            </div>
        </div>

        <!-- 4. Sample Baseline Seeder -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3 h-100 p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-3 bg-info bg-opacity-10 text-info rounded-3">
                        <i class="fa-solid fa-seedling fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Seed Default Hotel Data</h5>
                        <small class="text-muted">Populates initial room categories, restaurant menus, and hotel facilities if empty.</small>
                    </div>
                </div>
                <p class="small text-secondary mb-4">
                    Safe operation: Only inserts data into tables that currently have 0 rows (leaves all existing records completely untouched).
                </p>
                <div class="mt-auto pt-3 border-top">
                    <a href="<?php echo base_url('admin/seed_database_defaults'); ?>" class="btn btn-outline-info text-dark w-100 py-2 fw-semibold">
                        <i class="fa-solid fa-plant-wilt me-2"></i> Seed Baseline Defaults
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Database Tables Status Table -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-list-check text-primary me-2"></i> Database Schema Health Inspector</h5>
            <span class="badge bg-light text-dark border"><?php echo $this->db->database; ?> @ <?php echo $this->db->hostname; ?></span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Table Name</th>
                        <th>Engine</th>
                        <th>Collation</th>
                        <th>Total Rows</th>
                        <th>Data Size</th>
                        <th>Index Size</th>
                        <th>Total Size</th>
                        <th class="pe-4 text-end">Health Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($tables_overview)): ?>
                        <?php foreach($tables_overview as $tbl): 
                            $data_kb = round(($tbl['data_length'] ?? 0) / 1024, 1);
                            $index_kb = round(($tbl['index_length'] ?? 0) / 1024, 1);
                            $total_kb = round((($tbl['data_length'] ?? 0) + ($tbl['index_length'] ?? 0)) / 1024, 1);
                        ?>
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">
                                    <i class="fa-solid fa-table text-muted me-2"></i><?php echo htmlspecialchars($tbl['name']); ?>
                                </td>
                                <td><span class="badge bg-light text-secondary border"><?php echo htmlspecialchars($tbl['engine'] ?? 'InnoDB'); ?></span></td>
                                <td class="small text-muted"><?php echo htmlspecialchars($tbl['collation'] ?? 'utf8mb4_general_ci'); ?></td>
                                <td class="fw-bold"><?php echo number_format($tbl['rows_count'] ?? 0); ?></td>
                                <td class="small"><?php echo $data_kb; ?> KB</td>
                                <td class="small"><?php echo $index_kb; ?> KB</td>
                                <td class="small fw-semibold"><?php echo $total_kb; ?> KB</td>
                                <td class="pe-4 text-end">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">
                                        <i class="fa-solid fa-check me-1"></i> Active
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                No database tables detected. Click <strong>"Sync & Repair All Tables"</strong> above to initialize.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
