<?php 
   session_start();

   ini_set('log_errors', 1);
    ini_set('error_log', './handleErrors/error.log');
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 0);

   include("php/config.php");
   if(isset($_SESSION['user_type']) != "c") {
    header("Location: login.php");
    exit(0);
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">

    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">

</head>
<body>
    <div id="main">
        <header>
            <div class="logo">
                <img src="./img/logo.png" alt="logo" width="40" height="40">
                <h2>KisanBaazar</h2>
            </div>
            <a style="text-align: right; color: #3AB34A;" href="bazaar.php"><b>Continue Shopping</b></a>
        </header>
        <div style="display: none; padding: 40px; text-align: center; font-size: 1.5em; font-weight: 700; color: #24732e;">
            <img src="./img/404.png" alt="404" style="width: 100%; max-width: 300px;">
            <p style="margin-bottom: 20px;">The page you requested cannot be found!</p>
            <a href="./" style="text-decoration: none; color: #fff; background-color: #3AB34A; padding: 7px 10px; border-radius: 5px; font-size: 20px;">Go Back</a>
        </div>
        <div id="cart">
            <h4 style="text-align:center; margin:150px auto;">Your cart is empty.</h4>
        </div>
        <div style="display:none;" id="payment-wrap">
            <div class="cart-subtotal">
                <div class="line">
                    <p>Total</p>
                    <p id="total">₹0.00</p>
                </div>
                <div class="line">
                    <p>Shipping Charges</p>
                    <p>₹60.00</p>
                </div>
                <div class="line">
                    <p>Taxes</p>
                    <p id="tax">₹0.00</p>
                </div>

            </div>
            <div class="cart-total">
                <div class="line">
                    <p><b style="font-size: 1.2em;">Grand Total</b></p>
                    
                    <p id="grand-total">₹0.00</p>
                </div>
            </div>
        </div>

        <form action='checkout.php' method='post' id="checkoutForm">
            <input type='hidden' name='products[0][productID]' value='abc'>
            <input type='hidden' name='products[0][quantity]' value='2'>
    
            <input type='hidden' name='products[1][productID]' value='xyz'>
            <input type='hidden' name='products[1][quantity]' value='5'>\
            
            <button type="submit" id="checkoutBtn">Checkout</button>
        </form>
    
    </div>
    
</body>
<script src="./js/cart.js"></script>
</html>