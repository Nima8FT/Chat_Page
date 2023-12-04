<?php

session_start();

$URL = explode('/', $_SERVER['REQUEST_URI']);
$URL = strtolower($URL[count($URL) - 1]);

define('HomeURL', '../');
define('URL', $URL);
define('HOST', $_SERVER['SERVER_NAME']);

function ReqAPI($url, $data)
{
    $opts = array(
        'http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            )
    );
    $context = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);

    return json_decode($result, true);
}

function ReqAPI1($url, $data)
{
    $opts = array(
        'http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            )
    );
    $context = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);

    echo $result;
}

function ReDirect($uri)
{
    echo '<script>location.replace("' . $uri . '")</script>';
}

function MSG()
{
    if (isset($_SESSION['err'])) {
        echo '<div class="err-txt">' . $_SESSION['err'] . '</div>';
        unset($_SESSION['err']);
    }
}

function UploadFiles($name, $Table)
{
    if ($_FILES['images']['name'] !== "") {
        $split_name = explode('.', $_FILES['images']['name']);
        $format = $split_name[count($split_name) - 1];
        $extensions = ['png', 'jpeg', 'jpg'];

        if (in_array($format, $extensions) === true) {
            $img_dir = "";
            if ($Table == "users") {
                $img_dir = __DIR__ . '/../images/' . $name . '.' . $format;
            }

            $tmp = $_FILES['images']['tmp_name'];
            move_uploaded_file($tmp, $img_dir);
            $_POST['img'] = $img_dir;
        } else {
            $_SESSION['err'] = 'format picture not valid';
            ReDirect('signup.php');
        }
    }
}

function Insert($Table, $POST)
{
    unset($_POST['id']);
    $Fields = "";
    $Values = "";
    $i = 1;

    foreach ($POST as $key => $value) {
        if ($value == "") {
            unset($POST[$key]);
        }
    }

    foreach ($POST as $key => $value) {
        if (count($POST) == $i) {
            $Fields .= $key;
            $Values .= $value;
        } else {
            $Fields .= $key . '<#>';
            $Values .= $value . '<#>';
        }
        $i++;
    }

    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "INSERT",
            "Table" => $Table,
            "Fields" => $Fields,
            "Values" => $Values
        )
    );

    echo $response;
}

function Find($Table, $Fields, $Values, $isFix, $isArr)
{
    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "SEARCH",
            "Table" => $Table,
            "Fields" => $Fields,
            "Values" => $Values,
            "isFix" => $isFix,
            "isArr" => $isArr
        )
    );

    return $response;
}

?>