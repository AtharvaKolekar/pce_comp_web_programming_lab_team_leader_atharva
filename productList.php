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
   $name = $_SESSION['name'];
   $uid = $_SESSION['uid'];

    $s = $_GET['s'] ?? '';
    $cat = $_GET['category'] ?? '';

    function calDistance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $distance = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515; // Distance in miles by default
        $distance = $distance * 1.609344; // Convert miles to kilometers
        return $distance;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#3AB34A">
    <title>KisanBaazar</title>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Inter" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="./css/bazaar.css" >
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
            <input type="search" id="search" placeholder="Search" autocomplete="no" spellcheck="no">
            <img src="./img/filter.png" alt="filter" width="25" height="25" id="myFilterBtn">
        </div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Filter Products</h2>
    </div>
    <div class="modal-body">

    <p>Sort products by:</p>
      
    <input type="radio" name="sort" value="1" checked>
    <label for="sort">Name</label><br>

    <input type="radio" name="sort" value="2">
    <label for="sort">Price - Low to High</label><br>

    <input type="radio" name="sort" value="3">
    <label for="sort">Price - High to Low</label><br>

    <input type="radio" name="sort" value="4">
    <label for="sort">Neaby Areas</label><br>
    </div>
  </div>
</div>

<div id="product-list">
    <!-- <div class="product" onclick="window.open('product.php?pid=1234', '_blank')">
        <img style="height: 200px;" src="./img/items/mangoes.jpg" alt="carrot" >
        <h3>Mangoes (1Kg)</h3>
        <p>Atharva Kolekar</p>
        <b style="font-size: 1.2px; color: #3AB34A">₹270</b>
        <s>₹450</s>
        <p class="discount">40% off</p>
    </div>
</div> -->
    <?php
    include("php/config.php");
    if($s !=""){
        $value = $s; 
        $sql = "SELECT users.*, products.* FROM users INNER JOIN products ON (users.uid = products.uid AND users.products>5) WHERE (products.product_name LIKE '%{$value}%') OR (products.tags LIKE '%{$value}%') OR (products.category LIKE '%{$value}%') OR (users.name LIKE '%{$value}%') OR (products.description LIKE '%{$value}%')";

    }
    elseif($cat !=""){
        $value = $cat;
        $sql = "SELECT users.*, products.* FROM users INNER JOIN products ON (users.uid = products.uid AND users.products>5) WHERE (products.category LIKE '{$value}%')";
    }
    else{
    $sql = "SELECT users.*, products.* FROM users INNER JOIN products ON (users.uid = products.uid AND users.products>5)";
    }
    $result = mysqli_query($con, $sql);
    $queryResult = mysqli_num_rows($result);
    if(!$queryResult){
        echo "<h4>No results found</h4>";
    }else{
    while($row = mysqli_fetch_assoc($result)){
        $pid = $row['pid'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $dprice = $row['dprice'];
        $farmer = $row['name'];
        $weight = $row['weight'];
        $distance = calDistance($_SESSION['lat'], $_SESSION['lon'], $row['lat'], $row['lon']);
        $discount = $row['discount'];
        $image = "./img/items/".$product_name.".jpg";

        ?>
            <div class="product" onclick="window.open('product.php?pid=<?php echo $pid ?>', '_blank')">
                <img src="<?php echo $image ?>" alt="<?php echo $product_name ?>" >
                <h3><?php echo $product_name ?> (<?php echo $weight ?>)</h3>
                <p><?php echo $farmer ?></p>
                <b>₹<?php echo $dprice ?></b>
                <p class="Ndistance" style="display:none;"><?php echo $distance ?></p>
    
                <?php
                    if ($discount > 0) {
                    echo '<s>₹'.$price.'</s><p class="discount">'.$discount.'% off</p>';
                    }
                ?>

            </div>
        <?php  
    }
    }
    ?>
</div>
        <footer>
            <p>Copyright © 2024 KisanBaazar</p>
        </footer>
    </div>

    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>


    $(document).ready(function(){
        sortProductsByName();
        function sortProductsByName() {
            var products = $('#product-list .product');
            products.sort(function (a, b) {
                var nameA = $(a).find('h3').text().toUpperCase();
                var nameB = $(b).find('h3').text().toUpperCase();
                return (nameA < nameB) ? -1 : (nameA > nameB) ? 1 : 0;
            });
            $('#product-list').empty().append(products);
        }
          // Function to sort products by price (low to high)
          function sortProductsByLowToHigh() {
            var products = $('#product-list .product');
            products.sort(function (a, b) {
                var priceA = parseFloat($(a).find('b').text().replace('₹', ''));
                var priceB = parseFloat($(b).find('b').text().replace('₹', ''));
                return priceA - priceB;
            });
            $('#product-list').empty().append(products);
        }

        // Function to sort products by price (high to low)
        function sortProductsByHighToLow() {
            var products = $('#product-list .product');
            products.sort(function (a, b) {
                var priceA = parseFloat($(a).find('b').text().replace('₹', ''));
                var priceB = parseFloat($(b).find('b').text().replace('₹', ''));
                return priceB - priceA;
            });
            $('#product-list').empty().append(products);
        }

        function sortProductsByNearAreas() {
            var products = $('#product-list .product');
            products.sort(function (a, b) {
                var distanceA = parseFloat($(a).find('.Ndistance').text());
                var distanceB = parseFloat($(b).find('.Ndistance').text());
                return distanceA - distanceB;
            });
            $('#product-list').empty().append(products);
        }
        $('input[name="sort"]').change(function () {
            var selectedValue = $('input[name="sort"]:checked').val();
            switch (selectedValue) {
                case '1':
                    sortProductsByName();
                    break;
                case '2':
                    sortProductsByLowToHigh();
                    break;
                case '3':
                    sortProductsByHighToLow();
                    break;
                case '4':
                    sortProductsByNearAreas();
                    break;

                // Add cases for other options as needed
            }
        });
        $('#search').on('keyup', function(){
            var radioButtons = document.querySelectorAll('input[type="radio"][name="sort"]');

            // Loop through each radio button
            radioButtons.forEach(function(radioButton) {
                // Check if the radio button is checked
                if (radioButton.checked) {
                    radioButton.checked = false;
                }

            });
            radioButtons[0].checked = true;
            var value = $(this).val().toLowerCase();
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {
                    search: value
                },
                success: function(data){
                    $('#product-list').html(data);
                    sortProductsByName();

                }
            });

        });
    })

    // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myFilterBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</html>