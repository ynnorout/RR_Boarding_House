<?php
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "inet_boarding_house_db"; /* Database name */

// Create connection
$con = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['complete_name'])) {
    $complete_name = mysqli_real_escape_string($con, $_POST['complete_name']);

    // Prepare SQL statement to check for duplicate tenant
    $query = "SELECT complete_name FROM tbltenant WHERE complete_name = ?";

    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $complete_name);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Store the result
        mysqli_stmt_store_result($stmt);

        // Check the number of rows returned
        $rows = mysqli_stmt_num_rows($stmt);

        // Send appropriate response based on the result
        if ($rows > 0) {
            // Duplicate tenant found, send response 'exists'
            echo 'exists';
        } else {
            // No duplicate found, send response 'not_exists'
            echo 'not_exists';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing the SQL statement
        echo "Error: " . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
}
?>
