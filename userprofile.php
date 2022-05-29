<?php
// starter session
session_start();
 
// Se om bruker er logget inn, hvis ikke send til login siden
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
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
<div class='parent'>
    <div class='div2 row'><a href="reset-password.php" class="btn btn-warning">Lag et nytt passord</a>
        <a href="logout.php" class="btn btn-danger ml-3">Logg ut</a></div>
    <div class='div1'>
        <h1>Hei på deg, <?php echo htmlspecialchars($_SESSION["username"]);?>. Dette er din side </h1>

        </div>
        </div>
</body>
</html>