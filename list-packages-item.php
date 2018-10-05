<?php 
	$getPackageCode = $_GET['name'];
	$getPackageName = $_GET['package'];
?>
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
					<h4 class="modal-title">Add a new package</span></h4>
				</div>
				<div class="modal-body">
					<form id="PackageFormNew">
						<!-- Form Package Code-->
		                <div class="form-group">
						    <label>Test Code</label>
							<select class="form-control" 
									  required
									  name="formPackageCodeNew"
							>
							    <option disabled selected>Please select an option below</option>
							    <?php
									$con = mysqli_connect("localhost","root","","yccl");	
									$result = mysqli_query($con,"SELECT * FROM test_details");
										while($row = mysqli_fetch_array($result))
										{
											$testcode = $row['test_code'];
											echo "<option data-test-code='".$testcode."'>" . $testcode .  "</option>";
										}
										echo "</table>";
										mysqli_close($con);
								?>
							</select>
						</div>
		    
		                <!-- Submit -->
		                <button type="submit"
		                        class="btn btn-primary">
		                    Add Test
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

						<!-- Form Package Code-->
		                <div class="form-group">
		                    <input type="hidden"
		                           class="form-control"
		                           name="formPackageId">
		                </div>

						<!-- Form Package Code-->
		                <div class="form-group">
		                    <input type="hidden"
		                           class="form-control"
		                           name="formPackageCode">
		                </div>

		                <!-- Form Package Name-->
		                <div class="form-group">
		                	<label>Package Name:</label>
		                    <input type="text"
		                           class="form-control"
		                           name="formPackageName"
		                           disabled>		                    
		                </div>

		                <!-- Form Package Price -->
		                <div class="form-group">
		                	<label>Package Price:</label>
		                    <input type="text"
		                           class="form-control"
		                           name="formPackagePrice"
		                           disabled>
		                </div><hr>

		                <!-- Form Test Code -->
		                <div class="form-group">
						    <label>Test Code</label>
							<select class="form-control" 
									  required
									  name="formTestCode"
							>
								<option disabled selected>Please select an option below</option>
							    <?php
									$con = mysqli_connect("localhost","root","","yccl");	
									$result = mysqli_query($con,"SELECT * FROM test_details");
										while($row = mysqli_fetch_array($result))
										{
											$testcode = $row['test_code'];
											$testname = $row['test_name'];
											$testprice = $row['test_price'];
											echo "<option value='".$testcode."' data-test-code='".$testcode."' data-test-name='".$testname."'>" . $testcode . " - " .  $testname . "(₱" . number_format($testprice,2). ")</option>";
										}
										echo "</table>";
										mysqli_close($con);
								?>
							</select>
						</div><hr>

		                <hr>
		                <!-- Submit -->
		                <button type="submit"
		                        class="btn btn-primary">
		                    Edit Test
		                </button>
		            </form>
				</div>
			</div>
		</div>
	</div>

	<ul class="breadcrumb">
		<li><a href="admin-dashboard.php">Dashboard</a></li>
		<li><a href="list-packages.php">Add/Edit Packages</a></li>
		<li><?php echo $getPackageCode . " - " . $getPackageName ?></li>
	</ul>

	<div class="container yccl-mt-3">
		<h2><?php 
			$status=$_GET['status'];
			if($status=="1") {
				echo $getPackageCode . " - Add/Edit Tests <span class='badge badge-danger'>Disabled</span>"; 
			}
			if($status=="2") {
				echo $getPackageCode . " - Add/Edit Tests <span class='badge badge-success'>Active</span>"; 
			}
		?> </h2>
		<div class="text-right">
			<div class="yccl-display-inlineblock text-left">
				<p class="yccl-mb-0"><strong>Action:</strong></p>
				<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalCreateForm">Add a new test</button>
			</div>
		</div><hr>

		<div class="table-responsive">          
			<table class="table table-striped" id="tblPackageItems">
				<thead>
					<tr>
						<th>#</th>
						<th>Test Code</th>
						<th>Test Name</th>
						<th>Price</th>
						<th>Reference Range</th>
						<th>Unit of Measure</th>
						<th>Last Modified</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=0;
					$con = mysqli_connect("localhost","root","","yccl");
					$result = mysqli_query($con,"SELECT * FROM view_packagelisting WHERE package_code = '$getPackageCode'");
					while($row = mysqli_fetch_array($result))
					{
						$i++;
						echo "<tr>";
						echo "<td>" . $i . "</td>";
						echo "<td>" . $row['pi_code'] . "</td>";
						echo "<td>" . $row['pi_name'] . "</td>";
						echo "<td>" . $row['pi_price'] . "</td>";
						echo "<td>" . $row['pi_referencerange'] . "</td>";
						echo "<td>" . $row['pi_unit'] . "</td>";
						echo "<td>" . date('d-M-Y g:i A', strtotime($row['pi_createdDate'])) . "</td>";
						echo "
						<td>
							<button class='btn btn-xs btn-primary' data-id='".$row['package_code']."' data-packageid='".$row['package_id']."' data-name='".$row['package_name']."' data-price='".$row['package_price']."' data-test-code='".$row['pi_code']."' data-test-name='".$row['pi_name']."' data-test-price='".$row['pi_price']."' data-test-referencerange='".$row['pi_referencerange']."' data-test-unit='".$row['pi_unit']."' id='editModalPackage'><span class='glyphicon glyphicon-pencil'></span></button>
						</td>";
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
		    $("#tblPackageItems").load("list-packages-item.php #tblPackageItems");
		}

        // Retrieve the data for the packages
        $(document).on("click", "#editModalPackage", function() { 
        	$varPackageId = $(this).data("packageid");
        	$varPackageCode = $(this).data("id");
        	$varPackageName = $(this).data("name");
        	$varPackagePrice = $(this).data("price");
        	$varTestCode = $(this).data("test-code");
        	$varTestName = $(this).data("test-name");

        	$('#lblPackageCode').text($varPackageCode + " - " + $varTestName);
        	$('input[name=formPackageId]').val($varPackageId);
        	$('input[name=formPackageCode]').val($varPackageCode);
        	$('input[name=formPackageName]').val($varPackageName);
        	$('input[name=formPackagePrice]').val($varPackagePrice.toFixed(2));
        	$('select[name=formTestCode]').val($varTestCode);

			        	
        	$('#modalEditForm').modal('show');
        });

        // Submit Registration Form
		$('#PackageForm').on('submit', function (e) {
			$('#modalEditForm').modal('hide');

            e.preventDefault();
            var serialized_array = $(this).serializeArray();
            var data = {
                action: 'edit-package-item'
            };
            for(var i = 0; i < serialized_array.length; i++) {
                var item = serialized_array[i];
                data[item.name] = item.value;
            }
            Dialog.confirm('Are you sure?', 'Are you sure you want to edit this package details?', function (yes) {
                if(yes) {
                    var preloader = new Dialog.preloader('Updating');
                    $.ajax({
                        type: 'POST',
                        url: 'config/api.php',
                        data: data
                    }).then(function(data) {
                        if(data.error) Dialog.alert('Updating Package Error: ' + data.error[0], data.error[1]);
                        else Dialog.alert('Updating Package Successful', data.message,
                        	function(OK) { RefreshTable() 
                        });
                    }).catch(function (error) {
                        Dialog.alert('Updating Package Error', error.statusText || 'Server Error');
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