<?php
// Set error logging to file
ini_set('log_errors', 1);
ini_set('error_log', './handleErrors/error.log');

try {
    $result = 1 / 0; 
} catch (Exception $e) {
    
    echo "Something went wrong";
}
?>
