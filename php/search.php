<?php

include_once("config.php");

$searchTerm = mysqli_real_escape_string($con, $_POST["searchTerm"]);

$output = "";
$sql = mysqli_query($con,"SELECT * FROM users WHERE fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%' ");
if(mysqli_num_rows($sql) > 0) {
    include("data.php");
}
else {
$output .= "No user fount related to your search term";
}

echo $output;
?>