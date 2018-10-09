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
					<h4 class="modal-title">Add a new profile</span></h4>
				</div>
				<div class="modal-body">
					<form id="ProfileFormNew">
						<!-- Form Profile Code-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formProfileCodeNew"
		                           placeholder="Enter profile code"
		                           required
		                    >
		                </div>

		                <!-- Form Profile Name-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formProfileNameNew"
		                           placeholder="Enter profile name"
		                           required
		                    >
		                </div>

		                <!-- Form Profile Price -->
		                <div class="form-group">
		                    <input type="number" step="0.01"
		                           class="form-control"
		                           name="formProfilePriceNew"
		                           placeholder="Enter profile price"
		                           required
		                    >
		                </div>
		                <div class="form-group">
		                	<label>Select the tests</label>

		                	<?php
									$con = mysqli_connect("localhost","root","","yccl");	
									$result = mysqli_query($con,"SELECT * FROM test_details");
									while($row = mysqli_fetch_array($result))
									{
										$testcode = $row['test_code'];
										$testname = $row['test_name'];
										$testprice = $row['test_price'];
										echo"<div class='checkbox'>
											    <label><input type='checkbox' name='formTestDetails' value='".$testcode."'>".$testcode. ' - ' . $testname. " (₱" . number_format($testprice,2) . ")</label>
											</div>";
									}
									mysqli_close($con);
		                	?> 
		                	
		                </div><hr>
		                <!-- Submit -->
		                <button type="submit"
		                        class="btn btn-primary addProfileClass">
		                    Add Profile
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
					<h4 class="modal-title">Edit <span id="lblProfileCode"></span></h4>
				</div>
				<div class="modal-body">
					<form id="ProfileForm">
						<!-- Form Profile Code-->
		                <div class="form-group">
		                    <input type="hidden"
		                           class="form-control"
		                           name="formProfileCode"
		                           placeholder="Enter profile code" 
		                    >
		                </div>

		                <!-- Form Profile Name-->
		                <div class="form-group">
		                	<label>Profile Name</label>
		                    <input type="text"
		                           class="form-control"
		                           name="formProfileName"
		                           placeholder="Enter profile name" 
		                    >
		                </div>


		                <!-- Form Profile Price -->
		                <div class="form-group">
		                	<label>Profile Price</label>
		                    <input type="number" step="0.01"
		                           class="form-control"
		                           name="formProfilePrice"
		                           placeholder="Enter profile price" 
		                    >
		                </div>

		                 <!-- Form Profile Status -->
		                <div class="form-group">
		                	<label>Profile Status:</label>
		                	<select class="form-control" name="formProfileStatus">
		                		<option disabled selected>Please select an option</option>
		                		<option value="1">1 - Disabled</option>
		                		<option value="2">2 - Active</option>
		                	</select>
		                </div>
		                <hr>
		                <!-- Submit -->
		                <button type="submit"
		                        class="btn btn-primary">
		                    Edit Profile
		                </button>
		            </form>
				</div>
			</div>
		</div>
	</div>

	<ul class="breadcrumb">
		<li><a href="admin-dashboard.php">Dashboard</a></li>
		<li>Add/Edit Profiles</li>
	</ul>

	<div class="container yccl-mt-3">
		<h2>Add/Edit Profiles</h2>
		<div class="text-right">
			<div class="yccl-display-inlineblock text-left">
				<p class="yccl-mb-0"><strong>Action:</strong></p>
				<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalCreateForm">Add a new profile</button>
			</div>
		</div><hr>
		
		<div class="table-responsive">          
			<table class="table table-striped" id="tblProfiles">
				<thead>
					<tr>
						<th>#</th>
						<th>Profile Code</th>
						<th>Profile Name</th>
						<th>Price</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=0;

						$con = mysqli_connect("localhost","root","","yccl");
						$result = mysqli_query($con,"SELECT * FROM profile_details");
						while($row = mysqli_fetch_array($result))
						{
							$i++;
							echo "<tr>";
							echo "<td>" . $i . "</td>";
							echo "<td><a class='btn-xs btn btn-primary' href='list-profiles-item.php?id=".$row['profile_id']."&name=".$row['profile_code']."&status=".$row['profile_status']."&profile=".$row['profile_name']."&testStatus=0'>" . $row['profile_code'] . "</a></td>";
							echo "<td>" . $row['profile_name'] . "</td>";
							echo "<td>" . number_format($row['profile_price'], 2) . "</td>";
							echo "
								<td>
									<button class='btn btn-xs btn-primary' data-id='".$row['profile_code']."' data-name='".$row['profile_name']."' data-price='".$row['profile_price']."' data-status='".$row['profile_status']."' id='editModalProfile'><span class='glyphicon glyphicon-pencil'></span></button>

									<button class='btn btn-xs btn-danger' data-id='".$row['profile_id']."' id='removeModalProfile'><span class='glyphicon glyphicon-remove'></span></button>
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
		    $("#tblProfiles").load("list-profiles.php #tblProfiles");
		}

        // Retrieve the data for the profiles
        $(document).on("click", "#editModalProfile", function() { 
        	$varProfileCode = $(this).data("id");
        	$varProfileName = $(this).data("name");
        	$varProfilePrice = $(this).data("price");
        	$varProfileStatus = $(this).data("status");

        	$('#lblProfileCode').text($varProfileCode + " - " + $varProfileName);
        	$('input[name=formProfileCode]').val($varProfileCode);
        	$('input[name=formProfileName]').val($varProfileName);
        	$('input[name=formProfilePrice]').val($varProfilePrice.toFixed(2));
        	$('select[name=formProfileStatus]').val($varProfileStatus);
        	
        	$('#modalEditForm').modal('show');
        });

        // Remove the data for the profiles
        $(document).on("click", "#removeModalProfile", function() { 
        	$varProfileId = $(this).data("id");

        	Dialog.confirm('Are you sure?', 'Are you sure you want to delete this profile?', function (yes) {
                if(yes) {
                    var preloader = new Dialog.preloader('Deleting');
                    $.ajax({
                        type: 'POST',
                        url: 'config/api.php',
                        data: {
                        	profileid: $varProfileId,
                        	action: 'delete-profile'
                        }
                    }).then(function(data) {
                        if(data.error) Dialog.alert('Deleting Profile Error: ' + data.error[0], data.error[1]);
                        else Dialog.alert('Deleting Profile Successful', data.message,
                        	function(OK) { RefreshTable() });
                    }).catch(function (error) {
                        Dialog.alert('Deleting Profile Error', error.statusText || 'Server Error');
                    }).always(function () {
                        preloader.destroy();
                    });
                }
            });
        }); 


        // Submit Registration Form
		$('#ProfileForm').on('submit', function (e) {
			$('#modalEditForm').modal('hide');

			/* var arr = [];
			$('input[name=formTestDetails]:checkbox:checked').each(function () {
			    arr.push($(this).val());
			}); */

            e.preventDefault();
            var serialized_array = $(this).serializeArray();
            var data = {
                action: 'edit-profiles'
            };
            for(var i = 0; i < serialized_array.length; i++) {
                var item = serialized_array[i];
                data[item.name] = item.value;
            }
            Dialog.confirm('Are you sure?', 'Are you sure you want to edit this profile details?', function (yes) {
                if(yes) {
                    var preloader = new Dialog.preloader('Updating');
                    $.ajax({
                        type: 'POST',
                        url: 'config/api.php',
                        data:data
                    }).then(function(data) {
                        if(data.error) Dialog.alert('Updating Profile Error: ' + data.error[0], data.error[1]);
                        else Dialog.alert('Updating Profile Successful', data.message,
                        	function(OK) { RefreshTable() });
                    }).catch(function (error) {
                        Dialog.alert('Updating Profile Error', error.statusText || 'Server Error');
                    }).always(function () {
                        preloader.destroy();
                    });
                }
            });
        });


        // Submit Registration Form
		$('#ProfileFormNew').on('submit', function (e) {
			$('#modalCreateForm').modal('hide');

			// Profile declaration for location change
			$varProfileCodeNew = $('input[name=formProfileCodeNew]').val();
        	$varProfileNameNew = $('input[name=formProfileNameNew]').val();

			//$('#modalCreateForm').modal('hide');

			var arr = [];
			$('input[name=formTestDetails]:checkbox:checked').each(function () {
			    arr.push($(this).val());
			});

            e.preventDefault();
            var serialized_array = $(this).serializeArray();
            var data = {
                action: 'add-profile',
                arr:arr
            };

            for(var i = 0; i < serialized_array.length; i++) {
                var item = serialized_array[i];
                data[item.name] = item.value;
            }
            Dialog.confirm('Are you sure?', 'Are you sure you want to add this newly created profile to the list of profiles?', function (yes) {
                if(yes) {
                    var preloader = new Dialog.preloader('Adding profile to the list');
                    $.ajax({
                        type: 'POST',
                        url: 'config/ajax.php',
                        data: data
                    }).then(function(data) {
                        if(data.error) Dialog.alert('Insertion of Profile Errors: ' + data.error[0], data.error[1]);
                        else Dialog.alert('Added the Profile Successfully', data.message,
                        	function(OK) { 
                        		RefreshTable();
                        		//location.href='list-profiles-item.php?name=' + $varProfileCodeNew + '& status=2' + '& profile=' + $varProfileNameNew;
                        	});
                    }).catch(function (error) {
                        Dialog.alert('Insertion of Profile Error', error.statusText || 'Server Error');
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