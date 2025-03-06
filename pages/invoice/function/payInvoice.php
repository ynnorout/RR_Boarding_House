<?php
session_start();
include_once('../../includes/dbcon.php');

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['pay'])) {
    // Validate and sanitize payment data
    $invoice_id = sanitize_input($_POST['invoice_id']);
    $invoice_number = sanitize_input($_POST['invoice_number']);
    $tenant_name = sanitize_input($_POST['complete_name']);
    $payment_amount = sanitize_input($_POST['payment']);

    // Insert payment record into tblpayment
    $sql_insert_payment = "INSERT INTO tblpayment (invoice_number, tenant_name, amount_paid, payment_date) VALUES (?, ?, ?, NOW())";
    $stmt_insert_payment = $conn->prepare($sql_insert_payment);
    $stmt_insert_payment->bind_param("ssd", $invoice_number, $tenant_name, $payment_amount);

    if ($stmt_insert_payment->execute()) {
        // Update invoice status to "Paid" in tblinvoice
        $sql_update_invoice_status = "UPDATE tblinvoice SET status = 'Paid' WHERE invoice_id = ?";
        $stmt_update_invoice_status = $conn->prepare($sql_update_invoice_status);
        $stmt_update_invoice_status->bind_param("i", $invoice_id);

        if ($stmt_update_invoice_status->execute()) {
            $_SESSION['success'] = 'Invoice paid successfully';

            // Record activity log
            $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
            $activity_details = "Payment made for Invoice #" . $invoice_number . " by " . $tenant_name . " amounting to PHP:" . $payment_amount;
            $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'payment', ?, NOW())";
            $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
            $stmt_insert_activitylog->bind_param("is", $user_id, $activity_details);
            $stmt_insert_activitylog->execute();
            $stmt_insert_activitylog->close();
        } else {
            $_SESSION['error'] = 'Failed to update invoice status';
        }
    } else {
        $_SESSION['error'] = 'Failed to process payment';
    }

    // Close statements
    $stmt_insert_payment->close();
    $stmt_update_invoice_status->close();

} else {
    $_SESSION['error'] = 'Payment data not submitted';
}

// Redirect to the appropriate page
header('location: ../invoice_list.php');
?>
