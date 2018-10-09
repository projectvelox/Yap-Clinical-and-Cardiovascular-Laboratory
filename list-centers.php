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

					<!-- Form Center ID-->
					<div class="form-group">
						<input type="hidden"
						class="form-control"
						name="formCenterId"
						placeholder="Enter center id"
						required 
						>
					</div>

					<!-- Form Center Name-->
					<div class="form-group">
						<label>Center Name</label>
						<input type="text"
						class="form-control"
						name="formCenterNameEdit"
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
							name="formCenterAddressEdit" 
							required>
						</textarea>
				</div>

				<!-- Form Center Contact-->
				<div class="form-group">
					<label>Contact Number</label>
					<input type="text"
					class="form-control"
					name="formCenterContactEdit"
					placeholder="Enter contact number"
					required
					>
				</div>

				<!-- Form Center Discount -->
				<div class="form-group">
					<label>Discount Percentage (%)</label>
					<input type="number" step="0.01"
					class="form-control"
					name="formCenterDiscountEdit"
					placeholder="Enter discount percentage"
					required
					>
				</div>
				<hr>
				<!-- Submit -->
				<button type="submit"
				class="btn btn-primary">
				Edit Center
			</button>
		</form>
	</div>
</div>
</div>
</div>

<ul class="breadcrumb">
	<li><a href="admin-dashboard.php">Dashboard</a></li>
	<li>Add/Edit Centers</li>
</ul>

<div class="container yccl-mt-3">
	<h2>Add/Edit Centers</h2>
	<div class="text-right">
		<div class="yccl-display-inlineblock text-left">
			<p class="yccl-mb-0"><strong>Action:</strong></p>
			<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalCreateForm">Add a new center</button>
		</div>
	</div><hr>

	<div class="table-responsive">          
		<table class="table table-striped" id="tblPackages">
			<thead>
				<tr>
					<th>#</th>
					<th>Center Name</th>
					<th>Address</th>
					<th>Contact</th>
					<th>Discount Percentage (%)</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=0;

				if(empty($_GET['status'])) { $status = ''; }
				else { $status = $_GET['status']; }

				$con = mysqli_connect("localhost","root","","yccl");
				$result = mysqli_query($con,"SELECT * FROM center_details");
				while($row = mysqli_fetch_array($result))
				{
					$i++;
					echo "<tr>";
					echo "<td>" . $i . "</td>";
					echo "<td>" . $row['center_name'] . "</td>";
					echo "<td>" . $row['center_address'] . "</td>";
					echo "<td>" . $row['center_contact'] . "</td>";
					echo "<td>" . number_format($row['center_discount'],2) . "</td>";
					echo "
					<td>
					<button class='btn btn-xs btn-primary' data-centerid='".$row['center_id']."' data-centername='".$row['center_name']."' data-centeraddress='".$row['center_address']."' data-centercontact='".$row['center_contact']."' data-centerdiscount='".$row['center_discount']."' id='editModalPackage'><span class='glyphicon glyphicon-pencil'></span></button>
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
			$("#tblPackages").load("list-centers.php #tblPackages");
		}

        // Submit Registration Form
        $('#PackageFormNew').on('submit', function (e) {

        	$('#modalCreateForm').modal('hide');

        	e.preventDefault();
        	var serialized_array = $(this).serializeArray();
        	var data = {
        		action: 'add-center'
        	};
        	for(var i = 0; i < serialized_array.length; i++) {
        		var item = serialized_array[i];
        		data[item.name] = item.value;
        	}
        	Dialog.confirm('Are you sure?', 'Are you sure you want to add this newly created test to the list of tests?', function (yes) {
        		if(yes) {
        			var preloader = new Dialog.preloader('Adding package to the list');
        			$.ajax({
        				type: 'POST',
        				url: 'config/api.php',
        				data: data
        			}).then(function(data) {
        				if(data.error) Dialog.alert('Insertion of Test Errors: ' + data.error[0], data.error[1]);
        				else Dialog.alert('Added the Test Successfully', data.message,
        					function(OK) { 
        						RefreshTable();
        					});
        			}).catch(function (error) {
        				Dialog.alert('Insertion of Test Error', error.statusText || 'Server Error');
        			}).always(function () {
        				preloader.destroy();
        			});
        		}
        	});
        });

        $(document).on("click", "#editModalPackage", function() { 
        	$formCenterId = $(this).data("centerid");
        	$formCenterNameEdit = $(this).data("centername");
        	$formCenterAddressEdit = $(this).data("centeraddress");
        	$formCenterContactEdit = $(this).data("centercontact");
        	$formCenterDiscountEdit = $(this).data("centerdiscount");

        	$('#lblPackageCode').text($formCenterNameEdit);
        	$('input[name=formCenterId]').val($formCenterId);
        	$('input[name=formCenterNameEdit]').val($formCenterNameEdit);
        	$('textarea[name=formCenterAddressEdit]').val($formCenterAddressEdit);
        	$('input[name=formCenterContactEdit]').val($formCenterContactEdit);
        	$('input[name=formCenterDiscountEdit]').val($formCenterDiscountEdit.toFixed(2));

        	$('#modalEditForm').modal('show');
        });

    // Submit Registration Form
    $('#PackageForm').on('submit', function (e) {
    	$('#modalEditForm').modal('hide');

    	e.preventDefault();
    	var serialized_array = $(this).serializeArray();
    	var data = {
    		action: 'edit-center'
    	};
    	for(var i = 0; i < serialized_array.length; i++) {
    		var item = serialized_array[i];
    		data[item.name] = item.value;
    	}
    	Dialog.confirm('Are you sure?', 'Are you sure you want to edit this center details?', function (yes) {
    		if(yes) {
    			var preloader = new Dialog.preloader('Updating');
    			$.ajax({
    				type: 'POST',
    				url: 'config/api.php',
    				data: data
    			}).then(function(data) {
    				if(data.error) Dialog.alert('Updating Center Error: ' + data.error[0], data.error[1]);
    				else Dialog.alert('Updating Center Successful', data.message,
    					function(OK) { RefreshTable() });
    			}).catch(function (error) {
    				Dialog.alert('Updating Center Error', error.statusText || 'Server Error');
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