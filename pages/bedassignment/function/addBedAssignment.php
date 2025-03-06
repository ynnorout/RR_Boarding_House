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
    // Validate and sanitize input parameters
    $tenant_id = sanitize_input($_POST['tenant_id']);
    $room_id = sanitize_input($_POST['room_id']);
    $bed_id = sanitize_input($_POST['bed_id']);
    $due_date = sanitize_input($_POST['due_date']);
    $months_to_stay = sanitize_input($_POST['months_to_stay']);

    // Get monthly rent for the selected bed
    $sql_get_monthly_rent = "SELECT monthly_rent FROM tblbed WHERE bed_id = ?";
    $stmt_get_monthly_rent = $conn->prepare($sql_get_monthly_rent);
    if (!$stmt_get_monthly_rent) {
        die("Error in SQL query: " . $conn->error);
    }
    $stmt_get_monthly_rent->bind_param("i", $bed_id);
    $stmt_get_monthly_rent->execute();
    $result_get_monthly_rent = $stmt_get_monthly_rent->get_result();
    if (!$result_get_monthly_rent) {
        die("Error in fetching monthly rent: " . $conn->error);
    }
    $monthly_rent_row = $result_get_monthly_rent->fetch_assoc();
    $monthly_rent = $monthly_rent_row['monthly_rent'];
    $stmt_get_monthly_rent->close();

    // Calculate due_date_iterate based on current month and due date
    $current_month = date('F', strtotime('+1 month'));
    $current_year = date('Y');
    $due_date_iterate = date('F j, Y', strtotime("$current_month $due_date, $current_year"));

    // Update the selected bed to occupied
    $sql_update_bed_status = "UPDATE tblbed SET status = 'occupied' WHERE bed_id = ?";
    $stmt_update_bed_status = $conn->prepare($sql_update_bed_status);
    if (!$stmt_update_bed_status) {
        die("Error in SQL query: " . $conn->error);
    }
    $stmt_update_bed_status->bind_param("i", $bed_id);
    if (!$stmt_update_bed_status->execute()) {
        die("Error updating bed status: " . $stmt_update_bed_status->error);
    }
    $stmt_update_bed_status->close();

    // Prepare and bind parameters for inserting assignment
    $sql_insert_assignment = "INSERT INTO tblbedassignment (tenant_id, room_id, bed_id, due_date, months_to_stay) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert_assignment = $conn->prepare($sql_insert_assignment);
    if (!$stmt_insert_assignment) {
        die("Error in SQL query: " . $conn->error);
    }
    $stmt_insert_assignment->bind_param("iiisi", $tenant_id, $room_id, $bed_id, $due_date, $months_to_stay);

    // Prepare and bind parameters for inserting activity log
    $sql_insert_activitylog = "INSERT INTO tblactivitylog (user_id, log_type, details, date_time) VALUES (?, 'add', ?, NOW())";
    $stmt_insert_activitylog = $conn->prepare($sql_insert_activitylog);
    if (!$stmt_insert_activitylog) {
        die("Error in SQL query: " . $conn->error);
    }
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
    $details = "Added new bed assignment for tenant in bed $bed_id";
    $stmt_insert_activitylog->bind_param("is", $user_id, $details);

    // Prepare and bind parameters for inserting invoice records
    $sql_insert_invoice = "INSERT INTO tblinvoice (tenant_id, assignment_id, invoice_number, due_date_iterate, bed_rate, penalty_amount, discount_amount, total_due, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'unpaid')";
    $stmt_insert_invoice = $conn->prepare($sql_insert_invoice);
    if (!$stmt_insert_invoice) {
        die("Error in SQL query: " . $conn->error);
    }

    // Execute the statement to insert assignment
    if ($stmt_insert_assignment->execute()) {
        $last_assignment_id = $stmt_insert_assignment->insert_id;

        // Insert record into tblactivitylog
        if ($stmt_insert_activitylog->execute()) {
            // Insert records into tblinvoice
            for ($i = 1; $i <= $months_to_stay; $i++) {
                $next_month = date('F', strtotime("+$i month"));
                $invoice_number = "$current_year-$tenant_id-$bed_id-$next_month";
                $total_due = $monthly_rent; // Initial total due without penalty or discount
                $penalty_amount = 0; // Default penalty amount
                $discount_amount = 0; // Default discount amount
                $stmt_insert_invoice->bind_param("iissdddd", $tenant_id, $last_assignment_id, $invoice_number, $due_date_iterate, $monthly_rent, $penalty_amount, $discount_amount, $total_due);
                $stmt_insert_invoice->execute();
                $due_date_iterate = date('F j, Y', strtotime("$due_date_iterate +1 month"));
            }
            $_SESSION['success'] = 'Bed assignment and invoices added successfully';
        } else {
            $_SESSION['error'] = 'Failed to log activity';
        }
    } else {
        $_SESSION['error'] = 'Something went wrong while adding bed assignment';
    }

    // Close statements
    $stmt_insert_assignment->close();
    $stmt_insert_activitylog->close();
    $stmt_insert_invoice->close();
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

// Redirect to the appropriate page
header('location: ../bedassignment_list.php');
?>
