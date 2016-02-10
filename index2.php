
<?php 
require 'lib/aws.phar';
use Aws\Common\Aws;


// Create a service builder using a configuration file
$aws = Aws::factory('config/hw_config.php');

// Get the client from the builder by namespace
$client = $aws->get('DynamoDb');



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
