<?php

declare(strict_types=1);

namespace Yupmin\Phystrix\Facades;

use Illuminate\Support\Facades\Facade;

class Phystrix extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'phystrix.command-factory';
    }
}
