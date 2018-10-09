<?php
      if(empty(session_id()))session_start();
      date_default_timezone_set('Asia/Manila');

      include 'config-file.php';

      switch ($_POST["action"]) {
          case 'add-package':
            
            $date = date('Y-m-d H:i:s');

            $varPackageCodeNew = $_POST['formPackageCodeNew'];
            $varPackageNameNew = $_POST['formPackageNameNew'];
            $varPackageDescriptionNew = $_POST['formPackageDescriptionNew'];
            $varPackagePriceNew = $_POST['formPackagePriceNew'];

            $sql = "INSERT INTO package_category(package_code, package_name, package_description, package_price, package_createdDate, package_status) VALUES('$varPackageCodeNew', '$varPackageNameNew', '$varPackageDescriptionNew', '$varPackagePriceNew', '$date', '2')";
            $result = mysqli_query($con,$sql);
            
            $checkboxes = isset($_POST['arr']) ? $_POST['arr'] : array();
            foreach ($checkboxes as $value) {

                  //Test Details
                  $sqlRetrieveTest = "
                      SELECT * 
                      FROM test_details
                      WHERE test_code='$value'
                  ";
                  $resultTest = mysqli_query($con,$sqlRetrieveTest);
                  $testdetails = mysqli_fetch_assoc($resultTest);

                  //Package Id
                  $sqlRetrievePackage = "
                      SELECT * 
                      FROM package_category
                      WHERE package_code='$varPackageCodeNew'
                  ";
                  $resultPackage = mysqli_query($con,$sqlRetrievePackage);
                  $packagedetails = mysqli_fetch_assoc($resultPackage);
                  
                  //Variable Declarations
                  $varTestName = $testdetails['test_name'];
                  $varTestPrice = $testdetails['test_price'];
                  $varTestReferenceRange = $testdetails['test_referencerange'];
                  $varTestUnit = $testdetails['test_unit'];
                  $varPackageId = $packagedetails['package_id'];

                  $query="INSERT INTO package_item(pi_code, pi_name, pi_price, pi_referencerange, pi_unit, package_id, pi_status) VALUES('$value', '$varTestName', '$varTestPrice', '$varTestReferenceRange', '$varTestUnit', '$varPackageId', '2')";
                  $results = mysqli_query($con,$query);
            } 
            
            if($result) {
                  header('Content-Type: application/json');
                  echo json_encode(['message' => 'Successfully added <b>'.$_POST['formPackageCodeNew'].'</b> to the list of packages']);
            }

            else {
                  header('Content-Type: application/json');
                  echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            }

            break;

          case 'add-profile':
            
            $date = date('Y-m-d H:i:s');

            $varProfileCodeNew = $_POST['formProfileCodeNew'];
            $varProfileNameNew = $_POST['formProfileNameNew'];
            $varProfilePriceNew = $_POST['formProfilePriceNew'];

            $sql = "INSERT INTO profile_details(profile_code, profile_name, profile_price, profile_status) VALUES('$varProfileCodeNew', '$varProfileNameNew', '$varProfilePriceNew', '2')";
            $result = mysqli_query($con,$sql);
            
            $checkboxes = isset($_POST['arr']) ? $_POST['arr'] : array();
            foreach ($checkboxes as $value) {

                  //Test Details
                  $sqlRetrieveTest = "
                      SELECT * 
                      FROM test_details
                      WHERE test_code='$value'
                  ";
                  $resultTest = mysqli_query($con,$sqlRetrieveTest);
                  $testdetails = mysqli_fetch_assoc($resultTest);

                  //Package Id
                  $sqlRetrievePackage = "
                      SELECT * 
                      FROM profile_details
                      WHERE profile_code='$varProfileCodeNew'
                  ";
                  $resultPackage = mysqli_query($con,$sqlRetrievePackage);
                  $packagedetails = mysqli_fetch_assoc($resultPackage);
                  
                  //Variable Declarations
                  $varTestName = $testdetails['test_name'];
                  $varTestPrice = $testdetails['test_price'];
                  $varTestReferenceRange = $testdetails['test_referencerange'];
                  $varTestUnit = $testdetails['test_unit'];
                  $varPackageId = $packagedetails['profile_id'];

                  $query="INSERT INTO profile_item(pi_code, pi_name, pi_price, pi_referencerange, pi_unit, profile_id) VALUES('$value', '$varTestName', '$varTestPrice', '$varTestReferenceRange', '$varTestUnit', '$varPackageId')";
                  $results = mysqli_query($con,$query);
            } 
            
            if($result) {
                  header('Content-Type: application/json');
                  echo json_encode(['message' => 'Successfully added <b>'.$_POST['formProfileCodeNew'].'</b> to the list of packages']);
            }

            else {
                  header('Content-Type: application/json');
                  echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            }

            break;
      }
?>