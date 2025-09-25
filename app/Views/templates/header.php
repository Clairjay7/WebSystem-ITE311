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
    <?php if ($isLoggedIn && $role): ?>
      <span class="navbar-text ms-3">
        <span class="badge bg-primary"><?= esc($roleLabel) ?></span>
      </span>
    <?php endif; ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link<?= $uri->getPath() === 'about' ? ' active' : '' ?>" href="<?= site_url('/about') ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= $uri->getPath() === 'contact' ? ' active' : '' ?>" href="<?= site_url('/contact') ?>">Contact</a>
        </li>

        <?php if ($isLoggedIn): ?>
          <?php if ($role === 'student'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Assignments</a></li>
          <?php elseif ($role === 'instructor'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">My Classes</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Submissions</a></li>
          <?php elseif ($role === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
          <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('/logout') ?>">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link<?= $uri->getPath() === 'login' ? ' active' : '' ?>" href="<?= site_url('/login') ?>">Login</a>
          </li>
          <?php if ($uri->getPath() !== 'register'): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('/register') ?>">Register</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>


