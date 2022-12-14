<?php
        
    $insert = false;
    $insertError = false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'connect.php';
        $name = $_POST['username'];
        $password = $_POST['Password'];
        $cpassword = $_POST['cPassword'];
        
        $existsql = "SELECT * FROM `login` WHERE name = '$name'";
        $re = mysqli_query($conn, $existsql);
        $existnum = mysqli_num_rows($re);
        if($existnum > 0){
            $insertError = "Username already exists. Please try again.";
        }
        else{
            if($password == $cpassword){
                $hashpass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `login` ( `name`, `password`, `dt`) VALUES ( '$name', '$hashpass', current_timestamp());";
                $result = mysqli_query($conn , $sql);
                if($result){
                    $insert = true;
                    header("Location: /idiscuss/index.php");
                    exit;
            }
            else{
                $insertError = "Data is not inserted";
                header("Location: /idiscuss/index.php");
                    exit;
            }
            }
            else{
                $insertError = "Passwords did not match";
                header("Location: /idiscuss/index.php");
                    exit;
            }
        
        }
    }
    
    
?>