<?php
// starter session
session_start();
 
// Hvis brukeren allerede er koblet til, send dem til welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Ha med config fil for å koble til databasen
require_once "config.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Profil</title>
</head>
<body>
<?php include 'header.php'; ?>

</body>
</html>