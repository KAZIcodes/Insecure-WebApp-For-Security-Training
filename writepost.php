<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure Weblog</title>
    <link rel="stylesheet" href="./statics/style.css">
    <link rel="stylesheet" href="./statics/form.css">
</head>
<?php
include "db.php";
session_start();
$username = $_SESSION["username"];
$user_id = $_SESSION['user_id'];

if ($_SESSION['is_logged'] === true) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $title = $_POST['title'];
        $category_id = $_POST['category'];
        $content = $_POST['content'];

        $insert_query = "INSERT INTO posts (user_id, title, content, category_id) VALUES ($user_id, '$title', '$content', $category_id);";

        try {
            $insert_res = mysqli_query($conn, $insert_query);

            if ($insert_res === true) {
                header("Location: myposts.php?msg=Your post has been published succesfully ;)");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
        }
    }

    $category_query = "SELECT * from categories";
    $query_res = mysqli_query($conn, $category_query);
    $rows = mysqli_fetch_all($query_res);
?>

    <body>
        <header>
            <h1>Welcome to Insecure Weblog</h1>
            <nav>
                <ul>
                    <li><a href="./index.php" id="main-tab">Main</a></li>
                    <li><a href="./home_panel.php" id="home-tab">Home</a></li>
                    <li><a href="myposts.php" id="myposts-tab">My Posts</a></li>
                    <li><a href="writepost.php" id="writepost-tab">Write Post</a></li>
                    <li><a href="settings.php" id="settings-tab">Settings</a></li>
                    <li><a href="logout.php" id="logout-tab">Logout</a> (<?php echo $username ?>)</li> <!-- you can delete all cookies by the function in functions.js -->
                </ul>
            </nav>
        </header>

        <main id="main-content">
            <h2>Write a Post</h2>

            <form action="./writepost.php" method="POST">

                <label for="title">Title:</label>
                <textarea id="title" name="title" placeholder="Title"></textarea><br>

                <label for="category">Category:</label><br>
                <select id="category" name="category" style="margin-top: 5px;">
                    <?php
                    foreach ($rows as $row) {
                        echo  "<option value=\"$row[0]\">$row[1]</option>";
                    }
                    ?>
                </select>

                <label for="content">Content:</label>
                <textarea id="content" name="content" placeholder="Hi this post is about ..."></textarea><br>

                <input type="submit" value="Post">
            </form>

        </main>

    <?php

    if (isset($message)) {
        echo "$message";
    }
} else {
    // Redirect to a specific URL
    header("Location: ./login.php");
    exit; // Make sure to exit to prevent further code execution
}
    ?>

    <footer>
        <p>&copy; 2023 Amirali Kazerooni</p>
    </footer>

    <script src="app.js"></script>
    </body>

</html>