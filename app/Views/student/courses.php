<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">My Courses</h3>
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-secondary btn-sm">Back to Dashboard</a>
    </div>
    
    <div class="row g-3">
        <!-- Sample Course Cards -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">ITE 311 - Web Systems</h5>
                    <p class="text-muted mb-2">Instructor: Prof. Smith</p>
                    <p class="card-text">Learn modern web development technologies including HTML, CSS, JavaScript, and frameworks.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">Active</span>
                        <small class="text-muted">3 credits</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">View Materials</button>
                    <button class="btn btn-outline-secondary btn-sm">Schedule</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">ITE 312 - Database Systems</h5>
                    <p class="text-muted mb-2">Instructor: Prof. Johnson</p>
                    <p class="card-text">Database design, SQL, and database management systems fundamentals.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">Active</span>
                        <small class="text-muted">3 credits</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">View Materials</button>
                    <button class="btn btn-outline-secondary btn-sm">Schedule</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">ITE 313 - Software Engineering</h5>
                    <p class="text-muted mb-2">Instructor: Prof. Williams</p>
                    <p class="card-text">Software development lifecycle, project management, and best practices.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-warning">Upcoming</span>
                        <small class="text-muted">3 credits</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">View Materials</button>
                    <button class="btn btn-outline-secondary btn-sm">Schedule</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Course Summary</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <h4 class="text-primary">3</h4>
                            <p class="text-muted mb-0">Total Courses</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h4 class="text-success">2</h4>
                            <p class="text-muted mb-0">Active</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h4 class="text-warning">1</h4>
                            <p class="text-muted mb-0">Upcoming</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h4 class="text-info">9</h4>
                            <p class="text-muted mb-0">Total Credits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
