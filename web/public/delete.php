<pre>
<?php

include(__DIR__ . '/../API.php');
$api = new API();

echo '<h4>DELETE REQUEST</h4>';

$return = $api->delete('http://localhost/dummy-endpoints/delete', [
    'id' => '5'
], [
    'responseType' => 'json'
]);

print_r($return);
?>
</pre>