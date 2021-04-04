<html>
	<head>
		<title>Inventory</title>
		<style>
		body{
			margin: 0 auto;
			text-align:center;
			background-image: url("img/inv.jpg");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			position: relative;
		}
		.container{
			width: 30%;
			height: 400px;
			text-align:center;
			margin: 0 auto;
			background: rgba(255, 255, 255, 0.5);
			border: solid;
			border-radius: 50px;
		}
		input[type="text"],input[type="password"] {
			height: 60px;
			width: 60%;
			font-size: 16px;
			margin-bottom: 20px;
			background-color: #fff;
			padding-left:10px;
		}
		input[type="submit"]{
			height: 60px;
			width: 50%;
			font-size: 20px;
			background: rgba(0,0,0, 0.5);
			border: solid;
			color: white;
			border-radius: 20px;
			font-family: Tahoma, Geneva, sans-serif;
			font-weight: bold;

		}
		p{
			font-size: 22px;
			color: white;
		}
		h2{
			font-size: 25px;
			color: black;
			font-family: Tahoma, Geneva, sans-serif;
		}
		
		</style>
	</head>
	<body>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
        <div class="container">
		<br>
        	<h2>Inventory and Purchase Ordering</h2>
        	<br>
		<form action="authorize.php" method="POST">
                	<input type="text" name="user" placeholder="Username" >
			<input type="password" name="pass" placeholder="Password"/>
			<br>
			<br>
			<br>
			<input type="submit" value="LOGIN" />
                </form>
	</div>
	</body>
</html>
