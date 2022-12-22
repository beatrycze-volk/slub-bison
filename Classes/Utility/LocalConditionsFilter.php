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
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The class for handling filtering by local conditions stored in CSV file.
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 */
class LocalConditionsFilter implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * This holds the logger
     *
     * @var LogManager
     * @access private
     */
    private $logger;

    /**
     * This holds the filters from CSV file
     *
     * @var array<Filter>
     * @access private
     */
    private $filters;

    public function __construct()
    {
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(get_class($this));
        
        $results = [];
        $spreadsheet = IOFactory::load('./fileadmin/bison/dummy.xlsx');
        
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $results[] = $worksheet->toArray(null, false, true);
        }

        // save memory
        $spreadsheet->__destruct();
        $spreadsheet = NULL;
        $this->filters = [];
        $data = $results[0];
        for ($i = 1; $i < count($data); $i++) {
            $this->filters[] = new Filter($data[$i][0], $data[$i][1], $data[$i][2], $data[$i][3], $data[$i][4], $data[$i][5]);
        }
    }

    /**
     * Filter results against the local conditions.
     */
    public function filter(&$journals) {
        for ($i = 0; $i < count($journals); $i++) {
            $this->applyFilter($journals[$i]);
        }
    }

    public function applyFilter(&$journal) {
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
}
