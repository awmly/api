<?php

$data = $_GET;

echo json_encode([
    'Request content type'      => $_SERVER['CONTENT_TYPE'],
    'Request data'              => $data,
]);

