<?php

namespace Yupmin\Phystrix\Facades;

use Illuminate\Support\Facades\Facade;

class PhystrixStream extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'phystrix.stream';
    }
}
