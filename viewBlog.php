<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "blogDataBase";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}

$monthQuery = "SELECT DISTINCT DATE_FORMAT(created_at, '%Y-%m') AS month FROM posts";
$monthResult = mysqli_query($conn, $monthQuery);

$availableMonths = [];
if ($monthResult) 
{
    while ($row = mysqli_fetch_assoc($monthResult)) 
    {
        $availableMonths[] = $row['month'];
    }

    for ($i=0; $i<count($availableMonths); $i++) 
    {
        for ($j=0; $j<count($availableMonths)-$i-1; $j++) 
        {
            if ($availableMonths[$j] < $availableMonths[$j+1]) 
            {
                $temp = $availableMonths[$j];
                $availableMonths[$j] = $availableMonths[$j+1];
                $availableMonths[$j+1] = $temp;
            }
        }
    }
}

if (isset($_GET['month'])) 
{
    $selectedMonth = $_GET['month'];
} 
else 
{
    $selectedMonth = "";
}

$sql = "SELECT id, title, content, created_at, email FROM posts";

if ($selectedMonth !== "") 
{
    $sql .= " WHERE DATE_FORMAT(created_at, '%Y-%m') = '$selectedMonth'";
}

$resultSet = mysqli_query($conn, $sql);

$result = [];
if ($resultSet) 
{
    while ($row = mysqli_fetch_assoc($resultSet)) 
    {
        $result[] = $row;
    }

    for ($i=0; $i<count($result); $i++) 
    {
        for ($j=0; $j<count($result)-$i-1; $j++) 
        {
            if ($result[$j]['created_at']<$result[$j+1]['created_at'])
            {
                $temp = $result[$j];
                $result[$j] = $result[$j+1];
                $result[$j+1] = $temp;
            }
        }
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
    <link rel="stylesheet" href="CSS/add.css?v=2">
    <link rel="stylesheet" href="CSS/mobileBlog.css" media="screen and (max-width: 768px)">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <script src="JavaScript/filterMonth.js" defer></script>
    <script src="JavaScript/commentPrevent.js" defer></script>
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
                echo '<li><a href="addPost.php">Add a Post</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            }
            else
            {
                echo '<li><a href="logreg.php">Add a Post</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<div class="blogContainer">
    <section id="newPost">
        <div id="postHeading">
            <h2>All Blog Posts</h2>
            <div id="dropDown">
                <form method="GET" id="monthForm">
                    <label for="month">View posts by month:</label>
                    <select name="month" id="month">
                        <option value="">-- All Months --</option>
                        <?php
                        foreach ($availableMonths as $month) 
                        {
                            $selected = "";
                            if ($month == $selectedMonth) 
                            {
                                $selected = "selected";
                            }

                            $readableMonth = date("F Y", strtotime($month));
                            echo "<option value='$month' $selected>$readableMonth</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>
        </div>

        <?php
        if (count($result) > 0) 
        {
            foreach ($result as $row) 
            {
                $postID = $row['id'];
                $email = $row['email'];
                $namePart = substr($email, 0, strpos($email, '@'));
                if (strlen($namePart) > 10) 
                {
                    $namePart = substr($namePart, 0, 10) . "...";
                }

                $date = date("j F Y, g:i a", strtotime($row['created_at']));
                $title = $row['title'];
                $content = nl2br($row['content']);

                echo "<article class='blogPost'>";
                echo "<div class='row'>";
                echo "<span class='author'>" . $namePart . "</span>";
                echo "<span class='date'>" . $date . "</span>";
                echo "</div>";
                echo "<h3>$title</h3>";
                echo "<p>$content</p>";

                if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin@admin') 
                {
                    echo "<form method='POST' action='deletePost.php' class='deleteForm'>";
                    echo "<input type='hidden' name='post_id' value='$postID'>";
                    echo "<button type='submit' id='deleteButton'>Delete Post</button>";
                    echo "</form>";
                }
                
                $commentQuery = "SELECT * FROM comments WHERE post_id = $postID";
                $commentResult = mysqli_query($conn, $commentQuery);
                
                $comments = [];
                
                if ($commentResult) 
                {
                    while ($comment = mysqli_fetch_assoc($commentResult)) 
                    {
                        $comments[] = $comment;
                    }
                
                    for ($i = 0; $i < count($comments); $i++) 
                    {
                        for ($j=0; $j<count($comments)-$i-1; $j++) 
                        {
                            if ($comments[$j]['created_at'] > $comments[$j+1]['created_at']) 
                            {
                                $temp = $comments[$j];
                                $comments[$j] = $comments[$j+1];
                                $comments[$j+1] = $temp;
                            }
                        }
                    }
                }

                if ($commentResult && mysqli_num_rows($commentResult) > 0) 
                {
                    echo "<div class='comments'><h4>Comments:</h4>";
                    foreach ($comments as $comment) 
                    {
                        $commenterEmail = $comment['email'];
                        $commenterName = strstr($commenterEmail, '@', true);
                        if (strlen($commenterName) > 10) 
                        {
                            $commenterName = substr($commenterName, 0, 10) . "...";
                        }
                        
                        $commenterName = strstr($comment['email'], '@', true);
                        if (strlen($commenterName) > 10) 
                        {
                            $commenterName = substr($commenterName, 0, 10) . "...";
                        }
                        $commenter = $commenterName;
                        $commentText = $comment['comment'];
                        echo "<p><strong>$commenter:</strong> $commentText";

                        if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin@admin') 
                        {
                            $commentId = $comment['id'];
                            echo " <form method='POST' action='deleteComment.php' id='deleteCommentForm'>";
                            echo "<input type='hidden' name='comment_id' value='$commentId'>";
                            echo "<button type='submit' id='deleteCommentButton'>Delete</button>";
                            echo "</form>";
                        }

                        echo "</p>";
                    }
                    echo "</div>";
                }

                if (isset($_SESSION['user'])) 
                {
                    echo "
                    <form method='POST' action='addComment.php' id='addCommentForm'>
                        <input type='hidden' name='post_id' value='$postID'>
                        <textarea name='comment' id='comment' required placeholder='Write a comment...'></textarea>
                        <p id='errorText'></p>
                        <button type='submit' id='addCommentButton'>Add Comment</button>
                    </form>";
                } 
                else 
                {
                    echo "<a href='logreg.php' id='createAccountButton'>Create an account to chat</a>";
                }

                echo "<hr></article>";
            }
        } 
        else 
        {
            echo "<p>No posts found for this month.</p>";
        }
        ?>
    </section>
</div>

<footer>
    <p>&copy; 2025 Mohammad Sabur Ali Mahdi</p>
</footer>

<?php
    mysqli_close($conn); 
?>
</body>
</html>
