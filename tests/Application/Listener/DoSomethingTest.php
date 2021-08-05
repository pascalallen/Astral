<?php

declare(strict_types=1);

namespace Astral\Test\Application\Listener;

use Astral\Application\Event\SomethingHappened;
use Astral\Application\Listener\DoSomething;
use Astral\Application\Messaging\Event\EventDispatcherInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \Astral\Application\Listener\DoSomething
 */
class DoSomethingTest extends TestCase
{
    /** @var DoSomething */
    protected $listener;
    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    protected function setUp(): void
    {
        /** @var ContainerInterface $container */
        $container = require dirname(__DIR__, 3).'/bootstrap/app.php';

        $this->listener = new DoSomething();
        $this->eventDispatcher = $container->get(EventDispatcherInterface::class);
    }

    public function test_that_test_string_is_displayed_on_something_happened_event()
    {
        $event = new SomethingHappened();

        $this->eventDispatcher->dispatch($event);

        $this->expectOutputString("I ran".PHP_EOL);
    }

}
