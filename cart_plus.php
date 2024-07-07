<?php

session_start();

if(isset($_GET["incre_id"])){
    $incre_id = $_GET["incre_id"];

    foreach($_SESSION["cart"] as $k => $part){
        if($incre_id == $k){
            $_SESSION["cart"][$k]["product_qty"]++;
        }
    }
}

header("location: cart.php");

?>