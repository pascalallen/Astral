<?php

declare(strict_types=1);

namespace Astral\Application\Listener;

use League\Event\Listener;

/**
 * Class DoSomething
 */
class DoSomething implements Listener
{
    public function __invoke(object $event): void
    {
        echo "I ran".PHP_EOL;
    }
}
