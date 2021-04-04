<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'admin') {
		include("pm_topbar.php");
		include("..\..\connect.php");
	} else {
		header("Location: C:/wamp64/www/index.php");
		exit();
	}

	if (isset($_GET["supplier"])) {
		$supplier = $_GET["supplier"];
		$query = "SELECT * FROM suppliers WHERE name='$supplier';";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
	}
?>


<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Supplier Information</title>

		<style>
			td {
				padding-top: 10px;
				padding-bottom: 10px;
				padding-right: 10px;
				padding-left: 10px;
				border-bottom: 2px solid black;
			}
		</style>
	</head>

	<body>
		<br>
		<div class="container">
			<h3>Please Enter Supplier Information</h3>
			<br>

			<form action="<?php if (isset($supplier)) {echo "pm_supplier_edit_function.php?supplier=$supplier";} else { echo "pm_supplier_edit_function.php"; } ?>" method="post">
				<table style="width: 100%;">
					<tr>
						<td><label for="name">Name:</label></td>
						<td><input type="text" id="name" name="name" style="width: 100%;" value="<?php 	if (isset($supplier)) {
																									echo $row['name'];
																								} ?>">
						</td>
					</tr>
					
					<tr>
						<td><label for="address">Address:</label></td>
						<td><input type="text" id="address" name="address" style="width: 100%;" value="<?php 	if (isset($supplier)) {
																													echo $row['address'];
																												} ?>">
						</td>
					</tr>

					<tr>
						<td><label for="email">E-Mail:</label></td>
						<td><input type="text" id="email" name="email" style="width: 100%;" value="<?php 	if (isset($supplier)) {
																													echo $row['email'];
																												} ?>">
						</td>
					</tr>

					<tr>
						<td><label for="number">Phone Number:</label></td>
						<td><input type="text" id="number" name="number" style="width: 100%;" value="<?php 	if (isset($supplier)) {
																													echo $row['phone_number'];
																												} ?>">
						</td>
					</tr>

					<tr>
						<td><label for="fax">Fax Number:</label></td>
						<td><input type="text" id="fax" name="fax" style="width: 100%;" value="<?php 	if (isset($supplier)) {
																													echo $row['fax_number'];
																												} ?>">
						</td>
					</tr>

					<tr>
						<td><label for="contact">Contact(If applicable):</label></td>
						<td><input type="text" id="contact" name="contact" style="width: 100%;" value="<?php 	if (isset($supplier)) {
																													echo $row['contact'];
																												} ?>">
						</td>
					</tr>
				</table>
				<button type="submit" name="button" style="float: right; margin-top: 10px;">Submit</button>
			</form>
		</div>
	</body>
</html>
