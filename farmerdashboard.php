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
    <title>Farmer dashboard</title>
    <link rel="stylesheet" href="./css/fd.css">
    <style>
        #heading{
            margin: 5px;
            margin-left: 0px;
        }
        .Navigation-bar img{
            max-width: 100%;
            height: auto;
            margin: 5px;
        }
        h2{
            color: #3ab34a;
        }
        #pr{
            color: #3ab34a;
            padding-top: 0px;
            padding-left: 10px;
            font-size: medium;
        }
        s{
            color: #ccc;
        }
        #minus{
      height:fit-content;
      width: fit-content;
      border: none;
      cursor: pointer;
      padding: 0px;
      background-color: #fff;
     }
     #plus{
      height: fit-content;
      width: fit-content;
      border: none;
      cursor: pointer;
      padding: 0px;
      background-color: #fff;
      
     }
     input{
      width: 20px;
      height: 10px;
   }
     
        
    </style>
</head>
<body>
  <div class="Navigation-bar">
        <img src="./img/logo.png" alt="leaf" height="40" width="40"> 
        <h1 id="heading">KisaanBazaar</h1>
  </div>
  <div class="dashboard">
  <button id="game" onclick="window.open('farmerOrders.php')">
        <img src="./img/order.png" alt="add">
        <h2>Orders</h2>
    </button>
    <button id="game" onclick="window.open('addproducts.php')">
        <img src="./img/add.png" alt="add">
        <h2>Add Products</h2>
    </button>
    
  </div>
  <center>
    <h1 id="pr">Products</h1>
</center>
<div class="products">
    <?php
        $sql = "SELECT * FROM products WHERE uid = '{$uid}'";

        $result = mysqli_query($con, $sql);
        $queryResult = mysqli_num_rows($result);
        if(!$queryResult){
            echo "<h4>No products found</h4>";
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $pid=$row['pid'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $dprice = $row['dprice'];
                $stock=$row['stock_quantity'];
                $image = "http://kisanbazaar.iblogger.org/img/items/".$product_name.".jpg";   
                    ?>
                        <div class="plist" onclick="window.open('product.php?pid=<?php echo $pid ?>', '_blank')">
                            
                            <div>
                                <img src="<?php echo $image ?>" alt="<?php echo $product_name ?>" width="40" height="40" alt="<?php echo $product_name ?>">
                            </div>
                            <div>
                                <p><?php echo $product_name ?></p>
                                <p>₹<?php echo $dprice ?><s>₹<?php echo $price ?></s></p>
                                <p>Stock Quantity: <?php echo $stock ?></p>
                            </div>
                        </div>

                    <?php


            }
        }
    
    
    ?>


    
    
    </div>  
</div>


    
</body>
</html>