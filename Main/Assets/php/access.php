<?php

session_start();
require_once('function.php');

function Signup($Table, $POST)
{
    if (
        isset($POST['unique_id']) && !empty($POST['unique_id']) &&
        isset($POST['fname']) && !empty($POST['fname']) &&
        isset($POST['email']) && !empty($POST['email']) &&
        isset($POST['lname']) && !empty($POST['lname']) &&
        isset($POST['password']) && !empty($POST['password']) &&
        isset($POST['img']) && !empty($POST['img']) &&
        isset($POST['status']) && !empty($POST['status'])
    ) {
        $POST['unique_id'] = rand(time(), 10000000);
        if (filter_var($POST['email'], FILTER_VALIDATE_EMAIL)) {
            if (strlen($POST['password']) > 7) {
                $password = password_hash($POST['password'], PASSWORD_DEFAULT);
                $POST['password'] = $password;
                $find_email = Find($Table, 'email', $POST['email'], true, false);
                if ($find_email == false) {
                    if (isset($_FILES)) {
                        UploadFiles(strval($POST['unique_id']), $Table);
                        $POST['img'] = $_POST['img'];
                        Insert($Table, $POST);
                    } else {
                        $_SESSION['err'] = 'please upload photos';
                        ReDirect('signup.php');
                    }
                } else {
                    $_SESSION['err'] = 'email already exist';
                    ReDirect('signup.php');
                }
            } else {
                $_SESSION['err'] = 'password less 8 characters';
                ReDirect('signup.php');
            }
        } else {
            $_SESSION['err'] = 'email is not valid';
            ReDirect('signup.php');
        }
    } else {
        $_SESSION['err'] = 'all input field are required!';
        ReDirect('signup.php');
    }
}




?>