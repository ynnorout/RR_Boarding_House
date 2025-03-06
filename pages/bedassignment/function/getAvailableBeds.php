<?php
// Include the database connection file
include_once('../../includes/dbcon.php');

// Check if room_id is set and not empty
if(isset($_POST['room_id']) && !empty($_POST['room_id'])) {
    // Sanitize the input
    $room_id = intval($_POST['room_id']);

    // Query to fetch available beds based on the selected room
    $sql = "SELECT * FROM tblbed WHERE room_id = ? AND status = 'available'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are available beds
    if ($result->num_rows > 0) {
        // Start building the HTML options
        $options = "<option value=''>Select Bed</option>";
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row['bed_id'] . "'>" . $row['bed_number'] . "</option>";
        }
        echo $options; // Output the HTML options
    } else {
        echo "<option value=''>No Available Beds</option>"; // Display a message if no beds are available
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "<option value=''>Invalid Room ID</option>"; // Display an error message if room_id is invalid or not set
}
?>
