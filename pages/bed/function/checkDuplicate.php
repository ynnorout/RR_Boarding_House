<?php

// Include the database connection
include_once('../../includes/dbcon.php');

if (isset($_POST['bed_number'])) {
    $bed_number = mysqli_real_escape_string($conn, $_POST['bed_number']);

    // Prepare SQL statement to check for duplicate bed number
    $query = "SELECT bed_id FROM tblbed WHERE bed_number = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $bed_number);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Store the result
        mysqli_stmt_store_result($stmt);

        // Get the number of rows returned
        $num_rows = mysqli_stmt_num_rows($stmt);
        
        if ($num_rows > 0) {
            // Duplicate bed number found, display error message
            echo "<span style='color: red;'>Bed number already exists. Please enter a different bed number.</span>";
            echo "<script>document.getElementById('add_button').disabled = true;</script>";
        } else {
            // No duplicate found, display success message
            echo "<span style='color: green;'>Bed number available.</span>";
            echo "<script>document.getElementById('add_button').disabled = false;</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing the SQL statement
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>
