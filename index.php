
<?php 
require 'lib/aws.phar';
use Aws\Common\Aws;


// Create a service builder using a configuration file
$aws = Aws::factory('config/hw_config.php');

// Get the client from the builder by namespace
$client = $aws->get('my.dynamodb');



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
        'time'    => array('N' => 123456),
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
echo "deleting table..." . "\n";
$client->deleteTable(array(
    'TableName' => 'errors'
));

$client->waitUntil('TableNotExists', array(
    'TableName' => 'errors'
));
echo "table deleted." . "\n";

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
