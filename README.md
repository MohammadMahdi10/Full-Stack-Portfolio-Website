# Full Stack Portfolio Website

## Summary
I developed a personal website as part of a module at Queen Mary University of London, showcasing both front-end and back-end development skills. The front end was built with HTML, CSS, and JavaScript, while the back end used PHP with a MySQL database to power a fully functional blog, login system, and admin system. Users can register, log in, and create blog posts, with all data securely stored, while the admin system provides management features. The site also highlights my achievements, education, and projects, serving as a portfolio to present my skills and experiences.

## Features
- Front end built with **HTML, CSS, and JavaScript**.
- Back end developed using **PHP and MySQL on XAMPP**.
- **Secure login system** for user registration and authentication.
- Fully functional blog where users can **create, edit, and view posts**.
- Admin system for managing users and content **(such as deleting posts and comments)**.
- Portfolio sections showcasing **achievements, education, and projects**.

**This portfolio website works but contains bugs and will no longer be maintained!**

## Watch the video!
Watch the video - https://youtu.be/WEIp9WuFg2s

## How to run for yourself
1. **Install XAMPP**
    - Download and **install XAMPP** from https://www.apachefriends.org/download.html
    - Open the XAMPP Control Panel and start **Apache** and **MySQL**.

2. **Setup the Project**
    - **Download and copy the website project folder** into the `htdocs` directory inside the **XAMPP installation folder** (e.g., `C:\xampp\htdocs\your-website`).

3. **Setup the Database**
    - Open a web browser and go to http://localhost/phpmyadmin/
    - **Create a new database** (e.g., `my_website_db`) - In the php file, it is called `blogdatabase`
    - **Import your SQL file** (if you have one) containing the necessary tables for the blog, login system, and admin system.

4. **Configure Database Connection (if database name changed)**
    - Open the PHP configuration file in the project that handles the database connection.
    - Update the database name, username, and password if needed.

5. **Run the Website**
    - In your browser, go to http://localhost/folder-name/ (ensure to include all file paths to the project folder)
    - You should now see the homepage and view my website!
