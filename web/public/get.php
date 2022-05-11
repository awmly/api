<pre>
<?php

include(__DIR__ . '/../API.php');
$api = new API();

echo '<h4>GET REQUEST</h4>';

$return = $api->get('http://localhost/dummy-endpoints/get', [
    'foo' => 'bar'
], [
    'responseType' => 'json'
]);
print_r($return);
?>
</pre>