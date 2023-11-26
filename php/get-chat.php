<?php

session_start();

if (isset($_SESSION["unique_id"])) {
    include("config.php");
    $outgoing_id = mysqli_real_escape_string($con, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
    $output = "";

    $sql = "SELECT * FROM messages 
    LEFT JOIN users on users.unique_id = messages.outgoing_msg_id
    WHERE (incomint_msg_id = {$outgoing_id} AND outgoing_msg_id = {$incoming_id}) 
    OR (incomint_msg_id = {$incoming_id} AND outgoing_msg_id = {$outgoing_id}) ORDER BY msg_id DESC";
    $query = mysqli_query($con, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '
                <div class="chat outgoing">
                    <div class="details">
                        <p>' . $row['msg'] . '</p>
                    </div>
                </div>';
            } else {
                $output .= '
                <div class="chat incoming">
                    <img src="php/images/' . $row['img'] . '" alt="" />
                    <div class="details">
                        <p>' . $row['msg'] . '</p>
                    </div>
                </div>';
            }
        }
        echo $output;
    }
} else {
    header("../login.php");
}

?>