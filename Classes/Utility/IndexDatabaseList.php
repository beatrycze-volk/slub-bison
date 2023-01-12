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
