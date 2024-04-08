<?php

declare(strict_types=1);

namespace Astral\Adapter;

use Closure;
use Psr\Container\ContainerInterface;
use Astral\Adapter\Exception\NotFoundException;
use Astral\Adapter\Exception\TypeMismatchException;
use TypeError;

/**
 * Class Container
 */
class Container implements ContainerInterface
{
    /**
     * Constructs Container
     */
    public function __construct(private array $services)
    {
    }

    /**
     * @inheritDoc
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new NotFoundException($this->notFoundMessage($id));
        }

        try {
            return $this->resolve($id);
        } catch (TypeError $error) {
            throw new TypeMismatchException($this->typeErrorMessage(), $error->getCode(), $error->getPrevious());
        }
    }

    /**
     * Resolves a service
     */
    private function resolve(string $id): mixed
    {
        if ($this->services[$id] instanceof Closure) {
            $this->services[$id] = $this->services[$id]($this);
        }

        return $this->services[$id];
    }

    /**
     * Generates Not Found Message
     */
    public function notFoundMessage(string $id): string
    {
        return 'No entry found for "'.$id.'"';
    }

    /**
     * Generates Type Error Message
     */
    public function typeErrorMessage(): string
    {
        return 'Factory function accepts only 1 argument of type ContainerInterface.';
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }
}
