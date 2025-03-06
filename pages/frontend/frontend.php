<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php' ?>

<body class="hold-transition layout-top-nav">
<div class="wrapper">

<?php include 'navbar.php' ?>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Home Page </h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Welcome to Boarding House Management System</h5>

                <p class="card-text">
                This system helps manage your boarding house efficiently, making tasks such as tenant management, invoice tracking, and payment processing easier and more organized.
                </p>

              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Features</h5>
              </div>
              <div class="card-body">
                <p class="card-text">
                  <ol>
                    <li>
                      <strong>Dashboard:</strong>
                      <ul>
                        <li>Total Active Tenants - Displays the total number of active tenants currently residing in the boarding house.</li>
                        <li>Total Beds - Shows the total number of beds available in the boarding house.</li>
                        <li>Total Collection - Sum of all payments collected from tenants.</li>
                        <li>Total Collectibles - Sum of all outstanding payments yet to be collected from tenants.</li>
                      </ul>
                    </li>
                    <li><strong>Tenants:</strong> Manages information and details of tenants residing in the boarding house, including contact details, and lease terms.</li>
                    <li><strong>Rooms:</strong> Provides information about the rooms available in the boarding house, including occupancy status, room types, and rental rates.</li>
                    <li><strong>Bed Info:</strong> Details about individual beds within each room, including bed numbers, sizes, and current occupancy status.</li>
                    <li><strong>Bed Assignment:</strong> Assigns beds to tenants, tracks bed allocations, and manages room occupancy.</li>
                    <li><strong>Invoice:</strong> Generates invoices for tenants, tracks payment history, and manages billing cycles.</li>
                    <li><strong>Reports:</strong> Generates various reports such as collectible reports, financial summaries, and tenant payment histories.</li>
                    <li><strong>Activity Log:</strong> Logs all system activities, including user logins, modifications to tenant records, and invoice generation.</li>
                    <li><strong>Backup Database:</strong> Allows for the backup of the system's database to prevent data loss and ensure data integrity.</li>
                  </ol>
                </p>
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include '../includes/dashboard_footer.php' ?>
</div>
<!-- ./wrapper -->
<?php include '../includes/footer.php' ?>
</body>
</html>
