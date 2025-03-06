<?php
// Include the authentication check file
include_once('../includes/auth_check.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php'; ?>
<style>
  .hidden-column {
    display: none;
  }
</style>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include '../includes/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include '../includes/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- Total Transactions Card -->
          <div class="col-sm-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Total Transactions</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                  require_once('../includes/dbcon.php');
                  // Query to get the total number of transactions
                  $sql_total_transactions = "SELECT COUNT(*) AS total_transactions FROM tblpayment";
                  $result_total_transactions = $conn->query($sql_total_transactions);
                  $row_total_transactions = $result_total_transactions->fetch_assoc();
                  $total_transactions = $row_total_transactions['total_transactions'];
                ?>
                <h1>Total Transactions: <?php echo $total_transactions; ?></h1>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- Total Payments Card -->
          <div class="col-sm-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Total Payments</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                require_once('../includes/dbcon.php');
                  // Calculate total payments
                  $sql_total_payments = "SELECT SUM(amount_paid) AS total_payments FROM tblpayment";
                  $result_total_payments = $conn->query($sql_total_payments);
                  $row_total_payments = $result_total_payments->fetch_assoc();
                  $total_payments = $row_total_payments['total_payments'];
                ?>
                <h1>Total Amount Paid: <?php echo number_format($total_payments, 2); ?></h1>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                Payment List
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class='hidden-column'>Payment ID</th>
                        <th>Invoice Number</th>
                        <th>Tenant Name</th>
                        <th>Amount Paid</th>
                        <th>Payment Date</th>
                        <th>Payment Mode</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once('../includes/dbcon.php');
                        $sql = "SELECT * FROM tblpayment ORDER BY payment_id DESC";

                        //use for MySQLi-OOP
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc())
                        {
                          echo 
                          "<tr>
                            <td class='hidden-column'>".$row['payment_id']."</td>
                            <td>".$row['invoice_number']."</td>
                            <td>".$row['tenant_name']."</td>
                            <td>".number_format($row['amount_paid'],2)."</td>
                            <td>".$row['payment_date']."</td>
                            <td>".$row['payment_mode']."</td>
                          </tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
 
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include '../includes/dashboard_footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include '../includes/footer.php'; ?>
</body>
</html>
