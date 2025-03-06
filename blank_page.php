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
            <h1 class="m-0">Fire Incidents by Barangay</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Insert the code for displaying fire incidents by barangay here -->
        <?php
        // Include database connection
        include_once('../includes/dbcon.php');

        // Check if the barangay parameter is set in the URL
        if(isset($_GET['barangay'])) {
            // Get the barangay name from the URL parameter and sanitize it
            $barangay = $_GET['barangay'];
            $barangay = htmlspecialchars($barangay);

            // Write SQL query to fetch fire incidents for the selected barangay with additional details
            $sql = "SELECT 
                        i.incident_id,
                        i.reported_date,
                        i.complete_address,
                        i.estimated_damage,
                        i.documentation
                    FROM tblIncident i
                    INNER JOIN tblbarangay b ON i.location_id = b.location_id
                    WHERE b.barangay = ?";

            // Prepare the SQL statement
            $stmt = $conn->prepare($sql);

            // Bind the parameter
            $stmt->bind_param("s", $barangay);

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Check if there are any fire incidents for the selected barangay
            if ($result->num_rows > 0) {
                // Fetch data and display fire incidents
                while ($row = $result->fetch_assoc()) {
                    // Output the fire incident details
                    echo "<p>Fire Incident ID: " . $row['incident_id'] . "</p>";
                    echo "<p>Reported Date: " . $row['reported_date'] . "</p>";
                    echo "<p>Complete Address: " . $row['complete_address'] . "</p>";
                    echo "<p>Estimated Damage: PHP " . number_format($row['estimated_damage'], 2) . "</p>";
                    echo "<p>Documentation: <a href='../upload/" . $row['documentation'] . "' target='_blank'>View Documentation</a></p>";
                    // Output other fire incident details as needed
                }
            } else {
                // No fire incidents found for the selected barangay
                echo "<p>No fire incidents found for Barangay: " . $barangay . "</p>";
            }

            // Close the statement
            $stmt->close();

        } else {
            // Barangay parameter is not set in the URL
            echo "<p>Error: Barangay parameter is missing.</p>";
        }

        // Close database connection
        $conn->close();
        ?>
      </div><!-- /.container-fluid -->
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
