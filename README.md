# Use only eloquent in laravel

## Installation

```bash
composer require mapyo/eloquent-only
```

## Usage

```php
<?php
use Mapyo\EloquentOnly\Eloquent;
$loader = require('./vendor/autoload.php');

Eloquent::init(
    array(
        'driver'   => 'mysql',
        'host'     => '127.0.0.1',
        'database' => 'database',
        'username' => 'user',
        'password' => 'password',
        'port'     => 3306,
        'charset'  => 'utf8',
    )
);

class User extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';
}

$user = User::find(1);
var_dump($user->name);

$log = Eloquent::getConnection()->getQueryLog();
var_dump($log);
```
