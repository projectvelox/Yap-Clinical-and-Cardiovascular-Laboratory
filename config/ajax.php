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


  case 'add-invoice':

  $date = date('Y-m-d H:i:s');
  $formTitle = $_POST['formTitle'];
  $formPatient = $_POST['formPatient'];
  $formBirthdate = $_POST['formBirthdate'];
  $formSex = $_POST['formSex'];
  $formContact = $_POST['formContact'];
  $formAddress = $_POST['formAddress'];
  $formCenter = $_POST['formCenter'];
  $formDoctor = $_POST['formDoctor'];
  $formPaymentType = $_POST['formPaymentType'];
  $totalPrice = $_POST['totalPrice'];
  $netPrice = $_POST['netPrice'];
            //$formTestDetails = $_POST['formTestDetails'];
            //$formPackageDetails = $_POST['formPackageDetails'];

  $sql = "INSERT INTO patient_profile(
  patient_title,
  patient_name, 
  patient_birthdate,
  patient_sex, 
  patient_contact, 
  patient_address, 
  patient_center, 
  patient_doctor, 
  payment_type,
  amount_total,
  amount_net) 

  VALUES(
  '$formTitle', 
  '$formPatient', 
  '$formBirthdate', 
  '$formSex', 
  '$formContact', 
  '$formAddress', 
  '$formCenter', 
  '$formDoctor', 
  '$formPaymentType',
  '$totalPrice',
  '$netPrice')
  ";
  $result = mysqli_query($con,$sql);

  $checkboxesTest = isset($_POST['arrTest']) ? $_POST['arrTest'] : array();
  foreach ($checkboxesTest as $valueTest) {
                    //Test Details
    $sqlRetrieveTest = "
    SELECT * 
    FROM test_details
    WHERE test_id='$valueTest'
    ";
    $resultTest = mysqli_query($con,$sqlRetrieveTest);
    $testdetails = mysqli_fetch_assoc($resultTest);

    $sqlRetrieveInvoice = "
    SELECT * 
    FROM patient_profile
    ORDER BY invoice_id DESC
    ";

    $resultInvoice = mysqli_query($con,$sqlRetrieveInvoice);
    $invoicedetails = mysqli_fetch_assoc($resultInvoice);
    
    //Variable Declarations
    $varTestId = $testdetails['test_id'];
    $varTestCode = $testdetails['test_code'];
    $varTestName = $testdetails['test_name'];
    $varTestPrice = $testdetails['test_price'];
    $varTestReferenceRange = $testdetails['test_referencerange'];
    $varTestUnit = $testdetails['test_unit'];
    $varInvoiceId = $invoicedetails['invoice_id'];

    $testQuery="INSERT INTO patient_test(test_id, test_code, test_name, test_price, test_referencerange, test_unit, invoice_id) VALUES('$varTestId', '$varTestCode', '$varTestName', '$varTestPrice', '$varTestReferenceRange', '$varTestUnit', '$varInvoiceId')";
    $testResults = mysqli_query($con,$testQuery);
  }

  $checkboxesPackages = isset($_POST['arrPackage']) ? $_POST['arrPackage'] : array();
  foreach ($checkboxesPackages as $valuePackages) {
                    //Test Details
    $sqlRetrievePackage = "
    SELECT * 
    FROM package_category
    WHERE package_id='$valuePackages'
    ";
    $resultPackage = mysqli_query($con,$sqlRetrievePackage);
    $packagedetails = mysqli_fetch_assoc($resultPackage);

    $sqlRetrieveInvoice = "
    SELECT * 
    FROM patient_profile
    ORDER BY invoice_id DESC
    ";

    $resultInvoice = mysqli_query($con,$sqlRetrieveInvoice);
    $invoicedetails = mysqli_fetch_assoc($resultInvoice);
    
    //Variable Declarations
    $varPackageId = $packagedetails['package_id'];
    $varPackageCode = $packagedetails['package_code'];
    $varPackageName = $packagedetails['package_name'];
    $varPackagePrice = $packagedetails['package_price'];
    $varPackageDescription = $packagedetails['package_description'];
    $varInvoiceId = $invoicedetails['invoice_id'];

    $packageQuery="INSERT INTO patient_package(package_id, package_code, package_name, package_price, package_description, invoice_id) VALUES('$varPackageId', '$varPackageCode', '$varPackageName', '$varPackagePrice', '$varPackageDescription', '$varInvoiceId')";
    $packageResults = mysqli_query($con,$packageQuery);
  }

  $checkboxesProfiles = isset($_POST['arrProfile']) ? $_POST['arrProfile'] : array();
  foreach ($checkboxesProfiles as $valueProfile) {
    //Test Details
    $sqlRetrieveProfile = "
    SELECT * 
    FROM profile_details
    WHERE profile_id='$valueProfile'
    ";
    $resultprofile = mysqli_query($con,$sqlRetrieveProfile);
    $profiledetails = mysqli_fetch_assoc($resultprofile);

    $sqlRetrieveInvoice = "
    SELECT * 
    FROM patient_profile
    ORDER BY invoice_id DESC
    ";

    $resultInvoice = mysqli_query($con,$sqlRetrieveInvoice);
    $invoicedetails = mysqli_fetch_assoc($resultInvoice);
    
    //Variable Declarations
    $varProfileId = $profiledetails['profile_id'];
    $varProfileCode = $profiledetails['profile_code'];
    $varProfileName = $profiledetails['profile_name'];
    $varProfilePrice = $profiledetails['profile_price'];
    $varInvoiceId = $invoicedetails['invoice_id'];

    $profileQuery="INSERT INTO patient_profiles(profile_id, profile_code, profile_name, profile_price, invoice_id) VALUES('$varProfileId', '$varProfileCode', '$varProfileName', '$varProfilePrice', '$varInvoiceId')";
    $profileResults = mysqli_query($con,$profileQuery);
  }
  

  if($result) {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Successfully added the patients profile']);
  }

  else {
    header('Content-Type: application/json');
    echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
  }

  break;

}
?>