<?php

session_start();

if(isset($_GET["decre_id"])){
    $decre_id = $_GET["decre_id"];
    foreach($_SESSION["cart"] as $k => $part){
        if($decre_id == $k){
            if($_SESSION["cart"][$k]["product_qty"] > 1){
                $_SESSION["cart"][$k]["product_qty"]--;
            }
        }
    }
}

header("location: cart.php");

?>