<?php

require("header.php");

$grand_total = 0;
$shipping = 50;






?>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop.html">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Empty Button -->

    <div class="container-fluid">
        <div class="row px-xl-5 mb-4">
            <div class="col-12">
            <a href="empty_cart.php?empty=1" class="btn btn-primary">Empty Cart</a>
            </div>
        </div>
    </div>



    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        <?php
                            if(isset($_SESSION["cart"])){
                                foreach($_SESSION["cart"] as $k){
                        ?>
                            <tr>
                                <td class="align-middle"><img src="<?php echo $k["product_img"] ?>" alt="" style="width: 50px;"></td>
                                <td style="text-align: left;"><?php echo $k["product_title"] ?></td>          
                                <td class="align-middle"><?php echo "৳".$k["product_price"] ?></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <a class="btn btn-sm btn-primary btn-minus" href="cart_minus.php?decre_id=<?php echo $k["id"] ?>"><i class="fa fa-minus"></i></a>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $k['product_qty']; ?>">
                                        <div class="input-group-btn">
                                                <a class="btn btn-sm btn-primary btn-plus" href="cart_plus.php?incre_id=<?php echo $k["id"] ?>"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <?php
                                        $total_price = $k["product_price"] * $k["product_qty"];
                                        echo "৳".$total_price;
                                        $grand_total+=$total_price;
                                        $_SESSION["payment"]["total"] = $grand_total;
                                    ?>
                                </td>
                                <td class="align-middle"><a href="remove_item.php?remove_id=<?php echo $k["id"] ?>" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
                            </tr>
                        <?php
                        
                                }
                            }
                        ?>
                    </tbody>
                </table>

            </div>

            <div class="col-lg-4">
            <span style="color:red;"><?php if(isset($_GET["msgfailed"])){ echo $_GET["msgfailed"]; } ?></span>
            <span style="color:green;"><?php if(isset($_GET["msgsuccess"])){ echo $_GET["msgsuccess"]; } ?></span>
                <form class="mb-3" action="coupon_check.php" method="post">
                    <div class="input-group">
                        <input type="text" name="coupon_code" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <?php
                    if(!empty($_SESSION["payment"]["coupon"])){
                        ?>

                        <html>
                            <div class="bg-light p-3 mb-3 d-flex justify-content-between align-middle">
                                <span class="mt-2"><?php echo $_SESSION["payment"]["coupon_code"]; ?></span>
                                <a href="remove_coupon.php"><span class="btn btn-danger pt-1 pb-1">Remove</span></a>
                            </div>
                        </html>
                        
                        <?php
                    }
                ?>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between">
                            <h6>Subtotal</h6>
                            <h6>
                                <?php
                                        if(!empty($_SESSION["payment"]["coupon"])){
                                            
                                            $percentage = $_SESSION["payment"]["coupon"];
                                            $totalWidth = $_SESSION["payment"]["total"];

                                            $_SESSION["payment"]["product_total"] = $_SESSION["payment"]["total"];
                                    
                                            $discounted_price = ($percentage / 100) * $totalWidth;
                                            $_SESSION["payment"]["total"] -= $discounted_price;
                                            echo "৳".$grand_total;
                                        } else{
                                            echo "৳".$grand_total;
                                        }
                                ?>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"><?php if($grand_total > 0){ $_SESSION["payment"]["shipping"] = $shipping; echo "৳".$_SESSION["payment"]["shipping"]; } else{ echo "৳0"; } ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Discount</h6>
                            <h6 class="font-weight-medium">
                                <?php 
                                    if($grand_total > 0){
                                        if(isset($discounted_price)){
                                            $_SESSION["payment"]["discount"] = $discounted_price;
                                            echo "৳".$_SESSION["payment"]["discount"]; 
                                        } else{
                                            echo "৳0";
                                        }
                                    } else{
                                        echo "৳0";
                                    }
                                ?>
                            </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>
                                <?php
                                    if(isset($_SESSION["payment"])){
                                        if($grand_total > 0){
                                            $_SESSION["payment"]["total"] += $shipping;
                                            echo "৳".$_SESSION["payment"]["total"];
                                        } else{
                                            echo "৳0";
                                        }
                                    } else{
                                        echo "৳0";
                                    }
                                ?>
                            </h5>
                        </div>

                        <a href="checkout.php"><button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


    <!-- Footer Start -->
    <?php
        require("footer.php");
    ?>