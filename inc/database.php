<?php
const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'blog';


class DbConnection
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
