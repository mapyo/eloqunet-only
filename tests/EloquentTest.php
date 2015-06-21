<?php

use Mapyo\EloquentOnly\Eloquent;

class EloquentTest extends EloquentOnlyTestsDatabaseTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function getDataSet()
    {
        return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            __DIR__ . "/_files/users.yml"
        );
    }

    public function testGetDataFromDatabase()
    {
        Eloquent::init(
            array(
                'driver'   => 'mysql',
                'host'     => 'localhost',
                'database' => getenv('DATABASE'),
                'username' => getenv('USERNAME'),
                'password' => '',
                'port'     => 3306,
                'collation' => 'utf8_unicode_ci',
                'charset'  => 'utf8'
            )
        );

        $user = User::find(1);
        $this->assertEquals('test', $user->name);

        $log = Eloquent::getConnection()->getQueryLog();
        $sql = "select * from `users` where `id` = ? limit 1";
        $this->assertEquals($sql, $log[0]["query"]);
    }
}

class User extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';
}

