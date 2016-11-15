<?php

class Database
{
	private $db;
	private static $self = null;

	private function __construct() { }

	private function __clone() { }

	public static function getConnection()
	{
		$database = (self::$self === null) ? self::$self = new self() : self::$self;

		$paramsPath = 'db_params.php';
		$params = include($paramsPath);

		$dsn = "mysql:host={$params['host']}; dbname={$params['dbname']}";
		$database->db = new PDO($dsn, $params['user'], $params['password']);
		$database->db->exec("set names utf8");
		return $database->db;
	}

}