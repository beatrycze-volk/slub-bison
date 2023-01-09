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
 */
class IndexDatabase
{
    /**
     * P-ISSN
     *
     * @var string
     */
    protected $pIssn;

    /**
     * E-ISSN
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
     * __construct
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
     * Returns the P-ISSN
     *
     * @return string
     */
    public function getPIssn()
    {
        return $this->pIssn;
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
