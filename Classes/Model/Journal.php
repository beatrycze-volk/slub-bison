<?php

declare(strict_types=1);

namespace Slub\Bison\Model;

/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

/**
 * Journal DTO
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $idx This holds the xid of the journal
 * @property string $id This holds the id of the journal
 * @property Score $id This holds the score which informs how much the searched article matches to this journal
 * @property Price $apcMax This holds the P-ISSN of the journal
 * @property string $pIssn This holds the P-ISSN of the journal
 * @property string $eIssn This holds the E-ISSN of the journal
 * @property bool $pubMed This holds the information if the journal is indexed in PubMed database
 * @property bool $openAlex This holds the information if the journal is indexed in Open Alex database
 * @property bool $webOfScience This holds the information if the journal is indexed in Web of Science database
 * @property bool $scopus This holds the information if the journal is indexed in Scopus database
 */
class Journal
{

    /**
     * idx of the journal
     *
     * @var string
     */
    protected $idx;

    /**
     * id of the journal
     *
     * @var string
     */
    protected $id;

    /**
     * score
     *
     * @var Score
     */
    protected $score;

    /**
     * maximal article processing charge (APC)
     *
     * @var Price
     */
    protected $apcMax;

    /**
     * E-ISSN of the journal
     *
     * @var string
     */
    protected $eIssn;

    /**
     * P-ISSN of the journal
     *
     * @var string
     */
    protected $pIssn;

    /**
     * title
     *
     * @var string
     */
    protected $title;

    /**
     * alternative title
     *
     * @var string
     */
    protected $alternativeTitle;

    /**
     * plan S compliance
     *
     * @var boolean
     */
    protected $planSCompliance;

    /**
     * information if the author retains copyright
     *
     * @var boolean
     */
    protected $retainsCopyrightAuthor;

    /**
     * information if the article receives DOI
     *
     * @var boolean
     */
    protected $doiPidScheme;

    /**
     * has APC
     *
     * @var boolean
     */
    protected $hasApc;

    /**
     * has other charges
     *
     * @var boolean
     */
    protected $hasOtherCharges;

    /**
     * publisher
     *
     * @var Publisher
     */
    protected $publisher;

    /**
     * publication time weeks
     *
     * @var integer
     */
    protected $publicationTimeWeeks;

    /**
     * access data
     *
     * @var AccessData
     */
    protected $accessData = [];

    /**
     * keywords
     *
     * @var array<Keyword>
     */
    protected $keywords = [];

    /**
     * licenses
     *
     * @var array<License>
     */
    protected $licenses = [];

    /**
     * subjects
     *
     * @var array<Subject>
     */
    protected $subjects = [];

    /**
     * editorial review processes
     *
     * @var array<EditorialReviewProcess>
     */
    protected $editorialReviewProcesses = [];

    /**
     * replacements
     *
     * @var array<Replacement>
     */
    protected $replacements;

    /**
     * created date
     *
     * @var \DateTime
     */
    protected $createdDate;

    /**
     * discontinued date
     *
     * @var \DateTime
     */
    protected $discontinuedDate;

    /**
     * last updated
     *
     * @var \DateTime
     */
    protected $lastUpdated;

    /**
     * has preservation
     *
     * @var boolean
     */
    protected $hasPreservation;

    /**
     * false if doesn't match filter, else filter data
     *
     * @var boolean|Filter
     */
    protected $filter;

    /**
     * mirror journal
     *
     * @var MirrorJournal
     */
    protected $mirrorJournal;

    /**
     * mark as mirror journal
     *
     * @var boolean
     */
    protected $isMirrorJournal;

    /**
     * index database
     *
     * @var IndexDatabase
     */
    protected $indexDatabase;

    /**
     * Construct for journal instance
     *
     * @access public
     *
     * @param array $journal The journal JSON
     *
     * @return void
     */
    public function __construct($journal)
    {
        $this->idx = $journal->idx;
        $this->id = $journal->id;
        $this->score = new Score($journal->score);
        $this->apcMax = Price::fromAPC($journal->apc_max);
        $this->eIssn = $journal->eissn;
        $this->pIssn = $journal->pissn;
        $this->title = $journal->title;
        $this->alternativeTitle = $journal->alternative_title;
        $this->planSCompliance = $journal->plan_s_compliance;
        $this->retainsCopyrightAuthor = $journal->copyright_author_retains;
        $this->doiPidScheme = $journal->doi_pid_scheme;
        $this->hasApc = $journal->has_apc;
        $this->hasOtherCharges = $journal->has_other_charges;
        $this->publisher = new Publisher($journal->publisher_name, $journal->publisher_country);
        $this->publicationTimeWeeks = $journal->publication_time_weeks;
        $this->accessData = AccessData::fromJournal($journal);
        foreach ($journal->keywords as $keyword) {
            $this->keywords[] = new Keyword($keyword);
        }

        foreach ($journal->languages as $language) {
            $this->languages[] = new Language($language);
        }

        foreach ($journal->licenses as $license) {
            $this->licenses[] = new License($license);
        }

        foreach ($journal->subjects as $subject) {
            $this->subjects[] = Subject::fromSubject($subject);
        }

        foreach ($journal->editorial_review_process as $process) {
            $this->editorialReviewProcesses[] = new EditorialReviewProcess($process);
        }

        $this->createdDate = $journal->created_date;
        $this->isMirrorJournal = false;
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
     * Returns the id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the score
     *
     * @return Score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Returns the max APC
     *
     * @return Apc
     */
    public function getApcMax()
    {
        return $this->apcMax;
    }

    /**
     * Returns the E-ISSN
     *
     * @return string
     */
    public function getEIssn()
    {
        return $this->eIssn;
    }

    /**
     * Returns the P-ISSN
     *
     * @return string
     */
    public function getPIssn()
    {
        return $this->pIssn;
    }

    /**
     * Returns the ISSNs
     *
     * @return string
     */
    public function getIssns()
    {
        if (!empty($this->eIssn) && !empty($this->pIssn)) {
            return $this->eIssn.', '.$this->pIssn;
        } else if (!empty($this->eIssn)) {
            return $this->eIssn;
        } else {
            return $this->pIssn;
        }
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
     * Returns the alternative title
     *
     * @return string
     */
    public function getAlternativeTitle()
    {
        return $this->alternativeTitle;
    }

    /**
     * Returns the information if plan S compliant
     *
     * @return boolean
     */
    public function getPlanSCompliance()
    {
        return $this->planSCompliance;
    }

    /**
     * Returns the information if author retains copyright
     *
     * @return boolean
     */
    public function getRetainsCopyrightAuthor()
    {
        return $this->retainsCopyrightAuthor;
    }

    /**
     * Returns the information if article receives DOI
     *
     * @return boolean
     */
    public function getDoiPidScheme()
    {
        return $this->doiPidScheme;
    }

    /**
     * Returns the information if there is APC
     *
     * @return bool
     */
    public function getHasApc()
    {
        return $this->hasApc;
    }

    /**
     * Returns the information if there are other charges
     *
     * @return bool
     */
    public function getHasOtherCharges()
    {
        return $this->hasOtherCharges;
    }

    /**
     * Returns the publisher
     *
     * @return Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Returns the access data
     *
     * @return AccessData
     */
    public function getAccessData()
    {
        return $this->accessData;
    }

    /**
     * Returns the publication time in weeks
     *
     * @return int
     */
    public function getPublicationTimeWeeks()
    {
        return $this->publicationTimeWeeks;
    }

    /**
     * Returns the keywords
     *
     * @return array<Keyword>
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Returns the languages
     *
     * @return array<Language>
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Returns the licenses
     *
     * @return array<License>
     */
    public function getLicenses()
    {
        return $this->licenses;
    }

    /**
     * Returns the subjects
     *
     * @return array<Subject>
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * Returns the editorial review processes
     *
     * @return array<EditorialReviewProcess>
     */
    public function getEditorialReviewProcesses()
    {
        return $this->editorialReviewProcesses;
    }

    /**
     * Date of creation
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Returns the information if the journal matches filter results
     *
     * @return boolean|Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Sets the information if the journal matches filter results
     *
     * @var boolean|Filter filter data or false if there is no filter match
     *
     * @return void
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /**
     * Returns the mirror journal
     *
     * @return MirrorJournal
     */
    public function getMirrorJournal()
    {
        return $this->mirrorJournal;
    }

    /**
     * Sets the the mirror journal
     *
     * @var MirrorJournal
     *
     * @return void
     */
    public function setMirrorJournal($mirrorJournal)
    {
        $this->mirrorJournal = $mirrorJournal;
    }

    /**
     * Returns the information if is mirror journal
     *
     * @return bool
     */
    public function getIsMirrorJournal()
    {
        return $this->isMirrorJournal;
    }

    /**
     * Sets the the information if is mirror journal
     *
     * @var boolean
     *
     * @return void
     */
    public function setIsMirrorJournal($isMirrorJournal)
    {
        $this->isMirrorJournal = $isMirrorJournal;
    }

    /**
     * Returns the information about the index databases
     *
     * @return IndexDatabase
     */
    public function getIndexDatabase()
    {
        return $this->indexDatabase;
    }

    /**
     * Sets the the information the index databases
     *
     * @var IndexDatabase
     *
     * @return void
     */
    public function setIndexDatabase($indexDatabase)
    {
        $this->indexDatabase = $indexDatabase;
    }
}
