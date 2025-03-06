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

if (isset($_POST['upload_proof_picture'])) {
    // Validate and sanitize input parameters
    if (!empty($_POST['tenant_id']) && !empty($_FILES['proof_picture'])) {
        $tenant_id = sanitize_input($_POST['tenant_id']);
        $proof_picture = $_FILES['proof_picture'];

        // Retrieve tenant's complete name from the database
        $sql_select_name = "SELECT complete_name FROM tbltenant WHERE tenant_id = ?";
        $stmt_select_name = $conn->prepare($sql_select_name);
        $stmt_select_name->bind_param("i", $tenant_id);
        $stmt_select_name->execute();
        $stmt_select_name->bind_result($tenant_name);
        $stmt_select_name->fetch();
        $stmt_select_name->close();

        // Construct filename based on tenant's complete name
        $extension = strtolower(pathinfo($proof_picture['name'], PATHINFO_EXTENSION));
        $file_name = $tenant_name . "." . $extension;
        $target_dir = "../identity_upload/";
        $target_file = $target_dir . $file_name;

        // Check file size
        if ($proof_picture["size"] > 500000) {
            $_SESSION['error'] = "Sorry, your file is too large.";
        } else {
            // Check if file already exists
            if (file_exists($target_file)) {
                unlink($target_file); // Delete existing file
            }
            
            // Upload file
            if (move_uploaded_file($proof_picture["tmp_name"], $target_file)) {
                // Update proof picture path in the database
                $sql_update_picture = "UPDATE tbltenant SET proof_of_identity = ? WHERE tenant_id = ?";
                $stmt_update_picture = $conn->prepare($sql_update_picture);
                $stmt_update_picture->bind_param("si", $file_name, $tenant_id);

                if ($stmt_update_picture->execute()) {
                    $_SESSION['success'] = "The file ". htmlspecialchars(basename($proof_picture["name"])) . " has been uploaded.";
                } else {
                    $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                }
                $stmt_update_picture->close();
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

// Redirect to the tenant list page
header('location: ../tenant_list.php');
?>
