<?php
include 'access.php';
include '../db.php';
session_start();
class MySQLBackup {
    private $username;
    private $password;
    private $database;
    private $backupPath;

    public function __construct($username, $password, $database, $backupPath) {
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->backupPath = $backupPath;
    }

    public function __destruct() {
        $backupFile = $this->backupPath . date('Y-m-d_H-i') . '.sql';
        $command = "mysqldump -u {$this->username} -p{$this->password} {$this->database} > $backupFile";
        exec($command);

        if ($backupFile) {
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"" . basename($backupFile) . "\"");
            readfile($backupFile);
        }
    }

}

new MySQLBackup($db_username, $db_password, $database, $backupPath);

?>