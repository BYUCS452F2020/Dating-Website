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

$result = $client->putItem([
    'Item' => [
        'filename' => [
            'S' => 'fakeFile.png',
        ],
        'user_id' => [
            'S' => 'fakeEmail@example.com',
        ],
	'extra' => [
	    'S' => 'extra data',
	],
    ],
    'ReturnConsumedCapacity' => 'TOTAL',
    'TableName' => 'Image',
]);

$result = $client->getItem([
    'Key' => [
        'filename' => [
            'S' => 'fakeFile.png',
        ],
        'user_id' => [
            'S' => 'fakeEmail@example.com',
        ],
    ],
    'TableName' => 'Image',
]);

echo $result->get('extra');
