<?php

!defined('SERVER_EXEC') && die('No access.');

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '192.168.2.153') {
	$servername = '127.0.0.1';
	$username = 'root';
	$password = 'password';
	$dbname = 'seafearless';
} else if ($_SERVER['SERVER_PORT'] == 194) { // GALATEA
	// require(dirname(__FILE__) . '/../../common/php/db.php');

	// $dbkey = 'upsr15r';
	// $dbdata = $DB[$dbkey];

	// $servername = $dbdata['host'];
	// $username = $dbdata['user'];
	// $password = $dbdata['pwd'];
	// $dbname = $dbdata['name'];
} else {
	// require(dirname(__FILE__) . '/../../common/php/inc/db.php');

	// $dbkey = 'upsr15r';
	// $dbdata = $DB[$dbkey];

	// $servername = $dbdata['host'];
	// $username = $dbdata['user'];
	// $password = $dbdata['pwd'];
	// $dbname = $dbdata['name'];
}

