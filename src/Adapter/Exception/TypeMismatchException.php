<?php

declare(strict_types=1);

namespace Astral\Adapter\Exception;

use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class TypeMismatchException
 */
class TypeMismatchException extends Exception implements ContainerExceptionInterface
{
}
