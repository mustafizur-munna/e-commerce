
<div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
        <div class="row px-xl-5">
            <?php
                if($conn){
                    $query = "SELECT * FROM `products`";
                    $sql = mysqli_query($conn, $query);
                    while($rows = mysqli_fetch_assoc($sql)){

            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo $rows["product_img"]?>" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="add_cart.php?id=<?php echo $rows["product_id"]; ?>"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="single_product.php?id=<?php echo $rows["product_id"]; ?>"><?php echo $rows["product_title"]?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <p><?php echo $rows["product_price"]?></p><h6 class="text-muted ml-2"><del><?php echo $rows["product_price"]?></del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                                    }
                                }
            ?>
        </div>
    </div>