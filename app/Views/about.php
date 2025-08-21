<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.nav a { text-decoration: none; margin-right: .5rem; }
		.nav a.active { font-weight: 700; color: #0d6efd; }
		.card { border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,.08); }
	</style>
</head>
<body class="bg-light">
	<div class="container py-5">
		<nav class="mb-4 nav">
			<a class="" href="<?= base_url('/') ?>">Home</a> |
			<a class="active" href="<?= base_url('about') ?>">About</a> |
			<a class="" href="<?= base_url('contact') ?>">Contact</a>
		</nav>
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
</body>
</html>



