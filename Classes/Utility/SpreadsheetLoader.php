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

use PhpOffice\PhpSpreadsheet\IOFactory;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The class for loading data stored in CSV file.
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @abstract
 * @property LogManager $logger This holds the logger
 * @property array $extConfig This holds the extension configuration
 * @property array $data This holds the data from CSV file
 */
abstract class SpreadsheetLoader
{

    /**
     * This holds the logger
     *
     * @var LogManager
     * @access protected
     */
    protected $logger;

    /**
     * @var array
     * @access protected
     */
    protected $extConfig;

    /**
     * This holds the data from CSV file
     *
     * @var array
     * @access protected
     */
    protected $data;

    /**
     * Constructs the spreadsheet loader
     *
     * @access public
     *
     * @param string $file name of file config which is loaded
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->extConfig = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('bison');
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(get_class($this));

        $results = [];
        $spreadsheet = IOFactory::load($this->extConfig[$file]);

        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $results[] = $worksheet->toArray(null, false, true);
        }

        $spreadsheet->__destruct();
        $spreadsheet = NULL;

        $this->data = $results[0];
    }
}
