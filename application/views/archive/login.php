<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('/assets/css/login.css'); ?>">
  <title>Login</title>
</head>
<body class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
          <?= $this->session->flashdata('error') ?>
        </div>
      <?php endif; ?>
      <div class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
          <div class="card login-card">
            <div class="row no-gutters">
              <div class="col-md-5">
                <img src="<?= base_url('/assets/images/login.jpg'); ?>" alt="login" class="login-card-img">
              </div>
              <div class="col-md-7">
              <a href="<?= base_url('/admin/login') ?>" class="btn btn-block login-btn mb-6">Administrator Login</a>
                <div class="card-body">
                      <div class="brand-wrapper d-flex align-items-center mb-2">
                        <img src="<?= base_url('/assets/images/images.png'); ?>" alt="logo" class="logo mr-3">
                        <h1 style="margin-top: 6px;">Advisable</h1>
                      </div>
                  <p class="login-card-description">Sign into your account</p>
                  <form method="post" action="<?= base_url('/login/verify') ?>">
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
                    <p class="login-card-footer-text">Don't have an account? <a href="<?= base_url('/register') ?>" class="text-reset">Register here</a></p>
                  <nav class="login-card-footer-nav">
                    <a href="#!">Terms of use.</a>
                    <a href="#!">Privacy policy</a>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>