<?php
// Include the authentication check file
include_once('../includes/auth_check.php');

// Include database connection
require_once('../includes/dbcon.php');

// Retrieve invoice details based on the selected assignment ID
function getInvoiceDetails($conn, $assignment_id) {
    $sql = "SELECT i.*, t.complete_name, t.address, t.email_address, t.contact
            FROM tblinvoice i 
            INNER JOIN tbltenant t ON i.tenant_id = t.tenant_id
            WHERE i.assignment_id = ? AND i.status = 'paid'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $assignment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $invoices = array();
    while ($row = $result->fetch_assoc()) {
        $invoices[] = $row;
    }
    return $invoices;
}

// Retrieve company information
function getCompanyInfo($conn) {
    $sql = "SELECT * FROM tblcompany";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Main code
if(isset($_GET['assignment_id']) && !empty($_GET['assignment_id'])) {
    $assignment_id = $_GET['assignment_id'];

    // Fetch invoice details
    $invoices = getInvoiceDetails($conn, $assignment_id);

    // Fetch company information
    $companyInfo = getCompanyInfo($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php'; ?>
<style>
@media print {
    .main-footer {
        display: none !important;
    }
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
            <h1>Invoice</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
      <?php include '../includes/success_message.php'; ?>
      <?php include '../includes/error_message.php'; ?>
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <?php foreach ($invoices as $invoiceDetails): ?>
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> <?php echo $companyInfo['company_name'] ?? ''; ?>
                    <small class="float-right">Date: <?php echo date('m/d/Y'); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                      <strong><?php echo $companyInfo['company_name'] ?? ''; ?></strong><br>
                      <?php echo $companyInfo['company_address'] ?? ''; ?><br>
                      Phone: <?php echo $companyInfo['company_contact'] ?? ''; ?><br>
                      Email: <?php echo $companyInfo['company_website'] ?? ''; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $invoiceDetails['complete_name'] ?? ''; ?></strong><br>
                    <?php echo $invoiceDetails['address'] ?? ''; ?><br>
                    Phone: <?php echo $invoiceDetails['contact'] ?? ''; ?><br>
                    Email: <?php echo $invoiceDetails['email_address'] ?? ''; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col"> 
                  <b>Invoice #<?php echo $invoiceDetails['invoice_number'] ?? ''; ?></b><br>
                  <br>
                  <b>Payment Due:</b> <?php echo $invoiceDetails['due_date_iterate'] ?? ''; ?><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Invoice Number</th>
                        <th>Tenant Name</th>
                        <th>Due Date Iterate</th>
                        <th>Bed Rate</th>
                        <th>Penalty Amount</th>
                        <th>Discount Amount</th>
                        <th>Total Due</th>
                        <th>Status</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $invoiceDetails['invoice_number'] ?? ''; ?></td>
                        <td><?php echo $invoiceDetails['complete_name'] ?? ''; ?></td>
                        <td><?php echo $invoiceDetails['due_date_iterate'] ?? ''; ?></td>
                        <td><?php echo number_format($invoiceDetails['bed_rate'] ?? 0, 2); ?></td>
                        <td><?php echo number_format($invoiceDetails['penalty_amount'] ?? 0, 2); ?></td>
                        <td><?php echo number_format($invoiceDetails['discount_amount'] ?? 0, 2); ?></td>
                        <td><?php echo number_format($invoiceDetails['total_due'] ?? 0, 2); ?></td>
                        <td><?php echo $invoiceDetails['status'] ?? ''; ?></td>
                        <td><?php echo $invoiceDetails['remarks'] ?? ''; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-6">
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Total:</th>
                        <td><?php echo number_format($invoiceDetails['total_due'] ?? 0, 2); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row no-print">
                <div class="col-12">
                  <!--<a href="#" onclick="window.print();" class="btn btn-default"><i class="fas fa-print"></i> PDF</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit Payment</button>-->
                  <button type="button"onclick="window.print();" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="fas fa-print"></i> Print</button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
            <?php endforeach; ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include '../includes/dashboard_footer.php'; ?>

</div><!-- ./wrapper -->

<?php include '../includes/footer.php'; ?>

</body>
</html>
