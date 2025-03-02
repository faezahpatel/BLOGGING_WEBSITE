<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogInPu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">BlogInPu</div>
        <!-- Hamburger Icon -->
        <div class="hamburger">&#9776;</div>
        <nav>
            <ul class="nav-links">

                <?php if (isset($_SESSION['user_id'])) { ?>
                    <!-- Show these links if user is logged in -->
                    <li><a href="html/create_blog.html">Create Blog</a></li>
                    <li><a href="php/profile.php">Dashboard</a></li>  
                    
                    <!-- <?php echo htmlspecialchars($_SESSION['user_name']); ?> -->
                    <li><a href="php/logout.php">Logout</a></li>
                <?php } else { ?>
                    <!-- Show these links if user is not logged in -->
                    <li><a href="html/login.html">Login</a></li>
                    <li><a href="html/register.html">Register</a></li>

                    
                <?php } ?>
             <li><a href="html/about.html">About Us</a></li>
                <li><a href="html/contact.html">Contact</a></li> 
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Welcome to MyBlog</h1>
            <p>Share your thoughts, ideas, and creativity with the world.</p>
            <a href="html/login.html">
            <button class="btn">Get Started</button>
                </a>
        </div>
    </section>
  


    <!-- Content Section -->
    <section class="content-section">
    <h2>HOW TO START BLOGGING?</h2>
    <p>Learn from the best resources available online.</p>
    <div class="cards-container">
        <div class="card">
            <h3>Beginner’s Guide to Blogging</h3>
            <p>Learn how to start a blog and write your first post.</p>
            <a href="https://www.bloggingbasics101.com/how-do-i-start-a-blog/" target="_blank" class="btn">Read More</a>
        </div>
        <div class="card">
            <h3>SEO Tips for Bloggers</h3>
            <p>Optimize your blog for search engines and get more traffic.</p>
            <a href="https://moz.com/beginners-guide-to-seo" target="_blank" class="btn">Learn SEO</a>
        </div>
        <div class="card">
            <h3>Content Writing Strategies</h3>
            <p>Discover how to write engaging blog posts that attract readers.</p>
            <a href="https://neilpatel.com/blog/content-writing-strategy/" target="_blank" class="btn">Improve Writing</a>
        </div>
    </div>
</section>


<marquee behavior="scroll" direction="left">
    Welcome to MyBlog! Share your thoughts with the world.
</marquee>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 MyBlog. All Rights Reserved. <strong>Developed BY FAEZAH PATEL</strong><a href="#"></a></p>
    </footer>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.navbar nav ul');

        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    </script>
</body>

</html>
