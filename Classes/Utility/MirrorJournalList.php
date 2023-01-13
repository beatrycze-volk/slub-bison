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

use Slub\Bison\Model\MirrorJournal;

/**
 * The class for handling filtering by mirror journals stored in CSV file.
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property array $mirrorJournals This holds the list of mirror journals from CSV file
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
     * Constructs the mirror journal list
     *
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('fileMirrorJournals');

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

    /**
     * Assigns mirror journals to the list of journals
     *
     * @access public
     *
     * @param array $journals the list of journals
     *
     * @return void
     */
    public function assignMirrorJournals(&$journals)
    {
        for ($i = 0; $i < count($journals); $i++) {
            $this->assignMirrorJournal($journals[$i]);
        }
    }

    /**
     * Assigns mirror journal to the journal
     *
     * @access public
     *
     * @param Journal $journal the single journal
     *
     * @return void
     */
    public function assignMirrorJournal(&$journal)
    {
        foreach ($this->mirrorJournals as $mirrorJournal) {
            if ($mirrorJournal->getOriginalIssn() === $journal->getEIssn()) {
                $journal->setMirrorJournal($mirrorJournal);
                break;
            }
        }
    }

    /**
     * Marks journals as mirror journals
     *
     * @access public
     *
     * @param array $journals the list of journals
     *
     * @return void
     */
    public function markMirrorJournals(&$journals)
    {
        for ($i = 0; $i < count($journals); $i++) {
            $this->markMirrorJournal($journals[$i]);
        }
    }

    /**
     * Marks journal as mirror journal
     *
     * @access public
     *
     * @param Journal $journal the single journal
     *
     * @return void
     */
    public function markMirrorJournal(&$journal)
    {
        foreach ($this->mirrorJournals as $mirrorJournal) {
            if ($mirrorJournal->getIssn() === $journal->getEIssn()) {
                $journal->setIsMirrorJournal(true);
                break;
            }
        }
    }
}
