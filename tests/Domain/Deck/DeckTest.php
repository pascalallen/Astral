<?php

declare(strict_types=1);

namespace Astral\Test\Domain\Deck;

use PHPUnit\Framework\TestCase;
use Astral\Domain\Card\Card;
use Astral\Domain\Deck\Deck;

/**
 * @covers \Astral\Domain\Deck\Deck
 */
class DeckTest extends TestCase
{
    public function test_that_cards_returns_expected_value()
    {
        $cards = $this->getCardsData();
        $deck = new Deck($cards);

        static::assertSame($cards, $deck->cards());
    }

    public function test_that_jokers_returns_expected_value()
    {
        $cards = $this->getCardsData();
        $deck = new Deck($cards);
        $expected = array_filter(
            $cards,
            function (Card $card) {
                return $card->type() === Card::JOKER_TYPE;
            }
        );

        static::assertSame($expected, $deck->jokers());
    }

    public function test_that_omit_jokers_removes_jokers()
    {
        $cards = $this->getCardsData();
        $deck = new Deck($cards);
        $deck->omitJokers();

        static::assertTrue(count($deck->jokers()) === 0);
    }

    public function test_that_deal_card_returns_top_card_from_deck()
    {
        $cards = $this->getCardsData();
        $deck = new Deck($cards);
        $dealtCard = $deck->dealCard();

        static::assertTrue(
            end($cards) === $dealtCard
            && count($deck->cards()) === (count($cards) - 1)
        );
    }

    public function test_that_shuffle_cards_shuffles_cards()
    {
        $cards = $this->getCardsData();
        $deck = new Deck($cards);
        $deck->shuffleCards();

        static::assertTrue(
            $deck->cards() !== $cards
            && count($deck->cards()) === count($cards)
        );
    }

    private function getCardsData(): array
    {
        $cards = [];
        $suitsData = [
            ['suit' => 'Club', 'color' => 'Black'],
            ['suit' => 'Diamond', 'color' => 'Red'],
            ['suit' => 'Heart', 'color' => 'Red'],
            ['suit' => 'Spade', 'color' => 'Black']
        ];
        $ranksData = [
            'Ace',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            'Jack',
            'Queen',
            'King'
        ];

        foreach ($suitsData as $suitsDatum) {
            foreach ($ranksData as $ranksDatum) {
                $cards[] = new Card(
                    $suitsDatum['color'],
                    Card::STANDARD_TYPE,
                    $suitsDatum['suit'],
                    $ranksDatum
                );
            }
        }
        $cards[] = new Card('Black', Card::JOKER_TYPE);
        $cards[] = new Card('Red', Card::JOKER_TYPE);

        return $cards;
    }
}
