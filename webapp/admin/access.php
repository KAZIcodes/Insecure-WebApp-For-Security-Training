<?php
function getUserIP() {
    $ip = '';

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] !== '') {
        // Use the forwarded IP address if it exists
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] !== '') {
        // Use the remote IP address as a fallback
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}


$userIP = getUserIP();

if ($userIP !== '127.0.0.1' and $userIP !== 'admin_ip' and $userIP !== '::1'){
    echo "Access Denied";
    exit;
}

?>
