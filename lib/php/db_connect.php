<?php
require 'aws/aws-autoloader.php';

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;


function getConnection(){

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

    return $dynamodb;
}

function doSelect($tableName, $query, $values){
    $dynamodb = getConnection();

    $returnArray = array();

    $marshaler = new Marshaler();
    $eav = $marshaler->marshalJson(json_encode($values));

    $params = [
        'TableName' => $tableName,
        'KeyConditionExpression' => $query,
        'ExpressionAttributeValues'=> $eav
    ];

    try {
        $result = $dynamodb->query($params);

        foreach ($result['Items'] as $item) {
            // get all of the returned items
            $itemArray = array();

            foreach ($item as $key => $value){
                // grab each of the actual values for the key
                foreach ($value as $key2 => $value2){
                    $itemArray[$key] = $value2;
                }
            }

            // add a row to the return array
            $returnArray[] = $itemArray;
        }

    } catch (DynamoDbException $e) {
        // log the error somewhere
    }

    // return the data from the database
    return $returnArray;
}
