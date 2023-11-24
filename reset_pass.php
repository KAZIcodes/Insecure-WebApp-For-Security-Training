<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure Blog - Reset Password</title>
    <link rel="stylesheet" href="./statics/login.css">
    <script src="./statics/functions.js"></script>
</head>


<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "UPDATE users set password = '$password' where username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result === true){
        $sql = "UPDATE users SET token = NULL WHERE username = '$username'";
        $token_null = mysqli_query($conn, $sql);

        header("Location: login.php?msg=The new password has been set successfully");
    }
}

if (array_key_exists('token', $_GET)) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM users where token = '$token'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $token_result = true;
    }
}

if ($token_result === true) { 
    $username = $row['username'];
    echo "<h1>Reset Password for $username </h1>";
    ?>

<form action="reset_pass.php" method="post">

    <label for="password">New Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <label for="password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>
    <input type="hidden" id="username" name="username" value="<?php echo $username; ?>"> <!-- pay attention to type -->
    <input type="submit" value="Reset" onclick="if (!passwordsMatch()) {alert('Passwords Don\'t Match !'); return false;}"><br><br>
</form>

<?php } else {
    echo "<p style='color: #fe0000;'>The provided token is not valid or expired</p> <a href='/forget_pass.php'>Go to forget password page</a>";
}

include 'footer.php';
?>