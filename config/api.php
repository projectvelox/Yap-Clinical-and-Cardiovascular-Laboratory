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

        case 'edit-package-item':
            $date = date('Y-m-d H:i:s');
            $varPackageId = $_POST['formPackageId'];
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

                    $sqlUpdate = "UPDATE package_item
                            SET pi_code='$varTestCode', 
                            pi_name='$varTestName',
                            pi_price='$varTestPrice',
                            pi_referencerange='$varTestReferenceRange',
                            pi_unit='$varTestUnit',
                            pi_createdDate='$date'
                            WHERE package_id='$varPackageId' & pi_code='$varTestCode'";
                   
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
        

        case 'add-package':
            $date = date('Y-m-d H:i:s');
            $varPackageCodeNew = $_POST['formPackageCodeNew'];
            $varPackageNameNew = $_POST['formPackageNameNew'];
            $varPackageDescriptionNew = $_POST['formPackageDescriptionNew'];
            $varPackagePriceNew = $_POST['formPackagePriceNew'];

            $sql = "INSERT INTO package_category(package_code, package_name, package_description, package_price, package_createdDate, package_status) VALUES('$varPackageCodeNew', '$varPackageNameNew', '$varPackageDescriptionNew', '$varPackagePriceNew', '$date', '2')";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully added <b>'.$_POST['formPackageCodeNew'].'</b> to the list of packages']);
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