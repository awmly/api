<pre>
<?php

include(__DIR__ . '/../API.php');
$api = new API();


echo '<h4>POST REQUEST - DATA SENT AS FORM DATA</h4>';

$return = $api->post('http://localhost/dummy-endpoints/post', [
    'foo' => 'bar'
], [
    'contentType'   => 'form-data',
    'responseType'  => 'json'
]);

print_r($return);


echo '<h4>POST REQUEST - DATA SENT AS JSON</h4>';

$return = $api->post('http://localhost/dummy-endpoints/post', [
    'foo' => 'bar'
], [
    'contentType'   => 'json',
    'responseType'  => 'json'
]);

print_r($return);


echo '<h4>POST REQUEST - DEBUGGING</h4>';

$return = $api->post('http://localhost/dummy-endpoints/post', [
    'foo' => 'bar'
], [
    'debug'         => true,
    'contentType'   => 'json',
    'responseType'  => 'json'
]);



?>
</pre>