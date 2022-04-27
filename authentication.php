<?php      
    include('connection.php');  
    $brukernavn = $_POST['user'];  
    $passord = $_POST['pass'];  
      
        //to prevent from mysqli injection  
        $brukernavn = stripcslashes($brukernavn);  
        $passord = stripcslashes($passord);  
        $brukernavn = mysqli_real_escape_string($con, $brukernavn);  
        $passord = mysqli_real_escape_string($con, $passord);  
      
        $sql = "select * from users where brukernavn = '$brukernavn' and passord = '$passord'";  
        // $sql2 = "select *from login where brukernavn = '?' and passord = '?'".(brukernavn, passord);  
echo $sql;
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            include('top.php');
            echo "<h1><center> Gaming </center></h1>";  
            include 'home.html';
           
        }  
        else{  
            echo "<h1> Login failed. Invalid brukernavn or passord.</h1>";  
        }     
?>  