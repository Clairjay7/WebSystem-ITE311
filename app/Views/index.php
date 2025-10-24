<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>
<?= $this->section('body_class') ?>page-home<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container py-5">
	<div class="row">
		<div class="col-lg-8 mx-auto">
			<div class="card p-4">
				<h1 class="mb-3">Welcome</h1>
				<p class="text-muted">This is the homepage. Use the navbar links to navigate.</p>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>