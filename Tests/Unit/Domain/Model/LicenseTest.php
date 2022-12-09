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
class LicenseTest extends UnitTestCase
{
    /**
     * @var \Slub\Bison\Domain\Model\License|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slub\Bison\Domain\Model\License::class,
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
    public function getNonCommercialReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getNonCommercial());
    }

    /**
     * @test
     */
    public function setNonCommercialForBoolSetsNonCommercial(): void
    {
        $this->subject->setNonCommercial(true);

        self::assertEquals(true, $this->subject->_get('nonCommercial'));
    }

    /**
     * @test
     */
    public function getNoDerivativeReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getNoDerivative());
    }

    /**
     * @test
     */
    public function setNoDerivativeForBoolSetsNoDerivative(): void
    {
        $this->subject->setNoDerivative(true);

        self::assertEquals(true, $this->subject->_get('noDerivative'));
    }

    /**
     * @test
     */
    public function getAttributionReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getAttribution());
    }

    /**
     * @test
     */
    public function setAttributionForBoolSetsAttribution(): void
    {
        $this->subject->setAttribution(true);

        self::assertEquals(true, $this->subject->_get('attribution'));
    }
}
