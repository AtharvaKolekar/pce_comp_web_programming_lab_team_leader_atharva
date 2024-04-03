<?php
session_start();

include("php/config.php");

if(isset($_POST['pname'])){
    $category=$_POST['category'];
    $productname=$_POST['pname'];
    $price=$_POST['price'];
    $discount=$_POST['discount'];
    $dprice=$_POST['finalprice'];
    $weight=$_POST['weight'];
    $description=$_POST['description'];
    $tags=$_POST['tags'];
    $stock=$_POST['stock'];
    $pid = substr(md5(uniqid()),0,5);
    echo $pid;

    $uid = $_SESSION['uid']?? "a7f2e0c4";
    
    $sql = "INSERT INTO products (pid, product_name, uid, price, discount, dprice, weight, stock_quantity, description, category, tags) VALUES ('{$pid}', '{$productname}', '{$uid}', '{$price}', '{$discount}', '{$dprice}', '{$weight}', '{$stock}', '{$description}', '{$category}', '{$tags}')";
    
    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION['message'] = "Product added Successfully";
        header("Location: addproducts.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong!";
        header("Location: addproducts.php");
        exit(0);
    }

}

    

    
?>

