<?php

declare(strict_types=1);

namespace Slub\Bison\Controller;

/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

use Slub\Bison\Domain\Repository\JournalRepository;
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
 * @property JournalRepository $journalRepository
 * @property array<Journal> $results This holds the journals for displaying to the frontend
 */
class RecommenderController extends AbstractController
{
    /**
     * @var JournalRepository
     * @access private
     */
    private $journalRepository;

    /**
     * @var array<Journal>
     * @access private
     */
    private $results;

    /**
     * @param JournalRepository $journalRepository
     *
     * @return void
     */
    public function injectJournalRepository(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    /**
     * The recommender function returning journals based on title etc.
     *
     * @return void
     */
    public function mainAction()
    {
        $this->results = [];

        if (!empty($this->requestData['title']) || !empty($this->requestData['abstract']) || !empty($this->requestData['references'])) {
            try {
                $response = $this->client->request(
                    'POST',
                    'search',
                    [
                        'json' => [
                            'title' => $this->requestData['title'],
                            'abstract' => $this->requestData['abstract'],
                            'references' => $this->requestData['references'],
                        ]
                    ]
                );

                if ($response->getStatusCode() === 200) {
                    $content = $response->getBody()->getContents();
                    $result = json_decode($content);
                    foreach ($result->journals as $journal) {
                        $this->results[] = new Journal($journal);
                    }

                    $this->indexDatabaseList->assignIndexDatabases($this->results);
                    $this->mirrorJournalList->assignMirrorJournals($this->results);
                    $this->mirrorJournalList->markMirrorJournals($this->results);
                    $this->localConditionsFilter->filter($this->results);

                    $this->view->assign('maxApc', $this->getMaxApc());
                    $this->view->assign('maxPublicationTime', $this->getMaxPublicationTime());
                    $this->view->assign('keywords', $this->getKeywords());
                    $this->view->assign('languages', $this->getLanguages());
                    $this->view->assign('subjects', $this->getSubjects());
                    $this->view->assign('suggestLanguage', $this->getSuggestLanguage($result));
                    $this->view->assign('suggestSubject', $this->getSuggestSubject($result));
                    $this->view->assign('displayMismatchedResults', filter_var($this->extConfig['displayMismatchedResults'], FILTER_VALIDATE_BOOLEAN));
                    $this->view->assign('displayMirrorJournals', filter_var($this->extConfig['displayMirrorJournals'], FILTER_VALIDATE_BOOLEAN));
                    $this->view->assign('isFilterTooStrict', $this->isFilterTooStrict());
                    $this->view->assign('countResults', $this->countResultsAfterFilter());
                    $this->view->assign('results', $this->results);
                }
            } catch (Exception $e) {
                $this->logger->error('Request error: ' . $e->getMessage());
                $this->view->assign('error', $e->getMessage());
            }
        }

        $this->view->assign('contact', $this->getContactPerson());
        $this->view->assign('viewData', $this->viewData);
    }

    /**
     * Checks if local filters are too strict. It is a case when after
     * filtering we have no results, but without filters there are results.
     *
     * @return bool
     */
    private function isFilterTooStrict()
    {
        return $this->countResultsAfterFilter() == 0 && count($this->results) > 0;
    }

    /**
     * Counts all results which match to filter conditions.
     *
     * @return int
     */
    private function countResultsAfterFilter()
    {
        $count = 0;
        foreach ($this->results as $result) {
            if ($result->getFilter() !== false) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Gets the language suggested for results.
     *
     * @param array $result JSON array with results
     *
     * @return Language|null
     */
    private function getSuggestLanguage($result)
    {
        if ($result->language !== NULL) {
            return new Language($result->language);
        }
    }

    /**
     * Gets the subject suggested for results.
     *
     * @param array $result JSON array with results
     *
     * @return Subject|null
     */
    private function getSuggestSubject($result)
    {
        if ($result->subject->code !== NULL) {
            return Subject::fromSubject($result->subject);
        }
    }

    /**
     * Gets the max APC for client side filter. APC can be stored
     * in filter field (when overwritten by local data)
     * or in APC max field.
     *
     * @return int
     */
    private function getMaxApc()
    {
        $apc = 0;
        foreach ($this->results as $result) {
            if ($result->getFilter() !== false && !empty($result->getFilter()->getPrice())) {
                $euro = $result->getFilter()->getPrice()->getEuro();
                if ($euro !== NULL && $apc < $euro) {
                    $apc = $euro;
                }
            } else {
                $euro = $result->getApcMax()->getEuro();
                if ($euro !== NULL && $apc < $euro) {
                    $apc = $euro;
                }
            }
        }

        return (ceil($apc / 100) * 100);
    }

    /**
     * Gets the max publication time for client side filter.
     *
     * @return int
     */
    private function getMaxPublicationTime()
    {
        $weeks = 0;
        foreach ($this->results as $result) {
            if ($weeks < $result->getPublicationTimeWeeks()) {
                $weeks = $result->getPublicationTimeWeeks();
            }
        }
        return $weeks;
    }

    /**
     * Gets the keywords for client side filter.
     *
     * @return array
     */
    private function getKeywords()
    {
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

    /**
     * Gets the languages for client side filter.
     *
     * @return array
     */
    private function getLanguages()
    {
        $languages = [];
        foreach ($this->results as $result) {
            $resultLanguages = $result->getLanguages();
            foreach ($resultLanguages as $language) {
                if (!in_array($language, $languages)) {
                    $languages[] = $language;
                }
            }
        }
        usort($languages, function ($first, $second) {
            return strcmp($first->getName(), $second->getName());
        });
        return $languages;
    }

    /**
     * Gets the subjects for client side filter.
     *
     * @return array
     */
    private function getSubjects()
    {
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
        usort($subjects, function ($first, $second) {
            return strcmp($first->getCode(), $second->getCode());
        });
        return $subjects;
    }
}
