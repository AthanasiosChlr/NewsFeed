<head>
  <title>Customer List</title>
  <script type="text/javascript">
    function confirmDelete() {
      return confirm('Are you sure you want to delete this customer?');
    }
  </script>
</head>
<div class="row justify-content-center">
  <div class="col-md-11">
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger">
        <?= $this->session->flashdata('error') ?>
      </div>
    <?php endif; ?>

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

    <div class="col-md-7 mx-auto mt-5">
      <div class="card-body">
        <h2 class="text-center mb-4">Customer List</h2>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($customers)): ?>
              <?php foreach ($customers as $customer): ?>
                <tr>
                  <td><?= htmlspecialchars($customer->first_name, ENT_QUOTES, 'UTF-8') ?></td>
                  <td><?= htmlspecialchars($customer->last_name, ENT_QUOTES, 'UTF-8') ?></td>
                  <td><?= htmlspecialchars($customer->email, ENT_QUOTES, 'UTF-8') ?></td>
                  <td>
                    <form method="post" action="<?= base_url('/delete_customer/' . $customer->id) ?>" style="display:inline;" onsubmit="return confirmDelete()">
                      <input type="hidden" name="id" value="<?= $customer->id ?>">
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#editForm<?= $customer->id ?>" aria-expanded="false" aria-controls="editForm<?= $customer->id ?>">
                      Edit
                    </button>
                    <a href="<?= base_url('view_user_messages/' . $customer->id) ?>" class="btn btn-info btn-sm">View Messages</a>
                    <div class="collapse mt-2" id="editForm<?= $customer->id ?>">
                      <div class="card card-body">
                        <form method="post" action="<?= base_url('update_customer/' . $customer->id) ?>">
                          <div class="form-group">
                            <label for="first_name" class="sr-only">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?= htmlspecialchars($customer->first_name, ENT_QUOTES, 'UTF-8') ?>">
                          </div>
                          <div class="form-group">
                            <label for="last_name" class="sr-only">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?= htmlspecialchars($customer->last_name, ENT_QUOTES, 'UTF-8') ?>">
                          </div>
                          <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email address" value="<?= htmlspecialchars($customer->email, ENT_QUOTES, 'UTF-8') ?>">
                          </div>
                          <div class="form-group mb-4">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                          </div>
                          <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center">No customers found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>