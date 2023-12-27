<?php

session_start();

$URL = explode('/', $_SERVER['REQUEST_URI']);
$URL = strtolower($URL[count($URL) - 1]);

define('HomeURL', '../');
define('URL', $URL);
define('HOST', $_SERVER['SERVER_NAME']);

if (isset($_GET) && !empty($_GET)) {
    if ($_GET['search'] == true) {
        Search();
    } else if ($_GET['mainusers'] == true) {
        MainUsers();
    }
}

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

    $id = $_SESSION['Login']['id'];

    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT * FROM users WHERE id = ' . $id
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
    $id = $_SESSION['Login']['id'];

    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT * FROM users WHERE NOT id = ' . $id
        )
    );

    $html = '<div class="users-list">';

    for ($i = 0; $i < count($response); $i++) {

        $db = $response[$i];

        $response2 = ReqAPI(
            'http://localhost/Chat_Page/Api/index.php',
            array(
                "Mode" => "QUERY",
                "Query" => 'SELECT * FROM `messages` WHERE (incoming_msg_id = ' . $id . ' OR outgoing_msg_id = ' . $id . ') AND (incoming_msg_id = ' . $db['id'] . ' OR outgoing_msg_id = ' . $db['id'] . ') ORDER BY id DESC LIMIT 1'
            )
        );

        $img = $db['img'];
        $split_img = explode('/', $img);
        $name_img = $split_img[count($split_img) - 1];
        (strlen($response2['msg']) > 28) ? $msg = substr($response2['msg'], 0, 28) : $msg = $response2['msg'];
        ($id == $response2['incoming_msg_id']) ? $you = 'You: ' : $you = '';
        ($db['status'] == 'Offline') ? $status = 'offline' : $status = '';
        if ($response2['msg'] == null) {
            $msg = "No message not yet";
        }

        $html .= '
        <a href="chat.php?id=' . $db['id'] . '">
            <div class="content">
                <img src="./Assets/images/' . $name_img . '" alt="Profile" />
                <div class="details">
                    <span>' . $db['fname'] . ' ' . $db['lname'] . '</span>
                    <p>' . $you . $msg . '</p>
                </div>
            </div>
            <div class="status-dot ' . $status . '"><i class="fas fa-circle"></i></div>
        </a>
        ';
    }

    $html .= '</div>';

    echo $html;
}

function Search()
{
    $id = $_SESSION['Login']['id'];
    $search_term = $_POST['search_term'];

    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => "SELECT * FROM users WHERE NOT id = {$id} AND (fname LIKE '%{$search_term}%' OR lname LIKE '%{$search_term}%')"
        )
    );

    $html = '<div class="users-list">';

    if ($response[0] != '') {
        for ($i = 0; $i < count($response); $i++) {

            $db = $response[$i];

            $response2 = ReqAPI(
                'http://localhost/Chat_Page/Api/index.php',
                array(
                    "Mode" => "QUERY",
                    "Query" => 'SELECT * FROM `messages` WHERE (incoming_msg_id = ' . $id . ' OR outgoing_msg_id = ' . $id . ') AND (incoming_msg_id = ' . $db['id'] . ' OR outgoing_msg_id = ' . $db['id'] . ') ORDER BY id DESC LIMIT 1'
                )
            );

            $img = $db['img'];
            $split_img = explode('/', $img);
            $name_img = $split_img[count($split_img) - 1];
            (strlen($response2['msg']) > 28) ? $msg = substr($response2['msg'], 0, 28) : $msg = $response2['msg'];
            ($id == $response2['outgoing_msg_id']) ? $you = 'You: ' : $you = '';
            ($db['status'] == 'Offline') ? $status = 'offline' : $status = '';
            if ($response2['msg'] == null) {
                $msg = "No message not yet";
            }

            $html .= '
            <a href="chat.php?id=' . $db['id'] . '">
                <div class="content">
                    <img src="./Assets/images/' . $name_img . '" alt="Profile" />
                    <div class="details">
                        <span>' . $db['fname'] . ' ' . $db['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                </div>
                <div class="status-dot ' . $status . '"><i class="fas fa-circle"></i></div>
            </a>
            ';
        }
    } else {
        if ($response['fname'] != '') {
            $response2 = ReqAPI(
                'http://localhost/Chat_Page/Api/index.php',
                array(
                    "Mode" => "QUERY",
                    "Query" => 'SELECT * FROM `messages` WHERE (incoming_msg_id = ' . $id . ' OR outgoing_msg_id = ' . $id . ') AND (incoming_msg_id = ' . $response['id'] . ' OR outgoing_msg_id = ' . $response['id'] . ') ORDER BY id DESC LIMIT 1'
                )
            );

            $img = $response['img'];
            $split_img = explode('/', $img);
            $name_img = $split_img[count($split_img) - 1];
            (strlen($response2['msg']) > 28) ? $msg = substr($response2['msg'], 0, 28) : $msg = $response2['msg'];
            ($id == $response2['outgoing_msg_id']) ? $you = 'You: ' : $you = '';
            ($response['status'] == 'Offline') ? $status = 'offline' : $status = '';
            if ($response2['msg'] == null) {
                $msg = "No message not yet";
            }

            $html .= '
            <a href="chat.php?id=' . $response['id'] . '">
                <div class="content">
                    <img src="./Assets/images/' . $name_img . '" alt="Profile" />
                    <div class="details">
                        <span>' . $response['fname'] . ' ' . $response['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                </div>
                <div class="status-dot ' . $status . '"><i class="fas fa-circle"></i></div>
            </a>
            ';
        } else {
            $html = 'No user fount related to your search term';
        }
    }

    $html .= '</div>';

    echo $html;
}

function HeadChat($id)
{
    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT * FROM users WHERE id = ' . $id
        )
    );

    $img = $response['img'];
    $split_img = explode('/', $img);
    $name_img = $split_img[count($split_img) - 1];

    $html = '
    <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
    <div class="content">
        <img src="Assets/images/' . $name_img . '" alt="Profile" />
        <div class="details">
            <span>' . $response['fname'] . ' ' . $response['lname'] . '</span>
            <p>' . $response['status'] . '</p>
        </div>
    </div>
    ';

    echo $html;
}

function MainChat($my_id, $user_id)
{
    $response = ReqAPI(
        'http://localhost/Chat_Page/Api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => "SELECT * FROM messages LEFT JOIN users ON users.id = messages.outgoing_msg_id
            WHERE (incoming_msg_id = {$my_id} AND outgoing_msg_id = {$user_id})
             OR (incoming_msg_id = {$user_id} AND outgoing_msg_id = {$my_id}) 
             ORDER BY messages.id ASC"
        )
    );

    $html = '';

    if ($response != false) {
        for ($i = 0; $i < count($response); $i++) {
            $db = $response[$i];

            $img = $db['img'];
            $split_img = explode('/', $img);
            $name_img = $split_img[count($split_img) - 1];

            if ($db['outgoing_msg_id'] == $user_id) {
                $html .= '
            <div class="chat outgoing">
                <div class="details">
                    <p>' . $db['msg'] . '</p>
                </div>
            </div>
            ';
            } else {
                $html .= '
            <div class="chat incoming">
                <img src="./Assets/images/' . $name_img . '" alt="Profile" />
                <div class="details">
                    <p>' . $db['msg'] . '</p>
                </div>
            </div>
            ';
            }
        }
    }


    echo $html;
}
