<?php
// Session start
session_start();

// clear all session data
$_SESSION = array();

// destroyed session completely
session_destroy();

// redirect useron home page (index.php)
header("location: index.php");
exit;
?>