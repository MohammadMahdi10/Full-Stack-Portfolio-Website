<?php
session_start();

if ($_SESSION['user'] !== 'admin@admin') 
{
    header("Location: viewBlog.php");
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

mysqli_query($conn, "DELETE FROM comments WHERE post_id = $postId");
mysqli_query($conn, "DELETE FROM posts WHERE id = $postId");

mysqli_close($conn);
header("Location: viewBlog.php");
exit();
?>
