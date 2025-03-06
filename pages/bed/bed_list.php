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
          <div class="col-sm-6">
            <h1>Bed Info</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
      <?php include '../includes/success_message.php'; ?>
      <?php include '../includes/error_message.php'; ?>
      <?php include 'add_modal.php'; ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class='hidden-column'>Bed ID</th>
                        <th>Room Name</th>
                        <th>Bed Number</th>
                        <th>Monthly Rent</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once('../includes/dbcon.php');
                        $sql = "SELECT b.bed_id, r.room_name, b.bed_number, b.monthly_rent, b.status FROM tblbed b JOIN tblroom r ON b.room_id = r.room_id";

                        //use for MySQLi-OOP
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc())
                        {
                          echo 
                          "<tr>
                            <td class='hidden-column'>".$row['bed_id']."</td>
                            <td>".$row['room_name']."</td>
                            <td>".$row['bed_number']."</td>
                            <td>".$row['monthly_rent']."</td>
                            <td>".$row['status']."</td>
                            <td>
                              <a href='#edit_".$row['bed_id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                              <a href='#delete_".$row['bed_id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                            </td>
                          </tr>";
                          include('edit_delete_modal.php');
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
 
  </div>
  <!-- /.content-wrapper -->

   <!-- Main Footer -->
  <?php include '../includes/dashboard_footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include '../includes/footer.php'; ?>
</body>
</html>
