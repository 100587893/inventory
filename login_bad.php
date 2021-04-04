<html>
	<head>
		<title>PPE Tracking</title>
		<style>
		body{
			margin: 0 auto;
			background-image: url("/img/bg.jpg");
		}
		.container{
			width: 30%;
			height: 600px;
			text-align:center;
			margin: 0 auto;
			background-color: 525252;
			margin-top: 5%;
		}
		.outside{
			color: red;
			font-size: 30px;
			text-align:center;
		}
		input[type="text"],input[type="password"] {
			height: 45px;
			width: 70%;
			font-size: 16px;
			margin-bottom: 20px;
			background-color: #fff;
			padding-left: 40px;
		}
		input[type="submit"]{
			margin-top: 10px;
			height: 45px;
			width: 150px;
			font-size: 16px;
			background-color: #000;
			color: white;
		}
		p{
			font-size: 22px;
			color: white;
			text-align:center;
		}
		h2{
			font-size: 40px;
			color: white;
			font-family: Georgia, "Times New Roman", Times, serif
		}
		
		</style>
	</head>
	<body>
        <div class="container">
       		<br>
        	<h2>Oxford College <br>PPE Inventory System</h2>
        	<br>
				<form action="authorize.php" method="POST">
                    <p>Username</p>
                    <input type="text" name="user" />
                    <p>Password</p>
                    <input type="password" name="pass" />
                    <p></p>
					<input type="submit" value="LOGIN" />
				</form>
		</div>
        <br>
        <br>
        <p class="outside">Incorrect Username/Password. Try Again!</p>
	</body>
</html>