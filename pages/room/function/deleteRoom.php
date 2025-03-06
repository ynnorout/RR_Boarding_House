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

if (isset($_GET['id'])) {
    // Validate and sanitize input parameter
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $id = sanitize_input($_GET['id']);

        // Retrieve the name of the room being deleted
        $stmt_select_room = $conn->prepare("SELECT room_name FROM tblroom WHERE room_id = ?");
        $stmt_select_room->bind_param("i", $id);
        $stmt_select_room->execute();
        $result = $stmt_select_room->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $room_name = $row['room_name'];

            // SQL injection prevention
            $sql_delete_room = "DELETE FROM tblroom WHERE room_id = ?";
            $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'delete', ?, NOW())";

            // Prepare and bind parameters for deleting room
            $stmt_delete_room = $conn->prepare($sql_delete_room);
            $stmt_delete_room->bind_param("i", $id);

            // Prepare and bind parameters for inserting activity log
            $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
            $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
            $details = "Deleted room: $room_name";
            $stmt_insert_activitylog->bind_param("is", $user_id, $details);

            // Execute the query to delete room
            if ($stmt_delete_room->execute()) {
                // Insert record into tblactivitylog
                if ($stmt_insert_activitylog->execute()) {
                    $_SESSION['success'] = 'Room deleted successfully';
                } else {
                    $_SESSION['error'] = 'Failed to log activity';
                }
            } else {
                $_SESSION['error'] = 'Something went wrong in deleting the room';
            }

            // Close statements
            $stmt_delete_room->close();
            $stmt_insert_activitylog->close();
        } else {
            $_SESSION['error'] = 'Room not found';
        }
        $stmt_select_room->close();
    } else {
        $_SESSION['error'] = 'Invalid room ID';
    }
} else {
    $_SESSION['error'] = 'Invalid request';
}

header('location: ../room_list.php');
?>
