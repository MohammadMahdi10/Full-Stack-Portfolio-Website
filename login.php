<?php
session_start();

$error = "";


$servername = "localhost";
$username = "root";
$password = "";
$database = "blogDataBase";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) 
{
    die("Failed to connect: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) 
{
    $_SESSION['user'] = $email;

    if ($email === 'admin@admin') 
    {
        header("Location: viewBlog.php");
    } 
    else 
    {
        header("Location: addPost.php");
    }
    exit();
}
else
{
    $error = "Invalid email or password.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/login.css?v=4">
    <link rel="stylesheet" href="CSS/mobileLogin.css" media="screen and (max-width: 768px)">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="JavaScript/loginPrevent.js" defer></script>
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

    <div class="container">
        <section id="loginForm">
            <form action="login.php" method="POST">
                <legend>Login</legend>

                <div id="group">
                    <fieldset>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                    </fieldset>

                    <fieldset>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                        <?php
                            if (!empty($error)) 
                            {
                                echo "<p id='errorText'>$error</p>";
                            }
                        ?>
                    </fieldset>
                </div>

                <button type="submit" id="loginButton">Login</button>
            </form>
        </section>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Mohammad Sabur Ali Mahdi</p>
    </footer>
</body>
</html>
