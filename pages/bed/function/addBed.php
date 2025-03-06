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
    // Validate and sanitize bed number input
    if (!empty($_POST['bed_number'])) {
        $bed_number = sanitize_input($_POST['bed_number']);
        
        // Validate and sanitize monthly rent input
        if (!empty($_POST['monthly_rent']) && is_numeric($_POST['monthly_rent'])) {
            $monthly_rent = sanitize_input($_POST['monthly_rent']);
            
            // Validate status input
            if (!empty($_POST['status'])) {
                $status = sanitize_input($_POST['status']);
                
                // Insert into tblbed
                $sql_insert_bed = "INSERT INTO tblbed (room_id, bed_number, monthly_rent, status) VALUES (?, ?, ?, ?)";
                
                // Prepare and bind parameters for inserting bed
                $stmt_insert_bed = $conn->prepare($sql_insert_bed);
                $stmt_insert_bed->bind_param("isds", $_POST['room_id'], $bed_number, $monthly_rent, $status);
                
                // Execute the statement to insert bed
                if ($stmt_insert_bed->execute()) {
                    // Log the activity
                    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
                    $details = "Added new bed: Bed Number=$bed_number";
                    $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'add', ?, NOW())";
                    $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
                    $stmt_insert_activitylog->bind_param("is", $user_id, $details);
                    $stmt_insert_activitylog->execute();
                    $stmt_insert_activitylog->close();
                    
                    $_SESSION['success'] = 'Bed added successfully';
                } else {
                    $_SESSION['error'] = 'Failed to add bed';
                }
                
                // Close statement
                $stmt_insert_bed->close();
            } else {
                $_SESSION['error'] = 'Status field is required';
            }
        } else {
            $_SESSION['error'] = 'Monthly rent must be a numeric value';
        }
    } else {
        $_SESSION['error'] = 'Bed number field is required';
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

// Redirect to the appropriate page
header('location: ../bed_list.php');
?>
