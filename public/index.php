<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/routes.php';

$request = new Request();
$request->process();



