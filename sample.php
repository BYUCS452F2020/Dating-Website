<?php
require './lib/php/aws/aws-autoloader.php';
use \Aws\DynamoDb\DynamoDbClient;

$client = \Aws\DynamoDb\DynamoDbClient::factory(array(
    'credentials' => [
        'key' => 'cs452',
        'secret' => 'cs452',
    ],
    'version' => '2012-08-10',
    'region' => 'us-west-2',
    'endpoint' => 'http://localhost:8000'
));
