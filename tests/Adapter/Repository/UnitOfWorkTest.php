<?php

declare(strict_types=1);

namespace Astral\Test\Adapter\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Astral\Adapter\Repository\UnitOfWork;

/**
 * @covers \Astral\Adapter\Repository\UnitOfWork
 */
class UnitOfWorkTest extends TestCase
{
    /** @var UnitOfWork */
    protected $unitOfWork;
    /** @var EntityManagerInterface|MockInterface */
    protected $mockEntityManager;

    protected function setUp(): void
    {
        $this->mockEntityManager = Mockery::mock(EntityManagerInterface::class);
        $this->unitOfWork = new UnitOfWork($this->mockEntityManager);
    }

    public function test_that_commit_delegates_to_service()
    {
        $this->mockEntityManager
            ->shouldReceive('flush')
            ->once()
            ->andReturnNull();

        static::assertTrue($this->unitOfWork->commit() === null);
    }

    public function test_that_commit_transactional_returns_value_from_callback()
    {
        $this->mockEntityManager
            ->shouldReceive('transactional')
            ->once()
            ->andReturnUsing(function (callable $func) {
                return $func();
            });

        $func = function () {
            return 'foo';
        };

        static::assertSame('foo', $this->unitOfWork->commitTransactional($func));
    }

    public function test_that_is_closed_returns_expected_value()
    {
        $this->mockEntityManager
            ->shouldReceive('isOpen')
            ->once()
            ->andReturnFalse();

        static::assertTrue($this->unitOfWork->isClosed());
    }
}
