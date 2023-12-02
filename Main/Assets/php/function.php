<?php

seesion_start();

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

?>