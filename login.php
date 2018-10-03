<?php
include 'config/config-file.php';
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(1);

session_start(); // Starting Session
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
                    case '1': $redirect = 'assets/css/style.css'; break;
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
?>