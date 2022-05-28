<?php
// Database credentials, kjører på localhost med root bruker uten passord, database: terminoppgave.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'terminoppgave');
 
// kobler til serveren
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Gi feilmelding hvis tilkoblingen ikke gikk
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>