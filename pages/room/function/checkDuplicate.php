<?php
include_once('../../includes/dbcon.php');

if (isset($_POST['roomName'])) {
    $roomName = mysqli_real_escape_string($conn, $_POST['roomName']);

    // Prepare SQL statement to check for duplicate room names
    $query = "SELECT room_name FROM tblroom WHERE room_name = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $roomName);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result
        mysqli_stmt_bind_result($stmt, $result);

        // Fetch the result
        mysqli_stmt_fetch($stmt);

        if ($result) {
            // Duplicate room name found, display error message
            echo "<span style='color: red;'>Room name already exists. Please enter a different room name.</span>";
            echo "<script>$('#response').html(\"<span style='color: red;'>Room name already exists. Please enter a different room name.</span>\"); $('#add_button').prop('disabled', true);</script>";
        } else {
            // No duplicate found, display success message
            echo "<span style='color: green;'>Room name available.</span>";
            echo "<script>$('#response').html(\"<span style='color: green;'>Room name available.</span>\"); $('#add_button').prop('disabled', false);</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing the SQL statement
        echo "Error: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
