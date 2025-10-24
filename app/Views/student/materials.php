<?= $this->extend('template') ?>

<?= $this->section('styles') ?>
<style>
    .course-materials-card {
        transition: transform 0.2s;
    }
    .course-materials-card:hover {
        transform: translateY(-5px);
    }
    .material-item {
        transition: background-color 0.2s;
    }
    .material-item:hover {
        background-color: #f8f9fa;
    }
    .download-btn {
        transition: all 0.2s;
    }
    .download-btn:hover {
        transform: scale(1.05);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-start">
                <i class="fas fa-book-open me-2"></i>Course Materials
            </h2>
            <p class="text-muted text-start">Download materials from your enrolled courses</p>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($coursesWithMaterials)): ?>
        <?php foreach ($coursesWithMaterials as $item): ?>
            <div class="card shadow-sm mb-4 course-materials-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>
                        <?= esc($item['course']['course_name'] ?? $item['course']['name'] ?? 'N/A') ?>
                    </h5>
                    <?php if (!empty($item['course']['description'])): ?>
                        <small><?= esc($item['course']['description']) ?></small>
                    <?php endif; ?>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php foreach ($item['materials'] as $material): ?>
                            <div class="list-group-item material-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <i class="fas fa-file-alt me-2 text-primary"></i>
                                            <?= esc($material['file_name']) ?>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            Uploaded: <?= date('M d, Y h:i A', strtotime($material['created_at'])) ?>
                                        </small>
                                    </div>
                                    <div>
                                        <a href="<?= base_url('materials/download/' . $material['id']) ?>" 
                                           class="btn btn-primary download-btn">
                                            <i class="fas fa-download me-2"></i>Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <small>
                        <i class="fas fa-info-circle me-1"></i>
                        <?= count($item['materials']) ?> material(s) available
                    </small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>No materials available yet.</strong>
            <p class="mb-0">Your instructors haven't uploaded any materials for your enrolled courses yet. Check back later!</p>
        </div>
        <div class="text-center mt-4">
            <a href="<?= base_url('student/courses') ?>" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to My Courses
            </a>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
