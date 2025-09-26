<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <h3 class="mb-3">User Management</h3>
    <p class="text-muted">Placeholder page. Manage users here.</p>
    <a href="<?= site_url('/dashboard') ?>" class="btn btn-secondary btn-sm">Back</a>
</div>
<?= $this->endSection() ?>


