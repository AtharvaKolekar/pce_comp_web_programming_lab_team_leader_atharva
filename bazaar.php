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
   $name = $_SESSION['name'];
   $uid = $_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#3AB34A">
    <title>KisanBaazar</title>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Inter" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="./css/bazaar.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    
</head>
<body>
    <div id="main">
        <header>
            <div class="logo">
                <img src="./img/logo.png" alt="logo" width="40" height="40">
                <h2>KisanBaazar</h2>
            </div>
            <a href="./logout.php"><img src="./img/power.png" alt="menu" width="30" height="30"></a>
            
        </header>
        <div class="cart-wrap">
            <div class="user">
                <h4>Welcome</h4>
                <h2><?= $name ?></h2>
            </div>
            <div class="cart">
                <a href="cart.php"><img src="./img/cart.png" alt="cart" width="30" height="30"></a>
            </div>
        </div>
        <div class="search-wrap">
            <input type="search" placeholder="Search" autocomplete="no" spellcheck="no" id="search">
            <img src="./img/filter.png" alt="filter" width="25" height="25">
        </div>
        <div class="slides">
            <img src="./img/banner1.webp" alt="banner1">
        </div>
        <div class="category-wrap">
            <h3>Categories</h3>
            <div class="category">
                <div class="item" onclick="window.open('productList.php?category=fruits', '_blank')">
                    <img src="./img/fruit.png" alt="fruits" width="60" height="60">
                    <p>Fruits</p>
                </div>
                <div class="item" onclick="window.open('productList.php?category=vegetables', '_blank')">
                    <img src="./img/vegetable.png" alt="vegetable" width="60" height="60">
                    <p>Vegies</p>
                </div>
                <div class="item" onclick="window.open('productList.php?category=grains', '_blank')">
                    <img src="./img/grain.png" alt="grain" width="60" height="60">
                    <p>Grains</p>
                </div>
                <div class="item" onclick="window.open('productList.php?category=dairy', '_blank')">
                    <img src="./img/milk.png" alt="Dairy" width="60" height="60">
                    <p>Dairy</p>
                </div>
                <div class="item" onclick="window.open('productList.php?category=flowers', '_blank')">
                    <img src="./img/flower.png" alt="flower" width="60" height="60">
                    <p>Flowers</p>
                </div>
                <div class="item" onclick="window.open('productList.php?category=spicies', '_blank')">
                    <img src="./img/spices.png" alt="spices" width="60" height="60">
                    <p>Spices</p>
                </div>
                <div class="item" onclick="window.open('productList.php?category=edible_oils', '_blank')">
                    <img src="./img/oil.png" alt="oil" width="60" height="60">
                    <p>Edible Oils</p>
                </div>
                <div class="item" onclick="window.open('productList.php?category=dry_fruits', '_blank')">
                    <img src="./img/dryfruit.png" alt="dryfruit" width="60" height="60">
                    <p>Dry Fruits</p>
                </div>
                <div class="item" onclick="window.open('productList.php?category=bakery', '_blank')">
                    <img src="./img/bread.png" alt="bread" width="60" height="60">
                    <p>Fresh Bakery</p>
                </div>
            </div>
        </div>
        <div class="todays-offer-wrap">
            <h3>Today's Special Offer</h3>
            <div class="todays-offer">
                <div class="card">
                    <img src="./img/items/apples.jpg" alt="apple">
                    <p>Apples (1kg)</p>
                    <b>₹200</b>
                    <s>₹250</s>
                    <p class="discount">20% off</p>
                </div>

                <div class="card">
                    <img src="./img/items/carrots.jpg" alt="carrot">
                    <p>Carrot (500g)</p>
                    <b>₹25</b>
                    <s>₹40</s>
                    <p class="discount">38% off</p>
                </div>

                <div class="card">
                    <img src="./img/items/bhendi.jpg" alt="bhendi">
                    <p>Bhendi (250g)</p>
                    <b>₹20</b>
                    <s>₹30</s>
                    <p class="discount">33% off</p>
                </div>

                <div class="card">
                    <img src="./img/items/rice.jpg" alt="rice">
                    <p>Rice (1kg)</p>
                    <b>₹80</b>
                    <s>₹100</s>
                    <p class="discount">20% off</p>
                </div>

                <div class="card">
                    <img src="./img/items/milk.jpg" alt="rice">
                    <p>Milk (500ml)</p>
                    <b>₹32</b>
                    <s>₹40</s>
                    <p class="discount">70% off</p>
                </div>

            </div>

        </div>
        <footer>
            <p>Copyright © 2024 KisanBaazar</p>
        </footer>
    </div>

    
</body>
<script>
    document.getElementById("search").addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    var value = this.value.trim();
    if (value !== "") {
        document.getElementById("search").value = "";
      window.open("productList.php?s=" + encodeURIComponent(value), "_blank");
    }
  }
});
</script>
</html>