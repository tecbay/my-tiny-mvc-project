<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/



require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/routes.php';
require __DIR__ . '/../foundation/db/create_table_first_time.php';


$request = new Request();
$request->process();






