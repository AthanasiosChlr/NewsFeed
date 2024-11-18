<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NewsFeed</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon-16x16.png'); ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/images/favicon-32x32.png'); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url('') ?>">NewsFeed</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <form class="d-flex mx-auto" role="search" style="width: 40vw;" method="get" action="<?= base_url('/search') ?>">
          <input class="form-control me-2" type="search" name="query" placeholder="Search article" aria-label="Search">
          <button class="btn btn-search btn-outline-secondary" type="submit">Search</button>
        </form>
        <ul class="navbar-nav">
          <li class="btn">
            <button id="darkModeToggle" type="button" class="btn btn-outline-secondary">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
                <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"></path>
              </svg>
            </button>
          </li>
          <?php if (isset($user) && !empty($user->first_name) && ($user->role == 'user' || $user->role == 'admin')): ?>
            <li class="dropdown d-flex align-items-center">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= base_url('/logout') ?>">Logout</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="btn">
              <div class="btn-group" role="group" aria-label="Button Group">
                <button id="signInBtn" class="btn buttonGroup btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
                <button id="registerBtn" class="btn buttonGroup btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
              </div>
            <?php endif; ?>
            </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Categories Sidebar -->
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <div class="col-auto col-md-2 col-xl-1 px-sm-1 px-0 sidebar" style="min-width: 160px;">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-black min-vh-100">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/technology') ?>">Technology</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/business') ?>">Business</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/entertainment') ?>">Entertainment</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/science') ?>">Science</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/health') ?>">Health</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/lifestyle') ?>">Lifestyle</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/food') ?>">Food</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/education') ?>">Education</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/sports') ?>">Sports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/tourism') ?>">Tourism</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="col py-2">
        <!-- Content -->
        <?php if (isset($content)) $this->load->view($content, isset($data) ? $data : []); ?>
      </div>
    </div>
  </div>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm" method="post">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <div id="loginError" class="alert alert-danger mt-2" style="display: none;"></div>
          <button type="button" class="btn btn-link px-0" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">Forgot Password?</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      var form = e.target;
      var formData = new FormData(form);

      fetch('<?= base_url('/login/process') ?>', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            var loginError = document.getElementById('loginError');
            loginError.textContent = data.message;
            loginError.style.display = 'block';
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });

    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordField = document.getElementById('password');
      const passwordFieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', passwordFieldType);
      this.querySelector('i').classList.toggle('bi-eye');
      this.querySelector('i').classList.toggle('bi-eye-slash');
    });
  </script>

  <!-- Register Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Register</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="registerForm" method="post">
            <div class="mb-3">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="register_password" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="register_password" name="password" required>
                <button class="btn btn-outline-secondary" type="button" id="toggleRegisterPassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              <div id="passwordStrength" class="mt-2"></div>
            </div>
            <div class="mb-3">
              <label for="retype_password" class="form-label">Retype Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="register_retype_password" name="retype_password" required>
                <button class="btn btn-outline-secondary" type="button" id="toggleRetypePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <div id="registerError" class="alert alert-danger mt-2" style="display: none;"></div>
            <div id="registerSuccess" class="alert alert-success mt-2" style="display: none;"></div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      e.preventDefault();
      var form = e.target;
      var formData = new FormData(form);

      var password = document.getElementById('register_password').value;
      var retypePassword = document.getElementById('register_retype_password').value;
      if (password !== retypePassword) {
        alert('Passwords do not match!');
        return;
      }

      fetch('<?= base_url('/register_user') ?>', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          var registerError = document.getElementById('registerError');
          var registerSuccess = document.getElementById('registerSuccess');
          if (data.success) {
            registerSuccess.textContent = 'Registration successful!';
            registerSuccess.style.display = 'block';
            registerError.style.display = 'none';
            setTimeout(() => {
              location.reload();
            }, 2000);
          } else {
            registerError.textContent = data.message;
            registerError.style.display = 'block';
            registerSuccess.style.display = 'none';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          var registerError = document.getElementById('registerError');
          registerError.textContent = 'An error occurred. Please try again.';
          registerError.style.display = 'block';
        });
    });

    document.getElementById('toggleRegisterPassword').addEventListener('click', function() {
      const passwordField = document.getElementById('register_password');
      const passwordFieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', passwordFieldType);
      this.querySelector('i').classList.toggle('bi-eye');
    });

    document.getElementById('register_password').addEventListener('input', function() {
      const password = this.value;
      const result = zxcvbn(password);
      const strengthText = [
        'Very Weak',
        'Weak',
        'Fair',
        'Good',
        'Strong'
      ];
      const passwordStrength = document.getElementById('passwordStrength');
      passwordStrength.textContent = `Strength: ${strengthText[result.score]}`;
      passwordStrength.className = `mt-2 text-${['danger', 'danger', 'warning', 'info', 'success'][result.score]}`;
    });

    document.getElementById('toggleRetypePassword').addEventListener('click', function() {
      const passwordField = document.getElementById('register_retype_password');
      const passwordFieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', passwordFieldType);
      this.querySelector('i').classList.toggle('bi-eye');
      this.querySelector('i').classList.toggle('bi-eye-slash');
    });
  </script>

  <!-- Reset Password Modal -->
  <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="login-card-description">Get a link to reset your password</p>
          <form id="resetPasswordForm" method="post">
            <div class="mb-3">
              <label for="reset_email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="reset_email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
          </form>
          <p class="login-card-footer-text mt-2 mb-0">Want to Login instead? <a href="#" class="text-reset" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In here</a></p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const darkModeToggle = document.getElementById('darkModeToggle');
      const body = document.body;

      // Check local storage for dark mode preference
      if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
      }

      darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
          localStorage.setItem('darkMode', 'enabled');
        } else {
          localStorage.setItem('darkMode', 'disabled');
        }
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const form = event.target;
        const formData = new FormData(form);

        fetch('<?= base_url('request_password_reset') ?>', {
          method: 'POST',
          body: formData,
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Password reset link has been sent to your email.');
            form.reset();
            $('#resetPasswordModal').modal('hide');
          } else {
            alert('Failed to send password reset link. ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred. Please try again.');
        });
      });
    });
  </script>
</body>

</html>
