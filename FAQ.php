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

$qstn = "";
$qstn_err = "";

// Håndterer form når det sendes inn
if($_SERVER["REQUEST_METHOD"] == "POST"){
 

  // Gir feilmelding hvis spørsmålsfeltet er tomt nå man prøver å sende inn
  if(empty(trim($_POST["question"]))){
    $qstn_err = "Still et spørsmål.";
} else{
    $qstn = trim($_POST["question"]);
}

  // Check input errors before inserting in database
  if(empty($qstn_err)){
        
    // Prepare an insert statement
    $sql = "INSERT INTO questions (user, question) VALUES (?, ?)";

   
   

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "is", $param_user, $param_qstn );
        
        // Set parameters
        $param_user = $_SESSION["id"];
        $param_qstn = $qstn;

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            echo "Spørsmålet ditt er sent inn!";
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($link);
}
  
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php require('header.php'); ?>

    <div>
        <h2>spørsmål?</h2>
        <p>send in spørsmål her</p>


        <!-- lager en form. Sender daten til dette dokumentet-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                
                <textarea name="question" cols="60" rows="10" value="<?php echo $qstn; ?>" ></textarea>
            </div>    
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>



</body>
</html>