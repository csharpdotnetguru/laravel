<?php return array(

    // Logging
    ////////////////////////////////////////////////////////////////////
    'application_name' => 'unotelly',

    // The schema to use to name log files
    'logs' => function ($rocketeer) {
            return sprintf('%s-%s-%s.log', $rocketeer->getConnection(), $rocketeer->getStage(), date('Ymd'));
        },

    // Remote access
    //
    // You can either use a single connection or an array of connections
    ////////////////////////////////////////////////////////////////////

    // The default remote connection(s) to execute tasks on
    'default' => array('staging'),

    // The various connections you defined
    // You can leave all of this empty or remove it entirely if you don't want
    // to track files with credentials : Rocketeer will prompt you for your credentials
    // and store them locally
    'connections' => array(
        'production' => array(
            'host'     => '209.222.12.53',
            'username' => ''
        ),
        'staging' => array(
            'host'     => '64.237.43.126',
            'username' => 'deploydog1600',
            'password' => 'fwek04=-+#@94JMF#;21'
        )
    ),

    // Contextual options
    //
    // In this section you can fine-tune the above configuration according
    // to the stage or connection currently in use.
    'on' => array(

        // PER CONNECTION
        'connections' => array(
            'production' => array(
                'scm' => array('branch' => 'master')
            ),
            'staging' => array(
                'scm' => array('branch' => 'develop')
            )
        ),

        // PER STAGE
        'stages' => array(
            'production' => array(
                'scm' => array('branch' => 'master'),
            ),
            'staging' => array(
                'scm' => array('branch' => 'develop'),
            ),
        ),

    ),

);