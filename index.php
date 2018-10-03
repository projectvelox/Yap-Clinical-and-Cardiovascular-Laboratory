<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
	<title>YCCL - Yap Clinical and Cardiovascular Laboratories</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<!-- Modal -->
	<div id="loginModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Login Modal</h4>
	      </div>
	      <div class="modal-body">
	        <p>Some text in the modal.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Navbar -->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="#">YCCL</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">About Us</a></li> 
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					<li><a data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<!-- Carousel -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="assets/images/bg-1.jpg">
			</div>

			<div class="item">
				<img src="assets/images/bg-2.jpg">
			</div>

			<div class="item">
				<img src="assets/images/bg-3.jpg">
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	
	<!-- Content -->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h3>What is YCCL?</h3>
				<p><strong>Yap Clinical and Cardiovascular Laboratories</strong></p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eleifend maximus libero sed condimentum. Pellentesque quis congue dolor, quis laoreet augue. Suspendisse id sapien vitae mauris scelerisque lacinia sed quis mi. Nam quis mauris eget justo semper vestibulum. Morbi fermentum fermentum eleifend. Morbi justo sem, eleifend sit amet ultricies sit amet, cursus non nulla. Donec interdum posuere elit, quis iaculis ante. Duis viverra, nulla eget iaculis imperdiet, ipsum arcu laoreet felis, sed consectetur mauris elit et ante. In tristique diam fringilla velit facilisis imperdiet. Praesent ac ipsum vel nulla dictum scelerisque. Sed non vestibulum ligula. Nunc at nisl enim. <br><br>

				Ut eleifend nunc nibh, ac luctus mauris molestie at. Integer quis pellentesque mi. Etiam elementum felis id nibh fermentum, vitae fermentum libero volutpat. Sed ultricies leo metus, sit amet auctor sapien placerat a. Donec consequat augue quis leo feugiat, convallis dapibus lorem venenatis. Suspendisse viverra fringilla ex ut vulputate. Morbi vitae tempor turpis. Suspendisse quis tortor posuere, tincidunt lectus ut, varius quam. Cras sed porta sem. Nunc vulputate massa ut nibh tincidunt, eget tempor nisi viverra. Etiam posuere nibh non efficitur commodo. Maecenas eu lectus ac dui vulputate egestas fringilla et lectus. Nullam euismod mattis augue, ut mollis purus consectetur ut.</p>
			</div>
			<div class="col-xs-12 col-md-6 hidden-xs">
				<div class="img-responsive">
					<img src="assets/images/heart.gif" height="500">
				</div>
			</div>
		</div>
		<hr>
	</div>
	<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>