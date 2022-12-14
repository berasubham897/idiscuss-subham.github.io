<?php
    $loggedin = false;
    $logError = false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'connect.php';
        $name = $_POST['username'];
        $password = $_POST['Password'];
        
        $sqlLog = "SELECT * FROM `login` WHERE name = '$name'";

        $resultLog = mysqli_query($conn, $sqlLog);
        $numLog = mysqli_num_rows($resultLog);
        if($numLog == 1){
            while($rowLog = mysqli_fetch_assoc($resultLog)){
                $userid = $rowLog['userID'];
                // echo var_dump($userid);
                if(password_verify($password, $rowLog['password'])){
                    $loggedin = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $name ;
                    $_SESSION["id"] = $userid;
                    header("location: /idiscuss/index.php");
                    exit;
                }
                else{
                    $logError = "Invalid Credentials";
                }
                
            }
        }
        else{
            $logError = "Invalid Credentials";
        }
        
    }
         
?>