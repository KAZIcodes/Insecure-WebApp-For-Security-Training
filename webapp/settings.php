<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure Weblog</title>
    <link rel="stylesheet" href="./statics/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./statics/form.css">
</head>

<?php
include "db.php";
session_start();
$username = $_SESSION["username"];
$user_id = $_SESSION['user_id'];

if ($_SESSION['is_logged'] === true) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_id = $_POST['user_id'];
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        $password = mysqli_real_escape_string($conn, $_POST['password']); // real escape is for quotes for example

        if ($password === "") {
            $update_query = "UPDATE `users` SET email = '$email', first_name = '$first_name', last_name = '$last_name', bio = '$bio' WHERE user_id =" . intval($user_id); // watchout the intval usage 
        } else {
            $update_query = "UPDATE `users` SET email = '$email', first_name = '$first_name', last_name = '$last_name', bio = '$bio', password = '$password' WHERE user_id =" . intval($user_id);
            $password_changed = true;
        }
        try {
            $query_res = mysqli_query($conn, $update_query);
            if ($query_res === true) {
                if ($password_changed === true) {
                    header("Location: ./logout.php");
                } else {
                    header("Location: ./settings.php");
                }
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
        }
    }


    try {
        $query = "SELECT * FROM users WHERE user_id =" . $_SESSION['user_id'];
        $query_res = mysqli_query($conn, $query);
        if ($query_res) {
            $user_info = mysqli_fetch_assoc($query_res);
        }
    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }

?>

    <body>
        <header>
            <h1>Welcome to Unsecure Weblog</h1>
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
            <h2>Update Your Information</h2>
            <img id="profile_image_preview" src="<?='/get_image.php?imgsrc=statics/images/' . md5($_SESSION['user_id']) . '.png';?>" onerror="this.src='./statics/images/default.png'" alt="Profile Image">
            <input type="file" id="imageUpload" accept="image/*">

            
            <script src="/statics/upload_image.js"></script> <br>
            
            <form action="./settings.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $user_info['user_id'] ?>">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user_info['username'] ?>" disabled><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user_info['email'] ?>"><br>

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $user_info['first_name'] ?>"><br>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $user_info['last_name'] ?>"><br>

                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio"><?php echo $user_info['bio'] ?></textarea><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br>

                <input type="submit" value="Update">
            </form>

        </main>
    <?php

    if (isset($_GET['message'])) {
        $message = $_GET['message'];
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