<?php
    session_start();

    unset($_SESSION["payment"]["coupon"]);
    unset($_SESSION["payment"]["coupon_code"]);
    header("location: cart.php");
?>