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

function category_id_to_name($conn, $category_id){
    $sql = "SELECT * from categories WHERE category_id = ". $category_id . ";";
    $query_res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query_res);
    return $row['category_name'];
}

function author_id_to_name($conn, $id){
    $sql = "SELECT * from users WHERE user_id = ". $id . ";";
    $query_res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query_res);
    return $row['username'];
}

if (isset($_GET['author_id'])) {
    $sql = "SELECT * FROM posts where user_id = " . $_GET['author_id'];
} else {
    $sql = "SELECT * FROM posts";
}

$query_res = mysqli_query($conn, $sql);

$rows = array(); // Initialize an empty array to store the rows
while ($row = mysqli_fetch_assoc($query_res)) {
    // Append each row as an associative array to the $rows array
    $rows[] = $row;
}

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
            <h1>All blog posts</h1>
            <?php foreach ($rows as $row) { ?>
            <p>- <a href="/show_posts.php?post_id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a>, published in <?php echo $row['created_at']; ?> in <b><?php echo category_id_to_name($conn, $row['category_id']); ?></b> by <a href="all_posts.php?author_id=<?php echo $row['user_id']; ?>"><?php echo author_id_to_name($conn, $row['user_id']);?></a></p>
            <?php } ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Amirali Kazerooni</p>
    </footer>

    <script src="app.js"></script>
</body>

</html>
