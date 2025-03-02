<?php
include('connect.php');

// Start the session
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required!";
        exit();
    }

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>
                alert('Email already exists. Please use another email.');
                window.location.href = '../html/register.html';
              </script>";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement to insert the user data into the database
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>
                alert('Registration successful! Please login.');
                window.location.href = '../html/login.html';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Registration failed! Please try again.');
                window.location.href = '../html/register.html';
              </script>";
    }
}
?>
