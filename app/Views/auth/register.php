<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>

<?= $this->section('body_class') ?>page-register<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
					<div class="card-header text-center">
						<strong>Register</strong>
					</div>
                    <div class="card-body">
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
                <h5 class="mb-3">Basic Information</h5>
                <div class="form-group">
                    <label for="student_id" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="student_id" name="student_id" value="<?= set_value('student_id') ?>" autocomplete="off" placeholder="Auto-generated" readonly>
                    <div class="form-text">This will be generated automatically.</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <div class="row g-2">
                        <div class="col-12 col-md-4">
                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= set_value('first_name') ?>" placeholder="First" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" class="form-control" name="middle_name" id="middle_name" value="<?= set_value('middle_name') ?>" placeholder="Middle">
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?= set_value('last_name') ?>" placeholder="Last" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= set_value('date_of_birth') ?>">
                </div>
                <div class="form-group">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select">
                        <option value="">Select gender</option>
                        <option value="Male" <?= set_value('gender')==='Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= set_value('gender')==='Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= set_value('gender')==='Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="contact_number" class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" id="contact_number" name="contact_number" value="<?= set_value('contact_number') ?>" autocomplete="tel">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
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
            </div>
        </div>
    </div>


<?= $this->endSection() ?>
