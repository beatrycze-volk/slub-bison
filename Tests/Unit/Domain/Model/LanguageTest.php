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
class LanguageTest extends UnitTestCase
{
    /**
     * @var \Slub\Bison\Domain\Model\Language|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slub\Bison\Domain\Model\Language::class,
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
    public function getLangReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLang()
        );
    }

    /**
     * @test
     */
    public function setLangForStringSetsLang(): void
    {
        $this->subject->setLang('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('lang'));
    }
}
