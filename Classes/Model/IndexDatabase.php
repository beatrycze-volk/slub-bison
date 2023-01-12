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
 * IndexDatabase DTO - this holds the information about the databases
 * in which the journal is indexed. This information comes from the CSV file.
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $pIssn This holds the P-ISSN of the journal
 * @property string $eIssn This holds the E-ISSN of the journal
 * @property bool $pubMed This holds the information if the journal is indexed in PubMed database
 * @property bool $openAlex This holds the information if the journal is indexed in Open Alex database
 * @property bool $webOfScience This holds the information if the journal is indexed in Web of Science database
 * @property bool $scopus This holds the information if the journal is indexed in Scopus database
 */
class IndexDatabase
{
    /**
     * P-ISSN of the journal
     *
     * @var string
     */
    protected $pIssn;

    /**
     * E-ISSN of the journal
     *
     * @var string
     */
    protected $eIssn;

    /**
     * PubMed
     *
     * @var bool
     */
    protected $pubMed;

    /**
     * OpenAlex
     *
     * @var bool
     */
    protected $openAlex;

    /**
     * Web of Science
     *
     * @var bool
     */
    protected $webOfScience;

    /**
     * Scopus
     *
     * @var bool
     */
    protected $scopus;

    /**
     * Constructor for index database
     * 
     * @access public
     * 
     * @param string $pIssn: the P-ISSN of the journal
     * @param string $eIssn: the E-ISSN of the journal
     * @param string $pubMed: format 'Y' or 'N' - if 'Y', the journal is indexed in database
     * @param string $openAlex: format 'Y' or 'N' - if 'Y', the journal is indexed in database
     * @param string $webOfScience: format 'Y' or 'N' - if 'Y', the journal is indexed in database
     * @param string $scopus: format 'Y' or 'N' - if 'Y', the journal is indexed in database
     */
    public function __construct($pIssn, $eIssn, $pubMed, $openAlex, $webOfScience, $scopus)
    {
        $this->pIssn = $pIssn;
        $this->eIssn = $eIssn;
        $this->pubMed = $this->setValue($pubMed);
        $this->openAlex = $this->setValue($openAlex);
        $this->webOfScience = $this->setValue($webOfScience);
        $this->scopus = $this->setValue($scopus);
    }

    /**
     * Returns the P-ISSN of the journal
     *
     * @return string
     */
    public function getPIssn()
    {
        return $this->pIssn;
    }

    /**
     * Returns the E-ISSN of the journal
     *
     * @return string
     */
    public function getEIssn()
    {
        return $this->eIssn;
    }

    /**
     * Returns the information if journal is stored in PubMed database
     *
     * @return bool
     */
    public function getPubMed()
    {
        return $this->pubMed;
    }

    /**
     * Returns the information if journal is stored in OpenAlex database
     *
     * @return bool
     */
    public function getOpenAlex()
    {
        return $this->openAlex;
    }

    /**
     * Returns the information if journal is stored in Web of Science database
     *
     * @return bool
     */
    public function getWebOfScience()
    {
        return $this->webOfScience;
    }

    /**
     * Returns the information if journal is stored in Scopus database
     *
     * @return bool
     */
    public function getScopus()
    {
        return $this->scopus;
    }

    private function setValue($value) {
        if ($value == 'Y') {
            return true;
        }
        return false;
    }
}
