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
    // Validate and sanitize input data
    $complete_name = sanitize_input($_POST['complete_name']);
    $address = sanitize_input($_POST['address']);
    $email_address = sanitize_input($_POST['email_address']);
    $contact = sanitize_input($_POST['contact']);
    $gender = sanitize_input($_POST['gender']);
    $status = sanitize_input($_POST['status']);
    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    // Upload profile picture
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
    $profile_picture_extension = pathinfo($profile_picture, PATHINFO_EXTENSION);
    $profile_picture_new_name = $complete_name . '.' . $profile_picture_extension;
    $profile_picture_path = "../profile_upload/" . $profile_picture_new_name;
    move_uploaded_file($profile_picture_tmp, $profile_picture_path);

    // Upload proof of identity
    $proof_of_identity = $_FILES['proof_of_identity']['name'];
    $proof_of_identity_tmp = $_FILES['proof_of_identity']['tmp_name'];
    $proof_of_identity_extension = pathinfo($proof_of_identity, PATHINFO_EXTENSION);
    $proof_of_identity_new_name = $complete_name . '.' . $proof_of_identity_extension;
    $proof_of_identity_path = "../identity_upload/" . $proof_of_identity_new_name;
    move_uploaded_file($proof_of_identity_tmp, $proof_of_identity_path);

    // SQL injection prevention
    $sql_insert_tenant = "INSERT INTO tbltenant (complete_name, address, email_address, contact, gender, status, username, password, profile_picture, proof_of_identity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'add', ?, NOW())";

    // Prepare and bind parameters for inserting tenant
    $stmt_insert_tenant = $conn->prepare($sql_insert_tenant);
    $stmt_insert_tenant->bind_param("ssssssssss", $complete_name, $address, $email_address, $contact, $gender, $status, $username, $hashed_password, $profile_picture_new_name, $proof_of_identity_new_name);

    // Prepare and bind parameters for inserting activity log
    $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
    $details = "Add new tenant: $complete_name";
    $stmt_insert_activitylog->bind_param("is", $user_id, $details);

    // Execute the statement to insert tenant
    if ($stmt_insert_tenant->execute()) {
        // Insert record into tblactivitylog
        if ($stmt_insert_activitylog->execute()) {
            $_SESSION['success'] = 'Tenant added successfully';
        } else {
            $_SESSION['error'] = 'Failed to log activity';
        }
    } else {
        $_SESSION['error'] = 'Something went wrong while adding tenant';
    }

    // Close statements
    $stmt_insert_tenant->close();
    $stmt_insert_activitylog->close();
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

// Redirect to the appropriate page
header('location: ../tenant_list.php');
?>
