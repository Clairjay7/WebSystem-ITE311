<?= $this->extend('template') ?>

<?= $this->section('styles') ?>
<style>
    .upload-card {
        max-width: 800px;
        margin: 0 auto;
    }
    .materials-list {
        max-height: 400px;
        overflow-y: auto;
    }
    .material-item {
        transition: background-color 0.2s;
    }
    .material-item:hover {
        background-color: #f8f9fa;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="upload-card">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-upload me-2"></i>Upload Course Material
            </h4>
        </div>
        <div class="card-body">
            <!-- Course Information -->
            <div class="alert alert-info">
                <i class="fas fa-book me-2"></i>
                <strong>Course:</strong> <?= esc($course['course_name'] ?? $course['name'] ?? 'N/A') ?>
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
                    <?php 
                    $error = session()->getFlashdata('error');
                    if (is_array($error)) {
                        foreach ($error as $err) {
                            echo esc($err) . '<br>';
                        }
                    } else {
                        echo esc($error);
                    }
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Upload Form -->
            <form action="<?= base_url('materials/upload/' . $course['id']) ?>" method="post" enctype="multipart/form-data" class="mb-4">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="material_file" class="form-label">
                        <i class="fas fa-file me-2"></i>Select File to Upload
                    </label>
                    <input type="file" 
                           class="form-control" 
                           id="material_file" 
                           name="material_file" 
                           required
                           accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt,.zip,.rar">
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>
                        Allowed file types: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, TXT, ZIP, RAR (Max: 10MB)
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Material
                    </button>
                    <a href="<?= base_url('courses') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Courses
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Existing Materials List -->
    <?php if (!empty($materials)): ?>
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Uploaded Materials
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="materials-list">
                    <div class="list-group list-group-flush">
                        <?php foreach ($materials as $material): ?>
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
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('materials/download/' . $material['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary"
                                           title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a href="<?= base_url('materials/delete/' . $material['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Are you sure you want to delete this material?')"
                                           title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-4">
            <i class="fas fa-info-circle me-2"></i>
            No materials uploaded yet for this course.
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
