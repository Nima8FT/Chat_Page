<?php

session_start();
if (isset($_SESSION["unique_id"])) {
    include("config.php");
    $outgoing_id = mysqli_real_escape_string($con, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    if (!empty($message)) {
        $sql = mysqli_query($con, "INSERT INTO messages (incomint_msg_id ,outgoing_msg_id ,msg) VALUES ({$incoming_id},{$outgoing_id},'{$message}')");
    }
} else {
    header("../login.php");
}

?>