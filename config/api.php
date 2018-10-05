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

        case 'add-package':
            $date = date('Y-m-d H:i:s');
            $varPackageCodeNew = $_POST['formPackageCodeNew'];
            $varPackageNameNew = $_POST['formPackageNameNew'];
            $varPackageDescriptionNew = $_POST['formPackageDescriptionNew'];
            $varPackagePriceNew = $_POST['formPackagePriceNew'];

            $sql = "INSERT INTO package_category(package_code, package_name, package_description, package_price, package_createdDate) VALUES('$varPackageCodeNew', '$varPackageNameNew', '$varPackageDescriptionNew', '$varPackagePriceNew', '$date')";
            $result = mysqli_query($con,$sql);

            if($result) echo json_encode(['message' => 'Successfully added <b>'.$_POST['formPackageCodeNew  '].'</b> to the list of packages']);
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