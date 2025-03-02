<?php
session_start();
include('connect.php'); // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}

// Check if the blog ID is passed via the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to fetch blog details
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Bind blog ID
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $error = null;

    // Validate title and content
    if (empty($title) || empty($content)) {
        $error = "Both title and content are required.";
    }

    // If there's no image uploaded, don't change the image
    if (empty($error)) {
        $sql = "UPDATE blogs SET title = ?, content = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $content, $id); // Update title and content only
        if ($stmt->execute()) {
            echo "Blog post updated successfully!";
            header('Location: view.php?id=' . $id);
            exit();
        } else {
            echo "Error updating the post.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <link rel="stylesheet" href="../assets/css/create_post.css"> <!-- Reusing CSS -->
</head>
<body>
    <div class="container">
        <h1>Edit Blog Post</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="edit_blog.php?id=<?php echo $id; ?>" method="POST">
            <input type="hidden" name="blog_id" value="<?php echo $id; ?>">

            <div class="input-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
            </div>

            <div class="input-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
            </div>

            <!-- Image section removed, no file input field -->

            <div class="upload-preview">
                <?php if (!empty($blog['image'])): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($blog['image']); ?>" alt="Current Image" style="display:block;">
                <?php else: ?>
                    <p>No image available</p>
                <?php endif; ?>
            </div>
            <button type="submit">Update Post</button>
        </form>

        <footer>
            <p>&copy; 2024 Your Blog Site. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
