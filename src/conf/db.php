<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$db = new Capsule;

$config = parse_ini_file('../src/conf/boniflux.db.conf.ini');

$db->addConnection($config);

$db->setAsGlobal();

$db->bootEloquent();
