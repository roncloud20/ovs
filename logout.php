<?php
// Start the session and clear the user ID
session_start();
unset($_SESSION['voter_id']);
unset($_SESSION['login_type']);

// Redirect the user to the login page
header('Location: login.php');
exit;
?>
