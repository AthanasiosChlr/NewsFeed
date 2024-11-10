<nav class="navbar navbar-expand-lg w-100 m-0 p-0 mt-3" style="background-color: transparent; box-shadow: none;">
  <div class="container-fluid justify-content-center">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item mx-2">
          <a class="nav-link" href="<?= base_url('/dashboard') ?>">My Profile</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="<?= base_url('/messages') ?>">Messages</a>
        </li>
        <?php if ($user->role == 'admin'): ?>
          <li class="nav-item mx-2">
            <a class="nav-link" href="<?= base_url('/customers') ?>">Customers</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="d-flex align-items-center mt-5 py-3 py-md-0">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-4">
        <h2 class="mb-4">Welcome, <?= htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') ?></h2>
        <p class="mt-4">Welcome to your dashboard. Here you can manage your profile, check your messages, and more.</p>
      </div>
      <div class="col-md-5 mx-auto">
        <div class="card h-100">
          <div class="card-body">
            <form method="post" action="<?= base_url('dashboard/update_profile') ?>">
              <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?= htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') ?>">
              </div>
              <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?= htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8') ?>">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email address" value="<?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?>">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              </div>
              <button type="submit" name="update_profile" id="update_profile" class="btn btn-primary">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>