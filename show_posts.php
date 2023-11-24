<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsecure Weblog</title>
    <link rel="stylesheet" href="./statics/style.css">
    <script src=./statics/functions.js></script>
</head>

<?php
include "db.php";
session_start();


$sql = "SELECT * FROM posts where post_id = " . $_GET['post_id'];
$query_res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query_res);
?>

<body>
    <header>
        <h1>Welcome to Insecure Weblog</h1>
        <nav>
            <ul>
                <li><a href="./index.php" id="main-tab">Main</a></li>
                <li><a href="./all_posts.php" id="posts-tab">All Posts</a></li>
                <li><a href="./login.php" id="panel-tab">User Panel</a></li>
            </ul>
        </nav>
    </header>

    <main id="main-content">
        <section>
            <h1><?php echo $row['title']; ?></h1>
            <p><?php echo $row['content']; ?></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Amirali Kazerooni</p>
    </footer>

    <script src="app.js"></script>
</body>

</html>