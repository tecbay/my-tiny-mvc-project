<?php


abstract class Model {


	protected $pdo;
	private $query;

	public function __construct() {
		$this->pdo = Connection::make( config( 'database' ) );


	}

	public function __get( $name ) {
		throw new Exception( '$table name doesn\'t specify in ' . get_called_class() . ' Model' );
	}

	public function all() {
		$statement = $this->pdo->prepare( "SELECT * FROM $this->table" );
		$statement->execute();

		return $statement->fetchAll( PDO::FETCH_CLASS );
	}

	public function insert( array $data ) {
		$fields = implode( ', ', array_keys( $data ) );
		$val    = ':' . implode( ', :', array_keys( $data ) );
		$sql    = "INSERT INTO $this->table ($fields) VALUES ($val)";
		try {
			return $this->pdo
				->prepare( $sql )
				->execute( $data );
		} catch ( \Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function where( string $column, string $operator, string $value ) {
		$sql = "SELECT * FROM $this->table WHERE $column$operator:$column";
		try {
			$q = $this->pdo
				->prepare( $sql );
			$q->execute( [ "$column" => $value ] );
			$this->query = $q;

			return $this;
		} catch ( \Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function whereBetween( string $column, string $max, string $min ) {
		$sql = "SELECT * FROM $this->table WHERE $column BETWEEN $max AND $min";


		try {
			$q = $this->pdo
				->prepare( $sql );
			$q->execute();
			$this->query = $q;

			return $this;
		} catch ( \Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function whereDate( string $column, string $max, string $min ) {
		$sql = "SELECT * FROM $this->table WHERE $column >= '" . $max . "' AND $column <= '" . $min . "'";


		try {
			$q = $this->pdo
				->prepare( $sql );
			$q->execute();
			$this->query = $q;

			return $this;
		} catch ( \Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function get() {
		return $this->query->fetchAll( PDO::FETCH_OBJ );
	}

	public function first() {
		return $this->query->fetch( PDO::FETCH_OBJ );
	}


}