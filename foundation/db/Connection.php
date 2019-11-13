<?php


class Connection {

	public static function make( array $config ): PDO {
		try {
			return new PDO(
				"{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']}",
				$config['username'],
				$config['password'],
				$config['options'] );
		} catch ( PDOException $e ) {
			echo $e->getMessage();
			die();
		}
	}
}