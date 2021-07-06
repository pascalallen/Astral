<?php

declare(strict_types=1);

namespace Astral\Test\Application\Command;

use PHPUnit\Framework\TestCase;
use Astral\Application\Command\SayHello;

/**
 * @covers \Astral\Application\Command\SayHello
 */
class SayHelloTest extends TestCase
{
    public function test_that_name_returns_expected_output()
    {
        $name = 'Pascal';

        $command = new SayHello($name);

        static::assertSame($name, $command->name());
    }
}
