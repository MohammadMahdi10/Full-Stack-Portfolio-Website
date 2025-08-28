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

$commentId = $_POST['comment_id'];
mysqli_query($conn, "DELETE FROM comments WHERE id = $commentId");

mysqli_close($conn);
header("Location: viewBlog.php");
exit();
?>
