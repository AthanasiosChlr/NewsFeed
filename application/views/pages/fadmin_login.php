<head>
  <title>Login</title>
</head>

<body class="container-fluid px-0">
  <div class="row justify-content-center mx-0">
    <div class="col-md-11 px-0">
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
          <?= $this->session->flashdata('error') ?>
        </div>
      <?php endif; ?>
      <div class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container px-0">
          <div class="card login-card">
            <div class="row no-gutters">
              <div class="col-md-5">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <p class="login-card-description">Sign into your administrator account</p>
                  <form method="post" action="<?= base_url('/admin/verify') ?>">
                    <div class="form-group">
                      <label for="email" class="sr-only">Email</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Email address">
                    </div>
                    <div class="form-group mb-4">
                      <label for="password" class="sr-only">Password</label>
                      <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    </div>
                    <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                  </form>
                  <a href="<?= base_url('/reset_password') ?>" class="forgot-password-link">Forgot password?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>