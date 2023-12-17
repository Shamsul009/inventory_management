<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();
setcookie('user_id', '', time() - 3600, '/');

// Redirect to the login page
header("Location: ../login/login_view.php");
exit();
?>
