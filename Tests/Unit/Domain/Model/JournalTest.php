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
class JournalTest extends UnitTestCase
{
    /**
     * @var \Slub\Bison\Domain\Model\Journal|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slub\Bison\Domain\Model\Journal::class,
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
    public function getIdxReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getIdx()
        );
    }

    /**
     * @test
     */
    public function setIdxForStringSetsIdx(): void
    {
        $this->subject->setIdx('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('idx'));
    }

    /**
     * @test
     */
    public function getRetainsCopyrightAuthorReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getRetainsCopyrightAuthor());
    }

    /**
     * @test
     */
    public function setRetainsCopyrightAuthorForBoolSetsRetainsCopyrightAuthor(): void
    {
        $this->subject->setRetainsCopyrightAuthor(true);

        self::assertEquals(true, $this->subject->_get('retainsCopyrightAuthor'));
    }

    /**
     * @test
     */
    public function getDiscontinuedDateReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getDiscontinuedDate()
        );
    }

    /**
     * @test
     */
    public function setDiscontinuedDateForDateTimeSetsDiscontinuedDate(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDiscontinuedDate($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('discontinuedDate'));
    }

    /**
     * @test
     */
    public function getEditorialBoardDateReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getEditorialBoardDate()
        );
    }

    /**
     * @test
     */
    public function setEditorialBoardDateForStringSetsEditorialBoardDate(): void
    {
        $this->subject->setEditorialBoardDate('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('editorialBoardDate'));
    }

    /**
     * @test
     */
    public function getEissnReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getEissn()
        );
    }

    /**
     * @test
     */
    public function setEissnForStringSetsEissn(): void
    {
        $this->subject->setEissn('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('eissn'));
    }

    /**
     * @test
     */
    public function getPissnReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPissn()
        );
    }

    /**
     * @test
     */
    public function setPissnForStringSetsPissn(): void
    {
        $this->subject->setPissn('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('pissn'));
    }

    /**
     * @test
     */
    public function getPublicationTimeWeeksReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getPublicationTimeWeeks()
        );
    }

    /**
     * @test
     */
    public function setPublicationTimeWeeksForIntSetsPublicationTimeWeeks(): void
    {
        $this->subject->setPublicationTimeWeeks(12);

        self::assertEquals(12, $this->subject->_get('publicationTimeWeeks'));
    }

    /**
     * @test
     */
    public function getPublisherCountryReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPublisherCountry()
        );
    }

    /**
     * @test
     */
    public function setPublisherCountryForStringSetsPublisherCountry(): void
    {
        $this->subject->setPublisherCountry('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('publisherCountry'));
    }

    /**
     * @test
     */
    public function getPublisherNameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPublisherName()
        );
    }

    /**
     * @test
     */
    public function setPublisherNameForStringSetsPublisherName(): void
    {
        $this->subject->setPublisherName('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('publisherName'));
    }

    /**
     * @test
     */
    public function getHasPreservationReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getHasPreservation());
    }

    /**
     * @test
     */
    public function setHasPreservationForBoolSetsHasPreservation(): void
    {
        $this->subject->setHasPreservation(true);

        self::assertEquals(true, $this->subject->_get('hasPreservation'));
    }

    /**
     * @test
     */
    public function getRefJournalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getRefJournal()
        );
    }

    /**
     * @test
     */
    public function setRefJournalForStringSetsRefJournal(): void
    {
        $this->subject->setRefJournal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('refJournal'));
    }

    /**
     * @test
     */
    public function getRefAuthorInstructionsReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getRefAuthorInstructions()
        );
    }

    /**
     * @test
     */
    public function setRefAuthorInstructionsForStringSetsRefAuthorInstructions(): void
    {
        $this->subject->setRefAuthorInstructions('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('refAuthorInstructions'));
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle(): void
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('title'));
    }

    /**
     * @test
     */
    public function getHasApcReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getHasApc());
    }

    /**
     * @test
     */
    public function setHasApcForBoolSetsHasApc(): void
    {
        $this->subject->setHasApc(true);

        self::assertEquals(true, $this->subject->_get('hasApc'));
    }

    /**
     * @test
     */
    public function getHasOtherChargesReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getHasOtherCharges());
    }

    /**
     * @test
     */
    public function setHasOtherChargesForBoolSetsHasOtherCharges(): void
    {
        $this->subject->setHasOtherCharges(true);

        self::assertEquals(true, $this->subject->_get('hasOtherCharges'));
    }

    /**
     * @test
     */
    public function getHasPidSchemeReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getHasPidScheme());
    }

    /**
     * @test
     */
    public function setHasPidSchemeForBoolSetsHasPidScheme(): void
    {
        $this->subject->setHasPidScheme(true);

        self::assertEquals(true, $this->subject->_get('hasPidScheme'));
    }

    /**
     * @test
     */
    public function getLastUpdatedReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLastUpdated()
        );
    }

    /**
     * @test
     */
    public function setLastUpdatedForDateTimeSetsLastUpdated(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setLastUpdated($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('lastUpdated'));
    }

    /**
     * @test
     */
    public function getDoiPidSchemeReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getDoiPidScheme()
        );
    }

    /**
     * @test
     */
    public function setDoiPidSchemeForIntSetsDoiPidScheme(): void
    {
        $this->subject->setDoiPidScheme(12);

        self::assertEquals(12, $this->subject->_get('doiPidScheme'));
    }

    /**
     * @test
     */
    public function getCreatedDateReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getCreatedDate()
        );
    }

    /**
     * @test
     */
    public function setCreatedDateForDateTimeSetsCreatedDate(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setCreatedDate($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('createdDate'));
    }

    /**
     * @test
     */
    public function getAimsScopeReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getAimsScope()
        );
    }

    /**
     * @test
     */
    public function setAimsScopeForStringSetsAimsScope(): void
    {
        $this->subject->setAimsScope('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('aimsScope'));
    }

    /**
     * @test
     */
    public function getAlternativeTitleReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getAlternativeTitle()
        );
    }

    /**
     * @test
     */
    public function setAlternativeTitleForStringSetsAlternativeTitle(): void
    {
        $this->subject->setAlternativeTitle('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('alternativeTitle'));
    }

    /**
     * @test
     */
    public function getScoreReturnsInitialValueForFloat(): void
    {
        self::assertSame(
            0.0,
            $this->subject->getScore()
        );
    }

    /**
     * @test
     */
    public function setScoreForFloatSetsScore(): void
    {
        $this->subject->setScore(3.14159265);

        self::assertEquals(3.14159265, $this->subject->_get('score'));
    }

    /**
     * @test
     */
    public function getPlanSComplianceReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getPlanSCompliance());
    }

    /**
     * @test
     */
    public function setPlanSComplianceForBoolSetsPlanSCompliance(): void
    {
        $this->subject->setPlanSCompliance(true);

        self::assertEquals(true, $this->subject->_get('planSCompliance'));
    }

    /**
     * @test
     */
    public function getJournalApcMaxMMReturnsInitialValueForApcMax(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getJournalApcMaxMM()
        );
    }

    /**
     * @test
     */
    public function setJournalApcMaxMMForObjectStorageContainingApcMaxSetsJournalApcMaxMM(): void
    {
        $journalApcMaxMM = new \Slub\Bison\Domain\Model\ApcMax();
        $objectStorageHoldingExactlyOneJournalApcMaxMM = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneJournalApcMaxMM->attach($journalApcMaxMM);
        $this->subject->setJournalApcMaxMM($objectStorageHoldingExactlyOneJournalApcMaxMM);

        self::assertEquals($objectStorageHoldingExactlyOneJournalApcMaxMM, $this->subject->_get('journalApcMaxMM'));
    }

    /**
     * @test
     */
    public function addJournalApcMaxMMToObjectStorageHoldingJournalApcMaxMM(): void
    {
        $journalApcMaxMM = new \Slub\Bison\Domain\Model\ApcMax();
        $journalApcMaxMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalApcMaxMMObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($journalApcMaxMM));
        $this->subject->_set('journalApcMaxMM', $journalApcMaxMMObjectStorageMock);

        $this->subject->addJournalApcMaxMM($journalApcMaxMM);
    }

    /**
     * @test
     */
    public function removeJournalApcMaxMMFromObjectStorageHoldingJournalApcMaxMM(): void
    {
        $journalApcMaxMM = new \Slub\Bison\Domain\Model\ApcMax();
        $journalApcMaxMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalApcMaxMMObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($journalApcMaxMM));
        $this->subject->_set('journalApcMaxMM', $journalApcMaxMMObjectStorageMock);

        $this->subject->removeJournalApcMaxMM($journalApcMaxMM);
    }

    /**
     * @test
     */
    public function getJournalArticleMMReturnsInitialValueForArticle(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getJournalArticleMM()
        );
    }

    /**
     * @test
     */
    public function setJournalArticleMMForObjectStorageContainingArticleSetsJournalArticleMM(): void
    {
        $journalArticleMM = new \Slub\Bison\Domain\Model\Article();
        $objectStorageHoldingExactlyOneJournalArticleMM = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneJournalArticleMM->attach($journalArticleMM);
        $this->subject->setJournalArticleMM($objectStorageHoldingExactlyOneJournalArticleMM);

        self::assertEquals($objectStorageHoldingExactlyOneJournalArticleMM, $this->subject->_get('journalArticleMM'));
    }

    /**
     * @test
     */
    public function addJournalArticleMMToObjectStorageHoldingJournalArticleMM(): void
    {
        $journalArticleMM = new \Slub\Bison\Domain\Model\Article();
        $journalArticleMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalArticleMMObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($journalArticleMM));
        $this->subject->_set('journalArticleMM', $journalArticleMMObjectStorageMock);

        $this->subject->addJournalArticleMM($journalArticleMM);
    }

    /**
     * @test
     */
    public function removeJournalArticleMMFromObjectStorageHoldingJournalArticleMM(): void
    {
        $journalArticleMM = new \Slub\Bison\Domain\Model\Article();
        $journalArticleMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalArticleMMObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($journalArticleMM));
        $this->subject->_set('journalArticleMM', $journalArticleMMObjectStorageMock);

        $this->subject->removeJournalArticleMM($journalArticleMM);
    }

    /**
     * @test
     */
    public function getJournalEditorialReviewProcessMMReturnsInitialValueForEditorialProcessReview(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getJournalEditorialReviewProcessMM()
        );
    }

    /**
     * @test
     */
    public function setJournalEditorialReviewProcessMMForObjectStorageContainingEditorialProcessReviewSetsJournalEditorialReviewProcessMM(): void
    {
        $journalEditorialReviewProcessMM = new \Slub\Bison\Domain\Model\EditorialProcessReview();
        $objectStorageHoldingExactlyOneJournalEditorialReviewProcessMM = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneJournalEditorialReviewProcessMM->attach($journalEditorialReviewProcessMM);
        $this->subject->setJournalEditorialReviewProcessMM($objectStorageHoldingExactlyOneJournalEditorialReviewProcessMM);

        self::assertEquals($objectStorageHoldingExactlyOneJournalEditorialReviewProcessMM, $this->subject->_get('journalEditorialReviewProcessMM'));
    }

    /**
     * @test
     */
    public function addJournalEditorialReviewProcessMMToObjectStorageHoldingJournalEditorialReviewProcessMM(): void
    {
        $journalEditorialReviewProcessMM = new \Slub\Bison\Domain\Model\EditorialProcessReview();
        $journalEditorialReviewProcessMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalEditorialReviewProcessMMObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($journalEditorialReviewProcessMM));
        $this->subject->_set('journalEditorialReviewProcessMM', $journalEditorialReviewProcessMMObjectStorageMock);

        $this->subject->addJournalEditorialReviewProcessMM($journalEditorialReviewProcessMM);
    }

    /**
     * @test
     */
    public function removeJournalEditorialReviewProcessMMFromObjectStorageHoldingJournalEditorialReviewProcessMM(): void
    {
        $journalEditorialReviewProcessMM = new \Slub\Bison\Domain\Model\EditorialProcessReview();
        $journalEditorialReviewProcessMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalEditorialReviewProcessMMObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($journalEditorialReviewProcessMM));
        $this->subject->_set('journalEditorialReviewProcessMM', $journalEditorialReviewProcessMMObjectStorageMock);

        $this->subject->removeJournalEditorialReviewProcessMM($journalEditorialReviewProcessMM);
    }

    /**
     * @test
     */
    public function getJournalIsReplacedByMMReturnsInitialValueForIsReplacedBy(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getJournalIsReplacedByMM()
        );
    }

    /**
     * @test
     */
    public function setJournalIsReplacedByMMForObjectStorageContainingIsReplacedBySetsJournalIsReplacedByMM(): void
    {
        $journalIsReplacedByMM = new \Slub\Bison\Domain\Model\IsReplacedBy();
        $objectStorageHoldingExactlyOneJournalIsReplacedByMM = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneJournalIsReplacedByMM->attach($journalIsReplacedByMM);
        $this->subject->setJournalIsReplacedByMM($objectStorageHoldingExactlyOneJournalIsReplacedByMM);

        self::assertEquals($objectStorageHoldingExactlyOneJournalIsReplacedByMM, $this->subject->_get('journalIsReplacedByMM'));
    }

    /**
     * @test
     */
    public function addJournalIsReplacedByMMToObjectStorageHoldingJournalIsReplacedByMM(): void
    {
        $journalIsReplacedByMM = new \Slub\Bison\Domain\Model\IsReplacedBy();
        $journalIsReplacedByMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalIsReplacedByMMObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($journalIsReplacedByMM));
        $this->subject->_set('journalIsReplacedByMM', $journalIsReplacedByMMObjectStorageMock);

        $this->subject->addJournalIsReplacedByMM($journalIsReplacedByMM);
    }

    /**
     * @test
     */
    public function removeJournalIsReplacedByMMFromObjectStorageHoldingJournalIsReplacedByMM(): void
    {
        $journalIsReplacedByMM = new \Slub\Bison\Domain\Model\IsReplacedBy();
        $journalIsReplacedByMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalIsReplacedByMMObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($journalIsReplacedByMM));
        $this->subject->_set('journalIsReplacedByMM', $journalIsReplacedByMMObjectStorageMock);

        $this->subject->removeJournalIsReplacedByMM($journalIsReplacedByMM);
    }

    /**
     * @test
     */
    public function getJournalKeywordMMReturnsInitialValueForKeyword(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getJournalKeywordMM()
        );
    }

    /**
     * @test
     */
    public function setJournalKeywordMMForObjectStorageContainingKeywordSetsJournalKeywordMM(): void
    {
        $journalKeywordMM = new \Slub\Bison\Domain\Model\Keyword();
        $objectStorageHoldingExactlyOneJournalKeywordMM = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneJournalKeywordMM->attach($journalKeywordMM);
        $this->subject->setJournalKeywordMM($objectStorageHoldingExactlyOneJournalKeywordMM);

        self::assertEquals($objectStorageHoldingExactlyOneJournalKeywordMM, $this->subject->_get('journalKeywordMM'));
    }

    /**
     * @test
     */
    public function addJournalKeywordMMToObjectStorageHoldingJournalKeywordMM(): void
    {
        $journalKeywordMM = new \Slub\Bison\Domain\Model\Keyword();
        $journalKeywordMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalKeywordMMObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($journalKeywordMM));
        $this->subject->_set('journalKeywordMM', $journalKeywordMMObjectStorageMock);

        $this->subject->addJournalKeywordMM($journalKeywordMM);
    }

    /**
     * @test
     */
    public function removeJournalKeywordMMFromObjectStorageHoldingJournalKeywordMM(): void
    {
        $journalKeywordMM = new \Slub\Bison\Domain\Model\Keyword();
        $journalKeywordMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalKeywordMMObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($journalKeywordMM));
        $this->subject->_set('journalKeywordMM', $journalKeywordMMObjectStorageMock);

        $this->subject->removeJournalKeywordMM($journalKeywordMM);
    }

    /**
     * @test
     */
    public function getJournalLanguageMMReturnsInitialValueForLanguage(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getJournalLanguageMM()
        );
    }

    /**
     * @test
     */
    public function setJournalLanguageMMForObjectStorageContainingLanguageSetsJournalLanguageMM(): void
    {
        $journalLanguageMM = new \Slub\Bison\Domain\Model\Language();
        $objectStorageHoldingExactlyOneJournalLanguageMM = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneJournalLanguageMM->attach($journalLanguageMM);
        $this->subject->setJournalLanguageMM($objectStorageHoldingExactlyOneJournalLanguageMM);

        self::assertEquals($objectStorageHoldingExactlyOneJournalLanguageMM, $this->subject->_get('journalLanguageMM'));
    }

    /**
     * @test
     */
    public function addJournalLanguageMMToObjectStorageHoldingJournalLanguageMM(): void
    {
        $journalLanguageMM = new \Slub\Bison\Domain\Model\Language();
        $journalLanguageMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalLanguageMMObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($journalLanguageMM));
        $this->subject->_set('journalLanguageMM', $journalLanguageMMObjectStorageMock);

        $this->subject->addJournalLanguageMM($journalLanguageMM);
    }

    /**
     * @test
     */
    public function removeJournalLanguageMMFromObjectStorageHoldingJournalLanguageMM(): void
    {
        $journalLanguageMM = new \Slub\Bison\Domain\Model\Language();
        $journalLanguageMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalLanguageMMObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($journalLanguageMM));
        $this->subject->_set('journalLanguageMM', $journalLanguageMMObjectStorageMock);

        $this->subject->removeJournalLanguageMM($journalLanguageMM);
    }

    /**
     * @test
     */
    public function getJournalLicenseMMReturnsInitialValueForLicense(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getJournalLicenseMM()
        );
    }

    /**
     * @test
     */
    public function setJournalLicenseMMForObjectStorageContainingLicenseSetsJournalLicenseMM(): void
    {
        $journalLicenseMM = new \Slub\Bison\Domain\Model\License();
        $objectStorageHoldingExactlyOneJournalLicenseMM = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneJournalLicenseMM->attach($journalLicenseMM);
        $this->subject->setJournalLicenseMM($objectStorageHoldingExactlyOneJournalLicenseMM);

        self::assertEquals($objectStorageHoldingExactlyOneJournalLicenseMM, $this->subject->_get('journalLicenseMM'));
    }

    /**
     * @test
     */
    public function addJournalLicenseMMToObjectStorageHoldingJournalLicenseMM(): void
    {
        $journalLicenseMM = new \Slub\Bison\Domain\Model\License();
        $journalLicenseMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalLicenseMMObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($journalLicenseMM));
        $this->subject->_set('journalLicenseMM', $journalLicenseMMObjectStorageMock);

        $this->subject->addJournalLicenseMM($journalLicenseMM);
    }

    /**
     * @test
     */
    public function removeJournalLicenseMMFromObjectStorageHoldingJournalLicenseMM(): void
    {
        $journalLicenseMM = new \Slub\Bison\Domain\Model\License();
        $journalLicenseMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalLicenseMMObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($journalLicenseMM));
        $this->subject->_set('journalLicenseMM', $journalLicenseMMObjectStorageMock);

        $this->subject->removeJournalLicenseMM($journalLicenseMM);
    }

    /**
     * @test
     */
    public function getJournalSubjectMMReturnsInitialValueForSubject(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getJournalSubjectMM()
        );
    }

    /**
     * @test
     */
    public function setJournalSubjectMMForObjectStorageContainingSubjectSetsJournalSubjectMM(): void
    {
        $journalSubjectMM = new \Slub\Bison\Domain\Model\Subject();
        $objectStorageHoldingExactlyOneJournalSubjectMM = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneJournalSubjectMM->attach($journalSubjectMM);
        $this->subject->setJournalSubjectMM($objectStorageHoldingExactlyOneJournalSubjectMM);

        self::assertEquals($objectStorageHoldingExactlyOneJournalSubjectMM, $this->subject->_get('journalSubjectMM'));
    }

    /**
     * @test
     */
    public function addJournalSubjectMMToObjectStorageHoldingJournalSubjectMM(): void
    {
        $journalSubjectMM = new \Slub\Bison\Domain\Model\Subject();
        $journalSubjectMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalSubjectMMObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($journalSubjectMM));
        $this->subject->_set('journalSubjectMM', $journalSubjectMMObjectStorageMock);

        $this->subject->addJournalSubjectMM($journalSubjectMM);
    }

    /**
     * @test
     */
    public function removeJournalSubjectMMFromObjectStorageHoldingJournalSubjectMM(): void
    {
        $journalSubjectMM = new \Slub\Bison\Domain\Model\Subject();
        $journalSubjectMMObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $journalSubjectMMObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($journalSubjectMM));
        $this->subject->_set('journalSubjectMM', $journalSubjectMMObjectStorageMock);

        $this->subject->removeJournalSubjectMM($journalSubjectMM);
    }
}
