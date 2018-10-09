<?php
    if(empty(session_id()))session_start();
    date_default_timezone_set('Asia/Manila');
	include 'config-file.php';

    header('Content-Type: application/json');
	switch ($_POST["action"]) {

        // Login Account
        case 'login-account':
            $username = mysqli_real_escape_string($con, $_POST['username'] ?: '');
            $password = $_POST['password'] ?: '';
            $sql = "
                SELECT * 
                FROM account
                WHERE account_username='$username'
            ";
            $result = mysqli_query($con,$sql);

            if($result) {
                $account = mysqli_fetch_assoc($result);
                if($account) {
                    if($account['account_password'] == $password) {
                        $_SESSION['account'] = $account;
                        $redirect = '';
                        switch ($account['account_type']) {
                            case '1': $redirect = 'admin-dashboard.php'; break;
                        }
                        echo json_encode(['redirect' => $redirect]);
                    }
                    else {
                        echo json_encode(['error' => ['WRONG_PASSWORD', 'Wrong Password.']]);
                    }
                }
                else {
                    echo json_encode(['error' => ['WRONG_USERNAME', 'Username does not exist.']]);
                }
            }
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'edit-package':
            $date = date('Y-m-d H:i:s');
            $varPackageCode = $_POST['formPackageCode'];
            $varPackageName = $_POST['formPackageName'];
            $varPackageDescription = $_POST['formPackageDescription'];
            $varPackagePrice = $_POST['formPackagePrice'];
            $varPackageStatus = $_POST['formPackageStatus'];

            $sql = "UPDATE package_category
                    SET package_name='$varPackageName', 
                        package_description='$varPackageDescription', 
                        package_price='$varPackagePrice', 
                        package_createdDate='$date',
                        package_status='$varPackageStatus'
                    WHERE package_code='$varPackageCode'";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully updated the package details for <b>'.$_POST['formPackageCode'].'</b>']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;


        case 'edit-profiles':
            $date = date('Y-m-d H:i:s');

            $varProfileCode = $_POST['formProfileCode'];
            $varProfileName = $_POST['formProfileName'];
            $varProfilePrice = $_POST['formProfilePrice'];
            $varProfileStatus = $_POST['formProfileStatus'];

            $sql = "UPDATE profile_details
                    SET profile_name='$varProfileName', 
                        profile_price='$varProfilePrice', 
                        profile_status='$varProfileStatus'
                    WHERE profile_code='$varProfileCode'";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully updated the profile details for <b>'.$_POST['formProfileCode'].'</b>']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'delete-profile':
            $profileid = $_POST['profileid'];

            $sqlPackage = "DELETE FROM profile_details WHERE profile_id='$profileid'";;
            
            $resultPackage = mysqli_query($con,$sqlPackage);

            if($resultPackage) echo json_encode(['message' => 'Successfully deleted the profile']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'add-profile-item':
            $date = date('Y-m-d H:i:s');
            $varTestCode = $_POST['formTestCodeNew'];
            $varPackageId = $_POST['formPackageIdNew'];

            $sqlRetrieve = "
                SELECT * 
                FROM test_details
                WHERE test_code='$varTestCode'
            ";

            $result = mysqli_query($con,$sqlRetrieve);
            if($result) {
                $testdetails = mysqli_fetch_assoc($result);
                if($testdetails) {
                    $varTestName = $testdetails['test_name'];
                    $varTestPrice = $testdetails['test_price'];
                    $varTestReferenceRange = $testdetails['test_referencerange'];
                    $varTestUnit = $testdetails['test_unit'];

                    $sqlUpdate = "INSERT INTO profile_item(pi_code, 
                                pi_name, 
                                pi_price, 
                                pi_referencerange, 
                                pi_unit, 
                                profile_id) 

                                VALUES(
                                '$varTestCode', 
                                '$varTestName',
                                '$varTestPrice',
                                '$varTestReferenceRange',
                                '$varTestUnit',
                                '$varPackageId')";
                   
                    $resultUpdate = mysqli_query($con,$sqlUpdate);

                    if($resultUpdate) echo json_encode(['message' => 'Successfully added the test code: <b>'.$varTestCode.'</b>']);
                    else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
                }

                else {
                    echo json_encode(['error' => ['WRONG_TESTCODE', 'Test code does not exist.']]);
                }
            }
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'edit-profile-item':
            $date = date('Y-m-d H:i:s');
            $varPackageItemId = $_POST['formPackageItemId'];
            $varTestCode = $_POST['formTestCode'];

            $sqlRetrieve = "
                SELECT * 
                FROM test_details
                WHERE test_code='$varTestCode'
            ";

            $result = mysqli_query($con,$sqlRetrieve);
            if($result) {
                $testdetails = mysqli_fetch_assoc($result);
                if($testdetails) {
                    $varTestName = $testdetails['test_name'];
                    $varTestPrice = $testdetails['test_price'];
                    $varTestReferenceRange = $testdetails['test_referencerange'];
                    $varTestUnit = $testdetails['test_unit'];

                    $sqlUpdate = "UPDATE profile_item
                            SET pi_code='$varTestCode', 
                            pi_name='$varTestName',
                            pi_price='$varTestPrice',
                            pi_referencerange='$varTestReferenceRange',
                            pi_unit='$varTestUnit'
                            WHERE pi_id='$varPackageItemId'";
                   
                    $resultUpdate = mysqli_query($con,$sqlUpdate);

                    if($resultUpdate) echo json_encode(['message' => 'Successfully updated the profile details for <b>'.$_POST['formTestCode'].'</b>']);
                    else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
                }

                else {
                    echo json_encode(['error' => ['WRONG_TESTCODE', 'Test code does not exist.']]);
                }
            }
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'add-package-item':
            $date = date('Y-m-d H:i:s');
            $varTestCode = $_POST['formTestCodeNew'];
            $varPackageId = $_POST['formPackageIdNew'];

            $sqlRetrieve = "
                SELECT * 
                FROM test_details
                WHERE test_code='$varTestCode'
            ";

            $result = mysqli_query($con,$sqlRetrieve);
            if($result) {
                $testdetails = mysqli_fetch_assoc($result);
                if($testdetails) {
                    $varTestName = $testdetails['test_name'];
                    $varTestPrice = $testdetails['test_price'];
                    $varTestReferenceRange = $testdetails['test_referencerange'];
                    $varTestUnit = $testdetails['test_unit'];

                    $sqlUpdate = "INSERT INTO package_item(pi_code, 
                                pi_name, 
                                pi_price, 
                                pi_referencerange, 
                                pi_unit, 
                                pi_createdDate, 
                                pi_status,
                                package_id) 

                                VALUES(
                                '$varTestCode', 
                                '$varTestName',
                                '$varTestPrice',
                                '$varTestReferenceRange',
                                '$varTestUnit',
                                '$date',
                                '2',
                                '$varPackageId')";
                   
                    $resultUpdate = mysqli_query($con,$sqlUpdate);

                    if($resultUpdate) echo json_encode(['message' => 'Successfully added the test code: <b>'.$varTestCode.'</b>']);
                    else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
                }

                else {
                    echo json_encode(['error' => ['WRONG_TESTCODE', 'Test code does not exist.']]);
                }
            }
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'edit-package-item':
            $date = date('Y-m-d H:i:s');
            $varPackageItemId = $_POST['formPackageItemId'];
            $varTestCode = $_POST['formTestCode'];
            $varTestStatus = $_POST['formTestStatus'];

            $sqlRetrieve = "
                SELECT * 
                FROM test_details
                WHERE test_code='$varTestCode'
            ";

            $result = mysqli_query($con,$sqlRetrieve);
            if($result) {
                $testdetails = mysqli_fetch_assoc($result);
                if($testdetails) {
                    $varTestName = $testdetails['test_name'];
                    $varTestPrice = $testdetails['test_price'];
                    $varTestReferenceRange = $testdetails['test_referencerange'];
                    $varTestUnit = $testdetails['test_unit'];

                    $sqlUpdate = "UPDATE package_item
                            SET pi_code='$varTestCode', 
                            pi_name='$varTestName',
                            pi_price='$varTestPrice',
                            pi_referencerange='$varTestReferenceRange',
                            pi_unit='$varTestUnit',
                            pi_createdDate='$date',
                            pi_status='$varTestStatus'
                            WHERE pi_id='$varPackageItemId'";
                   
                    $resultUpdate = mysqli_query($con,$sqlUpdate);

                    if($resultUpdate) echo json_encode(['message' => 'Successfully updated the package details for <b>'.$_POST['formTestCode'].'</b>']);
                    else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
                }

                else {
                    echo json_encode(['error' => ['WRONG_TESTCODE', 'Test code does not exist.']]);
                }
            }
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;
        

        case 'add-test':
            
            $date = date('Y-m-d H:i:s');
            $formTestCodeNew = $_POST['formTestCodeNew'];
            $formTestNameNew = $_POST['formTestNameNew'];
            $formTestReferenceRangeNew = $_POST['formTestReferenceRangeNew'];
            $formTestUnitNew = $_POST['formTestUnitNew'];
            $formTestPriceNew = $_POST['formTestPriceNew'];

            $sql = "INSERT INTO test_details(test_code, test_name, test_referencerange, test_unit, test_price) VALUES('$formTestCodeNew', '$formTestNameNew', '$formTestReferenceRangeNew', '$formTestUnitNew', '$formTestPriceNew')";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully added <b>'.$_POST['formTestCodeNew'].'</b> to the list of packages']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'add-center':

            $formCenterName = $_POST['formCenterName'];
            $formCenterAddress = $_POST['formCenterAddress'];
            $formCenterContact = $_POST['formCenterContact'];
            $formCenterDiscount = $_POST['formCenterDiscount'];

            $sql = "INSERT INTO center_details(center_name, center_address, center_contact, center_status, center_discount) VALUES('$formCenterName', '$formCenterAddress', '$formCenterContact', '2' ,'$formCenterDiscount')";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully added <b>'.$_POST['formCenterName'].'</b> to the list of center']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);

            break;

        case 'edit-center':
            $formCenterNameEdit = $_POST['formCenterNameEdit'];
            $formCenterAddressEdit = $_POST['formCenterAddressEdit'];
            $formCenterContactEdit= $_POST['formCenterContactEdit'];
            $formCenterDiscountEdit = $_POST['formCenterDiscountEdit'];
            $formCenterId = $_POST['formCenterId'];

            $sql = "UPDATE center_details
                    SET
                        center_name='$formCenterNameEdit',
                        center_address='$formCenterAddressEdit', 
                        center_contact='$formCenterContactEdit',
                        center_discount='$formCenterDiscountEdit'
                    WHERE center_id='$formCenterId'";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully updated the center details']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'add-doctor':

            $formDoctorName = $_POST['formDoctorName'];
            $formDoctorAddress = $_POST['formDoctorAddress'];
            $formDoctorContact = $_POST['formDoctorContact'];
            $formDoctorDiscount = $_POST['formDoctorDiscount'];

            $sql = "INSERT INTO doctor_details(doctor_name, doctor_address, doctor_contact, doctor_status, doctor_discount) VALUES('$formDoctorName', '$formDoctorAddress', '$formDoctorContact', '2' ,'$formDoctorDiscount')";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully added <b>'.$_POST['formDoctorName'].'</b> to the list of doctor']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);

            break;

        case 'edit-doctor':
            $formDoctorNameEdit = $_POST['formDoctorNameEdit'];
            $formDoctorAddressEdit = $_POST['formDoctorAddressEdit'];
            $formDoctorContactEdit= $_POST['formDoctorContactEdit'];
            $formDoctorDiscountEdit = $_POST['formDoctorDiscountEdit'];
            $formDoctorId = $_POST['formDoctorId'];

            $sql = "UPDATE doctor_details
                    SET
                        doctor_name='$formDoctorNameEdit',
                        doctor_address='$formDoctorAddressEdit', 
                        doctor_contact='$formDoctorContactEdit',
                        doctor_discount='$formDoctorDiscountEdit'
                    WHERE doctor_id='$formDoctorId'";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully updated the doctor details']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        case 'edit-test':
            $varTestCode = $_POST['formTestCode'];
            $formTestName = $_POST['formTestName'];
            $formTestReferenceRange= $_POST['formTestReferenceRange'];
            $formTestUnit = $_POST['formTestUnit'];
            $formTestPrice = $_POST['formTestPrice'];

            $sql = "UPDATE test_details
                    SET test_name='$formTestName', 
                        test_referencerange='$formTestReferenceRange', 
                        test_unit='$formTestUnit',
                        test_price='$formTestPrice'
                    WHERE test_code='$varTestCode'";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully updated the test details']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;


        case 'delete-package':
            $packageId = $_POST['packageid'];

            $sqlPackage = "DELETE FROM package_category WHERE package_id='$packageId'";
            $sqlItem = "DELETE FROM package_item WHERE package_id='$packageId'";
            
            $resultPackage = mysqli_query($con,$sqlPackage);
            $resultItem = mysqli_query($con,$sqlItem);

            if($resultPackage) echo json_encode(['message' => 'Successfully deleted the package <b>'.$_POST['packageid'].'</b>']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;





        case 'edit-account':
            $password = $_POST['password'];
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];

            $sql = "UPDATE accounts
                    SET firstname='$firstname', 
                        middlename='$middlename', 
                        lastname='$lastname', 
                        password='$password' 
                    WHERE username='$username'";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully updated your account details <b>'.$_POST['username'].'</b>']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;


        case 'delete-account':
            $username = $_POST['username'];

            $sql = "DELETE FROM accounts
                    WHERE username='$username'";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully deleted the account <b>'.$_POST['username'].'</b>']);
            else echo json_encode(['error' => ['DB_ERROR', mysqli_error($con)]]);
            break;

        // Action Not Found

        default:
            echo json_encode(['error' => ['ACTION_NOT_FOUND', 'Action not found.']]);
            break;
    }