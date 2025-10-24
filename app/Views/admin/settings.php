<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <h3 class="mb-3">Settings</h3>
    <p class="text-muted">Placeholder page. Configure site preferences here.</p>
    <a href="<?= site_url('/dashboard') ?>" class="btn btn-secondary btn-sm">Back</a>
    
</div>
<?= $this->endSection() ?>


