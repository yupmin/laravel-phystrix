<?php

declare(strict_types=1);

namespace Yupmin\Phystrix\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakePhystrixCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:phystrix-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Phystrix Command class';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Command';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/phystrix-command.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Phystrix';
    }
}
