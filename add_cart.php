<?php

session_start();


if(isset($_GET["id"])){

    $id = $_GET["id"];

    $conn = mysqli_connect("localhost", "root", "", "php-classes");

    $query = "SELECT * FROM `products` WHERE product_id = $id";
    $sql = mysqli_query($conn, $query);

    $rows = mysqli_fetch_assoc($sql);

    $product_title = $rows["product_title"];
    $product_img = $rows["product_img"];
    $product_price = $rows["product_price"];


    // Session Start

    if(!empty($_SESSION["cart"])){
        $product_id_check = array_column($_SESSION["cart"], "id");
        if(in_array($id, $product_id_check)){
            $_SESSION["cart"][$id]["product_qty"]++;
        } else{
            $_SESSION["cart"][$id] = array(
                "id" => $id,
                "product_title" => $product_title,
                "product_img" => $product_img,
                "product_price" => $product_price,
                "product_qty" => 1
            );
        }
    } else{
        $_SESSION["cart"][$id] = array(
            "id" => $id,
            "product_title" => $product_title,
            "product_img" => $product_img,
            "product_price" => $product_price,
            "product_qty" => 1
        );
    }

header("location: index.php");


}


?>