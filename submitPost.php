<?php
session_start();

if (!isset($_SESSION['user'])) 
{
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "blogDataBase";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) 
{
    die("Failed to connect: " . mysqli_connect_error());
}

$errorMessage = "";

$email = $_SESSION['user'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql = "INSERT INTO posts (`title`, `content`, `email`, `created_at`) 
        VALUES ('$title', '$content', '$email', NOW())";

if (mysqli_query($conn, $sql)) 
{
    header("Location: viewBlog.php");
    exit();
} 
else 
{
    $errorMessage = "Error...";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS/add.css">
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php#about">About Me</a></li>
            <li><a href="index.php#experience">Experience</a></li>
            <li><a href="index.php#skills">Skills</a></li>
            <li><a href="index.php#education">Education</a></li>
            <li><a href="project.html">Projects</a></li>
            <li><a href="viewBlog.php">Blog</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <?php
            if (isset($_SESSION['user'])) 
            {
                echo "<li><a href='logout.php'>Logout</a></li>";
            }

            ?>
        </ul>
    </nav>
</header>

<div class="blogContainer">
    <section id="newPost">
        <?php
        if (!empty($errorMessage)) 
        {
            echo "<p id='errorMessage'>$errorMessage</p>";
        }
        ?>
        <a href="addEntry.php">Back to blog form</a>
    </section>
</div>

<footer>
    <p>&copy; 2025 Mohammad Sabur Ali Mahdi</p>
</footer>
</body>
</html>
