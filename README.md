# Laravel Phystrix

Laravel Phystrix Package using by [Modern Phystrix](https://github.com/yupmin/phystrix)

## Requirements

* PHP 7.1 above
* Laravel 5.5 above

## Installation

```bash
composer require yupmin/laravel-phystrix
```

Install config

```bash
php artisan vendor/publish --provider=Yupmin\Phystrix\ServiceProvider
```

## How to use

Make Phystrix Command

```bash
php artisan make:phystrix-command TestCommand
```

Edit file 'app/Phystrix/TestCommand.php'

```php
class TestCommand extends AbstractCommand
{
    protected $wantFallback;

    public function __construct($wantFallback = false)
    {
        $this->wantFallback = $wantFallback;
    }

    /**
     * @param bool $wantFallback
     * @return mixed
     * @throws Exception
     */
    protected function run()
    {
        if ($this->wantFallback) {
            throw new Exception("fallback");
        }

        return 'run test';
    }

    /**
     * @param Exception $exception
     * @return mixed
     */
    public function getFallback(Exception $exception)
    {
        return $exception->getMessage();
    }
}
```

Run TestCommand

```php
phystrinx(App\Phystrix\TestCommand::class)->exercute();
// => "run test"
phystrinx(App\Phystrix\TestCommand::class, false)->exercute();
// => "fallback"
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.