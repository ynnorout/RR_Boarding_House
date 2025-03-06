<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
                    <h1>Tenant Info</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <?php include '../includes/success_message.php'; ?>
            <?php include '../includes/error_message.php'; ?>
            <?php include 'add_modal.php'; ?>
            <?php //include 'change_credentials_modal.php'; ?>
           
            

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
                                            <th>Action</th>
                                            <th class='hidden-column'>Tenant ID</th>
                                            <th>Profile Picture</th>
                                            <th>Complete Name</th>
                                            <th>Address</th>
                                            <th>Email Address</th>
                                            <th>Contact</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <th>Proof of Identity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once('../includes/dbcon.php');
                                        $sql = "SELECT * FROM tbltenant ORDER BY tenant_id DESC";

                                        //use for MySQLi-OOP
                                        $query = $conn->query($sql);
                                        while ($row = $query->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>
                                                        <a href='#edit_" . $row['tenant_id'] . "' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                                                        <a href='#delete_" . $row['tenant_id'] . "' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                                                        <a href='#change_credentials_" . $row['tenant_id'] . "' class='btn btn-info btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-lock'></span> Login Credentials</a>
                                                    </td>
                                                    <td class='hidden-column'>" . $row['tenant_id'] . "</td>
                                                    <td class='text-center'>
                                                        <img src='profile_upload/" . $row['profile_picture'] . "' class='img-thumbnail' style='width:100px;' alt='Profile Picture'><br>
                                                        <button class='btn btn-flat btn-warning btn-xs' data-toggle='modal' data-target='#edit_avatar_" . $row['tenant_id'] . "'><i class='nav-icon fas fa-pen'></i> Edit Picture</button>
                                                    </td>
                                                    <td>" . $row['complete_name'] . "</td>
                                                    <td>" . $row['address'] . "</td>
                                                    <td>" . $row['email_address'] . "</td>
                                                    <td>" . $row['contact'] . "</td>
                                                    <td>" . $row['gender'] . "</td>
                                                    <td>" . $row['status'] . "</td>
                                                    <td class='text-center'>
                                                        <img src='identity_upload/" . $row['proof_of_identity'] . "' class='img-thumbnail' style='width:100px;' alt='Proof of Identity'><br>
                                                        <button class='btn btn-flat btn-warning btn-xs' data-toggle='modal' data-target='#edit_proof_" . $row['tenant_id'] . "'><i class='nav-icon fas fa-pen'></i> Edit Proof</button>
                                                    </td>
                                                </tr>";
                                            include('edit_delete_modal.php');
                                            include('change_credentials_modal.php');
                                            include('update_profile_modal.php');
                                            include('update_proof_modal.php');
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
  <?php include '../includes/dashboard_footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include '../includes/footer.php'; ?>
</body>
</html>
