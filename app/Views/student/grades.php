<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">My Grades</h3>
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-secondary btn-sm">Back to Dashboard</a>
    </div>
    
    <!-- GPA Overview -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-primary">3.75</h4>
                    <p class="text-muted mb-0">Current GPA</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-success">91.5%</h4>
                    <p class="text-muted mb-0">Overall Average</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-info">15</h4>
                    <p class="text-muted mb-0">Completed Assignments</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-warning">3</h4>
                    <p class="text-muted mb-0">Courses</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Grades by Course -->
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">ITE 311 - Web Systems</h5>
                    <small class="text-muted">Prof. Smith</small>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h4 text-success">A</span>
                        <span class="text-muted">94.2%</span>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Recent Assignments:</small>
                        <ul class="list-unstyled mt-1">
                            <li class="d-flex justify-content-between">
                                <span>HTML/CSS Layout</span>
                                <span class="text-success">95/100</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>JavaScript Quiz</span>
                                <span class="text-success">92/100</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Midterm Exam</span>
                                <span class="text-success">96/100</span>
                            </li>
                        </ul>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 94.2%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">ITE 312 - Database Systems</h5>
                    <small class="text-muted">Prof. Johnson</small>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h4 text-success">B+</span>
                        <span class="text-muted">88.7%</span>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Recent Assignments:</small>
                        <ul class="list-unstyled mt-1">
                            <li class="d-flex justify-content-between">
                                <span>SQL Queries</span>
                                <span class="text-success">88/100</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>ER Diagram</span>
                                <span class="text-success">90/100</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Midterm Exam</span>
                                <span class="text-warning">87/100</span>
                            </li>
                        </ul>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 88.7%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">ITE 313 - Software Engineering</h5>
                    <small class="text-muted">Prof. Williams</small>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h4 text-success">A-</span>
                        <span class="text-muted">91.5%</span>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Recent Assignments:</small>
                        <ul class="list-unstyled mt-1">
                            <li class="d-flex justify-content-between">
                                <span>Use Case Diagram</span>
                                <span class="text-success">93/100</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Project Proposal</span>
                                <span class="text-success">89/100</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Quiz 1</span>
                                <span class="text-success">92/100</span>
                            </li>
                        </ul>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 91.5%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Grade History -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Grade History</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Assignment</th>
                            <th>Course</th>
                            <th>Score</th>
                            <th>Grade</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Oct 10, 2024</td>
                            <td>HTML/CSS Layout Assignment</td>
                            <td>ITE 311</td>
                            <td>95/100</td>
                            <td><span class="badge bg-success">A</span></td>
                            <td><button class="btn btn-outline-primary btn-sm">View</button></td>
                        </tr>
                        <tr>
                            <td>Oct 8, 2024</td>
                            <td>SQL Queries Exercise</td>
                            <td>ITE 312</td>
                            <td>88/100</td>
                            <td><span class="badge bg-success">B+</span></td>
                            <td><button class="btn btn-outline-primary btn-sm">View</button></td>
                        </tr>
                        <tr>
                            <td>Oct 6, 2024</td>
                            <td>Use Case Diagram</td>
                            <td>ITE 313</td>
                            <td>93/100</td>
                            <td><span class="badge bg-success">A-</span></td>
                            <td><button class="btn btn-outline-primary btn-sm">View</button></td>
                        </tr>
                        <tr>
                            <td>Oct 3, 2024</td>
                            <td>JavaScript Quiz</td>
                            <td>ITE 311</td>
                            <td>92/100</td>
                            <td><span class="badge bg-success">A-</span></td>
                            <td><button class="btn btn-outline-primary btn-sm">View</button></td>
                        </tr>
                        <tr>
                            <td>Oct 1, 2024</td>
                            <td>Database Midterm</td>
                            <td>ITE 312</td>
                            <td>87/100</td>
                            <td><span class="badge bg-warning">B+</span></td>
                            <td><button class="btn btn-outline-primary btn-sm">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
