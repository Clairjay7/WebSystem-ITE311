<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <h3 class="mb-3">My Classes</h3>
    <p class="text-muted">This is a placeholder. Wire up your classes list here.</p>
    <a href="<?= site_url('/dashboard') ?>" class="btn btn-secondary btn-sm">Back</a>
<?php /* Add table/list here later */ ?>
</div>
<?= $this->endSection() ?>


