<pre>
<?php

include(__DIR__ . '/../API.php');
$api = new API();

echo '<h4>PUT REQUEST - DATA SENT AS FORM URL ENCODED</h4>';

$return = $api->put('http://localhost/dummy-endpoints/put', [
    'foo' => 'bar'
], [
    'responseType'  => 'json'
]);
print_r($return);


echo '<h4>PUT REQUEST - DATA SENT AS JSON</h4>';

$return = $api->put('http://localhost/dummy-endpoints/put', [
    'foo' => 'bar'
], [
    'contentType'   => 'json',
    'responseType'  => 'json'
]);
print_r($return);
?>
</pre>