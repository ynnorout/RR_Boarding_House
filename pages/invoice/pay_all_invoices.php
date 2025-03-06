<?php
// Include the database connection file
include_once('../includes/dbcon.php');

// Start the session
session_start();

// Retrieve the assignment ID from the URL parameter
$assignmentId = isset($_GET['assignment_id']) ? $_GET['assignment_id'] : null;

// Check if the assignment ID is provided
if ($assignmentId) {
    // Prepare the SQL query to update all invoices related to the assignment ID
    $updateSql = "UPDATE tblinvoice SET status = 'paid', remarks = 'payAll' WHERE assignment_id = ? and status='unpaid'";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("i", $assignmentId);
    
    // Execute the update query
    if ($updateStmt->execute()) {
        // Prepare the SQL query to insert records into tblpayment
        $insertSql = "INSERT INTO tblpayment (invoice_number, tenant_name, amount_paid, payment_date, payment_mode) 
                      SELECT i.invoice_number, t.complete_name, i.total_due, NOW(), 'cash' 
                      FROM tblinvoice i 
                      INNER JOIN tbltenant t ON i.tenant_id = t.tenant_id 
                      WHERE i.assignment_id = ? AND i.remarks = 'payAll'";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("i", $assignmentId);

        // Execute the insert query
        if ($insertStmt->execute()) {
            // Payment and insertion successful, redirect to the view invoice page
            header('location: view_invoice_all.php?assignment_id='.$assignmentId);
            exit();
        } else {
            // Error occurred while inserting payment records, redirect with error message
            $_SESSION['error'] = "Invoices are already paid";
            header('location: invoice_list.php');
            exit();
        }
    } else {
        // Error occurred while updating invoices, redirect with error message
        $_SESSION['error'] = "Failed to pay all invoices.";
        header('location: invoice_list.php');
        exit();
    }
} else {
    // Assignment ID is not provided, redirect with error message
    $_SESSION['error'] = "Assignment ID is missing.";
    header('location: invoice_list.php');
    exit();
}
?>
