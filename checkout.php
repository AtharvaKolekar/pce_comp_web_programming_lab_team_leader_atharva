<?php


if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: bazaar.php");
    exit(0);
}
session_start();
include('php/config.php');

//$_SESSION['GrandTotal'] = 0;

$posted = array();
if(!empty($_POST)) {
    foreach($_POST as $key => $value) {
        $posted[$key] = $value;
    }
}


if(empty($posted['txnid'])) {
    $txnid = time();
} else {
    $txnid = $posted['txnid'];
}

if(empty($posted['amount'])) {

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];

// print_r($uid);
// print_r($name);

$total = 0;

$products = $_POST['products'];



$uniqueFarmers = array();
$uniqueFarmersSubTotal = array();
$productUID = array();

foreach ($products as $index => $product) {
    $productID = $product['productID'];
    $quantity = $product['quantity'];
    
    
    $sql = "SELECT * FROM products WHERE pid ='{$productID}'";
    $result = mysqli_query($con, $sql);
    if(!$result && ($quantity<=0 || $quantity>6) ){
        break;
    } 

    $row = mysqli_fetch_assoc($result);

    if(!in_array( $row['uid'], $uniqueFarmers)) {
        $uniqueFarmers[] = $row['uid'];
        $uniqueFarmersSubTotal[] = $row['dprice'] * $quantity;
    }else{
        $keyyy = array_search($row['uid'], $uniqueFarmers);
        $uniqueFarmersSubTotal[$keyyy] = end($uniqueFarmersSubTotal) + $row['dprice'] * $quantity;
    }
    $productUID[] = $row['uid'];
    $total += $row['dprice'] * $quantity;
}



$_SESSION['uniqueFarmers'] = serialize($uniqueFarmers);
$_SESSION['uniqueFarmersSubTotal'] = serialize($uniqueFarmersSubTotal);
$_SESSION['products'] = serialize($products);



$GrandTotal = $total + $total * 0.1 + 60;

$cid = $uid;


$orderList = array();




// print_r("Order->");
// print_r($orderList);

// print_r("Product=");
// print_r($productUID);

$farmerID = $uniqueFarmers;
$ordersID = $orderList;
$productList = $productUID;

$neworderList = [];
foreach ($productList as $product) {
    // Find the index of the farmer ID corresponding to the product
    $index = array_search($product, $farmerID);
    if ($index !== false && isset($ordersID[$index])) {
        // Add the order ID corresponding to the farmer ID to the OrderList array
        $neworderList[] = $ordersID[$index];
    } else {
        // If no corresponding farmer ID is found, you can handle this case accordingly
        $neworderList[] = null; // or any default value you want to use
    }
}



foreach ($products as $index => $product) {
    $oid = $neworderList[$index];
    echo $oid;

    $productID = $product['productID'];
    $quantity = $product['quantity'];

    $sql = "INSERT INTO orderItems (oid, pid, quantity) VALUES ('{$oid}', '{$productID}', '{$quantity}')";
    $result = mysqli_query($con, $sql);

}

}else{
    $GrandTotal = $posted['amount'];


}

$MERCHANT_KEY = "x0ITz8";
$SALT = "QMeuRQvVfHthHRFrCqTwPYl0yY6mty4z";
// $txnid = time();
$PAYU_BASE_URL = "./payment.php"; 
$action = '';

// https://webscodex.medium.com/integrate-payumoney-payment-gateway-in-php-db07be0d70e3



$formError = 0;



$hash = '';

$hashSequence = "key|txnid|amount|productinfo|firstname|email";
if(empty($posted['hash']) && sizeof($posted) > 0) {

    if(empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) ) {
        $formError = 1;
    } else {
        $hashString = $posted['key'] . '|' . $posted['txnid'] . '|' . $posted['amount'] . '|' . $posted['productinfo'] . '|' . $posted['firstname'] . '|' . $posted['email'] . '|||||||||||' . $SALT;


        $hash = hash("sha512", $hashString);
        $action = $PAYU_BASE_URL ;
        $_SESSION['GrandTotal'] = 0;
    }
} elseif(!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL ;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./css/checkout.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">

    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <script>
    var hash = '<?php echo $hash ?>';

    function submitPayuForm() {
    if (hash == '') {
        return;
    }
    var payuForm = document.forms.payuForm;
    payuForm.submit();
    }
 </script>
</head>
<body onload="submitPayuForm()">
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
        <?php if($formError) { ?>
            <div class="alert alert-danger align-items-center">Please fill all mandatory fields.</div>
        <?php } ?>
        <form action="<?php echo $action; ?>" method="post" name="payuForm">
            <h2>Shipping Details</h2>
            <input type="hidden" id="key" name="key" value="<?php echo $MERCHANT_KEY ?>" />
            <input type="hidden" id="txnid" name="txnid" value="<?php echo $txnid ?>" />
            <input type="hidden" id="productinfo" name="productinfo" value="KisanBaazarItems" />
            <input type="hidden" id="amount" name="amount" value="<?php echo $GrandTotal ?>" />
            <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>" />

            <input type="hidden" id="surl" name="surl" value="http://localhost/Farmer/v4/status.php" />
            <input type="hidden" id="furl" name="furl" value="http://localhost/Farmer/v4/status.php" />

            <label for="firstname">Name </label>
            <input type="text" id="firstname" name="firstname" placeholder="Name" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" required>

            <label for="email">Email </label>
            <input type="email" id="email" name="email" placeholder="Email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" required>

            <label for="phone">Phone </label>
            <input type="number" id="phone" name="phone" placeholder="Phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" required>

            <label for="address1">Address Line 1 </label>
            <input type="text" id="address1" name="address1" placeholder="Address Line 1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" required>

            <label for="address2">Address Line 2 (Optional)</label>
            <input type="text" id="address2" name="address2" placeholder="Address Line 2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>">
            
            <label for="city">City</label>
            <input type="text" id="city" name="city" placeholder="City" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" required>

            <label for="state">State</label>
            <input type="text" id="state" name="state" placeholder="State" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" required>

            <label for="country">Country</label>
            <input type="text" id="country" name="country" placeholder="Country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" required>

            <label for="zipcode">Zipcode</label>
            <input type="number" id="zipcode" name="zipcode" placeholder="Zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" required>

            <button type="submit">Pay ₹<?php echo $GrandTotal;?></button>
        </form>
    
    </div>
    
</body>
<script>

</script>
</html>