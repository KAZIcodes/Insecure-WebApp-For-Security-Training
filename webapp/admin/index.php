<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure Weblog</title>
    <link rel="stylesheet" href="../statics/style.css">
    <script src=./statics/functions.js></script>
</head>

<?php
session_start();
include "access.php";  // to restirct people who can see this 
?>

<body>
    <header>
        <h1>Welcome to Insecure Weblog</h1>
        <nav>
            <ul>
                <li><a href="../index.php" id="main-tab">Main</a></li>
                <li><a href="./all_users.php" id="panel-tab">All Users</a></li>
                <li><a href="./mysql_bakcup.php" id="posts-tab">Database Backup</a></li>
            </ul>
        </nav>
    </header>

    <main id="main-content">
        <section>
            <h1>Administration Panel</h1>
            <p>Welcome Admin</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Amirali Kazerooni</p>
    </footer>

    <script src="app.js"></script>
</body>

</html>