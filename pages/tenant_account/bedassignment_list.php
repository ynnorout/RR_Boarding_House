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
  <?php include '../includes/sidebar_tenant.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bed Assignment Info</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                My Bed(s)
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class='hidden-column'>Assignment ID</th>
                        <th>Tenant Name</th>
                        <th>Room Name</th>
                        <th>Bed Number</th>
                        <th>Due Date</th>
                        <th>Months to Stay</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once('../includes/dbcon.php');
                        $sql = "SELECT ba.assignment_id, t.complete_name, r.room_name, b.bed_number, ba.due_date, ba.months_to_stay
                                FROM tblbedassignment ba
                                INNER JOIN tbltenant t ON ba.tenant_id = t.tenant_id
                                INNER JOIN tblroom r ON ba.room_id = r.room_id
                                INNER JOIN tblbed b ON ba.bed_id = b.bed_id
                                WHERE ba.tenant_id = '" . $_SESSION['tenant_id'] . "'";

                        //use for MySQLi-OOP
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc())
                        {
                          echo 
                          "<tr>
                            <td class='hidden-column'>".$row['assignment_id']."</td>
                            <td>".$row['complete_name']."</td>
                            <td>".$row['room_name']."</td>
                            <td>".$row['bed_number']."</td>
                            <td>".$row['due_date']."</td>
                            <td>".$row['months_to_stay']."</td>
                            <td>
                              <a href='../tenant_account/invoice_list.php?assignment_id=".$row['assignment_id']."' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-edit'></span> View Invoices</a>
                            </td>
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
    <!-- Add Modal -->
 
  </div>
  <!-- /.content-wrapper -->

  

  <!-- Main Footer -->
  <?php include '../includes/dashboard_footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include '../includes/footer.php'; ?>
</body>
</html>
