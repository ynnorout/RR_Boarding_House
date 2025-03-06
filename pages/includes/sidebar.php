<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RRBoardingHouse</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../dashboard/dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../tenant/tenant_list.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Tenants
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../room/room_list.php" class="nav-link">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Rooms
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../bed/bed_list.php" class="nav-link">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Bed Info
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../bedassignment/bedassignment_list.php" class="nav-link">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Bed Assignment
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../invoice/invoice_list.php" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Invoice
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../report/report_list.php" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <?php 
            // Check if user type is admin before displaying the Users link
            if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') { 
          ?>
          <li class="nav-item">
            <a href="../user/users_list.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="../activitylog/activity_log_list.php" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                User Activity Log
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../companyinfo/company.php" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Company Info
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../backup/backup.php" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Backup Database
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
            <a href="../includes/logout.php" class="nav-link">
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
