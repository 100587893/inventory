<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<style>
			.navbar-nav li:hover > ul.dropdown-menu {
				display: block;
			}
			.dropdown-submenu {
				position:relative;
			}
			.dropdown-submenu>.dropdown-menu {
				top:0;
				/*left:-100%;*/
				right: 10rem; /* 10rem is the min-width of dropdown-menu */
				left: 100%;
				margin-top:-6px;
			}

			/* rotate caret on hover */
			.dropdown-menu > li > a:hover:after {
				text-decoration: underline;
				transform: rotate(-90deg);
			}
			a:link {
				color: black;
			}
			a:visited {
				color: black;
			}
		</style>
	</head>

	<body>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<a class="navbar-brand pb-2" href="wm_home.php"><img src="../oxfordlogo.png" width="300"></a>

			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav p-2">
					<li class="nav-item">
						<a class="nav-link" href="wm_home.php">Home</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="wm_local_inv.php">Warehouse Inventory</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Active Orders
						</a>

						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

							<li class="dropdown-item">
								<a href="wm_active_requests.php?campus=Barrie">Barrie</a>
							</li>
							<li class="dropdown-item">
								<a href="wm_active_requests.php?campus=Burlington">Burlington</a>
							</li>
							<li class="dropdown-item">
								<a href="wm_active_requests.php?campus=Mississauga">Mississauga</a>
							</li>
							<li class="dropdown-item">
								<a href="wm_active_requests.php?campus=Peterborough">Peterborough</a>
							</li>
							<li class="dropdown-item">
								<a href="wm_active_requests.php?campus=Scarborough">Scarborough</a>
							</li>
							<li class="dropdown-item">
								<a href="wm_active_requests.php?campus=Toronto">Toronto</a>
							</li>
						</ul>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="wm_recieve_history.php">Receive History</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="wm_ship_history.php">Ship History</a>
					</li>
				</ul>
			</div>
			<a href="../../logout.php"><button type="button" class="btn btn-danger" style="float: right;">Logout</button></a>
		</nav>

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>