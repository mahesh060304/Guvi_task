<?php
    require_once '../vendor/autoload.php';
    try {
        $con=mysqli_connect("localhost","root","","login");
    } catch (mysqli_sql_exception $e) {
        echo "Mysql connection failed: " . $e->getMessage();
    }

    $dbconnection= new MongoDB\Client('mongodb://localhost:27017');
    $db = $dbconnection->selectDatabase('user_details');
    $mycollection = $db->user_register;
 ?>
