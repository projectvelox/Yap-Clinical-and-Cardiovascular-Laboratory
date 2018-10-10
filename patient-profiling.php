<!DOCTYPE html>
<html>
<!-- Head -->
<?php include 'views/partials/header.php'?>

<body>
	<?php include 'views/partials/navbar.php'?>
	<!-- Create Form -->
	<div id="modalCreateForm" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add a new center</span></h4>
						</div>
						<div class="modal-body">
							<form id="PackageFormNew">
								<!-- Form Center Name-->
								<div class="form-group">
									<label>Center Name</label>
									<input type="text"
									class="form-control"
									name="formCenterName"
									placeholder="Enter center name"
									required
									>
								</div>

								<!-- Form Center Address-->
								<div class="form-group">
									<label>Center Address</label>
									<textarea 
									class="form-control" 
									rows="5" 
									name="formCenterAddress" 
									required>
								</textarea>
							</div>

							<!-- Form Center Contact-->
							<div class="form-group">
								<label>Contact Number</label>
								<input type="text"
								class="form-control"
								name="formCenterContact"
								placeholder="Enter contact number"
								required
								>
							</div>

							<!-- Form Center Discount -->
							<div class="form-group">
								<label>Discount Percentage (%)</label>
								<input type="number" step="0.01"
								class="form-control"
								name="formCenterDiscount"
								placeholder="Enter discount percentage"
								required
								>
							</div>

							<hr>
							<!-- Submit -->
							<button type="submit"
							class="btn btn-primary">
							Add Center
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>


<ul class="breadcrumb">
	<li><a href="admin-dashboard.php">Dashboard</a></li>
	<li>Patient Profiling</li>
</ul>

<div class="container yccl-mt-3">
	<h2>Patient Profiling</h2><hr>
	<form id="PackageForm">
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<div class="row">
					<div class="col-xs-12 col-md-2">
						<div class="form-group">
						<label>Title</label>
						  <select class="form-control" name="formTitle">
						    <option value="Mr.">Mr.</option>
						    <option value="Mrs.">Mrs.</option>
						    <option value="Miss">Miss</option>
						    <option value="Master">Master</option>
						    <option value="Baby">Baby</option>
						    <option value="Master">Master</option>
						    <option value="Ven">Ven</option>
						    <option value="Dr">Dr</option>
						  </select>
						</div>
					</div>
					<div class="col-xs-12 col-md-10">
						<!-- Form Patient Name-->
						<div class="form-group">
							<label>Patient's Name</label>
							<input type="text"
								class="form-control"
								name="formPatient"
								placeholder="Enter patient's name"
								required 
							>
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<label>Birthdate</label>
						<div class="form-group">
							<input type="date"
								class="form-control"
								name="formBirthdate"
								required 
							>
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="form-group">
							<label>Sex</label>
						  	<select class="form-control" name="formSex">
							    <option value="Male">Male</option>
							    <option value="Female">Female</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="form-group">
							<label>Contact Number</label>
						  	<input type="text"
								class="form-control"
								name="formContact"
								placeholder="Enter patient's contact number"
								required 
							>
						</div>
					</div>
					<div class="col-xs-12 col-md-12">
						<div class="form-group">
							<label>Address</label>
						  	<textarea 
						  		class="form-control"
						  		name="formAddress" 
						  	>
						  		
						  	</textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="form-group">
                	<label>Center</label>
                	<select class="form-control" name="formCenter">
                	<option selected disabled>Please select a center</option>
                	<?php
							$con = mysqli_connect("localhost","root","","yccl");	
							$result = mysqli_query($con,"SELECT * FROM center_details");
							while($row = mysqli_fetch_array($result))
							{
								echo"<option value='".$row['center_name']."'>".$row['center_name']."</option>";
							}
							mysqli_close($con);
                	?> 
                	</select>
                </div>
                <div class="form-group">
                	<label>Doctor</label>
                	<select class="form-control" name="formDoctor" id="formDoctor">
                	<option selected disabled>Please select a doctor</option>
                	<?php
							$con = mysqli_connect("localhost","root","","yccl");	
							$result = mysqli_query($con,"SELECT * FROM doctor_details");
							while($row = mysqli_fetch_array($result))
							{
								echo"<option value='".$row['doctor_name']."' data-discount='".$row['doctor_discount']."'>".$row['doctor_name']."</option>";
							}
							mysqli_close($con);
                	?> 
                	</select>
                </div>
                <div class="form-group">
                	<label>Payment Type</label>
                	<select class="form-control" name="formPaymentType">
                		<option selected disabled>Please select a payment type</option>
                		<option value="Cash">Cash</option>
                		<option value="Card">Cash</option>
                	</select>
                </div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div class="form-group">
                	<label>Select the tests you want to include</label>
                	<?php
							$con = mysqli_connect("localhost","root","","yccl");	
							$result = mysqli_query($con,"SELECT * FROM test_details");
							while($row = mysqli_fetch_array($result))
							{
								$testcode = $row['test_code'];
								$testname = $row['test_name'];
								$testprice = $row['test_price'];
								echo"<div class='checkbox'>
									    <label><input type='checkbox' name='formTestDetails' data-price='".$row['test_price']."' value='".$row['test_id']."'>".$testcode. ' - ' . $testname. " (₱" . number_format($testprice,2) . ")</label>
									</div>";
							}
							mysqli_close($con);
                	?> 
                </div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="form-group">
                	<label>Select the packages you want to include</label>
                	<?php
							$con = mysqli_connect("localhost","root","","yccl");	
							$result = mysqli_query($con,"SELECT * FROM package_category");
							while($row = mysqli_fetch_array($result))
							{
								echo"<div class='checkbox'>
									    <label><input type='checkbox' name='formPackageDetails' data-price='".$row['package_price']."' value='".$row['package_id']."'>".$row['package_name']. " (₱" . number_format($row['package_price'],2) . ")</label>
									</div>";
							}
							mysqli_close($con);
                	?> 
                </div>
			</div>
			<div class="col-xs-12 col-md-4">
				<p><strong>Total Amount</strong></p>
				<p id="totalAmount">₱ 0.00</p>
				<p><strong>Discount</strong></p>
				<p id="discountAmount">0%</p>
				<p><strong>Net</strong></p>
				<p id="netAmount">₱ 0.00</p>

				<hr><button type="submit"
					class="btn btn-primary">
					Save and Print
				</button>
			</div>
		</div><hr>
		<!-- Submit -->
		
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		var Dialog = new BootstrapDialog({
			buttonClass: 'btn-primary'
		});

		$totalPrice = 0;
		$netPrice = 0;
		$dicountPrice = 0;

		$('#formDoctor').on('change', function() {

		  $discount =$("#formDoctor option:selected").data("discount").toString();
		  
		  if($discount.length==1){
		  	$dicountPrice = parseFloat(".0" + $("#formDoctor option:selected").data("discount"));
		  }
		  else {
		  	$dicountPrice = parseFloat("." + $("#formDoctor option:selected").data("discount"));
		  }

		  $("#discountAmount").text($dicountPrice.toFixed(2).substring(2) + "%");

		  $netPrice = $totalPrice - ($totalPrice * $dicountPrice);
	       $("#totalAmount").text("₱ " + $totalPrice.toFixed(2));
	       $("#netAmount").text("₱ " + $netPrice.toFixed(2));
		});

		$('#PackageForm :checkbox').change(function () {
		    if ($(this).is(':checked')) {
		       $totalPrice = parseFloat($(this).data("price")) + parseFloat($totalPrice);
		       $netPrice = $totalPrice - ($totalPrice * $dicountPrice);

		       $("#totalAmount").text("₱ " + $totalPrice.toFixed(2));
		       $("#netAmount").text("₱ " + $netPrice.toFixed(2));
		    } 
		    else {
		       $totalPrice = parseFloat($totalPrice) - parseFloat($(this).data("price"));
		       $netPrice = $totalPrice - ($totalPrice * $dicountPrice);

		       $("#totalAmount").text("₱ " + $totalPrice.toFixed(2));
		       $("#netAmount").text("₱ " + $netPrice.toFixed(2));

		    }
		});

		// Submit Registration Form
        $('#PackageForm').on('submit', function (e) {
        	var arrTest = [];
        	var arrPackage = [];

			$('input[name=formTestDetails]:checkbox:checked').each(function () {
			    arrTest.push($(this).val());
			});
			$('input[name=formPackageDetails]:checkbox:checked').each(function () {
			    arrPackage.push($(this).val());
			});


        	e.preventDefault();
        	var serialized_array = $(this).serializeArray();
        	var data = {
        		totalPrice: $totalPrice.toFixed(2),
				netPrice: $netPrice.toFixed(2),
				arrTest:arrTest,
				arrPackage:arrPackage,
        		action: 'add-invoice'
        	};
        	for(var i = 0; i < serialized_array.length; i++) {
        		var item = serialized_array[i];
        		data[item.name] = item.value;
        	}
        	Dialog.confirm('Are you sure?', 'Are you sure you want to save this now?', function (yes) {
        		if(yes) {
        			var preloader = new Dialog.preloader('Adding patient profile');
        			$.ajax({
        				type: 'POST',
        				url: 'config/ajax.php',
        				data: data
        			}).then(function(data) {
        				if(data.error) Dialog.alert('Adding patient profile error: ' + data.error[0], data.error[1]);
        				else Dialog.alert('Adding patient profile successful', data.message,
        					function(OK) { 
        						location.href='invoice.php';
        					});
        			}).catch(function (error) {
        				Dialog.alert('Adding patient profile error', error.statusText || 'Server Error');
        			}).always(function () {
        				preloader.destroy();
        			});
        		}
        	});
        });
		
	});
</script>
</body>
</html>