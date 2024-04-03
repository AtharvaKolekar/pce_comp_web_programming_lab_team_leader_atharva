<?php

session_start();
ini_set('log_errors', 1);
ini_set('error_log', './handleErrors/error.log');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);

if(isset($_SESSION['user_type']) != "c") {
 header("Location: login.php");
 exit(0);
}
include("php/config.php");
$name = $_SESSION['name'];
$uid = $_SESSION['uid'];

$pid = $_GET['pid'];
if(isset($pid)){
    $sql = "SELECT * FROM products WHERE pid ='{$pid}'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $lat = 0;
    $lon = 0;

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
        <link rel="stylesheet" href="./css/product.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">
        <link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
        <script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
        <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">

    </head>
    <body>
        <div id="main">
            <header>
                <div class="logo">
                    <img src="./img/logo.png" alt="logo" width="40" height="40">
                    <h2>KisanBaazar</h2>
                </div>
                <div class="cart">
                    <a href="cart.php"><img src="./img/cart.png" alt="cart" width="30" height="30"></a>
                </div>
            </header>

            <?php
                if($row>0){
                    $product_name = $row['product_name'];
                    $weight = $row['weight'];
                    $category = $row['category'];
                    $description = $row['description'];
                
                    $price = $row['price'];
                    $dprice = $row['dprice'];
                    $discount = $row['discount'];
                    $uid = $row['uid'];
                
                    $sql = "SELECT * FROM users WHERE uid = '{$uid}'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['name'];
                    $city = $row['city'];
                    $bio = $row['bio'];
                    $lat = $row['lat'];
                    $lon = $row['lon'];
                
                    ?>
                    <div class="product-wrapper">
                        <div class="product-img-wrapper">
                            <div class="product-img">
                                <img src="./img/items/<?= $product_name ?>.jpg" alt="<?= $product_name ?>">
                            </div>
                        </div>
                        <div class="product-body">
                            <h1><?= $product_name ?> (<?= $weight ?>)</h1>
                            <h4><?= $category ?></h4>
                            <div class="price">
                                <h2>₹ <?= $dprice ?></h2>
                                <?php
                                if($discount > 0){
                                    ?>
                                   <p><s>₹ <?= $price ?></s></p>
                                    <?php
                                }
                                ?>
                            </div>
                            
                            <p>Quantity:
                                <select name="quantity" id="quantity">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>

                            </p>
                            <p class="description"><?= $description ?></p>
                            <button class="addtocart">
                                <div class="pretext">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                                </div>
                            
                                
                                <div class="pretext done">
                                <div class="posttext"><i class="fas fa-check"></i> ADDED</div>
                                </div>
                                
                            </button>
                
                        </div>
                    </div>
                    <div class="knowmore">
                        <h2>Know your seller</h2>
                        <div class="profile">
                            <img src="./img/farmer.jpg" alt="farmer">
                            <div class="text">
                                <h3><?= $name ?></h3>
                                <p><?= $city ?></p>
                            </div>
                        </div>
                        <div class="bio"><?= $bio ?></div>
                        <div class="map-wrapper">
                            <div id="map"></div>
                        </div>
                    </div>
                    <?php
            
                }else{
                    ?>
                    <div style="padding: 40px; text-align: center; font-size: 1.5em; font-weight: 700; color: #24732e;">
                        <img src="./img/404.png" alt="404" style="width: 100%; max-width: 300px;">
                        <p style="margin-bottom: 20px;">The page you requested cannot be found!</p>
                        <a href="./" style="text-decoration: none; color: #fff; background-color: #3AB34A; padding: 7px 10px; border-radius: 5px; font-size: 20px;">Go Back</a>
                    </div>
                    <?php
                }
            ?>

</div>
    
    </body>
    <script>
    const button = document.querySelector(".addtocart");
    const done = document.querySelector(".done");
    console.log(button);
    let added = false;

    button.addEventListener('click', () => {
      if (added) {
        done.style.transform = "translate(-110%) skew(-40deg)";
        added = false;
      } else
      {
        done.style.transform = "translate(0px)";
        added = true;
      }
    
    });

document.addEventListener('DOMContentLoaded', function() {
  const addToCartBtn = document.querySelector(".addtocart");
  const pid = "<?php echo $pid;?>";
  const productName = "<?php echo $product_name;?>";
  const price = "<?php echo $dprice;?>";
  const weight = "<?php echo $weight;?>";
  const farmerName = "<?php echo $name;?>";
  const img = "./img/items/<?= $product_name ?>.jpg";

  var quantity = document.getElementById('quantity').value;

 
  if (!localStorage.getItem('cartItems')) {
    localStorage.setItem('cartItems', JSON.stringify([]));
  }
  const cartItems = JSON.parse(localStorage.getItem('cartItems'));

  const cartItem = cartItems.find(item => item.pid === pid);

  if (cartItem) {
        done.style.transform = "translate(0px)";
        added = true;


  }else{
        done.style.transform = "translate(-110%) skew(-40deg)";
        added = false;
  }
  addToCartBtn.addEventListener('click', function() {
    quantity = document.getElementById('quantity').value;
    const existingIndex = cartItems.findIndex(item => item.pid === pid);

    if (added == true) {
      const item = { pid:pid, productName:productName, farmerName: farmerName, price: price, weight: weight, quantity: quantity, img: img };

      if (existingIndex === -1) {
        cartItems.push(item);
      }
      localStorage.setItem('cartItems', JSON.stringify(cartItems));
      done.style.transform = "translate(0px)";
    added = true;
    } else {
      if (existingIndex !== -1) {
        cartItems.splice(existingIndex, 1);
      }
      localStorage.setItem('cartItems', JSON.stringify(cartItems));
      done.style.transform = "translate(-110%) skew(-40deg)";
        added = false;
    }
  });
});



    
    
    var mapOptions = {
           center: [<?= $lat ?>, <?= $lon ?>],
           zoom: 8
        }

        var map = new L.map('map', mapOptions);
        var layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);
        var marker = L.marker([<?= $lat ?>, <?= $lon ?>]);
        marker.addTo(map);
    </script>
    </html>
        
    <?php



}else{
  header("Location: bazaar.php");
  exit(0);
}
?>
<!-- http://localhost/Farmer/v3/product.php?pid=5958d -->