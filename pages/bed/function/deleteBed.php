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

if (isset($_GET['bed_id'])) {
    // Validate and sanitize input parameter
    if (!empty($_GET['bed_id']) && is_numeric($_GET['bed_id'])) {
        $bed_id = sanitize_input($_GET['bed_id']);

        // Retrieve the bed number being deleted
        $stmt_select_bed = $conn->prepare("SELECT bed_number FROM tblbed WHERE bed_id = ?");
        $stmt_select_bed->bind_param("i", $bed_id);
        $stmt_select_bed->execute();
        $stmt_select_bed->store_result();
        if ($stmt_select_bed->num_rows > 0) {
            $stmt_select_bed->bind_result($bed_number);
            $stmt_select_bed->fetch();

            // SQL injection prevention
            $sql_delete_bed = "DELETE FROM tblbed WHERE bed_id = ?";
            $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'delete', ?, NOW())";

            // Prepare and bind parameters for deleting bed
            $stmt_delete_bed = $conn->prepare($sql_delete_bed);
            $stmt_delete_bed->bind_param("i", $bed_id);

            // Prepare and bind parameters for inserting activity log
            $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
            $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
            $details = "Deleted bed: $bed_number";
            $stmt_insert_activitylog->bind_param("is", $user_id, $details);

            // Execute the query to delete bed
            if ($stmt_delete_bed->execute()) {
                // Insert record into tblactivitylog
                if ($stmt_insert_activitylog->execute()) {
                    $_SESSION['success'] = 'Bed deleted successfully';
                } else {
                    $_SESSION['error'] = 'Failed to log activity';
                }
            } else {
                $_SESSION['error'] = 'Something went wrong in deleting the bed';
            }

            // Close statements
            $stmt_delete_bed->close();
            $stmt_insert_activitylog->close();
        } else {
            $_SESSION['error'] = 'Bed not found';
        }
        $stmt_select_bed->close();
    } else {
        $_SESSION['error'] = 'Invalid bed ID';
    }
} else {
    $_SESSION['error'] = 'Invalid request';
}

header('location: ../bed_list.php');
?>
