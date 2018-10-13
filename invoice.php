<!DOCTYPE html>
<html>
<!-- Head -->
<?php include 'views/partials/header.php'?>
<style type="text/css" media="print,screen">
	#hide { display: none; }
	@media print {
	.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
	  float: left;
	}
	.col-md-12 {
	  width: 100%;
	}
	.col-md-11 {
	  width: 91.66666666666666%;
	}
	.col-md-10 {
	  width: 83.33333333333334%;
	}
	.col-md-9 {
	  width: 75%;
	}
	.col-md-8 {
	  width: 66.66666666666666%;
	}
	.col-md-7 {
	  width: 58.333333333333336%;
	}
	.col-md-6 {
	  width: 50%;
	}
	.col-md-5 {
	  width: 41.66666666666667%;
	}
	.col-md-4 {
	  width: 33.33333333333333%;
	 }
	 .col-md-3 {
	   width: 25%;
	 }
	 .col-md-2 {
	   width: 16.666666666666664%;
	 }
	 .col-md-1 {
	  width: 8.333333333333332%;
	 }

  }
</style>
<body>
	<?php include 'views/partials/navbar.php'?>
	<ul class="breadcrumb" id="hide">
		<li><a href="admin-dashboard.php">Dashboard</a></li>
		<li><a href="patient-profiling.php">Patient Profiling</a></li>
		<li>Invoice</li>
	</ul>
	<div class="container">
		<?php 
			$con = mysqli_connect("localhost","root","","yccl");	
			$result = mysqli_query($con,"SELECT * FROM patient_profile ORDER BY invoice_id DESC LIMIT 1");
			while($row = mysqli_fetch_array($result))
			{
				$invoiceId = $row['invoice_id'];
				echo "<br>
					<h4><strong>Invoice Number:</strong> ".date('Y')."-INV".str_pad($row['invoice_id'], 5,'0',STR_PAD_LEFT)."</h4><hr>
					<div class='row'>
						<div class='col-xs-12 col-md-5'>
							<h4><strong>Invoice Details</strong></h4>
							<p><strong>Date:</strong> ".date('d-M-Y g:i A', strtotime($row['invoice_date']))."</p>
							<p><strong>Total Amount: </strong>" . $row['amount_total'] ."</p>
							<p><strong>Net Amount:</strong> " . $row['amount_total'] . "</p>
							<p><strong>Payment Type:</strong> " . $row['payment_type'] . "</p><br>

							<h4><strong>Patient Details</strong></h4>
							<p><strong>Name:</strong> ". $row['patient_title'] . " " . $row['patient_name']."</p>
							<p><strong>Birthdate:</strong> ". $row['patient_birthdate']."</p>
							<p><strong>Sex:</strong> ". $row['patient_sex']."</p>
							<p><strong>Address:</strong> ". $row['patient_address']."</p><br>

							<p><strong>Center:</strong> ". $row['patient_center']."</p>
							<p><strong>Doctor:</strong> ". $row['patient_doctor']."</p>
						</div>
					
						<div class='col-xs-12 col-md-7'>
							<div class='row'>
								<div class='col-xs-12 col-md-12'>
									<h4><strong>Package</strong></h4>
									<ul>";
									$packageResult = mysqli_query($con,"SELECT * FROM patient_package WHERE invoice_id = '$invoiceId'");
									while($packageRow = mysqli_fetch_array($packageResult))
									{
										echo "<li>" . $packageRow['package_code'] . " - " . $packageRow['package_name'] . " (₱ " . number_format($packageRow['package_price'],2) . ") " . "</li>";
									}

								echo "</ul>
										</div>
										<div class='col-xs-12 col-md-12'>
											<h4><strong>Profiles</strong></h4>
												<ul>";
									
									$profileResult = mysqli_query($con,"SELECT * FROM patient_profiles WHERE invoice_id = '$invoiceId'");
									while($profileRow = mysqli_fetch_array($profileResult))
									{
										echo "<li>" . $profileRow['profile_code'] . " - " . $profileRow['profile_name'] . " (₱ " . number_format($profileRow['profile_price'],2) . ") " . "</li>";
									}

								echo "</ul>
										</div>
										<div class='col-xs-12 col-md-12'>
											<h4><strong>Tests</strong></h4>
												<ul>";
									$testResult = mysqli_query($con,"SELECT * FROM patient_test WHERE invoice_id = '$invoiceId'");
									while($testRow = mysqli_fetch_array($testResult))
									{
										echo "<li>" . $testRow['test_code'] . " - " . $testRow['test_name'] . " (₱ " . number_format($testRow['test_price'],2) . ") " . "</li>";
									}
											echo "</ul>
										</div>
									</div>
								</div>
							</div>
							";

			}
			mysqli_close($con);
		?>
	</div>
	<script type="text/javascript">
		$( document ).ready(function() {
		    window.print();
		});
	</script>
</body>
</html>