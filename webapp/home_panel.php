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
/* unsecure way:
$is_logged = $_COOKIE["is_logged"];
$user_id = $_COOKIE["user_id"];
$username = $_COOKIE["username"];
*/
session_start();
$username = $_SESSION["username"];
if ($_SESSION['is_logged'] === true) {
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
            <h1>Welcome to the Panel</h1>
            <?php echo "<h2>Hello $username</h2>"; ?>
        </main>
    <?php
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