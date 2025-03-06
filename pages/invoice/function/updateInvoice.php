<?php
session_start();
// Include the database connection and initialize session
require_once('../../includes/dbcon.php');

if (isset($_POST['update'])) {
    // Retrieve form data and sanitize inputs
    $invoice_id = $_POST['invoice_id'];
    $penalty_amount = intval($_POST['penalty']); // Sanitize to ensure it's an integer
    $discount_amount = intval($_POST['discount']); // Sanitize to ensure it's an integer
    $remarks = htmlspecialchars($_POST['remarks']); // Sanitize to prevent XSS attacks

    // Retrieve bed_rate from the database
    $sql = "SELECT bed_rate FROM tblinvoice WHERE invoice_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $invoice_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['error'] = 'Invoice details not found';
        header("Location: ../invoice_list.php");
        exit();
    }

    $row = $result->fetch_assoc();
    $bed_rate = $row['bed_rate'];

    // Compute total due
    $total_due = ($bed_rate + $penalty_amount) - $discount_amount;

    // Update invoice in the database
    $update_sql = "UPDATE tblinvoice SET penalty_amount = ?, discount_amount = ?, total_due = ?, remarks = ? WHERE invoice_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("iiisi", $penalty_amount, $discount_amount, $total_due, $remarks, $invoice_id);

    if ($update_stmt->execute()) {
        // Record activity log
        $log_details = "Updated invoice ID $invoice_id";
        $user_id = $_SESSION['user_id'] ?? 0; // Ensure user_id is set
        $activity_sql = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'update', ?, NOW())";
        $activity_stmt = $conn->prepare($activity_sql);
        $activity_stmt->bind_param("is", $user_id, $log_details);
        $activity_stmt->execute();

        // Set success message
        $_SESSION['success'] = 'Invoice updated successfully';
    } else {
        // Set error message for database update failure
        $_SESSION['error'] = 'Error updating invoice';
    }

    // Redirect back to the invoice list page
    header("Location: ../invoice_list.php");
    exit(); // Ensure script execution stops after redirect
} else {
    // Redirect back if form was not submitted
    header("Location: ../invoice_list.php");
    exit(); // Ensure script execution stops after redirect
}
?>
