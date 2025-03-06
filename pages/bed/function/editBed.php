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
    if (!empty($_POST['bed_id']) && !empty($_POST['bed_number']) && !empty($_POST['monthly_rent']) && !empty($_POST['status']) && !empty($_POST['room_id'])) {
        $bed_id = sanitize_input($_POST['bed_id']);
        $new_bed_number = sanitize_input($_POST['bed_number']);
        $new_monthly_rent = sanitize_input($_POST['monthly_rent']);
        $new_status = sanitize_input($_POST['status']);
        $new_room_id = sanitize_input($_POST['room_id']);

        // Get the existing bed information from the database
        $stmt_select_old_bed = $conn->prepare("SELECT bed_number, monthly_rent, status, room_id FROM tblbed WHERE bed_id = ?");
        $stmt_select_old_bed->bind_param("i", $bed_id);
        $stmt_select_old_bed->execute();
        $stmt_select_old_bed->bind_result($old_bed_number, $old_monthly_rent, $old_status, $old_room_id);
        $stmt_select_old_bed->fetch();
        $stmt_select_old_bed->close();

        // Check if the new bed information is different from the existing one
        if ($new_bed_number != $old_bed_number || $new_monthly_rent != $old_monthly_rent || $new_status != $old_status || $new_room_id != $old_room_id) {
            // SQL injection prevention
            $sql_update_bed = "UPDATE tblbed SET bed_number = ?, monthly_rent = ?, status = ?, room_id = ? WHERE bed_id = ?";
            $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'update', ?, NOW())";

            // Prepare and bind parameters for updating bed information
            $stmt_update_bed = $conn->prepare($sql_update_bed);
            $stmt_update_bed->bind_param("ssssi", $new_bed_number, $new_monthly_rent, $new_status, $new_room_id, $bed_id);

            // Prepare and bind parameters for inserting activity log
            $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
            $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
            $log_details = "Updated bed information: Bed number: $old_bed_number to $new_bed_number, Monthly rent: $old_monthly_rent to $new_monthly_rent, Status: $old_status to $new_status, Room ID: $old_room_id to $new_room_id";
            $stmt_insert_activitylog->bind_param("is", $user_id, $log_details);

            // Execute the query to update bed information
            if ($stmt_update_bed->execute()) {
                // Insert record into tblactivitylog
                if ($stmt_insert_activitylog->execute()) {
                    $_SESSION['success'] = 'Bed information updated successfully';
                } else {
                    $_SESSION['error'] = 'Failed to log activity';
                }
            } else {
                $_SESSION['error'] = 'Something went wrong in updating the bed information';
            }

            // Close statements
            $stmt_update_bed->close();
            $stmt_insert_activitylog->close();
        } else {
            $_SESSION['error'] = 'No changes made to the bed information';
        }
    } else {
        $_SESSION['error'] = 'Incomplete data provided for updating bed information';
    }
} else {
    $_SESSION['error'] = 'Invalid request';
}

header('location: ../bed_list.php');
?>
