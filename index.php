<?php
require 'core/bootstrap.php';

$routes = [
	'' => 'FotostudioController@index',
	'index' => 'FotostudioController@index',
];

$db = [
	'name'     => 'tasklist',
	'username' => 'root',
	'password' => '',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');