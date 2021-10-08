<?php

declare(strict_types=1);

namespace Astral\Application\Messaging\Event;

use League\Event\EventGenerator;
use League\Event\ListenerPriority;
use League\Event\ListenerSubscriber;

/**
 * Interface EventDispatcherInterface
 */
interface EventDispatcherInterface
{
    /**
     * Provide all relevant listeners with an event to process
     */
    public function dispatch(object $event): object;

    public function dispatchGeneratedEvents(EventGenerator $generator): void;

    public function subscribeTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void;

    public function subscribeOnceTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void;

    public function subscribeListenersFrom(ListenerSubscriber $subscriber): void;
}
