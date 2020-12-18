<?php

require 'lib/php/aws/aws-autoloader.php';

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$sdk = new Aws\Sdk([
    'endpoint'   => 'http://localhost:8000',
    'region'   => 'us-west-2',
    'version'  => '2012-08-10',
    'credentials' => [
        'key' => 'cs452',
        'secret' => 'cs452',
    ],
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();

$tableName = 'Image';

$eav = $marshaler->marshalJson('
    {
        ":user": "fakeEmail@example.com",
        ":file": "fakeFile.png"
    }
');

$params = [
    'TableName' => $tableName,
    'KeyConditionExpression' => 'user_id = :user and filename = :file',
    'ExpressionAttributeValues'=> $eav
];

try {
    $result = $dynamodb->query($params);

    echo "Query succeeded.<br>";

    echo json_encode($result['Items']) . "<br>";

    foreach ($result['Items'] as $image) {
        echo json_encode($image) . "<br>";

        foreach ($image as $key => $value){
            echo $key . "    " . $value['S'] . "   ";

            foreach ($value as $key2 => $value2){
                echo $value2 . "<br>";
            }
        }

        echo $marshaler->unmarshalValue($image['user_id']) . ': ' .
            $marshaler->unmarshalValue($image['filename']) . "<br>";
    }

} catch (DynamoDbException $e) {
    echo "Unable to query:\n";
    echo $e->getMessage() . "\n";
}





/*

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
            'S' => 'fakeFile.png',
        ],
        'user_id' => [
            'S' => 'fakeEmail@example.com',
        ],
    ],
    'TableName' => 'Image',
]);

echo "result: " . (json_encode($result));

*/
