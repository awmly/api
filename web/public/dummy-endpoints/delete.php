<?php

$phpinput = file_get_contents('php://input');

if (strstr($_SERVER['CONTENT_TYPE'], 'json'))
{
    $data = json_decode($phpinput);
}
else
{
    parse_str($phpinput, $data);
}

echo json_encode([
    'Request content type'      => $_SERVER['CONTENT_TYPE'],
    'Request data'              => $data,
]);