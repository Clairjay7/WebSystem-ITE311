<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>

<?= $this->section('body_class') ?>page-dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$name = session('name') ?? 'User';
$email = session('email') ?? '';
$role = strtolower((string) (session('role') ?? 'student'));

$roleToLabel = [
	'student'    => 'Student',
	'instructor' => 'Instructor',
	'admin'      => 'Admin',
];

$roleLabel = $roleToLabel[$role] ?? ucfirst($role);

$roleToLogo = [
	'student'    => 'https://pnghq.com/wp-content/uploads/student-icon-png-free-highres-download-94160.png',
	'instructor' => 'https://static.vecteezy.com/system/resources/previews/016/305/941/original/instructor-icon-design-free-vector.jpg',
	'admin'      => 'https://static.vecteezy.com/system/resources/previews/000/290/610/original/administration-vector-icon.jpg',
];

$logo = $roleToLogo[$role] ?? $roleToLogo['student'];
?>

 

<div class="container py-4">
	<?php if (session()->getFlashdata('welcome')): ?>
		<div class="alert alert-success mb-3"><?= session()->getFlashdata('welcome') ?></div>
	<?php endif; ?>

    <div class="card">
		<div class="card-body p-4">
			<div class="d-flex align-items-center gap-3 mb-3">
				<img src="<?= esc($logo) ?>" alt="Role" style="width:64px;height:64px;border-radius:12px;background:#fff;padding:10px;">
				<div>
					<h3 class="mb-1">Welcome, <?= esc($name) ?>!</h3>
					<span class="badge bg-primary text-uppercase"><?= esc($roleLabel) ?></span>
				</div>
			</div>
			<div class="row g-3">
				<div class="col-md-6">
					<div class="border rounded p-2 bg-light"><strong>Email:</strong> <?= esc($email) ?></div>
				</div>
				<div class="col-md-6">
					<div class="border rounded p-2 bg-light"><strong>Role:</strong> <?= esc($roleLabel) ?></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Conditional content per role -->
	<?php if ($role === 'student'): ?>
		<div class="row g-3 mt-4">
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">Courses</h5><p class="text-muted mb-3">Your enrolled subjects and materials</p><a href="#" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">Assignments</h5><p class="text-muted mb-3">Pending and submitted tasks</p><a href="#" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">Grades</h5><p class="text-muted mb-3">Exam scores and performance</p><a href="#" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
		</div>
	<?php elseif ($role === 'instructor'): ?>
		<div class="row g-3 mt-4">
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">My Classes</h5><p class="text-muted mb-3">Manage classes and materials</p><a href="<?= site_url('/instructor/my-classes') ?>" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">Submissions</h5><p class="text-muted mb-3">Review and grade student work</p><a href="<?= site_url('/instructor/submissions') ?>" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">Attendance</h5><p class="text-muted mb-3">Record and track attendance</p><a href="<?= site_url('/instructor/attendance') ?>" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
		</div>
	<?php elseif ($role === 'admin'): ?>
		<div class="row g-3 mt-4">
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">User Management</h5><p class="text-muted mb-3">Create, update, and assign roles</p><a href="#" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">Reports</h5><p class="text-muted mb-3">System and academic reports</p><a href="#" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
			<div class="col-md-4">
				<div class="card h-100"><div class="card-body"><h5 class="card-title mb-2">Settings</h5><p class="text-muted mb-3">Configure site preferences</p><a href="#" class="btn btn-sm btn-outline-primary">Open</a></div></div>
			</div>
		</div>
	<?php else: ?>
		<div class="alert alert-warning mt-4">Your role (<?= esc($roleLabel) ?>) has no custom dashboard yet.</div>
	<?php endif; ?>

	<div class="mt-4">
		<a href="<?= site_url('/logout') ?>" class="btn btn-outline-danger btn-sm">Logout</a>
	</div>
</div>

<?= $this->endSection() ?>


