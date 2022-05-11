<?php

if (strstr($_SERVER['CONTENT_TYPE'], 'json'))
{
    $phpinput = file_get_contents('php://input');
    $data = json_decode($phpinput);
}
else
{
    $data = $_POST;
}

echo json_encode([
    'Request content type'      => $_SERVER['CONTENT_TYPE'],
    'Request data'              => $data,
]);