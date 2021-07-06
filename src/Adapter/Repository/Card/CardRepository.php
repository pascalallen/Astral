<?php

declare(strict_types=1);

namespace Astral\Adapter\Repository\Card;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Generator;
use Astral\Adapter\Repository\BaseRepository;
use Astral\Domain\Card\Card;
use Astral\Domain\Card\CardRepositoryInterface;

/**
 * Class CardRepository
 */
class CardRepository extends BaseRepository implements CardRepositoryInterface
{
    /**
     * Constructs CardRepository
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Card::class);
    }

    /**
     * @inheritDoc
     */
    public function getAll(int $perPage, ?int $page = 1, bool $includeJokers = true): Paginator
    {
        $query = $this->createQueryBuilder('c')
            ->select('c')
            ->setFirstResult($perPage * ($page - 1))
            ->setMaxResults($perPage);

        if (!$includeJokers) {
            $query->andWhere('c.type != :type')
                ->setParameter('type', Card::JOKER_TYPE);
        }

        return new Paginator($query);
    }

    /**
     * @inheritDoc
     */
    public function streamAll(bool $includeJokers = true): Generator
    {
        $perPage = 15;
        $page = 1;

        $resultSet = $this->getAll($perPage, $page, $includeJokers);

        /** @var Card $card */
        foreach ($resultSet as $card) {
            yield $card;
        }

        $totalPages = ceil(count($resultSet) / $perPage);
        if ($totalPages > 1) {
            $page = 2;
            while ($page <= $totalPages) {
                $resultSet = $this->getAll($perPage, $page, $includeJokers);

                /** @var Card $card */
                foreach ($resultSet as $card) {
                    yield $card;
                }

                $page++;
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function add(Card $card): void
    {
        $this->entityManager->persist($card);
    }

    /**
     * @inheritDoc
     */
    public function remove(Card $card): void
    {
        $this->entityManager->remove($card);
    }
}
