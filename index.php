<!DOCTYPE html>
<html>
<!-- Head -->
<?php include 'views/partials/header.php'?>
<body>

	<!-- Modal -->
	<div id="loginModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Login in to your account</h4>
				</div>
				<div class="modal-body">
					<form id="LoginForm">
		                <!-- Username -->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="username"
		                           placeholder="Enter your username">
		                </div>

		                <!-- Password -->
		                <div class="form-group">
		                    <input type="password"
		                           class="form-control"
		                           name="password"
		                           placeholder="Enter your password">
		                </div>
		                <hr>
		                <!-- Submit -->
		                <button type="submit"
		                        class="btn btn-primary">
		                    Login
		                </button>
		            </form>
				</div>
			</div>
		</div>
	</div>

	<?php include 'views/partials/navbar.php'?>
	
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

	<script type="text/javascript">
		$(document).ready(function () {
        var Dialog = new BootstrapDialog({
            buttonClass: 'btn-primary'
        });

        // Submit Registration Form
        $('#LoginForm').on('submit', function (e) {
        	$('#loginModal').modal('hide');
            e.preventDefault();
            var serialized_array = $(this).serializeArray();
            var data = {action: 'login-account'};
            for(var i = 0; i < serialized_array.length; i++) {
                var item = serialized_array[i];
                data[item.name] = item.value;
            }
            var preloader = new Dialog.preloader('Logging in');
            $.ajax({
                type: 'POST',
                url: 'config/api.php',
                data: data
            }).then(function(data) {
                if(data.error) Dialog.alert('Login Error', data.error[1]);
                else {
                    new Dialog.preloader('Redirecting');
                    window.location.href = data.redirect;
                }
            }).catch(function (error) {
                Dialog.alert('Registration Error', error.statusText || 'Server Error');
            }).always(function () {
                preloader.destroy();
            });
        });
    });
	</script>
</body>
</html>