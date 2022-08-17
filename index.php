<?php
require 'core/bootstrap.php';

$routes = [
	/* Startseite */
	'' => 'BilderController@index',
	'startseite' => 'BilderController@index',

	/* Bilder hinzufügen, bearbeiten und löschen */
	'bild_hinzufuegen' => 'BilderController@bild_hinzufuegen',
	'bild_loeschen' => 'BilderController@bild_loeschen',
	'bild_bearbeiten' => 'BilderController@bild_bearbeiten',

	/* Benutzerverwaltung */
	'benutzerverwaltung' => 'BenutzerController@benutzerverwaltung',

	/* Benutzer "VIPs" hinzufügen, bearbeiten und löschen */
	'benutzer_hinzufuegen' => 'BenutzerController@benutzer_hinzufuegen',
	'benutzer_loeschen' => 'BenutzerController@benutzer_loeschen',
	'benutzer_bearbeiten' => 'BenutzerController@benutzer_bearbeiten',

	/* Login | Logout */
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