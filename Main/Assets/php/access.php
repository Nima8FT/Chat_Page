<?php

session_start();
require_once('function.php');

if (isset($_GET) && !empty($_GET)) {
    $id = $_SESSION['Login']['id'];
    if ($_GET['logout'] == $id) {
        Logout($id);
    }
}

function Signup($Table, $POST)
{
    if (
        isset($POST['fname']) && !empty($POST['fname']) &&
        isset($POST['email']) && !empty($POST['email']) &&
        isset($POST['lname']) && !empty($POST['lname']) &&
        isset($POST['password']) && !empty($POST['password']) &&
        isset($POST['img']) && !empty($POST['img']) &&
        isset($POST['status']) && !empty($POST['status'])
    ) {
        if (filter_var($POST['email'], FILTER_VALIDATE_EMAIL)) {
            if (strlen($POST['password']) > 7) {
                $password = password_hash($POST['password'], PASSWORD_DEFAULT);
                $POST['password'] = $password;
                $find_email = Find($Table, 'email', $POST['email'], true, false);
                if ($find_email == false) {
                    if (isset($_FILES)) {
                        UploadFiles(strval($POST['id']), $Table);
                        $POST['img'] = $_POST['img'];
                        $POST['status'] = "Offline";
                        Insert($Table, $POST);
                        ReDirect('login.php');
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

function Login($username, $password)
{
    if (
        isset($username) && !empty($username) &&
        isset($password) && !empty($password)
    ) {
        $login = Find('users', 'email', $username, true, false);
        if ($login && password_verify($password, $login['password'])) {
            if ($login['status'] !== 'Active') {
                $status['status'] = 'Active';
                Update('users', $status, $login['id']);
            }
            $_SESSION['Login'] = $login;
            ReDirect('user.php');
        } else {
            $_SESSION['err'] = 'username or password is not correct';
        }
    } else {
        $_SESSION['err'] = 'all input field are required!';
    }
}

function Logout($id)
{
    $POST['status'] = "Offline";
    Update('users', $POST, $id);
    session_unset();
    session_destroy();
    ReDirect('../../login.php');
}
