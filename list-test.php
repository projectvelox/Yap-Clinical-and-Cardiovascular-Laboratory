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
					<h4 class="modal-title">Add a new test</span></h4>
				</div>
				<div class="modal-body">
					<form id="PackageFormNew">
						<!-- Form Test Code-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestCodeNew"
		                           placeholder="Enter test code"
		                           required
		                    >
		                </div>

		                <!-- Form Test Name-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestNameNew"
		                           placeholder="Enter test name"
		                           required
		                    >
		                </div>

		                <!-- Form Test Reference Range -->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestReferenceRangeNew"
		                           placeholder="Enter reference range"
		                           required
		                    >
		                </div>

		                <!-- Form Test Unit of Measurement-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestUnitNew"
		                           placeholder="Enter unit of measurement"
		                           required
		                    >
		                </div>

		                <!-- Form Test Price -->
		                <div class="form-group">
		                    <input type="number" step="0.01"
		                           class="form-control"
		                           name="formTestPriceNew"
		                           placeholder="Enter test price"
		                           required
		                    >
		                </div>

		                <hr>
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
						<!-- Form Test Code-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestCode"
		                           placeholder="Enter test code"
		                           required
		                           
		                    >
		                </div>

		                <!-- Form Test Name-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestName"
		                           placeholder="Enter test name"
		                           required
		                    >
		                </div>

		                <!-- Form Test Reference Range -->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestReferenceRange"
		                           placeholder="Enter reference range"
		                           required
		                    >
		                </div>

		                <!-- Form Test Unit of Measurement-->
		                <div class="form-group">
		                    <input type="text"
		                           class="form-control"
		                           name="formTestUnit"
		                           placeholder="Enter unit of measurement"
		                           required
		                    >
		                </div>

		                <!-- Form Test Price -->
		                <div class="form-group">
		                    <input type="number" step="0.01"
		                           class="form-control"
		                           name="formTestPrice"
		                           placeholder="Enter test price"
		                           required
		                    >
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
		<li>Add/Edit Test</li>
	</ul>

	<div class="container yccl-mt-3">
		<h2>Add/Edit Test</h2>
		<div class="text-right">
			<div class="yccl-display-inlineblock text-left">
				<p class="yccl-mb-0"><strong>Action:</strong></p>
				<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalCreateForm">Add a new test</button>
			</div>
		</div><hr>
		
		<div class="table-responsive">          
			<table class="table table-striped" id="tblPackages">
				<thead>
					<tr>
						<th>#</th>
						<th>Test Code</th>
						<th>Test Name</th>
						<th>Reference Range</th>
						<th>Unit of Measurement</th>
						<th>Price</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=0;
						
						if(empty($_GET['status'])) { $status = ''; }
						else { $status = $_GET['status']; }

						$con = mysqli_connect("localhost","root","","yccl");
						$result = mysqli_query($con,"SELECT * FROM test_details");
						while($row = mysqli_fetch_array($result))
						{
							$i++;
							echo "<tr>";
							echo "<td>" . $i . "</td>";
							echo "<td>" . $row['test_code'] . "</td>";
							echo "<td>" . $row['test_name'] . "</td>";
							echo "<td>" . $row['test_referencerange'] . "</td>";
							echo "<td>" . $row['test_unit'] . "</td>";
							echo "<td>" . $row['test_price'] . "</td>";
							echo "
								<td>
									<button data-testcode='".$row['test_code']."' data-testname='".$row['test_name']."' data-testreferencerange='".$row['test_referencerange']."' data-testunit='".$row['test_unit']."' data-testprice='".$row['test_price']."' class='btn btn-xs btn-primary' id='editModalPackage'><span class='glyphicon glyphicon-pencil'></span></button>
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
		    $("#tblPackages").load("list-test.php #tblPackages");
		}

        // Submit Registration Form
		$('#PackageFormNew').on('submit', function (e) {

			$('#modalCreateForm').modal('hide');

            e.preventDefault();
            var serialized_array = $(this).serializeArray();
            var data = {
                action: 'add-test'
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
    	$varTestCode = $(this).data("testcode");
    	$varTestName = $(this).data("testname");
    	$varReferenceRange = $(this).data("testreferencerange");
    	$varUnit = $(this).data("testunit");
    	$varPrice = $(this).data("testprice");

    	$('#lblPackageCode').text($varTestCode + " - " + $varTestName);
    	$('input[name=formTestCode]').val($varTestCode);
    	$('input[name=formTestName]').val($varTestName);
    	$('input[name=formTestReferenceRange]').val($varReferenceRange);
    	$('input[name=formTestPrice]').val($varPrice.toFixed(2));
    	$('input[name=formTestUnit]').val($varUnit);

    	$('#modalEditForm').modal('show');
    });

    // Submit Registration Form
		$('#PackageForm').on('submit', function (e) {
			$('#modalEditForm').modal('hide');

            e.preventDefault();
            var serialized_array = $(this).serializeArray();
            var data = {
                action: 'edit-test'
            };
            for(var i = 0; i < serialized_array.length; i++) {
                var item = serialized_array[i];
                data[item.name] = item.value;
            }
            Dialog.confirm('Are you sure?', 'Are you sure you want to edit this test details?', function (yes) {
                if(yes) {
                    var preloader = new Dialog.preloader('Updating');
                    $.ajax({
                        type: 'POST',
                        url: 'config/api.php',
                        data: data
                    }).then(function(data) {
                        if(data.error) Dialog.alert('Updating Test Error: ' + data.error[0], data.error[1]);
                        else Dialog.alert('Updating Test Successful', data.message,
                        	function(OK) { RefreshTable() });
                    }).catch(function (error) {
                        Dialog.alert('Updating Test Error', error.statusText || 'Server Error');
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