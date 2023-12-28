<?php

require_once('function.php');

$id = $_SESSION['Login']['id'];

if (isset($_POST)) {
    if (empty($_POST)) {
        MainUsers($id);
    } 
}
