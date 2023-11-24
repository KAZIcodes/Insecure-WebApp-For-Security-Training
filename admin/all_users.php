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
include "../db.php";

if (array_key_exists('operation', $_GET) && array_key_exists('keyword', $_GET)) {
    $op = $_GET['operation'];
    $kw = $_GET['keyword'];

    if ($op == 'search') {
        $sql = "SELECT * FROM users WHERE username LIKE '%$kw%' OR email LIKE '%$kw%';";
        $result = mysqli_query($conn, $sql);
    } else if ($op == 'delete') {
        $sql = "DELETE FROM users WHERE user_id = $kw;";
        $result = mysqli_query($conn, $sql);
        if ($result === true) {
            header("Location: ./all_posts.php?msg=Operation done succesfully ;)");
            exit;
        } else {
            header("Location: ./all_posts.php?err=Operation done succesfully ;)");
            exit;
        }
    } else if ($op == 'export-user') {
        $sql = "SELECT * FROM users WHERE user_id = $kw;";
        $result = mysqli_query($conn, $sql);
        $export_obj = base64_encode(serialize(mysqli_fetch_assoc($result)));
    } else if ($op == 'import-user') {
        $import_obj = unserialize(base64_decode($kw));
    }
} else {
    $sql = "SELECT * FROM users;";
    $result = mysqli_query($conn, $sql);
}

$rows = array();
while ($row_tmp = mysqli_fetch_assoc($result)) {
    // Append each row as an associative array to the $rows array
    $rows[] = $row_tmp;
}

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
            <h1>All Users</h1>
            <?php
            //msg handeling
            if (isset($_GET['msg'])) {
                $message = $_GET['msg'];
                echo "<p style='color: #00ad17;'>$message</p>";
            } else if (isset($_GET['err'])) {
                $message = $_GET['err'];
                echo "<p style='color: #fe0000;'>$message</p>";
            }

            if (isset($export_obj)) {
                echo "<h4>Exported user: </h4>";
                echo '<div style="word-wrap: break-word;">' . $export_obj . '</div><br><br>';
                echo "<a href='all_users.php?operation=import-user&keyword=$export_obj'>Import(load and see) the same user again ?</a>";
            } 
            else if (isset($import_obj)) {
                echo "<h4>Imported user: </h4>";
                echo "<pre>";
                var_dump($import_obj);
            }
            else {
                foreach ($rows as $row) {
                    echo  "Username: <a href='all_users.php?operation=search&keyword=" . $row['username'] . "'>" . $row['username'] . "</a>" . "  ----------  <a href='all_users.php?operation=delete&keyword=" . $row['user_id'] . "'>Delete</a> | <a href='all_users.php?operation=export-user&keyword=" . $row['user_id'] . "'>Export</a><br><br>";
                }
            }

            ?>

        </section>
    </main>

    <footer>
        <p>&copy; 2023 Amirali Kazerooni</p>
    </footer>

    <script src="app.js"></script>
</body>

</html>