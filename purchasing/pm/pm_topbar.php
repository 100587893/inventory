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
			<a class="navbar-brand pb-2" href="pm_home.php"><img src="../oxfordlogo.png" width="300"></a>

			<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button> -->

			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav p-2">
					<li class="nav-item">
						<a class="nav-link" href="pm_home.php">Home</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Orders
						</a>

						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

							<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Active</a>
								<ul class="dropdown-menu">
									<li class="dropdown-item"><a href="pm_active_requests.php?campus=Barrie">Barrie</a></li>
									<li class="dropdown-item"><a href="pm_active_requests.php?campus=Burlington">Burlington</a></li>
									<li class="dropdown-item"><a href="pm_active_requests.php?campus=Scarborough">Scarborough</a></li>
								</ul>
							</li>

							<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">History</a>
								<ul class="dropdown-menu">
									<li class="dropdown-item"><a href="pm_request_history.php?campus=Barrie">Barrie</a></li>
									<li class="dropdown-item"><a href="pm_request_history.php?campus=Burlington">Burlington</a></li>
									<li class="dropdown-item"><a href="pm_request_history.php?campus=Scarborough">Scarborough</a></li>
								</ul>
							</li>
						</ul>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							New Item Requests
						</a>

						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

							<li class="dropdown-item">
								<a href="pm_item_requests.php?campus=Barrie">Barrie</a>
							</li>
							<li class="dropdown-item">
								<a href="pm_item_requests.php?campus=Burlington">Burlington</a>
							</li>
							<li class="dropdown-item">
								<a href="pm_item_requests.php?campus=Scarborough">Scarborough</a>
							</li>
						</ul>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Inventory
						</a>

						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

							<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Current</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li class="dropdown-item">
										<a href="pm_inventory.php?campus=Barrie">Barrie</a>
									</li>
									<li class="dropdown-item">
										<a href="pm_inventory.php?campus=Burlington">Burlington</a>
									</li>
									<li class="dropdown-item">
										<a href="pm_inventory.php?campus=Scarborough">Scarborough</a>
									</li>
									<li class="dropdown-item">
										<a href="pm_inventory.php?campus=Warehouse">Warehouse</a>
									</li>
								</ul>
							</li>

							<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">History</a>
								<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
									<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Additions</a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li class="dropdown-item">
												<a href="pm_add_history.php?campus=Barrie">Barrie</a>
											</li>
											<li class="dropdown-item">
												<a href="pm_add_history.php?campus=Burlington">Burlington</a>
											</li>
											<li class="dropdown-item">
												<a href="pm_add_history.php?campus=Scarborough">Scarborough</a>
											</li>
										</ul>
									</li>

									<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Removals</a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li class="dropdown-item">
												<a href="pm_sub_history.php?campus=Barrie">Barrie</a>
											</li>
											<li class="dropdown-item">
												<a href="pm_sub_history.php?campus=Burlington">Burlington</a>
											</li>
											<li class="dropdown-item">
												<a href="pm_sub_history.php?campus=Scarborough">Scarborough</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Management
						</a>

						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

							<li class="dropdown-item">
								<a href="product_management.php">Product Management</a>
							</li>

							<li class="dropdown-item">
								<a href="supplier_management.php">Supplier Management</a>
							</li>
						</ul>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							PO Management
						</a>

						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

							<li class="dropdown-item">
								<a href="po_management.php?campus=Barrie">Barrie</a>
							</li>
							<li class="dropdown-item">
								<a href="po_management.php?campus=Burlington">Burlington</a>
							</li>
							<li class="dropdown-item">
								<a href="po_management.php?campus=Scarborough">Scarborough</a>
							</li>
							<li class="dropdown-item">
								<a href="po_management.php?campus=Warehouse">Warehouse</a>
							</li>
						</ul>
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