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
          <!-- Total Tenants Card -->
          <div class="col-sm-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tenants with occupied bed(s)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                  require_once('../includes/dbcon.php');
                  // Query to get the count of active tenants
                  $sql_occupied_tenants = "SELECT COUNT(DISTINCT tenant_id) AS occupied_tenants 
                                        FROM tblbedassignment 
                                        WHERE bed_id IN 
                                        (SELECT bed_id 
                                        FROM tblbed 
                                        WHERE status = 'occupied')";
                        // Perform the query
                        $result_occupied_tenants = $conn->query($sql_occupied_tenants);

                        // Check for errors
                        if (!$result_occupied_tenants) {
                            die("Query failed: " . $conn->error);
                        }
                        // Fetch the result
                        $row_occupied_tenants = $result_occupied_tenants->fetch_assoc();
                        $occupied_tenants = $row_occupied_tenants['occupied_tenants'];
                ?>
                <h1>Total: <?php echo $occupied_tenants; ?></h1>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- Total Collectibles Card -->
          <div class="col-sm-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Collectibles</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                  // Query to get the total collectibles
                  $sql_total_collectibles = "SELECT SUM(total_due) AS total_collectibles FROM tblinvoice WHERE status = 'unpaid'";
                  $result_total_collectibles = $conn->query($sql_total_collectibles);
                  $row_total_collectibles = $result_total_collectibles->fetch_assoc();
                  $total_collectibles = $row_total_collectibles['total_collectibles'];
                ?>
                <h1>Total: <?php echo number_format($total_collectibles, 2); ?></h1>
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
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                Collectibles by Tenant
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Tenant Name</th>
                        <th>Outstanding Balance</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once('../includes/dbcon.php');
                        // Query to get collectibles by tenant
                        $sql = "SELECT t.complete_name AS tenant_name, SUM(i.total_due) AS outstanding_balance
                                FROM tbltenant t
                                INNER JOIN tblinvoice i ON t.tenant_id = i.tenant_id
                                WHERE i.status = 'unpaid'
                                GROUP BY t.complete_name";

                        // Execute the query
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc())
                        {
                          echo 
                          "<tr>
                            <td>".$row['tenant_name']."</td>
                            <td>".number_format($row['outstanding_balance'], 2)."</td>
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
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                Collectibles Pie Chart
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <canvas id="paymentSummaryChart" width="400" height="400"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
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

<!-- Chart.js -->
<script src="../../plugins/chart.js/Chart.min.js"></script>

<script>
// Fetch data from PHP and create pie chart
<?php
  // Query to fetch payment data for pie chart
  $sql_payment_summary = "SELECT t.complete_name AS tenant_name, SUM(i.total_due) AS outstanding_balance
  FROM tbltenant t
  INNER JOIN tblinvoice i ON t.tenant_id = i.tenant_id
  WHERE i.status = 'unpaid'
  GROUP BY t.complete_name";
  $result_payment_summary = $conn->query($sql_payment_summary);

  // Initialize arrays to store payment data
  $payment_modes = [];
  $total_payments = [];

  // Fetch and store payment data
  while ($row = $result_payment_summary->fetch_assoc()) {
    $payment_modes[] = $row['tenant_name'];
    $total_payments[] = $row['outstanding_balance'];
  }
?>

// JavaScript code to create pie chart using Chart.js
var ctx = document.getElementById('paymentSummaryChart').getContext('2d');
var paymentSummaryChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: <?php echo json_encode($payment_modes); ?>,
    datasets: [{
      label: 'To Collect',
      data: <?php echo json_encode($total_payments); ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(255, 206, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(153, 102, 255, 0.7)',
        'rgba(255, 159, 64, 0.7)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      position: 'right'
    },
    title: {
      display: true,
      text: 'Collectibles'
    }
  }
});
</script>
</body>
</html>
