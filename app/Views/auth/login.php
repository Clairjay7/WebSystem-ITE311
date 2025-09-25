<?= $this->extend('template') ?>
<?= $this->section('styles') ?><?= $this->endSection() ?>

<?= $this->section('body_class') ?>page-login<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="login-wrap">
        <div class="card">
            <div class="card-header text-center">
                <strong>Welcome back</strong>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('/login') ?>" method="post" id="loginForm" class="p-3">
                <?= csrf_field() ?>
                <div class="mb-3" role="radiogroup" aria-label="Login as">
                    <label class="form-label" style="text-align:center; display:block; margin-bottom:8px;">Login as</label>
                    <input type="hidden" name="role" id="roleInput" value="student">
                    <div id="roleGrid" class="d-flex justify-content-center gap-2">
                        <label class="btn btn-outline-primary active" data-role="student" role="radio" aria-checked="true" tabindex="0">
                            <input type="radio" name="rolePick" value="student" class="role-radio" autocomplete="off" checked> Student
                        </label>
                        <label class="btn btn-outline-primary" data-role="instructor" role="radio" aria-checked="false" tabindex="0">
                            <input type="radio" name="rolePick" value="instructor" class="role-radio" autocomplete="off"> Instructor
                        </label>
                        <label class="btn btn-outline-primary" data-role="admin" role="radio" aria-checked="false" tabindex="0">
                            <input type="radio" name="rolePick" value="admin" class="role-radio" autocomplete="off"> Admin
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" autocomplete="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
</div>


<?= $this->endSection() ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('roleGrid');
    const roleInput = document.getElementById('roleInput');
    const form = document.getElementById('loginForm');

    function setActiveByRadio(radio) {
        const labels = grid.querySelectorAll('.role-card');
        labels.forEach(l => {
            l.classList.toggle('active', l.querySelector('.role-radio') === radio);
            l.setAttribute('aria-checked', l.querySelector('.role-radio') === radio ? 'true' : 'false');
        });
        roleInput.value = radio.value;
    }

    grid.addEventListener('change', (e) => {
        const radio = e.target.closest('.role-radio');
        if (radio) {
            setActiveByRadio(radio);
        }
    });

    // Also handle click anywhere on the label to check the radio programmatically
    grid.addEventListener('click', (e) => {
        const label = e.target.closest('.role-card');
        if (label) {
            const radio = label.querySelector('.role-radio');
            if (radio) {
                radio.checked = true;
                setActiveByRadio(radio);
            }
        }
    });

    // Initialize from hidden input or the checked radio
    const initialValue = (roleInput.value || 'student').toLowerCase();
    const initialRadio = grid.querySelector(`.role-radio[value="${initialValue}"]`) || grid.querySelector('.role-radio:checked');
    if (initialRadio) {
        setActiveByRadio(initialRadio);
    }

    // Final safeguard: sync hidden role right before submit
    form.addEventListener('submit', () => {
        const selected = grid.querySelector('.role-radio:checked');
        if (selected) {
            roleInput.value = selected.value;
        }
    });
});
</script>
