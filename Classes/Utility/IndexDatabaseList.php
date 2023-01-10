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

use Slub\Bison\Model\IndexDatabase;

/**
 * The class for handling assigning index databases stored in CSV file.
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 */
class IndexDatabaseList extends SpreadsheetLoader
{
    /**
     * This holds the mirror journals from CSV file
     *
     * @var array
     * @access private
     */
    private $indexDatabases;

    /**
     * @access public
     */
    public function __construct()
    {
        parent::__construct('fileDatabases');

        $this->indexDatabases = [];
        for ($i = 1; $i < count($this->data); $i++) {
            $this->indexDatabases[] = new IndexDatabase(
                $this->data[$i][0],
                $this->data[$i][1],
                $this->data[$i][2],
                $this->data[$i][3],
                $this->data[$i][4],
                $this->data[$i][5]
            );
        }
    }

    public function assignIndexDatabases(&$journals) {
        for ($i = 0; $i < count($journals); $i++) {
            $this->assignIndexDatabase($journals[$i]);
        }
    }

    public function assignIndexDatabase(&$journal) {
        foreach ($this->indexDatabases as $indexDatabase) {
            if (!empty($indexDatabase->getEIssn()) && !empty($journal->getEIssn())) {
                if ($indexDatabase->getEIssn() == $journal->getEIssn()) {
                    $journal->setIndexDatabase($indexDatabase);
                    break;
                }
            } else {
                if ($indexDatabase->getPIssn() == $journal->getPIssn()) {
                    $journal->setIndexDatabase($indexDatabase);
                    break;
                }
            }
        }
    }
}
