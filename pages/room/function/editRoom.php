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
    if (!empty($_POST['id']) && !empty($_POST['room_name']) && !empty($_POST['description'])) {
        $id = sanitize_input($_POST['id']);
        $new_room_name = sanitize_input($_POST['room_name']);
        $new_description = sanitize_input($_POST['description']);

        // Get the existing room name from the database
        $stmt_select_old_room = $conn->prepare("SELECT room_name FROM tblroom WHERE room_id = ?");
        $stmt_select_old_room->bind_param("i", $id);
        $stmt_select_old_room->execute();
        $stmt_select_old_room->bind_result($old_room_name);
        $stmt_select_old_room->fetch();
        $stmt_select_old_room->close();

        // Check if the new room name or description is different from the existing one
        if ($new_room_name != $old_room_name) {
            // SQL injection prevention
            $sql_update_room = "UPDATE tblroom SET room_name = ?, room_description = ? WHERE room_id = ?";
            $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'update', ?, NOW())";

            // Prepare and bind parameters for updating room
            $stmt_update_room = $conn->prepare($sql_update_room);
            $stmt_update_room->bind_param("ssi", $new_room_name, $new_description, $id);

            // Prepare and bind parameters for inserting activity log
            $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
            $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
            $log_details = "Updated room: $old_room_name to $new_room_name";
            $stmt_insert_activitylog->bind_param("is", $user_id, $log_details);

            // Execute the query to update room
            if ($stmt_update_room->execute()) {
                // Insert record into tblactivitylog
                if ($stmt_insert_activitylog->execute()) {
                    $_SESSION['success'] = 'Room updated successfully';
                } else {
                    $_SESSION['error'] = 'Failed to log activity';
                }
            } else {
                $_SESSION['error'] = 'Something went wrong in updating the room';
            }

            // Close statements
            $stmt_update_room->close();
            $stmt_insert_activitylog->close();
        } else {
            $_SESSION['error'] = 'No changes made to the room';
        }
    } else {
        $_SESSION['error'] = 'Select room to edit first';
    }
} else {
    $_SESSION['error'] = 'Invalid request';
}

header('location: ../room_list.php');
?>
