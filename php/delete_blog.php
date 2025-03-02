<?php
session_start();
include('connect.php'); 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}

// Check if the blog ID is passed via the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE query to remove the blog post
    $sql = "DELETE FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Bind the blog ID

    // Execute the query
    if ($stmt->execute()) {
       
        header('Location: profile.php'); 
        exit();
    } else {
        echo "Error deleting the blog post.";
    }
} else {
    echo "Invalid blog ID.";
}
?>
