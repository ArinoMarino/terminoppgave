

<?php /*
//  starter session
session_start();
 
// Se om bruker er logget inn, hvis ikke send til login siden
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
} */
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <header class="menybar">
        <h1 id="h1">Yass</h1>
        <p>Hallo, <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
        <nav id="nav">
            <a href="FAQ.php">FAQ og brukerstøtte</a>
            
        </nav>
        
    </header>
</body>
</html>