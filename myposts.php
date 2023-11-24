<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure Weblog</title>
    <link rel="stylesheet" href="./statics/style.css">
    
</head>
<?php
include "db.php";
session_start();
$username = $_SESSION["username"];
$user_id = $_SESSION['user_id'];

if ($_SESSION['is_logged'] === true) {

    $posts_query = "SELECT * from posts";
    $query_res = mysqli_query($conn, $posts_query);
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
            <h2 style="text-align: center;">My Posts</h2>

            <?php
            foreach ($rows as $row) {
                echo "- $row[2] published in $row[5]  <a href='view_post.php?$row[0]'>VIEW</a>  <a href='edit_post.php?$row[0]'>EDIT</a>";
                echo "<br><br>";
            }
            ?>
        </main>

    <?php

    if (isset($_GET['msg'])) {
        $tmp = $_GET['msg'];
        echo "<p style='color: #00ad17; text-align: center;'>$tmp</p>";
    }

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