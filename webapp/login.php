<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure Blog - Login</title>
    <link rel="stylesheet" href="./statics/login.css">
</head>

<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") { //to check if user is already loged in

    $is_logged = $_SESSION["is_logged"];

    if ($is_logged === true) {
        header("Location: ./home_panel.php");
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] == "POST") { // when the user wants to log in

    $username = $_POST['username'];
    $password = $_POST['password'];
    $auth_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    //$auth_query = "select group_concat(column_name) from information_schema.columns where table_schema='unsecure_weblog' and table_name='users'";
    $query_res = mysqli_query($conn, $auth_query);

    if ($query_res ) { // there should be a second condtion mysqli_num_rows($query_res) == 1 to prevent from the simpelest SQLi : mamad' or 1=1#

        $row = mysqli_fetch_assoc($query_res);
        /*innsecure way:
        setcookie("username", $row['username'], time() + 3600);
        setcookie("user_id", $row['user_id'], time() + 3600);
        setcookie("is_logged", "true", time() + 3600);
        */
        $_SESSION['is_logged'] = true;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];

        header("Location: ./home_panel.php");
        exit;
    } else {
        $error_message = "Invalid username or password !";
    }
}
?>

<body>
    <h1>Login to Unsecure Blog</h1>
    <form action="./login.php" method="POST"> <!-- pay attention to action attribute -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login"><br><br>
        <a href='signup.php', style='color: #0049f4;'>Don't have an acoount ?</a><br><br>
        <?php
            if (isset($error_message)){echo "<a href='forget_pass.php?username=$username', style='color: #0049f4;'>Forgot your password ?</a>";}
            else {echo " <a href='forget_pass.php', style='color: #0049f4;'>Forgot your password ?</a>";}
         ?>
    </form>

    <?php
    
    if (isset($error_message)) {
        echo "<p style='color: #fe0000;'>$error_message</p>";
    }
    else if (array_key_exists('msg', $_GET)){
        $message = $_GET['msg'];
        echo "<p style='color: #00ad17;'>$message</p>";
    }
    ?>

    <footer>
        <p>&copy; 2023 Amirali Kazerooni</p>
    </footer>
</body>

</html>