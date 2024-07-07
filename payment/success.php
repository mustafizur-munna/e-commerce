<?php
require("../header.php");

    
$val_id=urlencode($_POST['val_id']);
$store_id=urlencode("elien65c5e2f446a04");
$store_passwd=urlencode("elien65c5e2f446a04@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

	# TO CONVERT AS ARRAY
	# $result = json_decode($result, true);
	# $status = $result['status'];

	# TO CONVERT AS OBJECT
	$result = json_decode($result);

	# TRANSACTION INFO
	$status = $result->status;
	$tran_date = $result->tran_date;
	$tran_id = $result->tran_id;
	$val_id = $result->val_id;
	$amount = $result->amount;
	$store_amount = $result->store_amount;
	$bank_tran_id = $result->bank_tran_id;
	$card_type = $result->card_type;

	# EMI INFO
	$emi_instalment = $result->emi_instalment;
	$emi_amount = $result->emi_amount;
	$emi_description = $result->emi_description;
	$emi_issuer = $result->emi_issuer;

	# ISSUER INFO
	$card_no = $result->card_no;
	$card_issuer = $result->card_issuer;
	$card_brand = $result->card_brand;
	$card_issuer_country = $result->card_issuer_country;
	$card_issuer_country_code = $result->card_issuer_country_code;

	# API AUTHENTICATION
	$APIConnect = $result->APIConnect;
	$validated_on = $result->validated_on;
	$gw_version = $result->gw_version;

} else {

	echo "Failed to connect with SSLCOMMERZ";
}



?>





<!-- My Codes -->


<?php

	$id = $_GET["id"];

	$conn = mysqli_connect("localhost", "root", "", "php-classes");
	$query = "SELECT * FROM `orders` WHERE order_id = '$id'";

	$sql = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($sql);

	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/style.css" rel="stylesheet">
    <style>
        .receipt-content .logo a:hover {
  text-decoration: none;
  color: #7793C4; 
}

.receipt-content .invoice-wrapper {
  background: #FFF;
  border: 1px solid #CDD3E2;
  box-shadow: 0px 0px 1px #CCC;
  padding: 40px 40px 60px;
  margin-top: 40px;
  border-radius: 4px; 
}

.receipt-content .invoice-wrapper .payment-details span {
  color: #A9B0BB;
  display: block; 
}
.receipt-content .invoice-wrapper .payment-details a {
  display: inline-block;
  margin-top: 5px; 
}

.receipt-content .invoice-wrapper .line-items .print a {
  display: inline-block;
  border: 1px solid #9CB5D6;
  padding: 13px 13px;
  border-radius: 5px;
  color: #708DC0;
  font-size: 13px;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear; 
}

.receipt-content .invoice-wrapper .line-items .print a:hover {
  text-decoration: none;
  border-color: #333;
  color: #333; 
}


@media (min-width: 1200px) {
  .receipt-content .container {width: 900px; } 
}

.receipt-content .logo {
  text-align: center;
  margin-top: 50px; 
}

.receipt-content .logo a {
  font-family: Myriad Pro, Lato, Helvetica Neue, Arial;
  font-size: 36px;
  letter-spacing: .1px;
  color: #555;
  font-weight: 300;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear; 
}

.receipt-content .invoice-wrapper .intro {
  line-height: 25px;
  color: #444; 
}

.receipt-content .invoice-wrapper .payment-info {
  margin-top: 25px;
  padding-top: 15px; 
}

.receipt-content .invoice-wrapper .payment-info span {
  color: #A9B0BB; 
}

.receipt-content .invoice-wrapper .payment-info strong {
  display: block;
  color: #444;
  margin-top: 3px; 
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-info .text-right {
  text-align: left;
  margin-top: 20px; } 
}
.receipt-content .invoice-wrapper .payment-details {
  border-top: 2px solid #EBECEE;
  margin-top: 30px;
  padding-top: 20px;
  line-height: 22px; 
}


@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-details .text-right {
  text-align: left;
  margin-top: 20px; } 
}
.receipt-content .invoice-wrapper .line-items {
  margin-top: 40px; 
}
.receipt-content .invoice-wrapper .line-items .headers {
  color: #A9B0BB;
  font-size: 13px;
  letter-spacing: .3px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 4px; 
}
.receipt-content .invoice-wrapper .line-items .items {
  margin-top: 8px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 8px; 
}
.receipt-content .invoice-wrapper .line-items .items .item {
  padding: 10px 0;
  color: #696969;
  font-size: 15px; 
}
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item {
  font-size: 13px; } 
}
.receipt-content .invoice-wrapper .line-items .items .item .amount {
  letter-spacing: 0.1px;
  color: #84868A;
  font-size: 16px;
 }
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item .amount {
  font-size: 13px; } 
}

.receipt-content .invoice-wrapper .line-items .total {
  margin-top: 30px; 
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes {
  float: left;
  width: 40%;
  text-align: left;
  font-size: 13px;
  color: #7A7A7A;
  line-height: 20px; 
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .total .extra-notes {
  width: 100%;
  margin-bottom: 30px;
  float: none; } 
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes strong {
  display: block;
  margin-bottom: 5px;
  color: #454545; 
}

.receipt-content .invoice-wrapper .line-items .total .field {
  margin-bottom: 7px;
  font-size: 14px;
  color: #555; 
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total {
  margin-top: 10px;
  font-size: 16px;
  font-weight: 500; 
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total span {
  color: #20A720;
  font-size: 16px; 
}

.receipt-content .invoice-wrapper .line-items .total .field span {
  display: inline-block;
  margin-left: 20px;
  min-width: 85px;
  color: #84868A;
  font-size: 15px; 
}

.receipt-content .invoice-wrapper .line-items .print {
  margin-top: 50px;
  text-align: center; 
}



.receipt-content .invoice-wrapper .line-items .print a i {
  margin-right: 3px;
  font-size: 14px; 
}

.receipt-content .footer {
  margin-top: 40px;
  margin-bottom: 110px;
  text-align: center;
  font-size: 12px;
  color: #969CAD; 
}
.items{
    margin-left: 15px;
}
.headers.clearfix {
    margin-left: 15px;
}
.headers.clearfix {
    margin-left: 15px;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
    justify-content: space-between;
}
    </style>
</head>
<body>


<div class="receipt-content">
    <div class="container bootstrap snippets bootdey">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice-wrapper">
				<div class="head d-flex justify-content-between">
				<a href="index.php" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">ELIEN</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Online</span>
                </a>
				<h1 style="display: inline-block; font-size: 50px;" class="mb-5">Paid Invoice</h1>
				</div>
					<div class="intro">
						Hi <strong><?php echo $row["full_name"]; ?></strong>, 
						<br>
						This is the payment invoice for the payment of <strong><?php echo "৳".$row["amount"]; ?></strong> (BDT).
					</div>

					<div class="payment-info">
						<div class="row">
							<div class="col-sm-6">
								<span>Reference No.</span>
								<strong><?php echo $tran_id; ?></strong>
							</div>
							<div class="col-sm-6 text-right">
								<span>Payment Date</span>
								<strong><?php echo $tran_date; ?></strong>
							</div>
						</div>
					</div>

					<div class="payment-details">
						<div class="row">
							<div class="col-sm-5">
								<span>Payer</span>
								<strong>
								<?php echo $row["full_name"]; ?>
								</strong>
								<p>
								<?php echo $row["address"]; ?> </br>
									<a class="text-dark" href="mailto:<?php echo $row["email"]; ?>">
									<?php echo $row["email"]; ?>
									</a>
								</p>
							</div>
							<div class="col-sm-7 text-right">
								<span>Payment To</span>
								<strong>
									ELIEN Online
								</strong>
								<p>
								Schiedam, Rotterdam, NL <br>
									<a class="text-dark" href="mailto:info@elienonline.com">
										info@elienonline.com
									</a>
								</p>
							</div>
						</div>
					</div>



						<table class="table table-light table-borderless table-hover text-left mb-5">
							<thead class="thead-dark">
								<tr>
									<th>S/N</th>
									<th>Product Name</th>
									<th>Product Quantity</th>
									<th>Amount</th>
								</tr>
							</thead>

							<tbody class="align-middle">
								<?php

									$sn = 0;
									if(isset($_SESSION["cart"])){
										foreach($_SESSION["cart"] as $k => $part){
											$sn++;

								?>
								<tr>
								<td><?php echo $sn; ?></td>
								<td class="align-middle"><?php echo $part["product_title"]; ?></td>
								<td class="align-middle"><?php echo $part["product_qty"]; ?></td>
								<td class="align-middle"><?php echo "৳".$_SESSION["payment"]["total"]; ?></td>
								</tr>
								<?php
										}
									}
								?>
							</tbody>


						</table>





						<div style="border-top: 1px solid #ddd;" class="total text-right pt-4">

							<div class="field">
								<strong>Subtotal: </strong> <span><?php echo "৳".$row["amount"]; ?></span>
							</div>
							<div class="field">
								<strong>Shipping: </strong> <span><?php echo "৳".$_SESSION["payment"]["shipping"]; ?></span>
							</div>
							<div class="field">
								<strong>Discount: </strong> <span><?php if($_SESSION["payment"]["discount"]){ echo "৳".$_SESSION["payment"]["discount"]; } else{ echo "৳0"; } ?></span>
							</div>
							<div class="field grand-total">
								<strong>Total</strong> <span><?php if($_SESSION["payment"]["total"]){ echo "৳".$_SESSION["payment"]["total"]; } else{ echo "৳0"; } ?></span>
							</div>
						</div>
						<div class="text-right">
							<h1>Thank You!</h1>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<?php
    require("../footer.php");
?>