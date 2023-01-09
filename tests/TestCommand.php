<?php

declare(strict_types=1);

namespace Tests;

use Exception;
use Odesk\Phystrix\AbstractCommand;

class TestCommand extends AbstractCommand
{
    private bool $throwException;

    public function __construct(bool $throwException = false)
    {
        $this->throwException = $throwException;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    protected function run()
    {
        if ($this->throwException) {
            throw new Exception('hi hello!!');
        }

        return 'run test';
    }

    /**
     * @param Exception|null $exception
     * @return mixed
     */
    protected function getFallback(?Exception $exception = null)
    {
        return $exception instanceof Exception ? $exception->getMessage() : 'null';
    }
}
