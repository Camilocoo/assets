<?php
	require_once('../../vendor/autoload.php');
	require_once('../../globals.php');
	require_once('../JsonPDO.php');
	require_once('../SlimAPI.php');
	require('routes.php');
	
	$api = new SlimAPI([
		'debug' => API_DEBUG
	]);
	
	$pdo = new \PDO( 'sqlite:db.sqlite3' );
	$db = new \LessQL\Database( $pdo );
	$db->setPrimary( 'response', ['user_id'] );
	$api->addDB('sqlite', $db);
	$api = addAPIRoutes($api);
	$api->run(); 