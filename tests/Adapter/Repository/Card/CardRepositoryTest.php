<?php

declare(strict_types=1);

namespace Astral\Test\Adapter\Repository\Card;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Astral\Application\Repository\UnitOfWorkInterface;
use Astral\Domain\Card\Card;
use Astral\Domain\Card\CardRepositoryInterface;

/**
 * @covers \Astral\Adapter\Repository\Card\CardRepository
 * @covers \Astral\Adapter\Repository\BaseRepository
 */
class CardRepositoryTest extends TestCase
{
    /** @var CardRepositoryInterface */
    protected $cardRepository;
    /** @var UnitOfWorkInterface */
    protected $unitOfWork;

    protected function setUp(): void
    {
        /** @var ContainerInterface $container */
        $container = require dirname(__DIR__, 4).'/bootstrap/app.php';

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get(EntityManagerInterface::class);
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->dropSchema($metadata);
        $schemaTool->updateSchema($metadata);

        $this->cardRepository = $container->get(CardRepositoryInterface::class);
        $this->unitOfWork = $container->get(UnitOfWorkInterface::class);
    }

    public function test_that_get_all_returns_expected_results()
    {
        $cards = $this->getCardsData();
        foreach ($cards as $card) {
            $this->cardRepository->add($card);
        }
        $this->unitOfWork->commit();

        $perPage = 15;
        $page = 1;
        $includeJokers = false;

        $results = $this->cardRepository->getAll($perPage, $page, $includeJokers);

        static::assertTrue($results->count() === 52);
    }

    public function test_that_stream_all_returns_expected_results_after_removal()
    {
        $cards = $this->getCardsData();
        foreach ($cards as $card) {
            $this->cardRepository->add($card);
        }
        $this->unitOfWork->commit();

        $results = $this->cardRepository->streamAll();

        /** @var Card $card */
        foreach ($results as $card) {
            if ($card->type() === Card::JOKER_TYPE) {
                $this->cardRepository->remove($card);
            }
        }
        $this->unitOfWork->commit();

        $cards = $this->cardRepository->streamAll();
        $count = 0;
        foreach ($cards as $card) {
            $count++;
        }

        static::assertTrue($count === 52);
    }

    public function test_that_stream_all_returns_expected_value()
    {
        $total = 54;
        $cards = $this->getCardsData();
        foreach ($cards as $card) {
            $this->cardRepository->add($card);
        }
        $this->unitOfWork->commit();

        $cards = $this->cardRepository->streamAll();
        $count = 0;
        foreach ($cards as $card) {
            $count++;
        }

        static::assertTrue($count === $total);
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
