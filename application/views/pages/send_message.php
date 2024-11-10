<nav class="navbar navbar-expand-lg navbar-light w-100 m-0 p-0 mt-3" style="box-shadow: none;">
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

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h2 class="mb-0">Send a Message</h2>
        </div>
        <div class="card-body">
          <form method="post" action="<?= base_url('/send_message/submit_message') ?>">
            <div class="form-group mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Recipient's Email" required>
            </div>
            <div class="form-group mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea name="message" id="message" class="form-control" placeholder="Your Message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>