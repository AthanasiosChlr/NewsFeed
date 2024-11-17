<div class="container"></div>
<div class="row d-flex justify-content-center align-items-center h-100">
  <div class="col-12 col-md-8 col-lg-6 col-xl-5">
    <div class="card shadow-lg custom-card">
      <div class="card-body p-5 text-center">
        <h2 class="fw-bold mb-2">Login</h2>
        <p class="mb-5">Please enter your login and password!</p>

        <?php if (isset($error) && !empty($error)): ?>
          <div class="alert alert-danger">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>

        <form id="login-form" method="post" action="<?= base_url('admin/process') ?>">
          <div class="form-outline mb-4">
            <label class="form-label" for="typeEmailX">Email</label>
            <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" required />
          </div>

          <div class="form-outline mb-4">
            <label class="form-label" for="typePasswordX">Password</label>
            <div class="input-group">
              <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" required />
              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <button class="btn btn-primary btn-lg px-5" type="submit">Login</button>
        </form>

        <div id="loginError" class="alert alert-danger mt-2" style="display: none;"></div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('typePasswordX');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.querySelector('i').classList.toggle('bi-eye');
    this.querySelector('i').classList.toggle('bi-eye-slash');
  });
</script>