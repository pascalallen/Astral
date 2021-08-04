<?php

declare(strict_types=1);

use Astral\Adapter\Container;
use Astral\Adapter\Messaging\Command\CommandBus;
use Astral\Adapter\Messaging\Event\EventDispatcher;
use Astral\Adapter\Repository\Card\CardRepository;
use Astral\Adapter\Repository\UnitOfWork;
use Astral\Application\Command\SayHello;
use Astral\Application\CommandHandler\SayHelloHandler;
use Astral\Application\Messaging\Command\CommandBusInterface;
use Astral\Application\Repository\UnitOfWorkInterface;
use Astral\Domain\Card\CardRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Plugins\LockingMiddleware;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

require dirname(__DIR__).'/config/bootstrap.php';

$handlerMiddleware = new CommandHandlerMiddleware(
    new ClassNameExtractor(),
    new InMemoryLocator([
        SayHello::class => new SayHelloHandler()
    ]),
    new HandleInflector()
);

$lockingMiddleware = new LockingMiddleware();

$paths = [dirname(__DIR__)."/database/metadata"];
$isDevMode = false;

$dbParams = [
    'driver'   => $_ENV['DB_DRIVER'],
    'host'     => $_ENV['DB_HOST'],
    'port'     => $_ENV['DB_PORT'],
    'user'     => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'dbname'   => $_ENV['DB_DATABASE']
];

$config = Setup::createXMLMetadataConfiguration(
    $paths,
    $isDevMode
);

$services = [
    CommandBusInterface::class      => new CommandBus([$lockingMiddleware, $handlerMiddleware]),
    EntityManagerInterface::class   => EntityManager::create($dbParams, $config),
    CardRepositoryInterface::class  => function (ContainerInterface $container) {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get(EntityManagerInterface::class);

        return new CardRepository($entityManager);
    },
    UnitOfWorkInterface::class      => function (ContainerInterface $container) {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get(EntityManagerInterface::class);

        return new UnitOfWork($entityManager);
    },
    LoggerInterface::class          => new Logger($_ENV['APP_NAME'], [
        new StreamHandler('php://stdout', Logger::DEBUG),
        new SyslogUdpHandler(
            $_ENV['PAPERTRAIL_URL'],
            (int) $_ENV['PAPERTRAIL_PORT'],
            LOG_USER,
            Logger::DEBUG
        )
    ]),
    EventDispatcherInterface::class => new EventDispatcher()
];

return new Container($services);
