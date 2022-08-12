<?php
require 'core/bootstrap.php';

$routes = [
	'' => 'FotostudioController@index',
	'home' => 'FotostudioController@index',
	'benutzerverwaltung' => 'FotostudioController@benutzerverwaltung',
	'bild_hinzufuegen' => 'FotostudioController@bild_hinzufuegen',
	'benutzer_hinzufuegen' => 'FotostudioController@benutzer_hinzufuegen',

	'deleteBenutzer' => 'FotostudioController@deleteBenutzer',
	'editBenutzer' => 'FotostudioController@editBenutzer',

	'deleteBild' => 'FotostudioController@deleteBild',
	'editBild' => 'FotostudioController@editBild',

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