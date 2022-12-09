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
class SubjectTest extends UnitTestCase
{
    /**
     * @var \Slub\Bison\Domain\Model\Subject|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slub\Bison\Domain\Model\Subject::class,
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
    public function getTermReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTerm()
        );
    }

    /**
     * @test
     */
    public function setTermForStringSetsTerm(): void
    {
        $this->subject->setTerm('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('term'));
    }
}
