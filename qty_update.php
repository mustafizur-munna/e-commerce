<?php

session_start();

$id = $_GET["id"];

$cart_quantity = $_POST["cart_quantity"];

$_SESSION["cart"][$id]["product_qty"] = $cart_quantity;

header("location: single_product.php?id=$id");

?>