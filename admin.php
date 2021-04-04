<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSSION['access']='admin') {
} else {
	header("Location: C:/wamp64/www/index.php");
	exit();
}
?>
<html>
	<head>
		<title>ADMIN Access</title>
        <style>
			body{
				background-image: url(img/bg2.jpg);
			}
			.container{
				width: 600px;
				height: 750px;
				text-align:center;
				margin: 0 auto;
				background-color: grey;
				margin-top: 50px;
			}
			h2{
				font-size: 30px;
				color: white;
				font-family: Tahoma, Geneva, sans-serif;
			}
			input[type="submit"]{
				margin-top: 10px;
				height: 45px;
				width: 200px;
				font-size: 16px;
				background-color: white;
				color: black;
			}
		
		</style>
	</head>
	<body>
    	<div class="container">.
        	<br>
        	<h2>Select a Campus</h2>
            <hr>
            <br>
            <form action="scar/scar.php">
            	<input type="submit" value="Scarborough"/>     
			</form>
            <form action="tor/toronto.php">
            	<input type="submit" value="Toronto"/>     
			</form>
            <form action="miss/miss.php">
            	<input type="submit" value="Mississauga"/>     
			</form>
            <form action="peter/peter.php">
            	<input type="submit" value="Peterborough"/>     
			</form>
            <form action="bur/bur.php">
            	<input type="submit" value="Burlington"/>     
			</form>
            <form action="barrie/barrie.php">
            	<input type="submit" value="Barrie"/>     
			</form>
            <form action="warehouse/warehouse.php">
            	<input type="submit" value="Warehouse"/>     
			</form>
            <form action="purchasing/purchasing.php">
            	<input type="submit" value="Purchasing Manager"/>     
			</form>
            
        </div>
        
           	
	</body>
</html>