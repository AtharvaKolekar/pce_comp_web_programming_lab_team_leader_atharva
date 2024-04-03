<?php

include("php/config.php");

session_start();


// ini_set('log_errors', 1);
//  ini_set('error_log', './handleErrors/error.log');
//  ini_set('error_reporting', E_ALL);
//  ini_set('display_errors', 0);

// include("php/config.php");
// if(isset($_SESSION['user_type']) != "f") {
//  header("Location: login.php");
//  exit(0);
// }

$uid = $_SESSION['uid']??"effea3f0";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Orders</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <style>
        *{
    margin: 0;
    padding: 0;
}
body {
    font-family: 'Inter', 'sans-serif';
    height: 100lvh;
    background-color: #F9F9F9;
}
body::-webkit-scrollbar{
    display: none;
}
#main{
    width: 100vw;
    max-width: 1200px;
    padding-bottom: 40px;
    margin: 0 auto ;
  

}

header{
    border-bottom: 2px solid #E1E1E1;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}
.logo{
    display: flex;
    align-items: center;
    padding: 20px 0;

}

.logo h2{
    margin-left: 10px;
    font-weight: 500;
    font-size: 24px;
}


.cart-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;

}
#cart{
    display: flex;
    flex-direction: column;
    padding:0 200px;

    /* border: 2px black solid; */

    

}
/* #cart  *{
    border: 2px solid black;

} */
#cart .item{
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 40px;

}
#cart .item p{
    margin: 3px 0;
    font-weight: 500;
}

#cart .item select{
    font-size: 1.2em;
    width: 120px;
    text-align: center;
}

#cart .item-img img{
    width:  150px;
    height: 100px;
    object-fit: contain;
    border: 1px solid #d1d1d1;
    background-color: #fff;
    border-radius: 7px;
}
#cart .item-remove{
    cursor: pointer;
}

.cart-subtotal{
    border-top: 2px solid #E1E1E1;
    display: flex;
    flex-direction: column;
    padding: 15px 0;

}
.cart-subtotal .line{
    display: flex;
    justify-content: space-between;
    padding: 0px 40px;

}
.cart-total{
    border-top: 2px solid #E1E1E1;
    display: flex;
    flex-direction: column;
    padding: 15px 0;

}
.cart-total .line{
    display: flex;
    justify-content: space-between;
    padding: 0px 40px;

}

.alert-message{
    color: red;
    margin: 10px 0;

}


#btn{
    font-size: 1.3em;
    padding: 10px ;
    width: 100%;
    background-color: #3AB34A;
    border: none;
    border-radius: 5px;
    outline: none;
    font-weight: bold;
    color: #fff;
    width: 100%;
    cursor: pointer;
 }

 @media screen and (max-width: 600px) {
    #cart .item{
        font-size: 0.9em;
        padding: 20px 20px;
    }
    #cart .item-img img{
        width:  70px;
        height: 60px;
        object-fit: contain;
        border: 1px solid #d1d1d1;
        background-color: #fff;
        border-radius: 7px;
    }
 }
    </style>
</head>
<body>
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
        <div class="cart-header">
            <h2>Farmer Orders</h2>  
        </div>
        </div>
        <div id="cart">
            <?php
                $sql = "SELECT oid, cid, fid, txnid, amount, status, city FROM orders WHERE fid = '{$uid}'";
                $result = mysqli_query($con, $sql);
                $queryResult = mysqli_num_rows($result);
                
                if(!$queryResult){
                    echo "<h4>No results found</h4>";
                }else{
                    while($row = mysqli_fetch_assoc($result)){
                        $oid = $row['oid'];
                        $fid = $row['fid'];
                        $cid = $row['cid'];
                        $txid = $row['txnid'];
                        $amount = $row['amount'];
                        $status = $row['status'];
                        $city = $row['city'];

                        $sql1 = "SELECT name FROM users WHERE uid = '{$cid}'";
                        $result1 = mysqli_query($con, $sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $name = $row1['name'];
                
                        // echo $oid . " " . $fid . " " . $txid . " " . $amount . " " . $status . "<br>";

                        ?>

                        <div class="item">
                            <div class="order-id">
                                <h3>#<?php echo $oid?></h3> 
                            </div>

                            <div class="Farmer name">
                                
                                <h2><?php echo $name?></h2>
                            </div>
                            <div >
                                    <h3><?php echo $city?></h3>           
                            </div>
                            <div class="stock-quantity">
                                    <h3>Rs <?php echo $amount?></h3>           
                            </div>
                            <div class="item-status">
                                <input type="hidden" name="oid" value="<?php echo $oid; ?>">
                                <select name="status" style="text-align:justify;">
                                <?php
                                    
                                    $statusList = array("Transaction Pending", "Transaction Error", "Order Placed", "Order Packed", "Order Out for Delivery", "Order Delivered");


                                    foreach ($statusList as $key => $sentence) {
                                        if ($sentence === $status) {
                                            echo "<option value='{$sentence}' selected>{$sentence}</option>";
                                            unset($sentences[$key]);
                                            continue;
                                        }
                                        
                                    }
                                ?>
                                        
                                </select>
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