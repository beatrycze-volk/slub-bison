<?php

namespace Slub\Bison\Utility;

/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

use Slub\Bison\Model\Filter;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The class for handling filtering by local conditions stored in CSV file.
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property array<Filter> $filters This holds the list of local condition filters
 * @property array $filters This holds the list of allowed licenses
 */
class LocalConditionsFilter extends SpreadsheetLoader
{

    /**
     * This holds the filters from CSV file
     *
     * @var array<Filter>
     * @access private
     */
    private $filters;

    /**
     * This holds the licenses from extension configuration
     *
     * @var array
     * @access private
     */
    private $licenses;

    /**
     * Constructs the local condition filter
     *
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('fileFilters');

        $this->filters = [];
        for ($i = 1; $i < count($this->data); $i++) {
            $this->filters[] = new Filter(
                $this->data[$i][0],
                $this->data[$i][1],
                $this->data[$i][2],
                $this->data[$i][3],
                $this->data[$i][4],
                $this->data[$i][5]
            );
        }

        $this->getLicenses();
    }

    /**
     * Filters the journals against the local conditions.
     *
     * @access public
     *
     * @param array<Journal> $journals the list of journals to be filtered
     *
     * @return void
     */
    public function filter(&$journals)
    {
        for ($i = 0; $i < count($journals); $i++) {
            $this->applyIssnFilter($journals[$i]);
            $this->applyLicenseFilter($journals[$i]);
            $this->applyMirrorJournalFilter($journals[$i]);
        }
    }

    /**
     * Filters the single journal against the local conditions.
     *
     * @access public
     *
     * @param Journal $journal the journal to be filtered
     *
     * @return void
     */
    public function applyIssnFilter(&$journal)
    {
        foreach ($this->filters as $filter) {
            if (!empty($filter->getEIssn()) && !empty($journal->getEIssn())) {
                if ($filter->getEIssn() == $journal->getEIssn()) {
                    $journal->setFilter($filter);
                    break;
                }
            } else {
                if ($filter->getPIssn() == $journal->getPIssn()) {
                    $journal->setFilter($filter);
                    break;
                }
            }
            $journal->setFilter(false);
        }
    }

    /**
     * Applies license filter the single journal
     *
     * @access private
     *
     * @param Journal $journal the journal to which filter is applied
     *
     * @return void
     */
    private function applyLicenseFilter(&$journal)
    {
        $foundLicense = false;
        foreach ($this->licenses as $license) {
            $journalLicenses = $journal->getLicenses();
            for ($i = 0; $i < count($journalLicenses); $i++) {
                if ($journalLicenses[$i]->getType() == $license) {
                    $foundLicense = true;
                    break;
                }
            }
        }

        if (!$foundLicense) {
            $journal->setFilter(false);
        }
    }

    /**
     * Applies mirror journal filter the single journal
     *
     * @access private
     *
     * @param Journal $journal the journal to which filter is applied
     *
     * @return void
     */
    private function applyMirrorJournalFilter(&$journal)
    {
        $displayMirrorJournals = filter_var($this->extConfig['displayMirrorJournals'], FILTER_VALIDATE_BOOLEAN);
        if (!$displayMirrorJournals && $journal->getIsMirrorJournal()) {
            $journal->setFilter(false);
        }
    }

    /**
     * Gets licenses for which journals should be filtered
     *
     * @access private
     *
     * @return void
     */
    private function getLicenses()
    {
        $configuredLicenses = $this->extConfig['licenses'];
        $this->licenses = [];
        $this->convertLicense($configuredLicenses, 'cc0', "CC0");
        $this->convertLicense($configuredLicenses, 'ccby', "CC BY");
        $this->convertLicense($configuredLicenses, 'ccbync', "CC BY-NC");
        $this->convertLicense($configuredLicenses, 'ccbyncnd', "CC BY-NC-ND");
        $this->convertLicense($configuredLicenses, 'ccbyncsa', "CC BY-NC-SA");
        $this->convertLicense($configuredLicenses, 'ccbynd', "CC BY-ND");
        $this->convertLicense($configuredLicenses, 'ccbysa', "CC BY-SA");
        $this->convertLicense($configuredLicenses, 'publicDomain', "Public domain");
        $this->convertLicense($configuredLicenses, 'publisher', "Publisher's own license");
    }

    /**
     * Converts licenses from CSV to format matching journal
     *
     * @access private
     *
     * @return void
     */
    private function convertLicense($licenses, $key, $value)
    {
        if ((int) $licenses[$key] === 1) {
            $this->licenses[] = $value;
        }
    }
}
