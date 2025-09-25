<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>

<?= $this->section('body_class') ?>page-register<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="register-wrap">
        <div class="card-like">
            <div class="title-area">
                <img src="<?= base_url('public/favicon.ico') ?>" alt="Logo">
                <h3>Register</h3>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('debug')): ?>
                <div class="alert alert-info"><?= session()->getFlashdata('debug') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('debug_data')): ?>
                <div class="alert alert-warning"><?= session()->getFlashdata('debug_data') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('debug_method')): ?>
                <div class="alert alert-info"><?= session()->getFlashdata('debug_method') ?></div>
            <?php endif; ?>

            <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form id="registerForm" action="<?= site_url('/register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-input" id="name" name="name" value="<?= set_value('name') ?>" autocomplete="name" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-input" id="email" name="email" value="<?= set_value('email') ?>" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-input" id="password" name="password" autocomplete="new-password" required>
                </div>
                <button type="submit" class="btn-primary">Register</button>
            </form>

            <script>
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                console.log('Form submitted!');
                console.log('Method:', this.method);
                console.log('Action:', this.action);
                console.log('Name:', document.getElementById('name').value);
                console.log('Email:', document.getElementById('email').value);
                console.log('Password length:', document.getElementById('password').value.length);
                
                // Add visual feedback
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.textContent = 'Submitting...';
                submitBtn.disabled = true;
                
                // Let the form submit normally
                return true;
            });
            </script>
        </div>
</div>


<?= $this->endSection() ?>
