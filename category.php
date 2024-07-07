<div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            <?php
                require("config.php");
                if($conn){
                    $query = "SELECT * FROM `categories`";
                    $sql = mysqli_query($conn, $query);
                    $rows_count = mysqli_num_rows($sql);
                    while($rows = mysqli_fetch_assoc($sql)){

            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img style="width: 70px; margin-top: 9px;" class="img-fluid" src="<?php echo $rows["cat_img"] ?>" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6><?php echo $rows["cat_name"];?></h6>
                            <small class="text-body"><?php echo "Code: ".$rows["cat_code"];?></small>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>