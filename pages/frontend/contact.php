<?php

// Include the database connection file
include_once('../includes/dbcon.php');

// Fetch data from tblFireContact
$sql_fire_contact = "SELECT * FROM tblFireContact";
$result_fire_contact = $conn->query($sql_fire_contact);

// Fetch data from tblcompany
$sql_company = "SELECT * FROM tblcompany";
$result_company = $conn->query($sql_company);

// Close database connection
$conn->close();
?>

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
            <h1 class="m-0"> Contact Page </h1>
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
                <p class="card-text">
                
                </p>

                <!-- Display company information -->
                <?php
                if ($result_company->num_rows > 0) {
                  while ($row_company = $result_company->fetch_assoc()) {
                    echo "<h2>{$row_company['company_name']}</h2>";
                    echo "<p>{$row_company['company_address']}</p>";
                    echo "<p>Contact: {$row_company['company_contact']}</p>";
                    echo "<p>Website: <a href='{$row_company['company_website']}' target='_blank'>{$row_company['company_website']}</a></p>";
                  }
                }
                ?>               
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          
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
