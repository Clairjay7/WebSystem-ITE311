<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>
<?= $this->section('body_class') ?>page-about<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card p-4">
                <h1 class="mb-3">About</h1>
                <p class="text-muted">This is the about page.</p>
                <p class="mb-0">Welcome to our Learning Management System. Explore courses, instructors, and more.</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
