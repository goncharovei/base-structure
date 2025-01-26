<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all the database connections defined for your application.
    | You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
        ],

        'mysql' => [

        ],

        'mariadb' => [

        ],

        'pgsql' => [

        ],

        'sqlsrv' => [

        ],

    ],

];
