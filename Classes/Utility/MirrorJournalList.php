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

use Slub\Bison\Model\MirrorJournal;

/**
 * The class for handling filtering by mirror journals stored in CSV file.
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 */
class MirrorJournalList extends SpreadsheetLoader
{
    /**
     * This holds the mirror journals from CSV file
     *
     * @var array
     * @access private
     */
    private $mirrorJournals;

    /**
     * @access public
     */
    public function __construct()
    {
        parent::__construct('./fileadmin/bison/mirror_journals.csv');
    
        $this->mirrorJournals = [];
        for ($i = 2; $i < count($this->data); $i++) {
            $this->mirrorJournals[] = new MirrorJournal(
                $this->data[$i][2],
                $this->data[$i][7],
                $this->data[$i][1],
                $this->data[$i][0],
                $this->data[$i][3],
                $this->data[$i][9],
                $this->data[$i][10]
            );
        }
    }

    public function assignMirrorJournals(&$journals) {
        for ($i = 0; $i < count($journals); $i++) {
            $this->assignMirrorJournal($journals[$i]);
        }
    }

    public function assignMirrorJournal(&$journal) {
        foreach ($this->mirrorJournals as $mirrorJournal) {
            if ($mirrorJournal->getOriginalIssn() == $journal->getEIssn()) {
                $journal->setMirrorJournal($mirrorJournal);
                break;
            }
        }
    }

    public function markMirrorJournals(&$journals) {
        for ($i = 0; $i < count($journals); $i++) {
            $this->markMirrorJournal($journals[$i]);
        }
    }

    public function markMirrorJournal(&$journal) {
        foreach ($this->mirrorJournals as $mirrorJournal) {
            if ($mirrorJournal->getIssn() == $journal->getEIssn()) {
                $journal->setIsMirrorJournal(true);
                break;
            }
        }
    }
}
