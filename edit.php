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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    
</body>
</html>
