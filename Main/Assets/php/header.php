<?php

require_once('function.php');
require_once('access.php');

if (isset($_POST['action'])) {
    $AC = $_POST['action'];
    unset($_POST['action']);

    if ($_POST['id']) {
        $ID = $_POST['id'];
        unset($_POST['id']);
    }

    if ($_POST['Table']) {
        $Table = $_POST['Table'];
        unset($_POST['Table']);
    }

    if ($AC == "insert") {
        Signup($Table, $_POST);
    }

    ReDirect($URL);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Assets/css/mains.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Chat Page</title>
</head>

<body>

    <article class="box-chat">