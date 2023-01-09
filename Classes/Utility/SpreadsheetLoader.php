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

use PhpOffice\PhpSpreadsheet\IOFactory;
use TYPO3\CMS\Core\Log\LogManager;
use Slub\Bison\Model\Filter;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The class for loading data stored in CSV file.
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @abstract
 */
abstract class SpreadsheetLoader
{
    /**
     * This holds the logger
     *
     * @var LogManager
     * @access private
     */
    protected $logger;

    /**
     * This holds the data from CSV file
     *
     * @var array
     * @access protected
     */
    protected $data;

    public function __construct($filePath)
    {
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(get_class($this));
        
        $results = [];
        $spreadsheet = IOFactory::load($filePath);

        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $results[] = $worksheet->toArray(null, false, true);
        }
        $spreadsheet->__destruct();
        $spreadsheet = NULL;

        $this->data = $results[0];
    }
}
