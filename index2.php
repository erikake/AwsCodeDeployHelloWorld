
<?php 
require 'lib/aws.phar';
use Aws\DynamoDb\DynamoDbClient;

$client = DynamoDbClient::factory(array(
    'profile' => 'guest1',
    'region'  => 'eu-central-1'
));

// Create an "errors" table
echo "creating table..." . "\n";
$client->createTable(array(
    'TableName' => 'errors',
    'AttributeDefinitions' => array(
        array(
            'AttributeName' => 'id',
            'AttributeType' => 'N'
        ),
        array(
            'AttributeName' => 'time',
            'AttributeType' => 'N'
        )
    ),
    'KeySchema' => array(
        array(
            'AttributeName' => 'id',
            'KeyType'       => 'HASH'
        ),
        array(
            'AttributeName' => 'time',
            'KeyType'       => 'RANGE'
        )
    ),
    'ProvisionedThroughput' => array(
        'ReadCapacityUnits'  => 10,
        'WriteCapacityUnits' => 20
    )
));


// Wait until the table is created and active
echo "Waiting for table creation..." . "\n";
$client->waitUntil('TableExists', array(
    'TableName' => 'errors'
));
echo "table done." . "\n";

$result = $client->putItem(array(
    'TableName' => 'errors',
    'Item' => array(
        'id'      => array('N' => '1201'),
        'time'    => array('N' => $time),
        'error'   => array('S' => 'Executive overflow'),
        'message' => array('S' => 'no vacant areas')
    )
));

$result = $client->getItem(array(
    'ConsistentRead' => true,
    'TableName' => 'errors',
    'Key'       => array(
        'id'   => array('N' => '1201'),
        'time' => array('N' => $time)
    )
));

// Grab value from the result object like an array
echo $result['Item']['id']['N'] . "\n";
//> 1201
echo $result->getPath('Item/id/N') . "\n";
//> 1201
echo $result['Item']['error']['S'] . "\n";
//> Executive overflow
echo $result['Item']['message']['S'] . "\n";
//> no vacant areas

$scan = $client->getIterator('Scan', array('TableName' => 'errors'));
foreach ($scan as $item) {
    $client->deleteItem(array(
        'TableName' => 'errors',
        'Key' => array(
            'id'   => array('N' => $item['id']['N']),
            'time' => array('N' => $item['time']['N'])
        )
    ));
}


?>



<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Hello World</title>
    </head>
    <body>
        A hellow world page 5
        <?php echo "pgp enabled" ?>
    </body>
</html>



<?php
phpinfo();
?>
