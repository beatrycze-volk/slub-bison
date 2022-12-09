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
class KeywordTest extends UnitTestCase
{
    /**
     * @var \Slub\Bison\Domain\Model\Keyword|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slub\Bison\Domain\Model\Keyword::class,
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
    public function getKeywordReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getKeyword()
        );
    }

    /**
     * @test
     */
    public function setKeywordForStringSetsKeyword(): void
    {
        $this->subject->setKeyword('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('keyword'));
    }
}
