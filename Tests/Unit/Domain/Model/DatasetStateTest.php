<?php

declare(strict_types=1);

namespace Slub\Bison\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 */
class DatasetStateTest extends UnitTestCase
{
    /**
     * @var \Slub\Bison\Domain\Model\DatasetState|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slub\Bison\Domain\Model\DatasetState::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getDatasetReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getDataset()
        );
    }

    /**
     * @test
     */
    public function setDatasetForStringSetsDataset(): void
    {
        $this->subject->setDataset('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('dataset'));
    }

    /**
     * @test
     */
    public function getDateReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getDate()
        );
    }

    /**
     * @test
     */
    public function setDateForDateTimeSetsDate(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDate($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('date'));
    }
}
