<?php

declare(strict_types=1);

namespace Astral\Application\CommandHandler;

use Exception;
use Astral\Application\Command\SayHello;
use Throwable;

/**
 * Class SayHelloHandler
 */
final class SayHelloHandler
{
    /**
     * Handles the command
     *
     * @throws Throwable
     */
    public function handle(SayHello $command): void
    {
        $name = $command->name();

        try {
            if (preg_match('~\d+~', $name)) {
                $message = sprintf('Name must not contain numbers: %s', $name);
                throw new Exception($message);
            }

            echo "Hello, $name!".PHP_EOL;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
