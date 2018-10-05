<?php 
	$getPackageCode = $_GET['name'];
?>
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
		                           disabled 
		                    >
		                </div>

		                <!-- Form Package Price -->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formPackagePrice"
		                           disabled 
		                    >
		                </div>

		                <!-- Form Test Name -->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestName"
		                           required 
		                    >
		                </div>

		                <!-- Form Test Description -->
		                <div class="form-group">
		                      <textarea 
		                      		class="form-control" 
		                      		rows="3"
		                      		name="formTestDescription"
		                      	>
		                      </textarea>
		                </div>

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
		<li><?php echo $getPackageCode; ?></li>
	</ul>

	<div class="container yccl-mt-3">
		<h2><?php echo $getPackageCode; ?> - Add/Edit Tests</h2><hr>
		<div class="row">
			<div class="table-responsive">          
				<table class="table table-striped" id="tblPackages">
					<thead>
						<tr>
							<th>#</th>
							<th>Test Name</th>
							<th>Test Description</th>
							<th>Last Modified</th>
							<th>Action</th>
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
							echo "<td>" . $row['pi_name'] . "</td>";
							echo "<td style='width:550px;'>" . $row['pi_description'] . "</td>";
							echo "<td>" . date('d-M-Y g:i A', strtotime($row['pi_createdDate'])) . "</td>";
							echo "
							<td>
								<button class='btn btn-xs btn-primary' data-id='".$row['package_code']."' data-name='".$row['package_name']."' data-price='".$row['package_price']."' data-test-name='".$row['pi_name']."' data-test-description='".$row['pi_description']."' id='editModalPackage'><span class='glyphicon glyphicon-pencil'></span></button>
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
        	$varPackagePrice = $(this).data("price");
        	$varTestName = $(this).data("test-name");
        	$varTestDescription = $(this).data("test-description");

        	$('#lblPackageCode').text($varPackageCode + " - " + $varTestName);
        	$('input[name=formPackageCode]').val($varPackageCode);
        	$('input[name=formPackageName]').val($varPackageName);
        	$('input[name=formPackagePrice]').val($varPackagePrice.toFixed(2));
        	$('input[name=formTestName]').val($varTestName);
        	$('textarea[name=formTestDescription]').val($varTestDescription);
        	
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