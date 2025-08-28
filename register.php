<?php
session_start();

$error = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
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

    $check = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) 
    {
        $error = "This email is already registered.";
    } 
    else 
    {
        $insert = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if (mysqli_query($conn, $insert)) 
        {
            header("Location: login.html");
            exit();
        } 
        else 
        {
            $error = "Something went wrong. Please try again.";
        }
    }

    mysqli_close($conn);
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
    <link rel="stylesheet" href="CSS/register.css?v=2">
    <link rel="stylesheet" href="CSS/mobileRegister.css" media="screen and (max-width: 768px)">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="JavaScript/registerPrevent.js" defer></script>
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
        <section id="registerForm">
            <form action="register.php" method="POST">
                <legend>Register</legend>

                <div id="group">
                    <fieldset>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                        <?php
                        if (!empty($error)) 
                        {
                            echo "<p id='errorText'>$error</p>";
                        }
                        ?>
                    </fieldset>

                    <fieldset>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </fieldset>
                </div>

                <button type="submit" id="registerButton">Register</button>
            </form>
        </section>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Mohammad Sabur Ali Mahdi</p>
    </footer>
</body>
</html>
