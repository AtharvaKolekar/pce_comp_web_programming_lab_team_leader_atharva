<?php



// if($_SERVER['REQUEST_METHOD'] != 'POST') {
//     header("Location: bazaar.php");
//     exit(0);
// }
session_start();
include('php/config.php');

$status = $_POST["status"] ?? "success";
$firstname = $_POST["firstname"] ?? "Rahul";
$amount = $_POST["amount"] ?? 0;
$txnid = $_POST["txnid"]    ?? 123456;
$posted_hash = $_POST["hash"] ?? 0;
$key = $_POST["key"] ?? 0;
$productinfo = $_POST["productinfo"] ?? 0;
$email = $_POST["email"] ?? "abc@mail.com";
$phone = $_POST["phone"] ?? "1234567890";
$address1 = $_POST["address1"] ?? "Vashi, Navi Mumbai";
$address2 = $_POST["address2"] ?? "Panvel";
$state = $_POST["state"] ?? "Maharashtra";
$country = $_POST["country"] ?? "India";
$zipcode = $_POST["zipcode"] ?? "400703";

$city = $_POST["city"] ?? "Mumbai";

if($status == "success") {
    echo "<img src='./img/success.png' width='200px'/>";
    echo "<h3>Thank You. Your order status is ". $status .".</h3>";
    echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
    echo "<h4>We have received a payment of Rs. " . $amount . ".  Your order will soon be shipped.</h4>";
    echo "<a href='bazaar.php'><h4>Continue Shopping</h4></a>";



    $uniqueFarmers = unserialize($_SESSION['uniqueFarmers']);
    $uniqueFarmersSubTotal = unserialize($_SESSION['uniqueFarmersSubTotal']);
    $products = unserialize($_SESSION['products']);
    $cid = $_SESSION['uid']??00;
    $name = $_SESSION['name']??00;

    foreach($uniqueFarmers as $key => $value) {
        $fid = $value;
        // echo $fid . " " . $uniqueFarmersSubTotal[$key] . "<br>";
        $sql = "INSERT INTO orders (cid, fid, txnid, amount, status, name, email, phone, address1, address2, city, state, country, zipcode) VALUES ('{$cid}', '{$fid}', '{$txnid}', '{$uniqueFarmersSubTotal[$key]}', 'Order Placed', '{$name}', '{$email}', '{$phone}', '{$address1}', '{$address2}', '{$city}', '{$state}', '{$country}', '{$zipcode}');";
        $result = mysqli_query($con, $sql);
    }

    } else {
        echo "<img src='./img/fail.jpg' width='200px'/>";
        echo "<br>Transaction is failed";
        echo "<a href='bazaar.php'><h4>Go Home</h4></a>";

    } 

?>