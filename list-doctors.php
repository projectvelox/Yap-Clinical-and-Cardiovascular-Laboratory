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
					<h4 class="modal-title">Add a new doctor</span></h4>
				</div>
				<div class="modal-body">
					<form id="PackageFormNew">
						<!-- Form doctor Name-->
						<div class="form-group">
							<label>Doctor Name</label>
							<input type="text"
							class="form-control"
							name="formDoctorName"
							placeholder="Enter doctor name"
							required
							>
						</div>

						<!-- Form Doctor Address-->
						<div class="form-group">
							<label>Doctor Address</label>
							<textarea 
							class="form-control" 
							rows="5" 
							name="formDoctorAddress" 
							required>
						</textarea>
					</div>

					<!-- Form Doctor Contact-->
					<div class="form-group">
						<label>Contact Number</label>
						<input type="text"
						class="form-control"
						name="formDoctorContact"
						placeholder="Enter contact number"
						required
						>
					</div>

					<!-- Form Doctor Discount -->
					<div class="form-group">
						<label>Discount Percentage (%)</label>
						<input type="number"
						class="form-control"
						name="formDoctorDiscount"
						placeholder="Enter discount percentage"
						required
						min="0"
						max="100" 
						>
					</div>

					<hr>
					<!-- Submit -->
					<button type="submit"
					class="btn btn-primary">
					Add Doctor
				</button>
			</form>
		</div>
	</div>
</div>
</div>

<!-- Edit Form -->
<div id="modalEditForm" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit <span id="lblPackageCode"></span></h4>
			</div>
			<div class="modal-body">
				<form id="PackageForm">

					<!-- Form Doctor ID-->
					<div class="form-group">
						<input type="hidden"
						class="form-control"
						name="formDoctorId"
						placeholder="Enter doctor id"
						required 
						>
					</div>

					<!-- Form Doctor Name-->
					<div class="form-group">
						<label>Doctor Name</label>
						<input type="text"
						class="form-control"
						name="formDoctorNameEdit"
						placeholder="Enter doctor name"
						required 
						>
					</div>

					<!-- Form Doctor Address-->
					<div class="form-group">
						<label>Doctor Address</label>
						<textarea 
							class="form-control" 
							rows="5" 
							name="formDoctorAddressEdit" 
							required>
						</textarea>
				</div>

				<!-- Form Doctor Contact-->
				<div class="form-group">
					<label>Contact Number</label>
					<input type="text"
					class="form-control"
					name="formDoctorContactEdit"
					placeholder="Enter contact number"
					required
					>
				</div>

				<!-- Form Doctor Discount -->
				<div class="form-group">
					<label>Discount Percentage (%)</label>
					<input type="number" step="0.01"
					class="form-control"
					name="formDoctorDiscountEdit"
					placeholder="Enter discount percentage"
					min="0"
					max="100" 
					required
					>
				</div>
				<hr>
				<!-- Submit -->
				<button type="submit"
				class="btn btn-primary">
				Edit Doctor
			</button>
		</form>
	</div>
</div>
</div>
</div>

<ul class="breadcrumb">
	<li><a href="admin-dashboard.php">Dashboard</a></li>
	<li>Add/Edit Doctors</li>
</ul>

<div class="container yccl-mt-3">
	<h2>Add/Edit Doctor</h2>
	<div class="text-right">
		<div class="yccl-display-inlineblock text-left">
			<p class="yccl-mb-0"><strong>Action:</strong></p>
			<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalCreateForm">Add a new doctor</button>
		</div>
	</div><hr>

	<div class="table-responsive">          
		<table class="table table-striped" id="tblPackages">
			<thead>
				<tr>
					<th>#</th>
					<th>Doctor Name</th>
					<th>Address</th>
					<th>Contact</th>
					<th>Discount Percentage (%)</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=0;

				$con = mysqli_connect("localhost","root","","yccl");
				$result = mysqli_query($con,"SELECT * FROM doctor_details");
				while($row = mysqli_fetch_array($result))
				{
					$i++;
					echo "<tr>";
					echo "<td>" . $i . "</td>";
					echo "<td>" . $row['doctor_name'] . "</td>";
					echo "<td>" . $row['doctor_address'] . "</td>";
					echo "<td>" . $row['doctor_contact'] . "</td>";
					echo "<td>" . number_format($row['doctor_discount'],2) . "</td>";
					echo "
					<td>
					<button class='btn btn-xs btn-primary' data-doctorid='".$row['doctor_id']."' data-doctorname='".$row['doctor_name']."' data-doctoraddress='".$row['doctor_address']."' data-doctorcontact='".$row['doctor_contact']."' data-doctordiscount='".$row['doctor_discount']."' id='editModalPackage'><span class='glyphicon glyphicon-pencil'></span></button>
					</td>
					";
					echo "</tr>";
				}

				mysqli_close($con);
				?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		var Dialog = new BootstrapDialog({
			buttonClass: 'btn-primary'
		});

		function RefreshTable() {
			$("#tblPackages").load("list-doctors.php #tblPackages");
		}

        // Submit Registration Form
        $('#PackageFormNew').on('submit', function (e) {

        	$('#modalCreateForm').modal('hide');

        	e.preventDefault();
        	var serialized_array = $(this).serializeArray();
        	var data = {
        		action: 'add-doctor'
        	};
        	for(var i = 0; i < serialized_array.length; i++) {
        		var item = serialized_array[i];
        		data[item.name] = item.value;
        	}
        	Dialog.confirm('Are you sure?', 'Are you sure you want to add this newly created test to the list of tests?', function (yes) {
        		if(yes) {
        			var preloader = new Dialog.preloader('Adding doctors to the list of doctors');
        			$.ajax({
        				type: 'POST',
        				url: 'config/api.php',
        				data: data
        			}).then(function(data) {
        				if(data.error) Dialog.alert('Insertion of Doctor Errors: ' + data.error[0], data.error[1]);
        				else Dialog.alert('Added the Doctor Successfully', data.message,
        					function(OK) { 
        						RefreshTable();
        					});
        			}).catch(function (error) {
        				Dialog.alert('Insertion of Doctor Error', error.statusText || 'Server Error');
        			}).always(function () {
        				preloader.destroy();
        			});
        		}
        	});
        });

        $(document).on("click", "#editModalPackage", function() { 
        	$formDoctorId = $(this).data("doctorid");
        	$formDoctorNameEdit = $(this).data("doctorname");
        	$formDoctorAddressEdit = $(this).data("doctoraddress");
        	$formDoctorContactEdit = $(this).data("doctorcontact");
        	$formDoctorDiscountEdit = $(this).data("doctordiscount");

        	$('#lblPackageCode').text($formDoctorNameEdit);
        	$('input[name=formDoctorId]').val($formDoctorId);
        	$('input[name=formDoctorNameEdit]').val($formDoctorNameEdit);
        	$('textarea[name=formDoctorAddressEdit]').val($formDoctorAddressEdit);
        	$('input[name=formDoctorContactEdit]').val($formDoctorContactEdit);
        	$('input[name=formDoctorDiscountEdit]').val($formDoctorDiscountEdit.toFixed(2));

        	$('#modalEditForm').modal('show');
        });

    // Submit Registration Form
    $('#PackageForm').on('submit', function (e) {
    	$('#modalEditForm').modal('hide');

    	e.preventDefault();
    	var serialized_array = $(this).serializeArray();
    	var data = {
    		action: 'edit-doctor'
    	};
    	for(var i = 0; i < serialized_array.length; i++) {
    		var item = serialized_array[i];
    		data[item.name] = item.value;
    	}
    	Dialog.confirm('Are you sure?', 'Are you sure you want to edit this doctor details?', function (yes) {
    		if(yes) {
    			var preloader = new Dialog.preloader('Updating');
    			$.ajax({
    				type: 'POST',
    				url: 'config/api.php',
    				data: data
    			}).then(function(data) {
    				if(data.error) Dialog.alert('Updating Doctor Error: ' + data.error[0], data.error[1]);
    				else Dialog.alert('Updating Doctor Successful', data.message,
    					function(OK) { RefreshTable() });
    			}).catch(function (error) {
    				Dialog.alert('Updating Doctor Error', error.statusText || 'Server Error');
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