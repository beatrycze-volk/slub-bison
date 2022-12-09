<?php

declare(strict_types=1);

namespace Slub\Bison\Domain\Model;


/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

/**
 * Journal
 */
class Journal extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * idx
     *
     * @var string
     */
    protected $idx = null;

    /**
     * retainsCopyrightAuthor
     *
     * @var bool
     */
    protected $retainsCopyrightAuthor = null;

    /**
     * discontinuedDate
     *
     * @var \DateTime
     */
    protected $discontinuedDate = null;

    /**
     * editorialBoardDate
     *
     * @var string
     */
    protected $editorialBoardDate = null;

    /**
     * eissn
     *
     * @var string
     */
    protected $eissn = null;

    /**
     * pissn
     *
     * @var string
     */
    protected $pissn = null;

    /**
     * publicationTimeWeeks
     *
     * @var int
     */
    protected $publicationTimeWeeks = null;

    /**
     * publisherCountry
     *
     * @var string
     */
    protected $publisherCountry = null;

    /**
     * publisherName
     *
     * @var string
     */
    protected $publisherName = null;

    /**
     * hasPreservation
     *
     * @var bool
     */
    protected $hasPreservation = null;

    /**
     * refJournal
     *
     * @var string
     */
    protected $refJournal = null;

    /**
     * refAuthorInstructions
     *
     * @var string
     */
    protected $refAuthorInstructions = null;

    /**
     * title
     *
     * @var string
     */
    protected $title = null;

    /**
     * hasApc
     *
     * @var bool
     */
    protected $hasApc = null;

    /**
     * hasOtherCharges
     *
     * @var bool
     */
    protected $hasOtherCharges = null;

    /**
     * hasPidScheme
     *
     * @var bool
     */
    protected $hasPidScheme = null;

    /**
     * lastUpdated
     *
     * @var \DateTime
     */
    protected $lastUpdated = null;

    /**
     * doiPidScheme
     *
     * @var int
     */
    protected $doiPidScheme = null;

    /**
     * createdDate
     *
     * @var \DateTime
     */
    protected $createdDate = null;

    /**
     * aimsScope
     *
     * @var string
     */
    protected $aimsScope = null;

    /**
     * alternativeTitle
     *
     * @var string
     */
    protected $alternativeTitle = null;

    /**
     * score
     *
     * @var float
     */
    protected $score = null;

    /**
     * planSCompliance
     *
     * @var bool
     */
    protected $planSCompliance = null;

    /**
     * journalApcMaxMM
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\ApcMax>
     */
    protected $journalApcMaxMM = null;

    /**
     * journalArticleMM
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Article>
     */
    protected $journalArticleMM = null;

    /**
     * journalEditorialReviewProcessMM
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\EditorialProcessReview>
     */
    protected $journalEditorialReviewProcessMM = null;

    /**
     * journalIsReplacedByMM
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\IsReplacedBy>
     */
    protected $journalIsReplacedByMM = null;

    /**
     * journalKeywordMM
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Keyword>
     */
    protected $journalKeywordMM = null;

    /**
     * journalLanguageMM
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Language>
     */
    protected $journalLanguageMM = null;

    /**
     * journalLicenseMM
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\License>
     */
    protected $journalLicenseMM = null;

    /**
     * journalSubjectMM
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Subject>
     */
    protected $journalSubjectMM = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->journalApcMaxMM = $this->journalApcMaxMM ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->journalArticleMM = $this->journalArticleMM ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->journalEditorialReviewProcessMM = $this->journalEditorialReviewProcessMM ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->journalIsReplacedByMM = $this->journalIsReplacedByMM ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->journalKeywordMM = $this->journalKeywordMM ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->journalLanguageMM = $this->journalLanguageMM ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->journalLicenseMM = $this->journalLicenseMM ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->journalSubjectMM = $this->journalSubjectMM ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the idx
     *
     * @return string
     */
    public function getIdx()
    {
        return $this->idx;
    }

    /**
     * Sets the idx
     *
     * @param string $idx
     * @return void
     */
    public function setIdx(string $idx)
    {
        $this->idx = $idx;
    }

    /**
     * Returns the retainsCopyrightAuthor
     *
     * @return bool
     */
    public function getRetainsCopyrightAuthor()
    {
        return $this->retainsCopyrightAuthor;
    }

    /**
     * Sets the retainsCopyrightAuthor
     *
     * @param bool $retainsCopyrightAuthor
     * @return void
     */
    public function setRetainsCopyrightAuthor(bool $retainsCopyrightAuthor)
    {
        $this->retainsCopyrightAuthor = $retainsCopyrightAuthor;
    }

    /**
     * Returns the boolean state of retainsCopyrightAuthor
     *
     * @return bool
     */
    public function isRetainsCopyrightAuthor()
    {
        return $this->retainsCopyrightAuthor;
    }

    /**
     * Returns the discontinuedDate
     *
     * @return \DateTime
     */
    public function getDiscontinuedDate()
    {
        return $this->discontinuedDate;
    }

    /**
     * Sets the discontinuedDate
     *
     * @param \DateTime $discontinuedDate
     * @return void
     */
    public function setDiscontinuedDate(\DateTime $discontinuedDate)
    {
        $this->discontinuedDate = $discontinuedDate;
    }

    /**
     * Returns the editorialBoardDate
     *
     * @return string
     */
    public function getEditorialBoardDate()
    {
        return $this->editorialBoardDate;
    }

    /**
     * Sets the editorialBoardDate
     *
     * @param string $editorialBoardDate
     * @return void
     */
    public function setEditorialBoardDate(string $editorialBoardDate)
    {
        $this->editorialBoardDate = $editorialBoardDate;
    }

    /**
     * Returns the eissn
     *
     * @return string
     */
    public function getEissn()
    {
        return $this->eissn;
    }

    /**
     * Sets the eissn
     *
     * @param string $eissn
     * @return void
     */
    public function setEissn(string $eissn)
    {
        $this->eissn = $eissn;
    }

    /**
     * Returns the pissn
     *
     * @return string
     */
    public function getPissn()
    {
        return $this->pissn;
    }

    /**
     * Sets the pissn
     *
     * @param string $pissn
     * @return void
     */
    public function setPissn(string $pissn)
    {
        $this->pissn = $pissn;
    }

    /**
     * Returns the publicationTimeWeeks
     *
     * @return int
     */
    public function getPublicationTimeWeeks()
    {
        return $this->publicationTimeWeeks;
    }

    /**
     * Sets the publicationTimeWeeks
     *
     * @param int $publicationTimeWeeks
     * @return void
     */
    public function setPublicationTimeWeeks(int $publicationTimeWeeks)
    {
        $this->publicationTimeWeeks = $publicationTimeWeeks;
    }

    /**
     * Returns the publisherCountry
     *
     * @return string
     */
    public function getPublisherCountry()
    {
        return $this->publisherCountry;
    }

    /**
     * Sets the publisherCountry
     *
     * @param string $publisherCountry
     * @return void
     */
    public function setPublisherCountry(string $publisherCountry)
    {
        $this->publisherCountry = $publisherCountry;
    }

    /**
     * Returns the publisherName
     *
     * @return string
     */
    public function getPublisherName()
    {
        return $this->publisherName;
    }

    /**
     * Sets the publisherName
     *
     * @param string $publisherName
     * @return void
     */
    public function setPublisherName(string $publisherName)
    {
        $this->publisherName = $publisherName;
    }

    /**
     * Returns the hasPreservation
     *
     * @return bool
     */
    public function getHasPreservation()
    {
        return $this->hasPreservation;
    }

    /**
     * Sets the hasPreservation
     *
     * @param bool $hasPreservation
     * @return void
     */
    public function setHasPreservation(bool $hasPreservation)
    {
        $this->hasPreservation = $hasPreservation;
    }

    /**
     * Returns the boolean state of hasPreservation
     *
     * @return bool
     */
    public function isHasPreservation()
    {
        return $this->hasPreservation;
    }

    /**
     * Returns the refJournal
     *
     * @return string
     */
    public function getRefJournal()
    {
        return $this->refJournal;
    }

    /**
     * Sets the refJournal
     *
     * @param string $refJournal
     * @return void
     */
    public function setRefJournal(string $refJournal)
    {
        $this->refJournal = $refJournal;
    }

    /**
     * Returns the refAuthorInstructions
     *
     * @return string
     */
    public function getRefAuthorInstructions()
    {
        return $this->refAuthorInstructions;
    }

    /**
     * Sets the refAuthorInstructions
     *
     * @param string $refAuthorInstructions
     * @return void
     */
    public function setRefAuthorInstructions(string $refAuthorInstructions)
    {
        $this->refAuthorInstructions = $refAuthorInstructions;
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Returns the hasApc
     *
     * @return bool
     */
    public function getHasApc()
    {
        return $this->hasApc;
    }

    /**
     * Sets the hasApc
     *
     * @param bool $hasApc
     * @return void
     */
    public function setHasApc(bool $hasApc)
    {
        $this->hasApc = $hasApc;
    }

    /**
     * Returns the boolean state of hasApc
     *
     * @return bool
     */
    public function isHasApc()
    {
        return $this->hasApc;
    }

    /**
     * Returns the hasOtherCharges
     *
     * @return bool
     */
    public function getHasOtherCharges()
    {
        return $this->hasOtherCharges;
    }

    /**
     * Sets the hasOtherCharges
     *
     * @param bool $hasOtherCharges
     * @return void
     */
    public function setHasOtherCharges(bool $hasOtherCharges)
    {
        $this->hasOtherCharges = $hasOtherCharges;
    }

    /**
     * Returns the boolean state of hasOtherCharges
     *
     * @return bool
     */
    public function isHasOtherCharges()
    {
        return $this->hasOtherCharges;
    }

    /**
     * Returns the hasPidScheme
     *
     * @return bool
     */
    public function getHasPidScheme()
    {
        return $this->hasPidScheme;
    }

    /**
     * Sets the hasPidScheme
     *
     * @param bool $hasPidScheme
     * @return void
     */
    public function setHasPidScheme(bool $hasPidScheme)
    {
        $this->hasPidScheme = $hasPidScheme;
    }

    /**
     * Returns the boolean state of hasPidScheme
     *
     * @return bool
     */
    public function isHasPidScheme()
    {
        return $this->hasPidScheme;
    }

    /**
     * Returns the lastUpdated
     *
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * Sets the lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return void
     */
    public function setLastUpdated(\DateTime $lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
    }

    /**
     * Returns the doiPidScheme
     *
     * @return int
     */
    public function getDoiPidScheme()
    {
        return $this->doiPidScheme;
    }

    /**
     * Sets the doiPidScheme
     *
     * @param int $doiPidScheme
     * @return void
     */
    public function setDoiPidScheme(int $doiPidScheme)
    {
        $this->doiPidScheme = $doiPidScheme;
    }

    /**
     * Returns the createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Sets the createdDate
     *
     * @param \DateTime $createdDate
     * @return void
     */
    public function setCreatedDate(\DateTime $createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * Returns the aimsScope
     *
     * @return string
     */
    public function getAimsScope()
    {
        return $this->aimsScope;
    }

    /**
     * Sets the aimsScope
     *
     * @param string $aimsScope
     * @return void
     */
    public function setAimsScope(string $aimsScope)
    {
        $this->aimsScope = $aimsScope;
    }

    /**
     * Returns the alternativeTitle
     *
     * @return string
     */
    public function getAlternativeTitle()
    {
        return $this->alternativeTitle;
    }

    /**
     * Sets the alternativeTitle
     *
     * @param string $alternativeTitle
     * @return void
     */
    public function setAlternativeTitle(string $alternativeTitle)
    {
        $this->alternativeTitle = $alternativeTitle;
    }

    /**
     * Returns the score
     *
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Sets the score
     *
     * @param float $score
     * @return void
     */
    public function setScore(float $score)
    {
        $this->score = $score;
    }

    /**
     * Returns the planSCompliance
     *
     * @return bool
     */
    public function getPlanSCompliance()
    {
        return $this->planSCompliance;
    }

    /**
     * Sets the planSCompliance
     *
     * @param bool $planSCompliance
     * @return void
     */
    public function setPlanSCompliance(bool $planSCompliance)
    {
        $this->planSCompliance = $planSCompliance;
    }

    /**
     * Returns the boolean state of planSCompliance
     *
     * @return bool
     */
    public function isPlanSCompliance()
    {
        return $this->planSCompliance;
    }

    /**
     * Adds a ApcMax
     *
     * @param \Slub\Bison\Domain\Model\ApcMax $journalApcMaxMM
     * @return void
     */
    public function addJournalApcMaxMM(\Slub\Bison\Domain\Model\ApcMax $journalApcMaxMM)
    {
        $this->journalApcMaxMM->attach($journalApcMaxMM);
    }

    /**
     * Removes a ApcMax
     *
     * @param \Slub\Bison\Domain\Model\ApcMax $journalApcMaxMMToRemove The ApcMax to be removed
     * @return void
     */
    public function removeJournalApcMaxMM(\Slub\Bison\Domain\Model\ApcMax $journalApcMaxMMToRemove)
    {
        $this->journalApcMaxMM->detach($journalApcMaxMMToRemove);
    }

    /**
     * Returns the journalApcMaxMM
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\ApcMax>
     */
    public function getJournalApcMaxMM()
    {
        return $this->journalApcMaxMM;
    }

    /**
     * Sets the journalApcMaxMM
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\ApcMax> $journalApcMaxMM
     * @return void
     */
    public function setJournalApcMaxMM(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $journalApcMaxMM)
    {
        $this->journalApcMaxMM = $journalApcMaxMM;
    }

    /**
     * Adds a Article
     *
     * @param \Slub\Bison\Domain\Model\Article $journalArticleMM
     * @return void
     */
    public function addJournalArticleMM(\Slub\Bison\Domain\Model\Article $journalArticleMM)
    {
        $this->journalArticleMM->attach($journalArticleMM);
    }

    /**
     * Removes a Article
     *
     * @param \Slub\Bison\Domain\Model\Article $journalArticleMMToRemove The Article to be removed
     * @return void
     */
    public function removeJournalArticleMM(\Slub\Bison\Domain\Model\Article $journalArticleMMToRemove)
    {
        $this->journalArticleMM->detach($journalArticleMMToRemove);
    }

    /**
     * Returns the journalArticleMM
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Article>
     */
    public function getJournalArticleMM()
    {
        return $this->journalArticleMM;
    }

    /**
     * Sets the journalArticleMM
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Article> $journalArticleMM
     * @return void
     */
    public function setJournalArticleMM(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $journalArticleMM)
    {
        $this->journalArticleMM = $journalArticleMM;
    }

    /**
     * Adds a EditorialProcessReview
     *
     * @param \Slub\Bison\Domain\Model\EditorialProcessReview $journalEditorialReviewProcessMM
     * @return void
     */
    public function addJournalEditorialReviewProcessMM(\Slub\Bison\Domain\Model\EditorialProcessReview $journalEditorialReviewProcessMM)
    {
        $this->journalEditorialReviewProcessMM->attach($journalEditorialReviewProcessMM);
    }

    /**
     * Removes a EditorialProcessReview
     *
     * @param \Slub\Bison\Domain\Model\EditorialProcessReview $journalEditorialReviewProcessMMToRemove The EditorialProcessReview to be removed
     * @return void
     */
    public function removeJournalEditorialReviewProcessMM(\Slub\Bison\Domain\Model\EditorialProcessReview $journalEditorialReviewProcessMMToRemove)
    {
        $this->journalEditorialReviewProcessMM->detach($journalEditorialReviewProcessMMToRemove);
    }

    /**
     * Returns the journalEditorialReviewProcessMM
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\EditorialProcessReview>
     */
    public function getJournalEditorialReviewProcessMM()
    {
        return $this->journalEditorialReviewProcessMM;
    }

    /**
     * Sets the journalEditorialReviewProcessMM
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\EditorialProcessReview> $journalEditorialReviewProcessMM
     * @return void
     */
    public function setJournalEditorialReviewProcessMM(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $journalEditorialReviewProcessMM)
    {
        $this->journalEditorialReviewProcessMM = $journalEditorialReviewProcessMM;
    }

    /**
     * Adds a IsReplacedBy
     *
     * @param \Slub\Bison\Domain\Model\IsReplacedBy $journalIsReplacedByMM
     * @return void
     */
    public function addJournalIsReplacedByMM(\Slub\Bison\Domain\Model\IsReplacedBy $journalIsReplacedByMM)
    {
        $this->journalIsReplacedByMM->attach($journalIsReplacedByMM);
    }

    /**
     * Removes a IsReplacedBy
     *
     * @param \Slub\Bison\Domain\Model\IsReplacedBy $journalIsReplacedByMMToRemove The IsReplacedBy to be removed
     * @return void
     */
    public function removeJournalIsReplacedByMM(\Slub\Bison\Domain\Model\IsReplacedBy $journalIsReplacedByMMToRemove)
    {
        $this->journalIsReplacedByMM->detach($journalIsReplacedByMMToRemove);
    }

    /**
     * Returns the journalIsReplacedByMM
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\IsReplacedBy>
     */
    public function getJournalIsReplacedByMM()
    {
        return $this->journalIsReplacedByMM;
    }

    /**
     * Sets the journalIsReplacedByMM
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\IsReplacedBy> $journalIsReplacedByMM
     * @return void
     */
    public function setJournalIsReplacedByMM(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $journalIsReplacedByMM)
    {
        $this->journalIsReplacedByMM = $journalIsReplacedByMM;
    }

    /**
     * Adds a Keyword
     *
     * @param \Slub\Bison\Domain\Model\Keyword $journalKeywordMM
     * @return void
     */
    public function addJournalKeywordMM(\Slub\Bison\Domain\Model\Keyword $journalKeywordMM)
    {
        $this->journalKeywordMM->attach($journalKeywordMM);
    }

    /**
     * Removes a Keyword
     *
     * @param \Slub\Bison\Domain\Model\Keyword $journalKeywordMMToRemove The Keyword to be removed
     * @return void
     */
    public function removeJournalKeywordMM(\Slub\Bison\Domain\Model\Keyword $journalKeywordMMToRemove)
    {
        $this->journalKeywordMM->detach($journalKeywordMMToRemove);
    }

    /**
     * Returns the journalKeywordMM
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Keyword>
     */
    public function getJournalKeywordMM()
    {
        return $this->journalKeywordMM;
    }

    /**
     * Sets the journalKeywordMM
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Keyword> $journalKeywordMM
     * @return void
     */
    public function setJournalKeywordMM(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $journalKeywordMM)
    {
        $this->journalKeywordMM = $journalKeywordMM;
    }

    /**
     * Adds a Language
     *
     * @param \Slub\Bison\Domain\Model\Language $journalLanguageMM
     * @return void
     */
    public function addJournalLanguageMM(\Slub\Bison\Domain\Model\Language $journalLanguageMM)
    {
        $this->journalLanguageMM->attach($journalLanguageMM);
    }

    /**
     * Removes a Language
     *
     * @param \Slub\Bison\Domain\Model\Language $journalLanguageMMToRemove The Language to be removed
     * @return void
     */
    public function removeJournalLanguageMM(\Slub\Bison\Domain\Model\Language $journalLanguageMMToRemove)
    {
        $this->journalLanguageMM->detach($journalLanguageMMToRemove);
    }

    /**
     * Returns the journalLanguageMM
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Language>
     */
    public function getJournalLanguageMM()
    {
        return $this->journalLanguageMM;
    }

    /**
     * Sets the journalLanguageMM
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Language> $journalLanguageMM
     * @return void
     */
    public function setJournalLanguageMM(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $journalLanguageMM)
    {
        $this->journalLanguageMM = $journalLanguageMM;
    }

    /**
     * Adds a License
     *
     * @param \Slub\Bison\Domain\Model\License $journalLicenseMM
     * @return void
     */
    public function addJournalLicenseMM(\Slub\Bison\Domain\Model\License $journalLicenseMM)
    {
        $this->journalLicenseMM->attach($journalLicenseMM);
    }

    /**
     * Removes a License
     *
     * @param \Slub\Bison\Domain\Model\License $journalLicenseMMToRemove The License to be removed
     * @return void
     */
    public function removeJournalLicenseMM(\Slub\Bison\Domain\Model\License $journalLicenseMMToRemove)
    {
        $this->journalLicenseMM->detach($journalLicenseMMToRemove);
    }

    /**
     * Returns the journalLicenseMM
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\License>
     */
    public function getJournalLicenseMM()
    {
        return $this->journalLicenseMM;
    }

    /**
     * Sets the journalLicenseMM
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\License> $journalLicenseMM
     * @return void
     */
    public function setJournalLicenseMM(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $journalLicenseMM)
    {
        $this->journalLicenseMM = $journalLicenseMM;
    }

    /**
     * Adds a Subject
     *
     * @param \Slub\Bison\Domain\Model\Subject $journalSubjectMM
     * @return void
     */
    public function addJournalSubjectMM(\Slub\Bison\Domain\Model\Subject $journalSubjectMM)
    {
        $this->journalSubjectMM->attach($journalSubjectMM);
    }

    /**
     * Removes a Subject
     *
     * @param \Slub\Bison\Domain\Model\Subject $journalSubjectMMToRemove The Subject to be removed
     * @return void
     */
    public function removeJournalSubjectMM(\Slub\Bison\Domain\Model\Subject $journalSubjectMMToRemove)
    {
        $this->journalSubjectMM->detach($journalSubjectMMToRemove);
    }

    /**
     * Returns the journalSubjectMM
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Subject>
     */
    public function getJournalSubjectMM()
    {
        return $this->journalSubjectMM;
    }

    /**
     * Sets the journalSubjectMM
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slub\Bison\Domain\Model\Subject> $journalSubjectMM
     * @return void
     */
    public function setJournalSubjectMM(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $journalSubjectMM)
    {
        $this->journalSubjectMM = $journalSubjectMM;
    }
}
