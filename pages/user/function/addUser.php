<?php
    session_start();
    include_once('../../includes/dbcon.php');

    if(isset($_POST['add'])){
        $username = $_POST['username'];
        $password = $_POST['password']; // Ensure you hash the password for security
        $user_type = $_POST['user_type'];
        $complete_name = $_POST['complete_name'];
        
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tblUser (username, password, user_type, complete_name) VALUES (?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $hashed_password, $user_type, $complete_name);

        // Execute the statement
        if($stmt->execute()){
            $_SESSION['success'] = 'User added successfully';
        }
        else{
            $_SESSION['error'] = 'Something went wrong while adding the user';
        }

        // Close statement
        $stmt->close();
    }
    else{
        $_SESSION['error'] = 'Fill up add form first';
    }

    // Redirect to the appropriate page
    header('location: ../users_list.php');
?>
