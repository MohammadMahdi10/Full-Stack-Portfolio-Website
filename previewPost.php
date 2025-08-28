<?php
session_start();

if (!isset($_POST['title']) || !isset($_POST['content'])) 
{
    header("Location: addPost.php");
    exit();
}

$title = $_POST['title'];
$content = nl2br($_POST['content']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/preview.css?v=2">
    <link rel="stylesheet" href="CSS/mobilePreview.css" media="screen and (max-width: 768px)">
    <meta charset="UTF-8">
    <title>Preview Post</title>
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
                    echo '<li><a href="logout.php">Logout</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>

    <div class="blogContainer">
        <section id="newPost">
            <h2>Preview Your Blog Post</h2>
            <article class="blogPost">
                <h3><?php echo $title; ?></h3>
                <p><?php echo $content; ?></p>
            </article>

            <form method="POST" action="submitPost.php" id="submitPost">
                <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>">
                <input type="hidden" name="content" value="<?php echo $_POST['content']; ?>">
                <button type="submit" name="confirm">Upload Post</button>
            </form>

            <form method="POST" action="addPost.php" id="editPost">
                <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>">
                <input type="hidden" name="content" value="<?php echo $_POST['content']; ?>">
                <button type="submit">Edit Post</button>
            </form>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Mohammad Sabur Ali Mahdi</p>
    </footer>
</body>
</html>
