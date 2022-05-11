<pre>
<?php

include(__DIR__ . '/../API.php');
$api = new API();


echo '<h4>AUTH REQUEST - USING BASIC AUTH</h4>';

$return = $api->post('http://localhost/dummy-endpoints/auth', [
    'foo' => 'bar'
], [
    'authHeader'    => 'testuser:Ww5B0tsQzr',
    'contentType'   => 'json',
    'responseType'  => 'json'
]);

print_r($return);


echo '<h4>AUTH REQUEST - USING AUTH BEARER </h4>';

$return = $api->post('http://localhost/dummy-endpoints/auth', [
    'foo' => 'bar'
], [
    'authBearer'    => 'I4mhRrnNqJlUpWvmJkOFBtu9GA39k01I',
    'contentType'   => 'json',
    'responseType'  => 'json'
]);

print_r($return);



?>
</pre>