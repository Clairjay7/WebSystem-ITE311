<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">My Assignments</h3>
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-secondary btn-sm">Back to Dashboard</a>
    </div>
    
    <!-- Assignment Status Overview -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-danger">3</h4>
                    <p class="text-muted mb-0">Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-warning">2</h4>
                    <p class="text-muted mb-0">In Progress</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-success">8</h4>
                    <p class="text-muted mb-0">Submitted</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-info">6</h4>
                    <p class="text-muted mb-0">Graded</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pending Assignments -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Pending Assignments</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Assignment</th>
                            <th>Course</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Database Design Project</strong>
                                <br><small class="text-muted">Create an ER diagram for a library system</small>
                            </td>
                            <td>ITE 312</td>
                            <td>
                                <span class="text-danger">Oct 15, 2024</span>
                                <br><small class="text-danger">Due in 2 days</small>
                            </td>
                            <td><span class="badge bg-danger">Not Started</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Start</button>
                                <button class="btn btn-outline-secondary btn-sm">Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Web Portfolio</strong>
                                <br><small class="text-muted">Create a personal portfolio website</small>
                            </td>
                            <td>ITE 311</td>
                            <td>
                                <span class="text-warning">Oct 20, 2024</span>
                                <br><small class="text-warning">Due in 7 days</small>
                            </td>
                            <td><span class="badge bg-warning">In Progress</span></td>
                            <td>
                                <button class="btn btn-success btn-sm">Continue</button>
                                <button class="btn btn-outline-secondary btn-sm">Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Software Requirements Document</strong>
                                <br><small class="text-muted">Write SRS for a mobile app</small>
                            </td>
                            <td>ITE 313</td>
                            <td>
                                <span class="text-success">Oct 25, 2024</span>
                                <br><small class="text-success">Due in 12 days</small>
                            </td>
                            <td><span class="badge bg-secondary">Not Started</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Start</button>
                                <button class="btn btn-outline-secondary btn-sm">Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Recent Submissions -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Recent Submissions</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Assignment</th>
                            <th>Course</th>
                            <th>Submitted</th>
                            <th>Grade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>HTML/CSS Layout Assignment</td>
                            <td>ITE 311</td>
                            <td>Oct 10, 2024</td>
                            <td><span class="text-success">95/100</span></td>
                            <td><span class="badge bg-success">Graded</span></td>
                        </tr>
                        <tr>
                            <td>SQL Queries Exercise</td>
                            <td>ITE 312</td>
                            <td>Oct 8, 2024</td>
                            <td><span class="text-success">88/100</span></td>
                            <td><span class="badge bg-success">Graded</span></td>
                        </tr>
                        <tr>
                            <td>System Analysis Report</td>
                            <td>ITE 313</td>
                            <td>Oct 5, 2024</td>
                            <td><span class="text-muted">-</span></td>
                            <td><span class="badge bg-warning">Under Review</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
