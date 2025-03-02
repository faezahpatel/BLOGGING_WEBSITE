BlogInPu


BlogInPu is a user-friendly blogging platform that allows users to create, edit, view, and manage blogs. It is built using PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap.


Features
User Authentication:
Login and registration functionality with secure session management.

Create Blogs:
Users can write and post blogs with a title, content, image, and category.

View Blogs:
Blogs can be viewed with complete details, including the uploaded image, category, and creation date.

Edit and Delete Blogs:
Blogs can be edited or deleted by their respective creators.

Dashboard:
Displays user information, total blogs created, and recent blogs.

Responsive Design:
Mobile-friendly interface built with Bootstrap and css.

Project Structure
File Structure:

/assets
  /css
    - styles.css       # Global styles
    - view.css         # Styles for viewing blogs
    - create_post.css  # Styles for creating blogs
    - common.css       # Styles for contactus and about us 
    - profile.css      # Styles for dashboard
    - view.css         # Styles for viewing blog 
/html
  - login.html         # Login page
  - register.html      # Registration page
  - create_blog.html   # Blog creation page
  - about.html         # About page
  - contact.html       # Contact page
/php
  - connect.php        # Database connection script
  - create_blog.php    # Handles blog creation
  - edit_blog.php      # Handles blog editing
  - delete_blog.php    # Handles blog deletion
  - view.php           # Displays individual blogs
  - profile.php        # User dashboard
  - logout.php         # Logout functionality
  - login.php          # Login backend script
  - register.php       # Registration backend script
- index.php            # Homepage of the website
- README.md            # Project documenattaion
Database:
The project uses MySQL as the database. The schema is included in the file blog_database.sql.

Database Tables:
Users:
id, name, email, password, created_at
Blogs:
id, title, content, image, category, user_id, created_at
Setup Instructions
Prerequisites:
A web server (e.g., XAMPP, WAMP, or LAMP)
PHP 7.4+ and MySQL
phpMyAdmin or any MySQL client