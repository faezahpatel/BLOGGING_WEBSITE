<?php
session_start();
include('connect.php'); 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    // Query to get blog details
    $sql = "SELECT * FROM blogs WHERE id = ?";  
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);  
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    
    if (!$blog) {
        echo "Blog not found.";
        exit();
    }
} else {
    echo "Invalid blog ID.";
    exit();
}

?>

<link rel="stylesheet" href="../assets/css/view.css">
<!-- Header Section -->
<header class="page-header">
    <div class="container">
        <h1>Check Out Your Posts</h1>
    </div>
</header>

<!-- Main Content -->
<main class="dashboard-main">
    <div class="blog-content">
        <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>

        <!-- <?php if (!empty($blog['image'])) { ?>
            <div class="blog-image">
                <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="Blog Image">
            </div>
        <?php } ?> -->

        <p><strong>Category:</strong> <?php echo htmlspecialchars($blog['category']); ?></p> <!-- Display the category here -->

        <p><strong>Posted on:</strong> <?php echo date("F j, Y, g:i a", strtotime($blog['created_at'])); ?></p>
        
        <div class="blog-actions">
            <a href="edit_blog.php?id=<?php echo $blog['id']; ?>" class="btn-edit">Edit Blog</a>
            <a href="delete_blog.php?id=<?php echo $blog['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this blog?');">Delete Blog</a>
        </div>
    </div>
</main>

<!-- Footer Section -->
<footer class="page-footer">
    <div class="container">
        <p>&copy; 2024 Your Blog. All rights reserved.</p>
    </div>
</footer>
