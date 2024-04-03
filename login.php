<?php 
   session_start(); 
   ini_set('log_errors', 1);
   ini_set('error_log', './handleErrors/error.log');
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 0);

   if(isset($_SESSION['user_type'])) {
    header("Location: bazaar.php");
    exit(0);
   }
?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/register.css"></link>

    <title>Login</title>
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
<body onload="document.login.Mnumber.focus();">
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
         <header class="title">Login</header>
         <form name="login" action="logincode.php" method="post" id="loginForm">
               <div class="field input">
                  <label for="Mnumber">Mobile No</label>
                  <input type="number" pattern="[0-9]{10}" name="Mnumber" placeholder="Mobile No" id="Mnumber">
               </div>
               <div class="field input">
                  <label for="pin">6-digit PIN</label>
                  <input type="number" pattern="[0-9]{6}" name="pin" placeholder="Pin No" id="pin">
               </div>
               <input type="hidden" name="lat" id="lat" value="0">
                <input type="hidden" name="lon" id="lon" value="0">
                <input type="hidden" name="city" id="city" value="">
               <div class="field">
                    <button class="btn" id="loginBtn">Login</button>
               </div>
               <div class="links">
                  <p>Don't have account? <a href="register.html">Register</a></p>
                  <!-- <br> -->
                  <p>Watch a video to know how to login <a href="video.html"> here </a></p>
                  
               </div>
               
         </form>
       </div> 
    </div>
</body>
<script src="./js/login.js"></script>
</html>