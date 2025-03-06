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

if (isset($_POST['upload_room_image'])) {
    // Validate and sanitize input parameters
    if (!empty($_POST['room_id']) && !empty($_FILES['room_image'])) {
        $room_id = sanitize_input($_POST['room_id']);
        $room_image = $_FILES['room_image'];

        // Retrieve room name from the database
        $sql_select_name = "SELECT room_name FROM tblroom WHERE room_id = ?";
        $stmt_select_name = $conn->prepare($sql_select_name);
        $stmt_select_name->bind_param("i", $room_id);
        $stmt_select_name->execute();
        $stmt_select_name->bind_result($room_name);
        $stmt_select_name->fetch();
        $stmt_select_name->close();

        // Construct filename based on room name
        $extension = strtolower(pathinfo($room_image['name'], PATHINFO_EXTENSION));
        $file_name = $room_name . "." . $extension;
        $target_dir = "../room_upload/";
        $target_file = $target_dir . $file_name;

        // Check file size
        if ($room_image["size"] > 500000) {
            $_SESSION['error'] = "Sorry, your file is too large.";
        } else {
            // Check if file already exists
            if (file_exists($target_file)) {
                unlink($target_file); // Delete existing file
            }
            
            // Upload file
            if (move_uploaded_file($room_image["tmp_name"], $target_file)) {
                // Update room image path in the database
                $sql_update_image = "UPDATE tblroom SET room_image = ? WHERE room_id = ?";
                $stmt_update_image = $conn->prepare($sql_update_image);
                $stmt_update_image->bind_param("si", $file_name, $room_id);

                if ($stmt_update_image->execute()) {
                    $_SESSION['success'] = "The file ". htmlspecialchars(basename($room_image["name"])) . " has been uploaded.";
                } else {
                    $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                }
                $stmt_update_image->close();
            } else {
                $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $_SESSION['error'] = 'Please select a file to upload';
    }
} else {
    $_SESSION['error'] = 'Invalid request';
}

// Redirect to the room list page
header('location: ../room_list.php');
?>