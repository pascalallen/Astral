<?php

declare(strict_types=1);

namespace Astral\Test\Domain\Card;

use PHPUnit\Framework\TestCase;
use Astral\Domain\Card\Card;

/**
 * @covers \Astral\Domain\Card\Card
 */
class CardTest extends TestCase
{
    public function test_that_color_returns_expected_value()
    {
        $color = 'Black';
        $type = Card::STANDARD_TYPE;
        $suit = 'Club';
        $rank = 'Ace';
        $card = new Card($color, $type, $suit, $rank);

        static::assertSame($color, $card->color());
    }

    public function test_that_type_returns_expected_value()
    {
        $color = 'Black';
        $type = Card::STANDARD_TYPE;
        $suit = 'Club';
        $rank = 'Ace';
        $card = new Card($color, $type, $suit, $rank);

        static::assertSame($type, $card->type());
    }

    public function test_that_suit_returns_expected_value()
    {
        $color = 'Black';
        $type = Card::STANDARD_TYPE;
        $suit = 'Club';
        $rank = 'Ace';
        $card = new Card($color, $type, $suit, $rank);

        static::assertSame($suit, $card->suit());
    }

    public function test_that_rank_returns_expected_value()
    {
        $color = 'Black';
        $type = Card::STANDARD_TYPE;
        $suit = 'Club';
        $rank = 'Ace';
        $card = new Card($color, $type, $suit, $rank);

        static::assertSame($rank, $card->rank());
    }
}
