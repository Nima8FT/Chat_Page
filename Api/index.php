<?php

require_once('database.php');
require_once('function.php');

if (!isset($_POST['Table'])) {
    $_POST['Table'] = "";
}

if (!isset($_POST['Query'])) {
    $_POST['Query'] = "";
}

if (!isset($_POST['Fields'])) {
    $_POST['Fields'] = "";
}

if (!isset($_POST['Values'])) {
    $_POST['Values'] = "";
}

if (!isset($_POST['ID'])) {
    $_POST['ID'] = "";
}

if (!isset($_POST['isFix'])) {
    $_POST['isFix'] = "";
}

if (!isset($_POST['isArr'])) {
    $_POST['isArr'] = "";
}

if (!isset($_POST['URL'])) {
    $_POST['isArr'] = "";
}

if (!isset($_POST['user'])) {
    $_POST['isArr'] = "";
}

if (!isset($_POST['pass'])) {
    $_POST['isArr'] = "";
}

if (!isset($_POST['HOST'])) {
    $_POST['isArr'] = "";
}

$Mode = $_POST['Mode'];
$Table = $_POST['Table'];
$Query = $_POST['Query'];
$Fields = explode('<#>', $_POST['Fields']);
$Values = explode('<#>', $_POST['Values']);
$ID = $_POST['ID'];
$isFix = $_POST['isFix'];
$isArr = $_POST['isArr'];
$URL = $_POST['URL'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$Host = $_POST['Host'];


$DB = new Database();

if ($Mode == "INSERT") {
    $DB->insert($Table, $Fields, $Values);
} else if ($Mode == "UPDATE") {
    $DB->update($Table, $Fields, $Values, $ID);
} else if ($Mode == "DELETE") {
    $DB->delete($Table, $ID);
} else if ($Mode == "SEARCH") {
    $DB->search($Table, $Fields, $Values, $isFix, $isArr);
} else if ($Mode == "QUERY") {
    $DB->query($Query);
}

?>