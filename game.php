<?php
// starter session
session_start();

// Se om bruker er logget inn, hvis ikke send til login siden
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Game</title>
</head>

<body>
<?php require('header.php'); ?>
    <div class="container">
        <div id="text">Text</div>  <!--  fortellende historie  -->
        <div id="option-buttons" class="btn-grid">  <!--  knappene der man kan ta valg   -->
          <button class="btn">Option 1</button>
          <button class="btn">Option 2</button>
          <button class="btn">Option 3</button>
          <button class="btn">Option 4</button>
        </div>
      </div>

    <script src="script.js"></script>

</body>

</html>