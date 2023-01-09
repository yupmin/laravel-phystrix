<?php

declare(strict_types=1);

namespace Tests;

use Odesk\Phystrix;

class TestCommandTest extends TestCase
{
    private Phystrix\CommandFactory $commandFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->commandFactory = $this->app->make(Phystrix\CommandFactory::class);
    }

    public function testExecute(): void
    {
        /** @var Phystrix\AbstractCommand|TestCommand $command */
        $command = $this->commandFactory->getCommand(TestCommand::class);
        $this->assertInstanceOf(TestCommand::class, $command);

        $this->assertEquals('run test', $command->execute());
    }

    public function testThrowException(): void
    {
        /** @var Phystrix\AbstractCommand|TestCommand $command */
        $command = $this->commandFactory->getCommand(TestCommand::class, true);
        $this->assertInstanceOf(TestCommand::class, $command);

        $this->assertEquals('hi hello!!', $command->execute());
    }
}
