<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WebSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css?v=20250912" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css?v=20250912" rel="stylesheet">
  <?= $this->renderSection('styles') ?>
</head>
<body class="<?= $this->renderSection('body_class') ?>">
<?php $uri = service('uri'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
      <!-- brand image removed as requested -->
    </a>
    <?php if (session()->get('isLoggedIn')): ?>
      <span class="navbar-text ms-3">
        <span class="badge bg-primary"><?= esc(strtoupper(session('userRole'))) ?></span>
      </span>
    <?php endif; ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('/about') ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('/contact') ?>">Contact</a>
        </li>
        <?php if (!session()->get('isLoggedIn')): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('/login') ?>">Login</a>
        </li>
        <?php if ($uri->getPath() !== 'register'): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('/register') ?>">Register</a>
        </li>
        <?php endif; ?>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('/register') ?>">Register</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 text-center">
    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js?v=20250912"></script>
</body>
</html>