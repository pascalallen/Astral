<?php

declare(strict_types=1);

namespace Astral\Adapter\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Class BaseRepository
 */
abstract class BaseRepository
{
    /**
     * Constructs BaseRepository
     */
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected string $className
    ) {
    }

    /**
     * Creates query builder
     */
    protected function createQueryBuilder(string $alias, ?string $indexBy = null): QueryBuilder
    {
        return $this->entityManager->createQueryBuilder()
            ->select($alias)
            ->from($this->className, $alias, $indexBy);
    }
}
