<head>
  <title>Messages Sent by <?= htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8') ?></title>
</head>

<body>
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

  <div class="container mt-4">
    <h2>Messages Sent by <?= htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8') ?></h2>
    <table class="table">
      <thead>
        <tr>
          <th>Recipient Email</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Message</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($messages as $message): ?>
          <tr>
            <td><?= htmlspecialchars($message->recipient_email, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($message->first_name, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($message->last_name, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($message->message, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($message->created_at, ENT_QUOTES, 'UTF-8') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>