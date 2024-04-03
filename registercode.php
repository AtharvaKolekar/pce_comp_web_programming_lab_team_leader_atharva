<?php
session_start();
include('php/config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name = $_POST['name'];
    $Mnumber = $_POST['Mnumber'];
    $pin = $_POST['pin'];
    $user_type = $_POST['user_type'];
    $city = $_POST['city'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];

    if($user_type == 'f'){
        $bio = $_POST['bio'];
        $address = $_POST['address'];
        $pincode = $_POST['pincode'];
        $bank_acc = $_POST['bank_acc'];
        $bank_ifsc = $_POST['bank_ifsc'];
    }

    $sql = "SELECT * FROM users WHERE phone ='{$Mnumber}'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row>0)
    {
        $_SESSION['message'] = "Phone number already exists!";
        header("Location: register.php");
        exit(0);
    }else{
        $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);
        $uid = substr(md5(uniqid()),0,8);
        if($user_type == 'c'){
            $sql = "INSERT INTO users (uid, name, phone, 
            pin_hash, user_type, city, lat, lon) 
            VALUES ('{$uid}', '{$name}', '{$Mnumber}', '{$hashed_pin}', '
            {$user_type}', '{$city}', '{$lat}', '{$lon}')";
        }else{
            $sql = "INSERT INTO users (uid, name, phone, pin_hash, user_type, 
            city, lat, lon, bio, address, pincode, bank_account, bank_ifsc) 
            VALUES ('{$uid}', '{$name}', '{$Mnumber}', '{$hashed_pin}', '{$user_type}',
             '{$city}', '{$lat}', '{$lon}', '{$bio}', '{$address}', '{$pincode}', 
             '{$bank_acc}', '{$bank_ifsc}')";
        }
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['message'] = "Registered Successfully";
            header("Location: register.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong!";
            header("Location: register.php");
            exit(0);
        }
    }

}
else
{
    $_SESSION['message'] = "Something went wrong!";
    header("Location: register.php");
    exit(0);
}

?>