<?php
   session_start();
include("php/config.php");
if(isset($_POST['search'])){
    $value = $_POST['search'];

    $sql = "SELECT users.*, products.* FROM users INNER JOIN products ON (users.uid = products.uid AND users.products>5) WHERE (products.product_name LIKE '%{$value}%') OR (products.tags LIKE '%{$value}%') OR (products.category LIKE '%{$value}%') OR (users.name LIKE '%{$value}%') OR (products.description LIKE '%{$value}%')";
    $result = mysqli_query($con, $sql);
    $queryResult = mysqli_num_rows($result);

    function calDistance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $distance = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515; // Distance in miles by default
        $distance = $distance * 1.609344; // Convert miles to kilometers
        return $distance;
    }

    if($queryResult > 0){?>

            <?php
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
            ?>


    <?php    
    }else{
        echo "<h4>No results found</h4>";
    }
}
?>