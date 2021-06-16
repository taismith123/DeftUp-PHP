<?php
session_start();

// expunge all variables
$_SESSION = array();

session_destroy();

// redirect user to homepage
header("location: homepage.html");
exit;
?>