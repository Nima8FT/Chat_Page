<?php

session_start();

include_once("config.php");

$fname = mysqli_real_escape_string($con, $_POST["fname"]);
$lname = mysqli_real_escape_string($con, $_POST["lname"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($con, "SELECT email FROM users WHERE email='{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - alreadey exist!";
        } else {
            if (isset($_FILES['images'])) {
                $img_name = $_FILES['images']['name'];
                $img_type = $_FILES['images']['type'];
                $tmp_name = $_FILES['images']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extesnsions = ['png', 'jpeg', 'jpg'];
                if (in_array($img_ext, $extesnsions) === true) {
                    $time = time();
                    $new_img_name = $time . $img_name;

                    // if (move_uploaded_file($tmp_name, "images/" $new_img_name)) {
                    $status = "Active now";
                    $random_id = rand(time(), 10000000);

                    $sql2 = mysqli_query($con, "INSERT INTO users (unique_id,fname,lname,email,password,img,status) VALUES ({$random_id},'{$fname}','{$lname}','{$email}','{$password}','{$new_img_name}','{$status}')");

                    if ($sql2) {
                        $sql3 = mysqli_query($con, "SELECT * FROM users WHERER email = '{$email}'");
                        if (mysqli_num_rows($sql3) > 0) {
                            $row = mysqli_fetch_array($sql3);
                            // $_SESSION['unique_id'] = $row['unique_id'];
                        }
                        // } else {
                        //     echo "Something went wrong";
                        // }
                    } else {
                        echo "move upload file";
                    }
                } else {
                    echo "Please select an image file - jpeg , jpg , png";
                }

            } else {
                echo "Please select an image file!";
            }
        }
    } else {
        echo "$email - this is not a valid email";
    }
} else {
    echo "all input field are required!";
}

?>