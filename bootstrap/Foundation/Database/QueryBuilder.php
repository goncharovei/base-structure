<?php

namespace Foundation\Database;

use Illuminate\Database\Capsule\Manager as DB;

class QueryBuilder
{
    public function __invoke()
    {
        $db = new DB;

        $db->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'database',
            'username' => 'root',
            'password' => 'password',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

    }
}