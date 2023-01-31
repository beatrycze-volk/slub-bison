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

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The class for handling local filters (currently licenses and mirror journals).
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property array $licenses This holds the list of allowed licenses
 */
class LocalFilter
{
    /**
     * @var array
     * @access private
     */
    private $extConfig;

    /**
     * This holds the licenses from extension configuration
     *
     * @var array
     * @access private
     */
    private $licenses;

    /**
     * Constructs the local filter
     *
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        $this->extConfig = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('bison');
        
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
            $this->applyLicenseFilter($journals[$i]);
            $this->applyMirrorJournalFilter($journals[$i]);
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
        foreach ($this->licenses as $license) {
            $journalLicenses = $journal->getLicenses();
            for ($i = 0; $i < count($journalLicenses); $i++) {
                if ($journalLicenses[$i]->getType() == $license) {
                    $journal->setFilter(true);
                    break;
                }
            }
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
