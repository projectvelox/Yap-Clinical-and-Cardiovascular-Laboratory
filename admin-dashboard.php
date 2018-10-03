<!DOCTYPE html>
<html>
<!-- Head -->
<?php include 'views/partials/header.php'?>

<body>
	<?php include 'views/partials/navbar.php'?>

	<div class="container">
		<h2>Admin Dashboard - Welcome <?php echo $_SESSION['account']['account_name'] ?></h2><hr>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h3>Master Data</h3><br>
				<div class="row">
					<div class="col-xs-6 col-md-3 yccl-icon-rotation">
						<img class="img-responsive" src="assets/images/icon-package.png">
						<p class="yccl-icon-text"><strong>Add/Edit Centers</strong></p>
					</div>
					<div class="col-xs-6 col-md-3 yccl-icon-rotation">
						<img class="img-responsive" src="assets/images/icon-package.png">
						<p class="yccl-icon-text"><strong>Add/Edit Doctors</strong></p>
					</div>
					<div class="col-xs-6 col-md-3 yccl-icon-rotation">
						<img class="img-responsive" src="assets/images/icon-package.png">
						<p class="yccl-icon-text"><strong>Add/Edit Tests</strong></p>
					</div>
					<div class="col-xs-6 col-md-3 yccl-icon-rotation">
						<img class="img-responsive" src="assets/images/icon-package.png">
						<p class="yccl-icon-text"><strong>Add/Edit Profiles</strong></p>
					</div>
					<div class="col-xs-6 col-md-3 yccl-icon-rotation">
						<img class="img-responsive" src="assets/images/icon-package.png">
						<p class="yccl-icon-text"><strong>Add/Edit Packages</strong></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>