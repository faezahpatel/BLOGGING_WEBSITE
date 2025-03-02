<?php
// Include database connection
include('connect.php');

// Start session
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    // Retrieve form data
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = $_POST['category']; 
    $author_id = $_SESSION['user_id']; 

    // Initialize image variable
    $image = null;

    // Check if an image was uploaded
    if (!empty($_FILES['image']['name'])) {
        // Check for file upload errors
        if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
            echo "File upload error: " . $_FILES['image']['error'];
            exit();
        }

        // Set the target directory for uploads
        $target_dir = 'uploads/';

        // Check if the uploads folder exists, if not create it
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Create folder with proper permissions
        }

        // Set the image file name and path
        $image_name = basename($_FILES['image']['name']);
        $image_path = $target_dir . $image_name;

        // Check if the file already exists
        if (file_exists($image_path)) {
            echo "File already exists.";
            exit();
        }

        // Try moving the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            // File uploaded successfully, store the image path
            $image = $image_path;
        } else {
            echo "Error uploading image.";
            exit();
        }
    }

    // Insert blog data into the database (including image path and category)
    $sql = "INSERT INTO blogs(title, content, image, category, author_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    // Bind parameters to prevent SQL injection
    if ($stmt->execute([$title, $content, $image, $category, $author_id])) {
        $_SESSION['success_message'] = "Blog post created successfully!";
       
        header("Location: ../php/profile.php?created=true");
        exit();
    } else {
        echo "Failed to create blog post.";
    }
} else {
    echo "Invalid request.";
}
?>
