<?php

namespace Database;

class DBConnection
{
	private $connection;

	public function __construct()
	{
		$this->connection = pg_connect(
		 "host='localhost'
		 port='5432'
		 dbname='process_manager'
		 user='postgres'
		 password='password'") or die(
		 "Unnable to connect database");
	}

	public function getConnection()
	{
		return $this->connection;
	}
}
