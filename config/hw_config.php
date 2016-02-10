<?php return array(
    'includes' => array('_aws'),
    'services' => array(
        'foo.dynamodb' => array(
            'extends' => 'dynamodb',
            'params'  => array(
                'profile' => 'guest1',
                'region'  => 'eu-central-1'
            )
        )
        
        //other dymanoDB
        /*
        ,
        'bar.dynamodb' => array(
            'extends' => 'dynamodb',
            'params'  => array(
                'profile' => 'my_other_profile',
                'region'  => 'us-west-2'
            )
        )*/
    )
);