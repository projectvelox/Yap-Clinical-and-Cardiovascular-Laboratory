<!DOCTYPE html>
<html>
<!-- Head -->
<?php include 'views/partials/header.php'?>

<body>
	<?php include 'views/partials/navbar.php'?>

		<!-- Modal -->
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
		                           name="formPackageCode"
		                    >
		                </div>

		                <!-- Form Package Name-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formPackageName"
		                    >
		                </div>

		                <!-- Form Package Description-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formPackageDescription"
		                    >
		                </div>

		                <!-- Form Package Price -->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formPackagePrice"
		                    >
		                </div>
		                <hr>
		                <!-- Submit -->
		                <button type="submit"
		                        class="btn btn-primary">
		                    Edit Package
		                </button>
		            </form>
				</div>
			</div>
		</div>
	</div>

	<ul class="breadcrumb">
		<li><a href="admin-dashboard.php">Dashboard</a></li>
		<li>Add/Edit Packages</li>
	</ul>

	<div class="container yccl-mt-3">
		<h2>Add/Edit Packages</h2><hr>
		<div class="row">
			<div class="table-responsive">          
				<table class="table table-striped" id="tblPackages">
					<thead>
						<tr>
							<th>#</th>
							<th>Package Code</th>
							<th>Package Name</th>
							<th>Price</th>
							<th>Last Modified Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=0;
						$con = mysqli_connect("localhost","root","","yccl");
						$result = mysqli_query($con,"SELECT * FROM package_category");
						while($row = mysqli_fetch_array($result))
						{
							$i++;
							echo "<tr>";
							echo "<td>" . $i . "</td>";
							echo "<td><a class='btn-xs btn btn-primary' href='list-packages-item.php?name=".$row['package_code']."'>" . $row['package_code'] . "</a></td>";
							echo "<td>" . $row['package_name'] . "</td>";
							echo "<td>" . number_format($row['package_price'], 2) . "</td>";
							echo "<td>" . date('d-M-Y g:i A', strtotime($row['package_createdDate'])) . "</td>";
							echo "
							<td>
								<button class='btn btn-xs btn-primary' data-id='".$row['package_code']."' data-name='".$row['package_name']."' data-description='".$row['package_description']."' data-price='".$row['package_price']."' id='editModalPackage'><span class='glyphicon glyphicon-pencil'></span></button>
							</td>";
							echo "</tr>";
						}
						mysqli_close($con);
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
        var Dialog = new BootstrapDialog({
            buttonClass: 'btn-primary'
        });

        function RefreshTable() {
		    $("#tblPackages").load("list-packages.php #tblPackages");
		}

        // Retrieve the data for the packages
        $(document).on("click", "#editModalPackage", function() { 
        	$varPackageCode = $(this).data("id");
        	$varPackageName = $(this).data("name");
        	$varPackageDescription = $(this).data("description");
        	$varPackagePrice = $(this).data("price");

        	$('#lblPackageCode').text($varPackageCode);
        	$('input[name=formPackageCode]').val($varPackageCode);
        	$('input[name=formPackageName]').val($varPackageName);
        	$('input[name=formPackageDescription]').val($varPackageDescription);
        	$('input[name=formPackagePrice]').val($varPackagePrice.toFixed(2));
        	
        	$('#modalEditForm').modal('show');
        });

        // Submit Registration Form
		$('#PackageForm').on('submit', function (e) {
			$('#modalEditForm').modal('hide');

            e.preventDefault();
            var serialized_array = $(this).serializeArray();
            var data = {
                action: 'edit-package'
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
                        	function(OK) { RefreshTable() });
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