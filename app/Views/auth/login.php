<?= $this->extend('template') ?>
<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('/css/login.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('body_class') ?>page-login<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="login-wrap">
        <div class="card-like">
            <div class="title-area">
                <img src="<?= base_url('https://logodix.com/logo/1834118.png') ?>" alt="Logo">
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('/login') ?>" method="post" id="loginForm">
                <?= csrf_field() ?>
                <div class="mb-4">
                    <label class="form-label" style="text-align:center; display:block; margin-bottom:8px;">Login as</label>
                    <input type="hidden" name="role" id="roleInput" value="student">
                    <div class="role-grid">
                        <div class="role-card active" data-role="student">
						<img src="https://pnghq.com/wp-content/uploads/student-icon-png-free-highres-download-94160.png" alt="Student">
                            <div class="mt-2 fw-semibold">Student</div>
                        </div>
                        <div class="role-card" data-role="instructor">
						<img src="https://static.vecteezy.com/system/resources/previews/016/305/941/original/instructor-icon-design-free-vector.jpg" alt="Instructor">
                            <div class="mt-2 fw-semibold">Instructor</div>
                        </div>
                        <div class="role-card" data-role="admin">
						<img src="https://static.vecteezy.com/system/resources/previews/000/290/610/original/administration-vector-icon.jpg" alt="Admin">
                            <div class="mt-2 fw-semibold">Admin</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-input" id="email" name="email" value="<?= set_value('email') ?>" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-input" id="password" name="password" autocomplete="current-password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>
</div>


<?= $this->endSection() ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.role-card');
    const roleInput = document.getElementById('roleInput');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            cards.forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            roleInput.value = card.getAttribute('data-role');
        });
    });
});
</script>
