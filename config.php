<?php

return [

	"database" => [
		'driver'   => 'mysql',
		'host'     => 'mysql',
		'port'     => '3306',
		'database' => 'xspeed_db',
		'username' => 'admin',
		'password' => 'pw_xspeed_db',
		'options'  => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
		]
	]
];