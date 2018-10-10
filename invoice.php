<!DOCTYPE html>
<html>
<!-- Head -->
<?php include 'views/partials/header.php'?>
<style type="text/css" media="print,screen">
	#hide { display: none; }
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
						<div class='col-xs-12 col-md-3'>
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
					
						<div class='col-xs-12 col-md-9'>
							<div class='row'>
								<div class='col-xs-12 col-md-6'>
									<h4><strong>Tests</strong></h4>
									<ul>";

									$testResult = mysqli_query($con,"SELECT * FROM patient_test WHERE invoice_id = '$invoiceId'");
									while($testRow = mysqli_fetch_array($testResult))
									{
										echo "<li>" . $testRow['test_code'] . " - " . $testRow['test_name'] . " (₱ " . number_format($testRow['test_price'],2) . ") " . "</li>";
									}

								echo "</ul>
										</div>
										<div class='col-xs-12 col-md-6'>
											<h4><strong>Package</strong></h4>
												<ul>";
									$packageResult = mysqli_query($con,"SELECT * FROM patient_package WHERE invoice_id = '$invoiceId'");
									while($packageRow = mysqli_fetch_array($packageResult))
									{
										echo "<li>" . $packageRow['package_code'] . " - " . $packageRow['package_name'] . " (₱ " . number_format($packageRow['package_price'],2) . ") " . "</li>";
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