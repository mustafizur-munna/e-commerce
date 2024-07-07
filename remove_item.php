<?php

session_start();

if(isset($_GET["remove_id"])){
    $remove_id = $_GET["remove_id"];
    foreach($_SESSION["cart"] as $k => $part){
        if($remove_id == $k){
            unset($_SESSION["cart"][$k]);
            header("location: cart.php");
        }
    }
}

?>