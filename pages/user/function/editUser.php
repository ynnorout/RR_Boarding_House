<?php
    session_start();
    include_once('../../includes/dbcon.php');

    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password']; // Ensure you hash the password for security
        $user_type = $_POST['user_type'];
        $complete_name = $_POST['complete_name'];
        
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind parameters
        $stmt = $conn->prepare("UPDATE tblUser SET username = ?, password = ?, user_type = ?, complete_name = ? WHERE user_id = ?");
        $stmt->bind_param("ssssi", $username, $hashed_password, $user_type, $complete_name, $id);
        
        // Execute the query
        if($stmt->execute()){
            $_SESSION['success'] = 'User updated successfully';
        } else {
            $_SESSION['error'] = 'Something went wrong in updating the user';
        }
        
        // Close statement
        $stmt->close();
    }
    else{
        $_SESSION['error'] = 'Select user to edit first';
    }

    header('location: ../users_list.php');
?>
