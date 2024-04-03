<?php 
ini_set('log_errors', 1);
ini_set('error_log', './handleErrors/error.log');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);

echo "hello";
if (!mysqli_connect("localhost","bad_user","bad_password","my_db")) {
    error_log("Not connected", 3, "./handleErrors/errors.log");//die("Couldn't connect");
 }
// ini_set('display_errors', 1);

?>
<?php
$password = $_POST["password"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if(password_verify($password, $hashed_password)) {
    echo "Password is valid!";
} else {
    echo "Invalid password.";
}

?>
