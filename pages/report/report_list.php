<?php
// Include the authentication check file
include_once('../includes/auth_check.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php' ?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<?php include '../includes/navbar.php' ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include '../includes/sidebar.php' ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Reports</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Payment List</h3>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <p class="card-text">The Payment List report provides a detailed record of all payments made by tenants. It includes information such as the payment ID, invoice number, tenant name, amount paid, payment date, and payment mode. </p>
                <a href="payment_list.php" class="btn btn-primary">View Report</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Collectibles by Tenant</h3>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <p class="card-text">The Collectibles by Tenant report categorizes outstanding payments or collectibles by individual tenants. It lists tenants who have overdue payments along with the total amount owed by each tenant.</p>
                <a href="collectibles_by_tenant.php" class="btn btn-primary">View Report</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Collectibles by Month</h3>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <p class="card-text">It provides a breakdown collectibes for each month, allowing property managers to track the receivables over time. This report helps in implementing proactive collection strategies, and addressing recurring payment issues.</p>
                <a href="collectibles_by_month.php" class="btn btn-primary">View Report</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Monthly Payment Collection</h3>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <p class="card-text">It presents the total amount paid by tenants on a monthly basis, allowing for easy tracking and analysis of payment trends over time. </p>
                <a href="monthly_payment_collection.php" class="btn btn-primary">View Report</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Other Reports</h3>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <p class="card-text">Space for Other Reports</p>
                <a href="#" class="btn btn-primary">View Report</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include '../includes/dashboard_footer.php' ?>

</div>
<!-- ./wrapper -->

<?php include '../includes/footer.php' ?>

</body>
</html>
