<?php

declare(strict_types=1);

namespace Astral\Test\Application\CommandHandler;

use Exception;
use PHPUnit\Framework\TestCase;
use Astral\Application\Command\SayHello;
use Astral\Application\CommandHandler\SayHelloHandler;

/**
 * @covers \Astral\Application\CommandHandler\SayHelloHandler
 */
class SayHelloHandlerTest extends TestCase
{
    /** @var SayHelloHandler */
    protected $handler;

    protected function setUp(): void
    {
        $this->handler = new SayHelloHandler();
    }

    public function test_that_handle_executes_successfully()
    {
        $name = 'Pascal';
        $command = new SayHello($name);

        $this->handler->handle($command);

        $this->expectOutputString("Hello, $name!".PHP_EOL);
    }

    public function test_that_handle_throws_exception_when_name_contains_numbers()
    {
        $this->expectException(Exception::class);

        $name = 'Pascal123';
        $command = new SayHello($name);

        $this->handler->handle($command);
    }
}
