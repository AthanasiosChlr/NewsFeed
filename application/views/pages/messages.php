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

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center">Messages</h2>
      <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <a href="<?= base_url('/send_message') ?>" class="btn btn-primary mt-1">Send Message</a>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Sender Email</th>
                <th>Date</th>
                <th>Action</th> <!-- New column for actions -->
              </tr>
            </thead>
            <tbody>
              <?php foreach ($messages as $index => $message): ?>
                <tr class="clickable-row" data-bs-toggle="collapse" data-bs-target="#message-<?= $index ?>" aria-expanded="false" aria-controls="message-<?= $index ?>">
                  <td><?= htmlspecialchars($message->first_name, ENT_QUOTES, 'UTF-8') ?></td>
                  <td><?= htmlspecialchars($message->last_name, ENT_QUOTES, 'UTF-8') ?></td>
                  <td><?= htmlspecialchars($message->sender_email, ENT_QUOTES, 'UTF-8') ?></td>
                  <td><?= htmlspecialchars($message->created_at, ENT_QUOTES, 'UTF-8') ?></td>
                  <td>
                    <form action="<?= base_url('/delete_message') ?>" method="post" style="display:inline;">
                      <input type="hidden" name="message_id" value="<?= $message->id ?>">
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  </td>
                </tr>
                <tr id="message-<?= $index ?>" class="collapse">
                  <td colspan="5">
                    <div class="message-content"><?= htmlspecialchars($message->message, ENT_QUOTES, 'UTF-8') ?></div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var rows = document.querySelectorAll('.clickable-row');
    rows.forEach(function(row) {
      row.addEventListener('click', function() {
        var target = this.getAttribute('data-bs-target');
        var collapseElement = document.querySelector(target);
        if (collapseElement.classList.contains('show')) {
          bootstrap.Collapse.getInstance(collapseElement).hide();
        } else {
          bootstrap.Collapse.getInstance(collapseElement).show();
        }
      });
    });
  });
</script>