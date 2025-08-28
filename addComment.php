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

$postId = $_POST['post_id'];
$comment = $_POST['comment'];
$email = $_SESSION['user'];

if ($postId > 0 && !empty($comment)) 
{
    $sql = "INSERT INTO comments (post_id, email, comment) VALUES ('$postId', '$email', '$comment')";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
header("Location: viewBlog.php");
exit();
?>
