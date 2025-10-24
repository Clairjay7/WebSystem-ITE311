<?php
helper('url');
$uri = service('uri');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learning Management System - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous"
    >
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), #6f42c1);
            color: white;
            border-radius: 20px;
        }

        .stats-card.success {
            background: linear-gradient(135deg, var(--success-color), #20c997);
        }

        .stats-card.info {
            background: linear-gradient(135deg, var(--info-color), #17a2b8);
        }

        .stats-card.warning {
            background: linear-gradient(135deg, var(--warning-color), #fd7e14);
        }

        .course-card {
            height: 100%;
            border-radius: 20px;
            overflow: hidden;
        }

        .course-card .card-img-top {
            height: 200px;
            object-fit: cover;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .badge-custom {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
        }

        .table th {
            background: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
        }

        .btn-custom {
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            color: white;
            font-weight: 700;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .activity-item {
            padding: 1rem;
            border-left: 4px solid var(--primary-color);
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 0 15px 15px 0;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary-color), #6f42c1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">
                <i class="fas fa-graduation-cap text-primary me-2"></i>
                LMS Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-book me-1"></i>Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-users me-1"></i>Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-chart-bar me-1"></i>Analytics</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row">
            <div class="col-12">
                <h1 class="section-title text-center mb-5">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    Learning Management System Dashboard
                </h1>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card stats-card h-100">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="display-6 fw-bold"><?= $totalUsers ?? 0 ?></h3>
                                <p class="mb-0">Total Users</p>
                            </div>
                            <div class="fs-1">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card stats-card success h-100">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="display-6 fw-bold"><?= $totalCourses ?? 0 ?></h3>
                                <p class="mb-0">Total Courses</p>
                            </div>
                            <div class="fs-1">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card stats-card info h-100">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="display-6 fw-bold"><?= $totalEnrollments ?? 0 ?></h3>
                                <p class="mb-0">Enrollments</p>
                            </div>
                            <div class="fs-1">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card stats-card warning h-100">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="display-6 fw-bold"><?= count($instructors ?? []) ?></h3>
                                <p class="mb-0">Instructors</p>
                            </div>
                            <div class="fs-1">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Courses -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-book-open me-2"></i>Recent Courses</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($recentCourses)): ?>
                            <div class="row">
                                <?php foreach ($recentCourses as $course): ?>
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card course-card">
                                            <div class="card-img-top d-flex align-items-center justify-content-center">
                                                <i class="fas fa-book fa-3x text-white"></i>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold"><?= esc($course['title']) ?></h5>
                                                <p class="card-text text-muted"><?= esc(substr($course['description'] ?? 'No description available', 0, 100)) ?>...</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="badge bg-primary badge-custom">
                                                        <i class="fas fa-user-tie me-1"></i><?= esc($course['instructor_name']) ?>
                                                    </span>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar me-1"></i>
                                                        <?= date('M d, Y', strtotime($course['created_at'])) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No courses available yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities and User Lists -->
        <div class="row mb-5">
            <!-- Recent Enrollments -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Recent Enrollments</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($recentEnrollments)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Course</th>
                                            <th>Enrolled Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recentEnrollments as $enrollment): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="user-avatar me-3">
                                                            <?= strtoupper(substr($enrollment['student_name'], 0, 1)) ?>
                                                        </div>
                                                        <?= esc($enrollment['student_name']) ?>
                                                    </div>
                                                </td>
                                                <td><?= esc($enrollment['course_title']) ?></td>
                                                <td>
                                                    <i class="fas fa-calendar me-1 text-muted"></i>
                                                    <?= date('M d, Y', strtotime($enrollment['enrolled_at'])) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-user-plus fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No recent enrollments.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- User Statistics -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-users me-2"></i>User Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Instructors</h6>
                                    <small class="text-muted"><?= count($instructors ?? []) ?> active instructors</small>
                                </div>
                                <span class="badge bg-primary"><?= count($instructors ?? []) ?></span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Students</h6>
                                    <small class="text-muted"><?= count($students ?? []) ?> enrolled students</small>
                                </div>
                                <span class="badge bg-success"><?= count($students ?? []) ?></span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Total Courses</h6>
                                    <small class="text-muted">Available courses</small>
                                </div>
                                <span class="badge bg-warning"><?= $totalCourses ?? 0 ?></span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Total Enrollments</h6>
                                    <small class="text-muted">Course enrollments</small>
                                </div>
                                <span class="badge bg-info"><?= $totalEnrollments ?? 0 ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Courses Table -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Courses</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($allCourses)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Course Title</th>
                                            <th>Description</th>
                                            <th>Instructor</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allCourses as $course): ?>
                                            <tr>
                                                <td>
                                                    <strong><?= esc($course['title']) ?></strong>
                                                </td>
                                                <td><?= esc(substr($course['description'] ?? 'No description', 0, 50)) ?>...</td>
                                                <td>
                                                    <span class="badge bg-primary badge-custom">
                                                        <i class="fas fa-user-tie me-1"></i><?= esc($course['instructor_name']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <i class="fas fa-calendar me-1 text-muted"></i>
                                                    <?= date('M d, Y', strtotime($course['created_at'])) ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary btn-custom">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-success btn-custom">
                                                        <i class="fas fa-edit me-1"></i>Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No courses available.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-heart text-danger me-1"></i>
                Learning Management System - Built with CodeIgniter 4
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-HoA44I+YtT53H23ZBQUcMZAfHb3v3k7yE9ONtdGml2SB/9W6rYeHMu+Vfq3QKgfM" 
        crossorigin="anonymous">
    </script>

    <!-- Custom JS -->
    <script>
        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on scroll
            const cards = document.querySelectorAll('.card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Add click effects to buttons
            const buttons = document.querySelectorAll('.btn-custom');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });
    </script>
</body>
</html>
