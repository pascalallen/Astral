<?php

declare(strict_types=1);

namespace Astral\Adapter\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Astral\Application\Repository\UnitOfWorkInterface;

/**
 * Class UnitOfWork
 */
final class UnitOfWork implements UnitOfWorkInterface
{
    /**
     * Constructs UnitOfWork
     */
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function commit(): void
    {
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function commitTransactional(callable $operation)
    {
        return $this->entityManager->transactional($operation);
    }

    /**
     * @inheritDoc
     */
    public function isClosed(): bool
    {
        return !$this->entityManager->isOpen();
    }
}
