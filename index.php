<?php

require_once "vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$app = \Dykyi\App\ApplicationFactory::create(php_sapi_name());
$app->run();