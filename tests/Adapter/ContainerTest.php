<?php

declare(strict_types=1);

namespace Astral\Test\Adapter;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Astral\Adapter\Container;
use Astral\Adapter\Exception\NotFoundException;
use Astral\Adapter\Exception\TypeMismatchException;
use stdClass;

/**
 * @covers \Astral\Adapter\Container
 */
class ContainerTest extends TestCase
{
    public function test_that_get_returns_instance_of_service()
    {
        $myTestService = 'my_test_service';
        $services = [
            $myTestService => function (ContainerInterface $container) {
                return new stdClass();
            }
        ];
        $container = new Container($services);
        $service = $container->get($myTestService);

        static::assertInstanceOf(stdClass::class, $service);
    }

    public function test_that_get_throws_exception_when_service_not_found()
    {
        $this->expectException(NotFoundException::class);

        $services = [];
        $container = new Container($services);
        $container->get('my_test_service');
    }

    public function test_that_get_throws_exception_when_service_cannot_be_resolved()
    {
        $this->expectException(TypeMismatchException::class);

        $myTestService = 'my_test_service';
        $services = [
            $myTestService => function (string $string) {
                return new stdClass();
            }
        ];
        $container = new Container($services);
        $container->get($myTestService);
    }
}
