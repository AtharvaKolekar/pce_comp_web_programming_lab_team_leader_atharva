<?php session_start(); 
ini_set('log_errors', 1);
ini_set('error_log', './handleErrors/error.log');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/register.css"></link>

    <title>Register</title>
    <script>
        function customAlert(message) {
        var alertBox = document.createElement("div");
        alertBox.setAttribute("id", "alertBox");
        alertBox.className = "alertBox";
        alertBox.innerHTML = message;
        document.body.appendChild(alertBox);
        setTimeout(function () {
        document.body.removeChild(alertBox);
        }, 5000);
    }



    </script>
</head>
<body onload="document.register.name.focus();">
                <?php
                    // Your message code
                    if(isset($_SESSION['message']))
                    {
                        echo '<script>customAlert("'.$_SESSION['message'].'");</script>';
                        unset($_SESSION['message']);
                    } // Your message code
                ?>
    <div class="container">
       <div class="box form-box">
        <header class="title">Sign Up</header>
        <form action="./registercode.php" name="register" id="reg" method="POST">
            <div class= "field input">
                <label for="name">Name</label>
                <input type="text" placeholder="Name" name="name" id="name">
            </div>

            <div class="field input">
               <label for="Mnumber">Mobile No</label>
               <input type="number" placeholder="Mobile No" name="Mnumber" id="Mnumber">
            </div>
             <div class="field input">
                <label for="pin">6-digit pin</label>
                <input type="number" placeholder="Pin" name="pin" id="pin">
             </div>
             <div class="field input">
               <label for="cpin">Confirm pin</label>
               <input type="password" placeholder="Pin" name="cpin" id="cpin">
            </div>
            <div class="field input">
               <label for="choice">Who are you?</label>
               <div class="choice">
                  <input type="radio" name="user_type" id="customer" value="c" checked>
                  <label for="customer">Customer</label><br>
                  <input type="radio" name="user_type" id="farmer" value="f"> 
                  <label for="farmer">Farmer</label><br>
               </div>
            </div>
            <input type="hidden" name="lat" id="lat" value="0">
            <input type="hidden" name="lon" id="lon" value="0">
            <input type="hidden" name="city" id="city" value="">
            <div id="fd">

            </div>


            <div id="success-message" style="display:none;">
               Registration successful!
             </div>
             <div class="field">
                <button class="btn" id="registerBtn">Register</button>
             </div>
             <div class="links">
                Already have account? <a href="index.html">Login</a>
             </div>
        </form>
       </div> 

    </div>
</body>
<script src="./js/register.js" type="text/javascript"></script>
</html>