<?php
// Starter session
session_start();
 
// Tømmer alle session variables
$_SESSION = array();
 
// Ødelegger session
session_destroy();
 
// Send brukeren til kogin siden
header("location: login.php");
exit;
?>