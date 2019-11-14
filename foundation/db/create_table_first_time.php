<?php


$pdo = Connection::make( config( 'database' ) );

try {

	// sql to create table
	$sql = 'CREATE TABLE IF NOT EXISTS orders (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    amount INT(10) NOT NULL,
    buyer VARCHAR(255) NOT NULL,
    receipt_id VARCHAR(20) NOT NULL,
    items VARCHAR(255) NOT NULL,
    buyer_email VARCHAR(50) NOT NULL,
    buyer_ip VARCHAR(20) NOT NULL,
    note TEXT,
    city VARCHAR(20) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    hash_key VARCHAR(255) NOT NULL,
    entry_at DATE NOT NULL,
    entry_by INT(10) NOT NULL
    )';
	$pdo->exec( $sql );
} catch ( PDOException $e ) {
	echo $sql . "<br>" . $e->getMessage();
}