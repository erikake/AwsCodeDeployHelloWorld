
<?php 
require 'lib/aws.phar';
use Aws\DynamoDb\DynamoDbClient;

$client = DynamoDbClient::factory(array(
    'profile' => 'guest1',
    'region'  => '<region name>'
));

// Create an "errors" table
echo "creating table..." . "\n";


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
