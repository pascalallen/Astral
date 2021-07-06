<?php

declare(strict_types=1);

namespace Astral\Domain\Card;

/**
 * Class Card
 */
class Card
{
    /**
     * Joker type
     *
     * @var string
     */
    public const JOKER_TYPE = 'joker';

    /**
     * Standard type
     *
     * @var string
     */
    public const STANDARD_TYPE = 'standard';

    /**
     * Auto-generated ID for Doctrine ORM
     *
     * @var int
     */
    protected int $id;

    /**
     * Constructs Card
     */
    public function __construct(
        protected string $color,
        protected string $type,
        protected ?string $suit = null,
        protected ?string $rank = null
    ) {
    }

    /**
     * Retrieves the card color
     */
    public function color(): string
    {
        return $this->color;
    }

    /**
     * Retrieves the card type
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Retrieves the card suit
     */
    public function suit(): string
    {
        return $this->suit;
    }

    /**
     * Retrieves the card rank
     */
    public function rank(): string
    {
        return $this->rank;
    }
}
