<?php
// starter session
session_start();
 
// Hvis brukeren allerede er koblet til, send dem til welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: userprofile.php");
    exit;
}
 
// Ha med config fil for å koble til databasen
require_once "config.php";
 
// Definer variabler og initialiser med tomme verdier
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Håndterer form når det sendes inn
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Sjekker om brukernavnet er tomt og gir en feilmelding om det er det. trim brukes for å fjerne kontrolltegn
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Gir feilmelding hvis passordfeltet er tomt nå man prøver å logge inn
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Sjekker at det er data i brukernavn og passord
    if(empty($username_err) && empty($password_err)){
        // Preparer et statement for raskere kode og unngå SQL injections
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Binder variabler til prepared statement som parametere
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Setter parameteret lik brukernavnet
            $param_username = $username;
            
            // prøver å kjøre prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Lagre resultat
                mysqli_stmt_store_result($stmt);
                
                // Se om brukernavnet finnes og hvis det gjør det, se om passord er riktig
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Binder result variabler
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Passorder er riktig, start en ny session
                            session_start();
                            
                            // Lagre data i session variabler, at ID og brukernavn er hva det er og at man er logget inn
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Sender brukeren til velkommen siden
                            header("location: welcome.php");
                        } else{
                            // Passord er feil send en feilmelding
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Brukernavn finnes ikke, send en feilmelding
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Lukk statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Lukk connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        //hvis det er en feil med login sies det ifra
        if(!empty($login_err)){
            echo 'Oops, der gikk det galt ja: ' . $login_err ;
        }        
        ?>

        <!-- lager en form. Sender daten til dette dokumentet og gjør < og > til html kode-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span ><?php echo $username_err; ?></span>
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
            <p>Har du ikke en bruker? <a href="register.php">Registrer deg her</a>.</p>
        </form>
    </div>
</body>
</html>