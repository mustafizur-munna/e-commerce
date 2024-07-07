<?php

require("config.php");

$product_title = $_POST["product_title"];
$product_desc = $_POST["product_desc"];

$product_image = $_FILES["product_image"];
$product_image_name = $product_image["name"];
$product_image_tmp_name = $product_image["tmp_name"];
$product_image_file_path = "product_image/".$product_image_name;
move_uploaded_file($product_image_tmp_name, $product_image_file_path);

$product_price = $_POST["product_price"];
$product_sale_price = $_POST["product_sale_price"];

if($conn){
    $query = "INSERT INTO `product`(`id`, `product_title`, `product_description`, `product_image`, `product_price`, `product_sale_price`) VALUES ('','$product_title','$product_desc','$product_image_file_path','$product_price','$product_sale_price')";
    $sql = mysqli_query($conn, $query);
    echo "Product saved successfully";
}



?>