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
                <h3 class="card-title">Occupied Beds</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                require_once('../includes/dbcon.php');
                // Query to get the total number of active tenants
                $sql_total_occupied = "SELECT COUNT(*) AS total_occupied FROM tblbed WHERE status = 'occupied'";
                $result_total_occupied = $conn->query($sql_total_occupied);
                $row_total_occupied = $result_total_occupied->fetch_assoc();
                $total_occupied = $row_total_occupied['total_occupied'];
                ?>
                <h1>Total: <?php echo $total_occupied; ?></h1>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                Collectibles by Month
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Total Collectibles</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once('../includes/dbcon.php');
                        // Query to get collectibles by month
                        $sql_collectibles_by_month = "SELECT YEAR(STR_TO_DATE(due_date_iterate, '%M %d, %Y')) AS year,
                                                              MONTHNAME(STR_TO_DATE(due_date_iterate, '%M %d, %Y')) AS month,
                                                              SUM(total_due) AS total_collectibles
                                                      FROM tblinvoice
                                                      WHERE status = 'unpaid'
                                                      GROUP BY YEAR(STR_TO_DATE(due_date_iterate, '%M %d, %Y')), MONTH(STR_TO_DATE(due_date_iterate, '%M %d, %Y'))
                                                      ORDER BY YEAR(STR_TO_DATE(due_date_iterate, '%M %d, %Y')), MONTH(STR_TO_DATE(due_date_iterate, '%M %d, %Y'));";
                        $result_collectibles_by_month = $conn->query($sql_collectibles_by_month);
                        while($row = $result_collectibles_by_month->fetch_assoc())
                        {
                          echo 
                          "<tr>
                            <td>".$row['year']."</td>
                            <td>".$row['month']."</td>
                            <td>".number_format($row['total_collectibles'], 2)."</td>
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
