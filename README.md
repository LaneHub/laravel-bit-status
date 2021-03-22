<h1 align="center"> Laravel Bit Status </h1>

<p align="center"> laravel orm bit status trait.</p>

[![Build Status](https://travis-ci.com/LaneHub/laravel-bit-status.svg?branch=master)](https://travis-ci.com/LaneHub/laravel-bit-status)
![StyleCI build status](https://github.styleci.io/repos/349354592/shield)

## Installing

```shell
$ composer require yuanling/laravel-bit-status -vvv
```

## Usage

Migrate database
```
$table->unsignedTinyInteger('status'); // 1 byte -> maximum of 8  different values
$table->unsigneInteger('status');      // 4 byte -> maximum of 32 different values
$table->unsignedBigInteger('status');  // 8 byte -> maximum of 64 different values
```

Add trait
```
use Illuminate\Database\Eloquent\Model;
use Yuanling\LaravelBitStatus\BitStatusTrait;

class TestModel extends Model
{
    const STATUS_INFO_COMPLETED = 1;   // 0001
    const STATUS_AVATAR_COMPLETED = 2; // 0010
    const STATUS_DESC_COMPLETED = 3;   // 0100
    const STATUS_FOO_COMPLETED = 4;    // 1000

    use BitStatusTrait;
}
```


```
$test = new TestModel;

$test->setBitStatus('status', TestModel::STATUS_AVATAR_COMPLETED);  // default set true
$test->setBitStatus('status', TestModel::STATUS_AVATAR_COMPLETED, true); // same as above
$test->getBitStatus('success', TestModel::STATUS_AVATAR_COMPLETED); // true


$test->setBitStatus('status', TestModel::STATUS_AVATAR_COMPLETED, false); // set false
$test->getBitStatus('status', TestModel::STATUS_AVATAR_COMPLETED); // false
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/LaneHub/laravel-bit-status/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/LaneHub/laravel-bit-status/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
