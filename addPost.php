<?php
session_start();
$title = "";
$content = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['preview']) || isset($_POST['post']))) 
{
    if (isset($_POST['title'])) 
    {
        $title = $_POST['title'];
    }

    if (isset($_POST['content'])) 
    {
        $content = $_POST['content'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/add.css">
    <link rel="stylesheet" href="CSS/mobileBlog.css" media="screen and (max-width: 768px)">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog Post</title>
    <script src="JavaScript/blogPrevent.js" defer></script>
    <script src="JavaScript/addPost.js" defer></script>
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
        </ul>
    </nav>
</header>

<div class="blogContainer">
    <section id="newPost">
        <form id="blogForm" method="POST" action="">
            <legend>Add Blog</legend>

            <div id="group">
                <fieldset>
                    <label for="postTitle">Title</label>
                    <input type="text" id="postTitle" name="title" maxlength="25" value="<?php echo $title; ?>">
                    <div class="charCounter"><span id="titleCount">0</span>/25</div>
                </fieldset>

                <fieldset>
                    <label for="postContent">Enter your text here</label>
                    <textarea id="postContent" name="content" rows="5" maxlength="100"><?php echo $content; ?></textarea>
                    <div class="charCounter"><span id="contentCount">0</span>/100</div>
                </fieldset>
            </div>

            <p id="errorText"></p>

            <div class="buttonContainer">
            <button type="submit" name="preview" id="preview">Preview</button>
            <button type="submit" name="post" id="post">Post</button>
            <button type="reset">Clear</button>

            </div>
        </form>
    </section>
</div>

<footer>
    <p>&copy; 2025 Mohammad Sabur Ali Mahdi</p>
</footer>
</body>
</html>