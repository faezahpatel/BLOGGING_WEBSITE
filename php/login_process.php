<?php

include('connect.php');

//session
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // validation for input 
    if (empty($email) || empty($password)) {
        header("Location: ../html/login.html?error=Both fields are required!");
        exit();
    }

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql); 

    // Bind parameters (email in this case)
    $stmt->bind_param("s", $email);  

    //query
    if ($stmt->execute()) {
        $result = $stmt->get_result(); // Get the result

        if ($result->num_rows > 0) {
            //  if User found, check password
            $row = $result->fetch_assoc(); 

            // Check if the entered password matches the hashed password stored in the database
            if (password_verify($password, $row['password'])) {
                // Password is correct, start session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];  

                
                header("Location: ../index.php");
                exit();
            } else {
                header("Location: ../html/login.html?error=Incorrect password!");
                exit();
            }
        } else {
            header("Location: ../html/login.html?error=No account found with that email!");
            exit();
        }
    } else {
        header("Location: ../html/login.html?error=Query failed!");
        exit();
    }
}
?>
