<?= $this->extend('template') ?>

<?= $this->section('styles') ?>
<style>
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
    .file-icon {
        font-size: 2rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('student/courses') ?>">My Courses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Materials</li>
                </ol>
            </nav>
            <h2 class="text-start">
                <i class="fas fa-book me-2"></i>
                <?= esc($course['course_name'] ?? $course['name'] ?? 'Course Materials') ?>
            </h2>
            <?php if (!empty($course['description'])): ?>
                <p class="text-muted text-start"><?= esc($course['description']) ?></p>
            <?php endif; ?>
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

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-folder-open me-2"></i>Available Materials
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($materials)): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($materials as $material): ?>
                        <div class="list-group-item material-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-file-pdf file-icon text-danger"></i>
                                </div>
                                <div class="col">
                                    <h6 class="mb-1">
                                        <?= esc($material['file_name']) ?>
                                    </h6>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        Uploaded: <?= date('M d, Y h:i A', strtotime($material['created_at'])) ?>
                                    </small>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('materials/download/' . $material['id']) ?>" 
                                       class="btn btn-primary download-btn">
                                        <i class="fas fa-download me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="p-5 text-center">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No Materials Available</h5>
                    <p class="text-muted">Your instructor hasn't uploaded any materials for this course yet.</p>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($materials)): ?>
            <div class="card-footer text-muted">
                <small>
                    <i class="fas fa-info-circle me-1"></i>
                    Total: <?= count($materials) ?> material(s)
                </small>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <a href="<?= base_url('student/courses') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to My Courses
        </a>
    </div>
</div>
<?= $this->endSection() ?>
