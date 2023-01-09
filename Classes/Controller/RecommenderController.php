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
use Slub\Bison\Model\Journal;
use Slub\Bison\Model\Language;
use Slub\Bison\Model\Subject;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

/**
 * The recommender controller for the Bison extension
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 */
class RecommenderController extends AbstractController
{
    /**
    * @var JournalRepository
    */
    protected $journalRepository;

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
        $this->results = [];

        if (!empty($this->requestData['title']) || !empty($this->requestData['abstract']) || $this->requestData['references']) {
            try {
                $response = $this->client->request(
                    'POST',
                    'search',
                    ['json' => [
                        'title' => $this->requestData['title'],
                        'abstract' => $this->requestData['abstract'],
                        'references' => $this->requestData['references'],
                        ]
                    ]
                );
        
                if ($response->getStatusCode() == 200) {
                    $content = $response->getBody()->getContents();
                    $result = json_decode($content);
                    foreach ($result->journals as $journal) {
                        $this->results[] = new Journal($journal);
                    }

                    $this->indexDatabaseList->assignIndexDatabases($this->results);
                    $this->mirrorJournalsFilter->assignMirrorJournals($this->results);
                    $this->mirrorJournalsFilter->markMirrorJournals($this->results);
                    $this->localConditionsFilter->filter($this->results);

                    $this->view->assign('maxApc', $this->getMaxApc());
                    $this->view->assign('maxPublicationTime', $this->getMaxPublicationTime());
                    $this->view->assign('keywords', $this->getKeywords());
                    $this->view->assign('languages', $this->getLanguages());
                    $this->view->assign('subjects', $this->getSubjects());
                    $this->view->assign('suggestLanguage', $this->getSuggestLanguage($result));
                    $this->view->assign('suggestSubject', $this->getSuggestSubject($result));
                    $this->view->assign('contact', $this->getContactPerson());
                    $this->view->assign('showMismatchedResults', filter_var($this->extConfig['showMismatchedResults'], FILTER_VALIDATE_BOOLEAN));
                    $this->view->assign('showMirrorJournals', filter_var($this->extConfig['showMirrorJournals'], FILTER_VALIDATE_BOOLEAN));
                    $this->view->assign('isFilterTooStrict', $this->isFilterTooStrict());
                    $this->view->assign('countResults', $this->countResultsAfterFilter());
                    $this->view->assign('results', $this->results);
                }
            } catch (Exception $e) {
                $this->logger->error('Request error: ' + $e->getMessage());
                $this->view->assign('error', $e->getMessage());
            }
        }
        
        $this->view->assign('viewData', $this->viewData);
    }

    private function isFilterTooStrict() {
        return $this->countResultsAfterFilter() == 0 && count($this->results) > 0;
    }

    private function countResultsAfterFilter() {
        $count = 0;
        foreach ($this->results as $result) {
            if ($result->getFilter() != false) {
                $count++;
            }
        }
        return $count;
    }

    private function getSuggestLanguage($result) {
        if ($result->language != NULL) {
            return new Language($result->language);
        }
    }

    private function getSuggestSubject($result) {
        if ($result->subject->code != NULL) {
            return Subject::fromSubject($result->subject);
        }
    }

    private function getMaxApc() {
        $apc = 0;
        foreach ($this->results as $result) {
            $euro = $result->getApcMax()->getEuro();
            if ($euro != NULL && $apc < $euro) {
                $apc =  $euro;
            }
        }
        return ceil($apc / 100) * 100;
    }

    private function getMaxPublicationTime() {
        $weeks = 0;
        foreach ($this->results as $result) {
            if ($weeks < $result->getPublicationTimeWeeks()) {
                $weeks = $result->getPublicationTimeWeeks();
            }
        }
        return $weeks;
    }

    private function getKeywords() {
        $keywords = [];
        foreach ($this->results as $result) {
            $resultKeywords = $result->getKeywords();
            foreach ($resultKeywords as $keyword) {
                if (!in_array($keyword, $keywords)) {
                    $keywords[] = $keyword;
                }
            }
        }
        sort($keywords);
        return $keywords;
    }

    private function getLanguages() {
        $languages = [];
        foreach ($this->results as $result) {
            $resultLanguages = $result->getLanguages();
            foreach ($resultLanguages as $language) {
                if (!in_array($language, $languages)) {
                    $languages[] = $language;
                }
            }
        }
        usort($languages, function($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });
        return $languages;
    }

    private function getSubjects() {
        $subjects = [];
        foreach ($this->results as $result) {
            $resultSubjects = $result->getSubjects();
            foreach ($resultSubjects as $subject) {
                if (!in_array($subject, $subjects)) {
                    $subjects[] = $subject;
                }

                if (!in_array($subject->getParent(), $subjects)) {
                    $subjects[] = $subject->getParent();
                }
            }
        }
        usort($subjects, function($a, $b) {
            return strcmp($a->getCode(), $b->getCode());
        });
        return $subjects;
    }
}
