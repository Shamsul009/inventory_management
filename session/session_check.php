<?php
session_start(); // Start the session

function checkSession() {
    if (isset($_SESSION['user_id'] , $_SESSION['user_authenticated'])) {
        // Session is set
        $storedUserId = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

        if ($storedUserId !== $_SESSION['user_id']) {
            // User ID mismatch between session and cookie
            header("Location: http://localhost/inventory/login/login_view.php");
            exit();
        }
    } else {
        // Session is not set
        header("Location: http://localhost/inventory/login/login_view.php");
        exit();
    }
}


?>
