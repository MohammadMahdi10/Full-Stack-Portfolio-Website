<?php
session_start();

if (!isset($_SESSION['user'])) 
{
    header("Location: logreg.php");
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

$title = $_POST['title'];
$content = $_POST['content'];
$email = $_SESSION['user'];

$sql = "INSERT INTO posts (title, content, email, created_at)
        VALUES ('$title', '$content', '$email', NOW())";

if (mysqli_query($conn, $sql)) 
{
    header("Location: viewBlog.php");
    exit();
}
else 
{
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
