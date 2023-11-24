<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure Blog - Reset Pass</title>
    <link rel="stylesheet" href="./statics/login.css">
</head>

<?php
include 'db.php';
include './statics/functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") { 

    $username = $_POST['username'];

    $exists_query = "SELECT * FROM users WHERE username = '$username'";
    $query_res = mysqli_query($conn, $exists_query);

    if ($query_res && mysqli_num_rows($query_res) == 1) { // the second condtion is important because it blocks this SQLi : mamad' or 1=1#
        
        $md5_random = md5(generateRandomString());
        $token_query = "UPDATE users SET token = '$md5_random' WHERE username = '$username'";
        $update_res = mysqli_query($conn, $token_query);

        if ($update_res){
            $row = mysqli_fetch_assoc($query_res);
            $message = "The reset password link has been sent to your email ;)";
            print("/reset_pass.php?token=$md5_random");
        }
        else {
            $error_message = "Setting Reset Pass Token Failed!";
        }
    } 
    else {
        $error_message = "Username Not Found !";
    }
}
?>

<body>
    <h1>Reset Password in Unsecure Blog</h1>
    <form action="./forget_pass.php" method="POST"> <!-- pay attention to action attribute -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php if(array_key_exists('username', $_GET)) echo $_GET['username']; ?>" required><br><br>
        <input type="submit" value="Continue"><br><br>
    </form>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: #fe0000;'>$error_message</p>";
    }
    else if (isset($message)){
        echo "<p style='color: #00ad17;'>$message</p>";
    }
    ?>
</body>


<?php
include 'statics/footer.php';
?>