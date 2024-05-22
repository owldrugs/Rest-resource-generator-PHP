<?php
require_once __DIR__.'/vendor/autoload.php';

use app\api\Api;
use app\resourses\Users;

$api = new Api();
$api->registerResourse('Users', Users::class,['get','post','put','delete']);
$api->run();
