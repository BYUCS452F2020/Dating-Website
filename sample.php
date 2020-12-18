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

$result = $client->createTable([
    'AttributeDefinitions' => [
        [
            'AttributeName' => 'filename',
            'AttributeType' => 'S',
        ],
        [
	    'AttributeName' => 'user_id',
	    'AttributeType' => 'S',
	],
    ],
    'KeySchema' => [
        [
            'AttributeName' => 'filename',
            'KeyType' => 'HASH',
        ],
        [
            'AttributeName' => 'user_id',
            'KeyType' => 'RANGE',
        ],
    ],
    'ProvisionedThroughput' => [
        'ReadCapacityUnits' => 5,
        'WriteCapacityUnits' => 5,
    ],
    'TableName' => 'Image',
]);

echo $result;
