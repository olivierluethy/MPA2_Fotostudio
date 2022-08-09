<?php
require 'core/bootstrap.php';

$routes = [
	'' => 'FotostudioController@index',
	'home' => 'FotostudioController@index',

	'login' => 'LoginController@login',
	'logout' => 'LoginController@logout',
];

$db = [
	'name'     => 'fotostudio',
	'username' => 'root',
	'password' => '',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');