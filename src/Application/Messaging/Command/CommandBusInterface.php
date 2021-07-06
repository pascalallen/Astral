<?php

declare(strict_types=1);

namespace Astral\Application\Messaging\Command;

/**
 * Interface CommandBusInterface
 */
interface CommandBusInterface
{
    /**
     * Executes the given command and optionally returns a value
     */
    public function handle(object $command): mixed;
}
