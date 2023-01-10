<?php

namespace Slub\Bison\Utility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use Slub\Bison\Model\Filter;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The class for handling filtering by local conditions stored in CSV file.
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
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
     * Filter results against the local conditions.
     */
    public function filter(&$journals) {
        for ($i = 0; $i < count($journals); $i++) {
            $this->applyIssnFilter($journals[$i]);
            $this->applyLicenseFilter($journals[$i], $license);
            $this->applyMirrorJournalFilter($journals[$i]);
        }
    }

    public function applyIssnFilter(&$journal) {
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

    private function applyLicenseFilter(&$journal) {
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

    private function applyMirrorJournalFilter(&$journal) {
        $showMirrorJournals = filter_var($this->extConfig['showMirrorJournals'], FILTER_VALIDATE_BOOLEAN);
        if (!$showMirrorJournals && $journal->getIsMirrorJournal()) {
            $journal->setFilter(false);
        }
    }

    private function getLicenses() {
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

    private function convertLicense($licenses, $key, $value) {
        if (intval($licenses[$key]) == 1) {
            $this->licenses[] = $value;
        }
    }
}
