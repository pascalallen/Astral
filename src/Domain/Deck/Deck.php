<?php

declare(strict_types=1);

namespace Astral\Domain\Deck;

use Astral\Domain\Card\Card;

/**
 * Class Deck
 */
class Deck
{
    /**
     * Constructs Deck
     */
    public function __construct(protected array $cards)
    {
    }

    /**
     * Retrieves the cards
     */
    public function cards(): array
    {
        return $this->cards;
    }

    /**
     * Retrieves the Jokers
     */
    public function jokers(): array
    {
        return array_filter(
            $this->cards,
            function (Card $card) {
                return $card->type() === Card::JOKER_TYPE;
            }
        );
    }

    /**
     * Omits Jokers
     */
    public function omitJokers(): void
    {
        $this->cards = array_filter(
            $this->cards,
            function (Card $card) {
                return $card->type() !== Card::JOKER_TYPE;
            }
        );
    }

    /**
     * Deals card from top of deck
     */
    public function dealCard(): ?Card
    {
        return array_pop($this->cards);
    }

    /**
     * Shuffles cards in deck
     */
    public function shuffleCards(): void
    {
        shuffle($this->cards);
    }
}
