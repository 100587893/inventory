<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'purchasing') {
		include("../../connect.php");
		include("../../mailer.php");
		require_once("../vendor/autoload.php");
	} else {
		header("Location: ../../index.php");
		exit();
	}

	$campus = $_GET['campus'];
	$supplier = $_GET['supplier'];
	$required_by = $_POST['required_by'];

	$query = "SELECT id FROM purchase_orders ORDER BY id DESC LIMIT 1;";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$num = $row['id'];
	$po_id = $num + 1;

	$query = "SELECT * FROM requests WHERE status='approved' AND campus='$campus' AND supplier='$supplier';";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$uname = $row['username'];

	$query = "SELECT fullname, campus FROM user WHERE username='$uname';";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$fullname = $row['fullname'];
	$campus = $row['campus'];

	$query = "SELECT address FROM campuses WHERE campus='$campus';";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$address = $row['address'];

	$query = "SELECT * FROM suppliers WHERE name='$supplier';";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$phone = $row['phone_number'];
	$fax = $row['fax_number'];
	$email = $row['email'];
	$contact = $row['contact'];

	$order_total = 0.0;
	$item_total = 0.0;

	$html = "
			<style>
				h1 {
					text-align: center;
				}
				.subtext_label {
					text-align: center;
				}
				div.container1 {
					width: 25%;
					float: left;
					border: 1px solid black;
					padding: 5px;
				}
				div.container2 {
					width: 25%;
					float: left;
					border-style: solid solid solid solid;
					border-width: 1px 1px 1px 1pxl;
					border-color: black black black black;
					padding: 5px;
					margin-left: 45px;
				}
				table {
					width: 100%;
				}
				table, tr, th, td {
					border: 1px solid black;
				}
			</style>

			<div class='container'>
				<h1>Purchase Order</h1>
				<p class='subtext_label'><b>Supplier: </b> $supplier</p>

				<p><b>Date Ordered:</b> " .date('m/d/Y'). "</p>
				<p><b>P.O. #:</b> $po_id</p>
				<p><b>Date Required:</b> $required_by</p>
				<p><b>Requester's Name:</b> $fullname</p>
				<br>

				<div class='container1'>
					<h5><b>Bill To:</b></h5>
					<p>Oxford College</p>
					<p>300 Borough Drive,</p>
					<p>Scarborough, Ontario, Canada</p>
					<p>M1P 4P5</p>
				</div>

				<div class='container2'>
					<h5><b>Ship To:</b></h5>
					<p>Oxford College</p>
					<p>$address</p>
				</div>

				<div class='container2'>
					<p><b>Terms:</b> Credit Card</p>
					<p><b>Phone:</b> $phone</p>
					<p><b>Fax:</b> $fax</p>
					<p><b>Email:</b> $email</p>
					<p><b>Contact:</b> $contact</p>
				</div>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

				<table>
					<tr>
						<th>Item Number</th>
						<th>Description</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Item Total</th>
					</tr>";
	
	$query = "SELECT * FROM requests INNER JOIN product ON requests.product_id=product.product_id WHERE requests.status='approved' AND requests.campus='$campus' AND requests.supplier='$supplier';";
	$result = mysqli_query($conn, $query);
	$row = $result->fetch_assoc();
	$name = $row['name'];
	$qnty = $row['quantity'];
	$pid = $row['product_id'];
	$rid = $row['r_id'];


	$query = "SELECT * FROM requests WHERE status='approved' AND campus='$campus' AND supplier='$supplier';";
	$result = mysqli_query($conn, $query);

	
	while ($row = mysqli_fetch_assoc($result)) {
		$rid = $row['r_id'];
		$pid = $row['product_id'];
		$quantity = $row['quantity'];
		$unit_price = $row['unit_price'];
		
		$query = "SELECT * FROM product WHERE product_id='$pid';";
		$result2 = mysqli_query($conn, $query);
		$row2 = mysqli_fetch_assoc($result2);
		
		$serial = $row2['product_id'];
		$description = $row2['description'];
		$item_total = $quantity*$unit_price;
		
		$html .= "	<tr>
						<td>$serial</td>
						<td>$description</td>
						<td>$quantity</td>
						<td>$ " .$unit_price. "</td>
						<td>$ " .$item_total. "</td>
					</tr>";
		$order_total += $item_total;
		$item_total = 0.0;
		
		$query = "UPDATE requests SET po_number=$po_id WHERE r_id=$rid and product_id='$pid';";
		mysqli_query($conn, $query);
	}

	$html .= "</table>
				<br>
				<h5 class='total_label' style='float: right;'><b>Order Total:</b> $" .$order_total. "</h5>
			</div>";
	
	$pdf = new \Mpdf\Mpdf();

	$file_location = "PO_" .$po_id. ".pdf";

	$pdf->WriteHTML($html);
	$pdf->Output($file_location, "F");

	$query = "INSERT INTO purchase_orders VALUES ($po_id, '$file_location', 'approved', '$supplier', '$campus', '$fullname');";
	mysqli_query($conn, $query);

	header("Location: po_management.php?campus=$campus");
?>
