<!DOCTYPE html>
<html>
<!-- Head -->
<?php include 'views/partials/header.php'?>

<body>
	<?php include 'views/partials/navbar.php'?>
	<?php include 'views/partials/unavailable.php'?>


	<div class="container">
		<h2>Admin Dashboard - Welcome <?php echo $_SESSION['account']['account_name'] ?></h2><hr>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h3>Master Data</h3><br>
				<div class="row">
					
					<div class="col-xs-4 col-md-3 yccl-icon-rotation">
						<a href="list-centers.php">
							<img class="img-responsive" src="assets/images/icon-package.png">
							<p class="yccl-icon-text"><strong>Add/Edit<br>Centers</strong></p>
						</a>
					</div> <!--
					<div class="col-xs-4 col-md-3 yccl-icon-rotation">
						<a data-toggle="modal" data-target="#unavailable">
							<img class="img-responsive" src="assets/images/icon-package.png">
							<p class="yccl-icon-text"><strong>Add/Edit<br>Doctors</strong></p>
						</a>
					</div> 

					<div class="col-xs-4 col-md-3 yccl-icon-rotation">
						<a data-toggle="modal" data-target="#unavailable">
							<img class="img-responsive" src="assets/images/icon-package.png">
							<p class="yccl-icon-text"><strong>Add/Edit<br>Profiles</strong></p>
						</a>
					</div>

					-->
					<div class="col-xs-4 col-md-3 yccl-icon-rotation">
						<a href="list-test.php">
							<img class="img-responsive" src="assets/images/icon-package.png">
							<p class="yccl-icon-text"><strong>Add/Edit<br>Tests</strong></p>
						</a>
					</div>
					
					<div class="col-xs-4 col-md-3 yccl-icon-rotation">
						<a href="list-packages.php">
							<img class="img-responsive" src="assets/images/icon-package.png">
							<p class="yccl-icon-text"><strong>Add/Edit<br>Packages</strong></p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>