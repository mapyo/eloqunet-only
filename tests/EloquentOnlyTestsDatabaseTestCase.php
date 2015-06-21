<?php

abstract class EloquentOnlyTestsDatabaseTestCase extends PHPUnit_Extensions_Database_TestCase
{
    static private $pdo = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO("mysql:dbname=eloquent-only;", "root");
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, ':memory:');
        }

        return $this->conn;
    }
}
