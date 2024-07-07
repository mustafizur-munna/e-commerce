<?php
session_start();

$coupon_code = $_POST["coupon_code"];

$conn = mysqli_connect("localhost", "root", "", "php-classes");
$query = "SELECT * FROM coupon WHERE coupon_code = '$coupon_code'";
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);


if($row["coupon_code"] == $coupon_code){

    if($_SESSION["payment"]["coupon"] == $row["discount_percentage"]){
        header("location: cart.php?msgfailed=Coupon already applied");
    } else{

        if($row["coupon_status"] == "active"){
            $_SESSION["payment"]["coupon"] = $row["discount_percentage"];
            $_SESSION["payment"]["coupon_code"] = $row["coupon_code"];
        }

        header("location: cart.php?msgsuccess=Coupon Applied Successfully");
    }

} else{
    header("location: cart.php?msgfailed=Coupon Doesn't exist or Expired");
}


?>