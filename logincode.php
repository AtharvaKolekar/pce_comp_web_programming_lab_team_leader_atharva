<?php
session_start();
include('php/config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $Mnumber = $_POST['Mnumber'];
    $pin = $_POST['pin'];

    $city = $_POST['city'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];

    

    $sql = "SELECT * FROM users WHERE phone ='{$Mnumber}'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row>0)
    {
        $pin_hash = $row['pin_hash'];
        if(password_verify($pin, $pin_hash)) {
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['lat'] = $row['lat'];
            $_SESSION['lon'] = $row['lon'];
 
            if($_SESSION['user_type'] == "c"){
                header("Location: bazaar.php");
            }else{
                header("Location: farmerdashboard.php");
            }
            
            exit(0);

        } else {
            $_SESSION['message'] = "Incorrect PIN! Try again!";
            header("Location: login.php");
            exit(0);
        }
        $_SESSION['message'] = "Phone number already exists!";
        header("Location: login.php");
        exit(0);
    }else{
        $_SESSION['message'] = "Phone number not registered!";
        header("Location: login.php");
        exit(0);
    }

}
else
{
    $_SESSION['message'] = "Something went wrong!";
    header("Location: register.php");
    exit(0);
}

?>