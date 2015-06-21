<?php

abstract class EloquentOnlyTestsDatabaseTestCase extends PHPUnit_Extensions_Database_TestCase
{
    static private $pdo = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                $database = getenv('DATABASE');
                $username = getenv('USERNAME');
                self::$pdo = new PDO("mysql:dbname={$database};", $username);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, ':memory:');
        }

        return $this->conn;
    }
}
