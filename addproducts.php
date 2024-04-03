<?php

session_start();
ini_set('log_errors', 1);
ini_set('error_log', './handleErrors/error.log');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);

include("php/config.php");
if(isset($_SESSION['user_type']) != "f") {
header("Location: login.php");
exit(0);
}
$name = $_SESSION['name'];
$uid = $_SESSION['uid'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Products</title>
    <link rel="stylesheet" href="./css/addproduct.css">
    
   
</head>
<body>
<?php
                    
                    if(isset($_SESSION['message']))
                    {
                        echo '<script>alert("'.$_SESSION['message'].'");</script>';
                        unset($_SESSION['message']);
                    } 
                ?>
    <div id="main">
        <header>
            <div class="logo">
                <img src="./img/logo.png" alt="logo" width="40" height="40">
                <h2>KisanBaazar</h2>
            </div>
            </header>
        <div style="display: none; padding: 40px; text-align: center; font-size: 1.5em; font-weight: 700; color: #24732e;">
            <img src="./img/404.png" alt="404" style="width: 100%; max-width: 300px;">
            <p style="margin-bottom: 20px;">The page you requested cannot be found!</p>
            <a href="./" style="text-decoration: none; color: #fff; background-color: #3AB34A; padding: 7px 10px; border-radius: 5px; font-size: 20px;">Go Back</a>
        </div>
       
            <div class="container">
                <form action="addcode.php"  id="loginform" class="box" name="form" method="post">
                    <label for="category">Categories :</label>
                    <select name="category" id="category">
                        <option value="fruits">Fruits</option>
                        <option value="vegetables">Vegetables</option>
                        <option value="flowers">Flowers</option>
                    </select>
    
                    <label for="product">Product :</label>
                    <select name="pname" id="pname">
                        <optgroup label="Fruits">
                        <option value="Apples">Apples</option>
                        <option value="Bananas">Bananas</option>
                        <option value="Oranges">Oranges</option>
                        </optgroup>
                        <optgroup label="Vegetables">
                        <option value="Tomatoes">Tomatoes</option>
                        <option value="Potatoes">Potato</option>
                        <option value="Carrots">Carrots</option>
                        </optgroup>
                        <optgroup label="Flowers">
                        <option value="Tulips">Tulips</option>
                        <option value="Daisies">Daisies</option>
                        <option value="Sunflowers">Sunflowers</option>
                        </optgroup>
                        
                    

                    </select>
                    <!-- <label for="image">Product Image</label> -->
                    <!-- <img  src="https://via.placeholder.com/250x150" alt=" productitem"> -->
                    <label for="weight">Weight :</label>
                    <select name="weight" id="weight">
                        <option value="100g">100g</option>
                        <option value="250g">250g</option>
                        <option value="500g">500g</option>
                        <option value="1kg">1kg</option>
                        <option value="2kg">2kg</option>
                    </select>
                    <label for="">Price</label>
                    <input type="number" name="price" id="price"  oninput="calculateFinalPrice()">
                    <label for="">Discount</label>
                    <input type="number" name="discount" id="discount"  oninput="calculateFinalPrice()">
                    <label for="">Final Price</label>
                    <input type="number" name="finalprice"  id="finalprice" readonly>
                    <label for="">Description</label>
                    <textarea name="description"  cols="30" rows="5" id="description" ></textarea>
                    <label for="">Tags</label>
                    <input type="text" name="tags" id="tags" >
                    <label for="">Stock Quantity</label>
                    <input type="number" name="stock" id="stock">
                    <button id="addbtn" >Add </button>
                </form>
                




                
            </div>   
</body>
<script>
     document.getElementById("addbtn").addEventListener('click', function(e) {
     e.preventDefault();
     if(document.getElementById("price").value === ""){
        alert("Enter all fields !!");
         return;
     }
     if(document.getElementById("discount").value === ""){
        alert("Enter all fields !!");
        return;
     }
     if(document.getElementById("description").value === ""){
         alert("Enter all fields !!");
         return;
     }
     if(document.getElementById("tags").value === " "){
         alert("Enter all fields !!");
       return;
     }  
     document.getElementById("loginform").submit();

    
    
});

function calculateFinalPrice() {
            var price = parseFloat(document.getElementById("price").value);
            var discount = parseFloat(document.getElementById("discount").value);
            if (isNaN(price) || isNaN(discount)) {
                document.getElementById("finalprice").value = "";
                return;
            }
            if (price < 20 || price > 5000) {
                alert("Price must be between Rs.20 and RS.5000.");
                return;
            }
             if (discount > 60) {
                alert("Discount cannot exceed 60%.");
                return;
            }
            var finalPrice = price - (price * (discount / 100));
            document.getElementById("finalprice").value = finalPrice.toFixed(2);
        }

        
</script>
</html>
