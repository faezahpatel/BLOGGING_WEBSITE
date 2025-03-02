<?php
session_start();
include('connect.php'); 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Query to get user info
$user_sql = "SELECT * FROM users WHERE id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user_data = $user_result->fetch_assoc();

// Query to get blogs written by the logged-in user
$sql = "SELECT * FROM blogs WHERE author_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Query to get number of blogs
$count_sql = "SELECT COUNT(*) AS blog_count FROM blogs WHERE author_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$blog_count = $count_result->fetch_assoc()['blog_count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/profile.css"> 
</head>
<body>

<!-- Sidebar for navigation -->
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Dashboard</h2>
    </div>
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../html/create_blog.html">Create Blog</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</aside>

<!-- Main Content -->
<main class="dashboard-container">
<header class="dashboard-header">
<section class="overview">
    <div class="user-info">
        <p><strong>NAME :<strong><?php echo htmlspecialchars($user_data['name']); ?></p>
        <p><?php echo htmlspecialchars($user_data['email']); ?></p>
        <p class="blog-count">Total Blogs Written: <?php echo $blog_count; ?></p> <!-- Total Blogs Written here -->
    </div>
   
</header>    
        
    </section>

    <!-- Recent Blogs Section -->
    <section class="recent-activity">
        <h3>Your Recent Blogs</h3>
        <?php if ($result->num_rows > 0) { ?>
            <div class="card-container">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="blog-card">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><strong>Posted on:</strong> <?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></p>
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="btn-view">Read More</a>
                        <a href="edit_blog.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                        <a href="delete_blog.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>No blogs found. Start by creating one!</p>
        <?php } ?>
    </section>
</main>


<script src="../assets/js/script.js"></script>
</body>
</html>
