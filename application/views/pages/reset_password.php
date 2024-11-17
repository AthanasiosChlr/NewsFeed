<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center">
          <h3>Reset Password</h3>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?php echo $_SESSION['error']; ?>
            </div>
          <?php endif; ?>
          <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
          <form action="<?= site_url("reset_password/$token") ?>" method="post">
            <div class="form-group">
              <label for="new_password">New Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="new_password" name="password" required>
                <div class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('new_password')">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="confirm_password" name="password_confirm" required>
                <div class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('confirm_password')">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-2">Reset Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function togglePasswordVisibility(fieldId) {
  var field = document.getElementById(fieldId);
  var button = field.nextElementSibling.querySelector('button');
  var icon = button.querySelector('i');
  if (field.type === "password") {
    field.type = "text";
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    field.type = "password";
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}
</script>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">