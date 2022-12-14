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
use Slub\Bison\Exception\IdNotFoundException;
use Slub\Bison\Result\Journal;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

/**
 * The recommender controller for the Bison extension
 */
class RecommenderController extends AbstractController
{

    /**
    * @var JournalRepository
    */
   protected $journalRepository;

   protected $title;

   protected $abstract;

   protected $references;

   protected $results;

    /**
     * @param JournalRepository $journalRepository
     */
    public function injectJournalRepository(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }


    /**
     * The recommender function returning journals based on title etc.
     */
    public function mainAction() {
        $results = $this->searchJournals();

        $this->view->assign('viewData', $this->viewData);
        $this->view->assign('title', $this->requestData['title']);
        $this->view->assign('abstract', $this->requestData['abstract']);
        $this->view->assign('references', $this->requestData['references']);
        $this->view->assign('results', $results);
    }

    private function searchJournals() {
        $results = [];
        //TODO: replace it with real data
        $title = 'Pushing the button: Why do learners pause online…';
        $abstract = 'With the recent surge in digitalization across…';
        $references = 'Ayres and Paas, 2007 10.1002/acp.1343 …';

        // run search only if some parameters are changed
        if ($this->title != $title || $this->abstract != $abstract || $this->references != $references) {
            $results = [];

            $this->title == $title;
            $this->abstract == $abstract;
            $this->references == $references;

            try {
                $response = $this->client->request(
                    'POST',
                    'search',
                    ['json' => [
                        'title' => $title,
                        'abstract' => $abstract,
                        'references' => $references,
                        ]
                    ]
                );
    
                if ($response->getStatusCode() == 200) {
                    $content = $response->getBody()->getContents();
                    $journals = json_decode($content);
                    foreach ($journals->journals as $journal) {
                        $results[] = new Journal($journal);
                    }
                }
            } catch(Exception $e) {
                $this->logger->error('Request error: ' + $e->getMessage());
            }
            $this->results = $results;
        }
    }

    private function sortJournals() {
        
    }

    private function filterJournals() {
        
    }
}
