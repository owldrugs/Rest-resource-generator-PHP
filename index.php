<?php
require_once __DIR__.'/vendor/autoload.php';

use app\api\Api;

$api = new Api();
$api->registerResourse('Users', \app\resourses\Users::class,['get','post','put','delete']);
$api->run();
