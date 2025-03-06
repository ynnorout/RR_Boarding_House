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

if (isset($_POST['edit'])) {
    // Validate and sanitize input parameters
    if (!empty($_POST['id']) && !empty($_POST['complete_name']) && !empty($_POST['address']) && !empty($_POST['email_address']) && !empty($_POST['contact']) && isset($_POST['gender']) && isset($_POST['status'])) {
        $id = sanitize_input($_POST['id']);
        $new_complete_name = sanitize_input($_POST['complete_name']);
        $new_address = sanitize_input($_POST['address']);
        $new_email_address = sanitize_input($_POST['email_address']);
        $new_contact = sanitize_input($_POST['contact']);
        $new_gender = sanitize_input($_POST['gender']);
        $new_status = sanitize_input($_POST['status']);

        // Get the existing data from the database
        $stmt_select_old_data = $conn->prepare("SELECT complete_name, address, email_address, contact, gender, status FROM tbltenant WHERE tenant_id = ?");
        $stmt_select_old_data->bind_param("i", $id);
        $stmt_select_old_data->execute();
        $stmt_select_old_data->bind_result($old_complete_name, $old_address, $old_email_address, $old_contact, $old_gender, $old_status);
        $stmt_select_old_data->fetch();
        $stmt_select_old_data->close();

        // Check if any data has been changed
        if ($new_complete_name != $old_complete_name || $new_address != $old_address || $new_email_address != $old_email_address || $new_contact != $old_contact || $new_gender != $old_gender || $new_status != $old_status) {
            // SQL injection prevention
            $sql_update_tenant = "UPDATE tbltenant SET complete_name = ?, address = ?, email_address = ?, contact = ?, gender = ?, status = ? WHERE tenant_id = ?";
            $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'update', ?, NOW())";

            // Prepare and bind parameters for updating tenant
            $stmt_update_tenant = $conn->prepare($sql_update_tenant);
            $stmt_update_tenant->bind_param("ssssssi", $new_complete_name, $new_address, $new_email_address, $new_contact, $new_gender, $new_status, $id);

            // Prepare and bind parameters for inserting activity log
            $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
            $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
            $log_details = "Updated tenant: Name - $old_complete_name to $new_complete_name, Address - $old_address to $new_address, Email - $old_email_address to $new_email_address, Contact - $old_contact to $new_contact, Gender - $old_gender to $new_gender, Status - $old_status to $new_status";
            $stmt_insert_activitylog->bind_param("is", $user_id, $log_details);

            // Execute the query to update tenant
            if ($stmt_update_tenant->execute()) {
                // Insert record into tblactivitylog
                if ($stmt_insert_activitylog->execute()) {
                    $_SESSION['success'] = 'Tenant updated successfully';
                } else {
                    $_SESSION['error'] = 'Failed to log activity';
                }
            } else {
                $_SESSION['error'] = 'Something went wrong in updating the tenant';
            }

            // Close statements
            $stmt_update_tenant->close();
            $stmt_insert_activitylog->close();
        } else {
            $_SESSION['error'] = 'No changes made to the tenant';
        }
    } else {
        $_SESSION['error'] = 'Please fill in all the fields';
    }
} else {
    $_SESSION['error'] = 'Invalid request';
}

header('location: ../tenant_list.php');
?>
