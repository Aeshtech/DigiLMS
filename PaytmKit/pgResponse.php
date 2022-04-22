<?php
session_start();
if (!isset($_SESSION['is_login'])) {   //focefully starting session and login user again
	$_SESSION['is_login'] = true;
	$_SESSION['stuLogEmail'] = $_GET['CUST_ID'];
}
require_once('../dbConnection.php');
// require_once('../mainInclude/header.php');
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Payment Status</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.minified.css">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="../css/stustyle.css">
</head>

<body>

	<?php
	if ($isValidChecksum == "TRUE") {
		if ($_POST["STATUS"] == "TXN_SUCCESS") {
			echo '
		<div class="container">
		<div class="row align-items-center">
		<div class="col-12"><img src="../image/paidSuccessfully.gif" alt="Payment Sucessful" class="d-block mx-auto" style="height:40vw;" ></div>
		<div class="col text-center">
		<h3 class="text-success">Congratulations for buying course from Digi LMS </h3>
		<h6 class="text-primary">You will be redirecting to your  dashboard! </h6>
		</div>
		</div>
		</div>
		';

			//if payment is succesfully done than insert  the payment details and and assign the course purchased to the user.
			if (isset($_SESSION['is_login']) && isset($_SESSION['stuLogEmail'])) {
				$stuLogEmail = $_SESSION['stuLogEmail'];
				$course_id = urldecode($_GET['COURSE_ID']);
				$order_id = $_POST['ORDERID'];
				$status = $_POST['STATUS'];
				$respmsg = $_POST['RESPMSG'];
				$amount = $_POST['TXNAMOUNT'];

				date_default_timezone_set('Asia/Kolkata');
				$date = date('d-m-y h:i:s');

				$sql = "INSERT INTO `courseorder`( `order_id`, `stu_email`, `course_id`, `status`, `respmsg`, `amount`,`order_date`) VALUES ('$order_id','$stuLogEmail','$course_id','$status','$respmsg','$amount','$date')";
				if ($conn->query($sql) == false) {
					echo "Order Insertion Failed.";
				}
			}
	?>
			<script>
				//redirecting user to their dashboard.
				setTimeout(() => {
					window.location.href = "../Student/myCourse.php";
				}, 3000)
			</script>
		<?php
		} else {
			echo "<h3 class='bg-primary text-center'>Transaction Failure</h3>";
		?>
			<script>
				setTimeout(() => {
					window.location.href = "../index.php";
				}, 1500)
			</script>

	<?php
		}
	} else {
		echo "<h1 class='bg-danger text-center'>Checksum mismatched - Bad Request</h1>";
		//Process transaction as suspicious.
		
	}

	?>
</body>
<!-- Jquery and Boostrap JavaScript -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.minified.js"></script>

<!-- Font Awesome JS -->
<script type="text/javascript" src="js/all.min.js"></script>

<!-- Custom JavaScript -->
<script type="text/javascript" src="js/custom.js"></script>

</html>