<?php

declare(strict_types=1);

namespace Astral\Application\Event;

/**
 * Class HelloSaid
 */
final class HelloSaid
{
    /**
     * Constructs HelloSaid
     */
    public function __construct(protected string $name)
    {
    }

    /**
     * Retrieves the name
     */
    public function name(): string
    {
        return $this->name;
    }
}
