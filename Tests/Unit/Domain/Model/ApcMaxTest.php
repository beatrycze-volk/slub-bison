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
class ApcMaxTest extends UnitTestCase
{
    /**
     * @var \Slub\Bison\Domain\Model\ApcMax|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slub\Bison\Domain\Model\ApcMax::class,
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
    public function getEuroReturnsInitialValueForFloat(): void
    {
        self::assertSame(
            0.0,
            $this->subject->getEuro()
        );
    }

    /**
     * @test
     */
    public function setEuroForFloatSetsEuro(): void
    {
        $this->subject->setEuro(3.14159265);

        self::assertEquals(3.14159265, $this->subject->_get('euro'));
    }

    /**
     * @test
     */
    public function getPriceReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function setPriceForIntSetsPrice(): void
    {
        $this->subject->setPrice(12);

        self::assertEquals(12, $this->subject->_get('price'));
    }

    /**
     * @test
     */
    public function getCurrencyReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCurrency()
        );
    }

    /**
     * @test
     */
    public function setCurrencyForStringSetsCurrency(): void
    {
        $this->subject->setCurrency('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('currency'));
    }
}
