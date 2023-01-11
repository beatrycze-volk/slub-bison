<?php

declare(strict_types=1);

namespace Slub\Bison\Controller;

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

use Slub\Bison\Domain\Repository\JournalRepository;
use Slub\Bison\Model\Journal;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

/**
 * The journal controller for the Bison extension.
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property JournalRepository $journalRepository
 * @property Journal $journal This holds the journal for displaying to the frontend
 */
class JournalController extends AbstractController
{

    /**
    * @var JournalRepository
    * @access private
    */
   private $journalRepository;

   /**
    * @var Journal
    * @access private
    */
   private $journal;

    /**
     * @param JournalRepository $journalRepository
     */
    public function injectJournalRepository(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    /**
     * The journal function returning one journal based on idx.
     * 
     * @access public
     */
    public function mainAction() {
        $this->getJournal();

        $this->view->assign('journal', $this->journal);
        $this->view->assign('contact', $this->getContactPerson());
        $this->view->assign('viewData', $this->viewData);
    }

    /**
     * Gets journal from API.
     * 
     * @access private
     */
    private function getJournal() {
        try {
            $response = $this->client->request(
                'GET',
                'journal/' . $this->requestData['id']
            );
    
            if ($response->getStatusCode() == 200) {
                $content = $response->getBody()->getContents();
                $journalJson = json_decode($content);
                $this->journal = new Journal($journalJson);
                $this->mirrorJournalList->assignMirrorJournal($this->journal);
                $this->localConditionsFilter->applyIssnFilter($this->journal);
            }
        } catch(Exception $e) {
            $this->logger->error('Request error: ' + $e->getMessage());
        }
    }
}
