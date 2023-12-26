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

function Update($Table, $POST, $Id)
{
    unset($_POST['id']);
    $Fields = "";
    $Values = "";
    $i = 1;

    foreach ($POST as $key => $val) {
        if ($val == "") {
            unset($POST[$key]);
        }
    }

    foreach ($POST as $key => $val) {
        if (count($POST) == $i) {
            $Fields .= $key;
            $Values .= $val;
        } else {
            $Fields .= $key . '<#>';
            $Values .= $val . '<#>';
        }
        $i++;
    }

    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "UPDATE",
            "Table" => $Table,
            "ID" => $Id,
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

function HeadUsers()
{

    $id = $_SESSION['Login']['unique_id'];

    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT * FROM users WHERE unique_id = ' . $id
        )
    );

    $img = $response['img'];
    $split_img = explode('/', $img);
    $name_img = $split_img[count($split_img) - 1];

    $html = '
    <header>
        <div class="content">
            <img src="./Assets/images/' . $name_img . '" alt="Profile" />
            <div class="details">
                <span>' . $response['fname'] . ' ' . $response['lname'] . '</span>
                <p>' . $response['status'] . '</p>
            </div>
        </div>
        <a href="Assets/php/access.php?logout=' . $response['id'] . '" class="logout">Logout</a>
    </header>
    ';

    echo $html;
}

function MainUsers()
{
    $id = $_SESSION['Login']['unique_id'];

    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT * FROM users WHERE NOT unique_id = ' . $id
        )
    );

    $html = '<div class="users-list">';

    for ($i = 0; $i < count($response); $i++) {

        $db = $response[$i];

        $img = $db['img'];
        $split_img = explode('/', $img);
        $name_img = $split_img[count($split_img) - 1];

        ($db['status'] == 'Offline') ? $status = 'offline' : $status = '';

        $html .= '
        <a href="chat.php?id=' . $db['id'] . '">
            <div class="content">
                <img src="./Assets/images/' . $name_img . '" alt="Profile" />
                <div class="details">
                    <span>' . $db['fname'] . ' ' . $db['lname'] . '</span>
                    <p>messages</p>
                </div>
            </div>
            <div class="status-dot ' . $status . '"><i class="fas fa-circle"></i></div>
        </a>
        ';
    }

    $html .= '</div>';

    echo $html;
}
