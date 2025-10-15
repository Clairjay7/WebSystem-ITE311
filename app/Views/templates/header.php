<?php $uri = service('uri'); ?>
<?php
$isLoggedIn = (bool) session()->get('isLoggedIn');
$role = strtolower((string) (session('role') ?? ''));
$roleLabel = $role ? strtoupper($role) : '';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
      <!-- brand image removed as requested -->
    </a>
    <?php /* role badge removed as requested */ ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <?php if ($isLoggedIn): ?>
            <a class="nav-link<?= $uri->getPath() === 'dashboard' ? ' active' : '' ?>" href="<?= site_url('/dashboard') ?>">Dashboard</a>
          <?php else: ?>
            <a class="nav-link<?= in_array($uri->getPath(), ['', 'home'], true) ? ' active' : '' ?>" href="<?= site_url('/home') ?>">Home</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= $uri->getPath() === 'about' ? ' active' : '' ?>" href="<?= site_url('/about') ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= $uri->getPath() === 'contact' ? ' active' : '' ?>" href="<?= site_url('/contact') ?>">Contact</a>
        </li>

        <?php if ($isLoggedIn): ?>
          <!-- When logged in: keep header simple as requested -->
        <?php else: ?>
          <?php if ($uri->getPath() !== 'login'): ?>
            <li class="nav-item">
              <a class="nav-link<?= $uri->getPath() === 'login' ? ' active' : '' ?>" href="<?= site_url('/login') ?>">Login</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link<?= $uri->getPath() === 'register' ? ' active' : '' ?>" href="<?= site_url('/register') ?>">Register</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>


