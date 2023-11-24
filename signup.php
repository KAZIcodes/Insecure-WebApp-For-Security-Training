<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure Blog - Sign Up</title>
    <link rel="stylesheet" href="./statics/login.css">
</head>

<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") { // when the user send registeration info

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    try {
        $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        $query_res = mysqli_query($conn, $insert_query);

        if ($query_res === true) {
            header("Location: ./login.php?msg=Signup Done Successfully, Please Login");
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<body>
    <h1>Signup in Insecure Blog</h1>
    <form action="./signup.php" method="POST"> <!-- pay attention to action attribute -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Sign up"><br><br>

        <a href='login.php', style='color: #0049f4;'>Already have an acoount ?</a>
    </form>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: #fe0000;'>$error_message</p>";
    }
    ?>
</body>


<?php
include 'statics/footer.php';
?>