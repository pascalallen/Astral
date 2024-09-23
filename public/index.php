<?php

declare(strict_types=1);

use Astral\Application\Command\SayHello;
use Astral\Application\Messaging\Command\CommandBusInterface;
use Psr\Container\ContainerInterface;

require dirname(__DIR__).'/config/bootstrap.php';

/** @var ContainerInterface $container */
$container = require dirname(__DIR__).'/bootstrap/app.php';

/** @var CommandBusInterface $commandBus */
$commandBus = $container->get(CommandBusInterface::class);

$sayHelloCommand = new SayHello('World');
$commandBus->handle($sayHelloCommand);
