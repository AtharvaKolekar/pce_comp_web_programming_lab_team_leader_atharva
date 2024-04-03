<?php
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
    <title>KisanBaazar</title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <link rel="stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
    <script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
</head>
<body>
    <div id="main">
        <header>
            <div class="logo">
                <img src="./img/logo.png" alt="logo" width="40" height="40">
                <h2>KisanBaazar</h2>
            </div>
            <div class="login-wrapper">
                <p class="login"><a style="text-decoration: none; color: #3AB34A;" href="./login.php">Login</a></p>
                <a style="text-decoration: none; color: #fff;" href="./register.php"><p class="register">Register</p></a>
            </div>
        </header>
        <div class="parallax">
            <div class="content">
                <h1>Fresh</h1>
                <h1>From</h1>
                <h1>Farm</h1>
                <p>Discover a world of fresh produce directly from local small-scale farmers to your urban doorstep—sustainability and freshness at your fingertips.</p>    
                <a  href="bazaar.php"><button class="shop">Shop Now</button></a>
            </div>

        </div>
        <div class="sec">
            <div class="heading1">
                <h1>✦ How to Register ✦</h1>
            </div>      
            <div class="video-wrapper">

                <video src="./img/video1.mp4" controls poster="./img/poster.avif"></video>
            </div>  
        </div>
        <div class="sec">
            <div class="heading1">
                <h1>✦ Locate Us ✦</h1>
            </div> 
            <div class="map-wrapper">
                <div id = "map" style = "width: 900px; height: 580px"></div>
            </div>     
            <br><br><br><br>
        </div>
        <footer>
            <p>Disclaimer: This website is for educational purposes only. No real products or services are sold here.</p>
            <b>&copy; 2024 KisanBaazar. All rights reserved.</b>
        </footer>
    </div>
    
</body>
<script>
    // Creating map options
    var mapOptions = {
       center: [18.9902, 73.1277],
       zoom: 16
    }
    
    // Creating a map object
    var map = new L.map('map', mapOptions);
    
    // Creating a Layer object
    var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    
    // Adding layer to the map
    map.addLayer(layer);

    // Creating a marker
    var marker = L.marker([18.9902, 73.1277]);
    
    // Adding marker to the map
    marker.addTo(map);
 </script>

<script>
        var mapOptions = {
            zoom: 16
        };

        // Creating a map object
        var map = new L.map('map', mapOptions);

        // Creating a Layer object
        var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

        // Adding layer to the map
        map.addLayer(layer);

        // Get user's geolocation
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Update map center
                map.setView([latitude, longitude]);

                // Create a marker at user's location
                var marker = L.marker([latitude, longitude]).addTo(map);
            });
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    </script>
</html>