<?php

declare(strict_types=1);

namespace Astral\Domain\Card;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use Generator;

/**
 * Interface CardRepositoryInterface
 */
interface CardRepositoryInterface
{
    /**
     * Retrieves list of cards
     */
    public function getAll(int $perPage, ?int $page = 1, bool $includeJokers = true): Paginator;

    /**
     * Retrieves stream of cards
     */
    public function streamAll(bool $includeJokers = true): Generator;

    /**
     * Adds a card
     *
     * @throws Exception When an error occurs
     */
    public function add(Card $card): void;

    /**
     * Removes a card
     *
     * @throws Exception When an error occurs
     */
    public function remove(Card $card): void;
}
