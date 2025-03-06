<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RRboardinghouse</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../tenant_account/dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../tenant_account/bedassignment_list.php" class="nav-link">
              <i class="nav-icon fas fa-city"></i>
              <p>
                Bed Assignment
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../tenant_account/invoice_list.php" class="nav-link">
              <i class="nav-icon fas fa-city"></i>
              <p>
                My Invoices
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../tenant_account/payment_list.php" class="nav-link">
              <i class="nav-icon fas fa-city"></i>
              <p>
                My Payments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../frontend/frontend.php" class="nav-link" target="_blank">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Visit Front-end Website
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../includes/logout_tenant.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
