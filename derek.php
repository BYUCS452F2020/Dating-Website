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

//$result = $client->putItem([
//    'Item' => [
//        'filename' => [
//            'S' => 'fakeFile.png',
//        ],
//        'user_id' => [
//            'S' => 'fakeEmail@example.com',
//        ],
//    ],
//    'ReturnConsumedCapacity' => 'TOTAL',
//    'TableName' => 'Image',
//]);

$result = $client->getItem([
    'Key' => [
        'filename' => [
            'S' => 'derek.png',
        ],
        'user_id' => [
            'S' => 'dereks_is',
        ],
    ],
    'TableName' => 'Image',
]);

echo $result->get('Key');
