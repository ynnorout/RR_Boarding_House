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

if (isset($_POST['add'])) {
    // Validate and sanitize room inputs
    if (!empty($_POST['room_name']) && !empty($_POST['description']) && !empty($_FILES['image']['name'])) {
        $roomName = sanitize_input($_POST['room_name']);
        $description = sanitize_input($_POST['description']);
        
        // Upload image
        $targetDirectory = "../room_upload/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $imageName = $roomName . '.' . $imageFileType;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                $_SESSION['error'] = "Sorry, your file is too large.";
            } else {
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                    $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } else {
                    // if everything is ok, try to upload file
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetDirectory . $imageName)) {
                        // SQL injection prevention
                        $sql_insert_room = "INSERT INTO tblroom (room_name, room_description, room_image) VALUES (?, ?, ?)";
                        $stmt_insert_room = $conn->prepare($sql_insert_room);
                        $stmt_insert_room->bind_param("sss", $roomName, $description, $imageName);
                        
                        // Execute the statement to insert room
                        if ($stmt_insert_room->execute()) {
                            // Log activity
                            $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
                            $details = "Added new room: $roomName";
                            $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'add', ?, NOW())";
                            $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
                            $stmt_insert_activitylog->bind_param("is", $user_id, $details);
                            if ($stmt_insert_activitylog->execute()) {
                                $_SESSION['success'] = 'Room added successfully';
                            } else {
                                $_SESSION['error'] = 'Failed to log activity';
                            }
                            // Close statement
                            $stmt_insert_activitylog->close();
                        } else {
                            $_SESSION['error'] = 'Something went wrong while adding the room';
                        }
                        
                        // Close statement
                        $stmt_insert_room->close();
                    } else {
                        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                    }
                }
            }
        } else {
            $_SESSION['error'] = "File is not an image.";
        }
    } else {
        $_SESSION['error'] = 'Please fill up all fields';
    }
} else {
    $_SESSION['error'] = 'Invalid request';
}

// Redirect to the appropriate page
header('location: ../room_list.php');
?>
