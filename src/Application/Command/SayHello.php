<?php

declare(strict_types=1);

namespace Astral\Application\Command;

/**
 * Class SayHello
 */
final class SayHello
{
    /**
     * Constructs SayHello
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
