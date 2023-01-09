# Laravel Phystrix

[![Latest Stable Version](https://poser.pugx.org/yupmin/laravel-phystrix/v/stable)](https://packagist.org/packages/yupmin/laravel-phystrix)
[![Total Downloads](https://poser.pugx.org/yupmin/laravel-phystrix/downloads)](https://packagist.org/packages/yupmin/laravel-phystrix)
[![License](https://poser.pugx.org/yupmin/laravel-phystrix/license)](https://packagist.org/packages/yupmin/laravel-phystrix)
[![Coding Standards](https://img.shields.io/badge/cs-PSR--2--R-yellow.svg)](https://github.com/php-fig-rectified/fig-rectified-standards)

Laravel Phystrix Package using by [Modern Phystrix](https://github.com/yupmin/phystrix)

## Requirements

* PHP 7.1 above
  * ext-json
  * ext-apcu
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
     * @param Exception|null $exception
     * @return mixed
     */
    protected function getFallback(?Exception $exception = null)
    {
        return $exception->getMessage();
    }
}
```

Run TestCommand

```php
phystrinx(App\Phystrix\TestCommand::class)->execute();
// => "run test"
phystrinx(App\Phystrix\TestCommand::class, false)->execute();
// => "fallback"
```

Run Phystrix Stream for dashboard (`apcu` is required.)

```php
Route::get('/phystrix.stream', function () {
    phystrix_stream()->run();
});
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
