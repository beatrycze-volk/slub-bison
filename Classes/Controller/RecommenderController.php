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
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

/**
 * The recommender controller for the SlubBison extension
 */
class RecommenderController extends AbstractController
{
    /**
    * @var JournalRepository
    */
   protected $journalRepository;

    /**
     * @param JournalRepository $journalRepository
     */
    public function injectJournalRepository(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    /**
     * The recommender function fetching title, abstract and references for ID (DOI / arXiv ID).
     */
    /*public function mainAction($id) {
        $dois = $this->extractDois($id);
        if (count($dois) > 0) {
            $doi = $dois[0];
    
            try {
                return $this->fetchCrossRef($doi);
            } catch (IdNotFoundException $e) {
                return $this->fetchDataCite($doi);
            }
        } else {
            return $this->fetchArXiv($id);
        }
    }*/

    /**
     * The recommender function returning journals based on title etc.
     */
    public function mainAction() {
        $title = $this->requestData['title'];
        $abstract = $this->requestData['abstract'];
        $references = $this->requestData['references'];

        $results = $this->fetchJournals($title, $abstract, $references, $skipArticle);

        $this->view->assign('viewData', $this->viewData);
        $this->view->assign('title', $title);
        $this->view->assign('abstract', $abstract);
        $this->view->assign('references', $references);
        $this->view->assign('results', $results);
    }

    /**
     * The recommender function returning journals based on title etc.
     * 
     * @return array
     */
    private function fetchJournals($title, $abstract, $references, $skipArticle) {
        $abstractArticles = $this->classifyEsMatchByAbstract($abstract);
        $titleArticles = $this->classifyEsMatchByTitle($title);
        $referencesArticles = $this->classifyReferences($references, $skipArticle);

        $articles = array_merge($abstractArticles, $titleArticles, $referencesArticles);

        // find journals and add score
        $journals = [];
        foreach ($articles as $article) {
            if ($article['idx'] == $skipArticle) {
                // this is for generating data sets or evaluating predictions
                continue;
            }

            $journal = $this->journalRepository->findByIssns($article['journal_issns']);
            if ($journal == null) {
                continue;
            }

            // why get it out of journals array and next again assign to it?
            //journal = journals.get(journal.idx, journal)
            $journals[$journal.idx] = $journal;
            //check if object has score attribute
            if ($journal->getScore() == null) {
                $score = new Score();
                /*journal.score = {
                    'title': [],
                    'abstract': [],
                    'dois': [],
                    'title_score': 0,
                    'abstract_score': 0,
                    'dois_score': 0,
                }*/
            }

            if (in_array($article, $abstractArticles)) {
                $source = 'abstract';
            } else if (in_array($article, $titleArticles)) {
                $source = 'title';
            } else {
                $source = 'dois';
            }

            /*journal.score[source].append({
                'title': article['title'],
                'doi': article['doi'] if 'doi' in article else None,
            })
            journal.score[source + '_score'] += article['score']*/
        }

        //$journals = list(journals.values());
        // calculate score with scoring model, create array so the scoring model can
        // evaluate all at once
        /*scores = []
        for journal in journals:
            scores.append([
                journal.score['title_score'],
                journal.score['abstract_score'],
                journal.score['dois_score']
            ])
            if skip_article is None:
                journal.score.pop('title_score'),
                journal.score.pop('abstract_score'),
                journal.score.pop('dois_score')

        response = requests.post(
            f'{settings.ML_SERVER}/scorer',
            json={'scores': scores}
        )
        scores = json.loads(response.content)
        for i, journal in enumerate(journals):
            journal.score['value'] = float(scores[i])

        journals.sort(key=lambda e: e.score['value'], reverse=True)
        return JournalSerializer(
            journals[:settings.MAX_JOURNAL_LIMIT],
            many=True
        ).data*/
        return null;
    }

    /**
     * Classify abstract based only elastic text match.
     * 
     * @return array
     */
    private function classifyEsMatchByAbstract($abstract) {
        if($abstract == '' or $abstract == null) {
            return [];
        }
        $abstract = substr($abstract, 0, 4500);  // otherwise the query is too long
        /*search = ArticleDocument.search()\
            .query('match', abstract=abstract)\
            .extra(min_score=100)\
            .params(size=100, request_timeout=40)
        results = search.execute()
        for result in results:
            result.score = result.meta.score*/
    
        return $results;
    }
    
    /**
     * Classify title based on elastic text match of other titles.
     * 
     * @return array
     */
    private function classifyEsMatchByTitle($title) {
        if($title == '' or $title == null) {
            return [];
        }
        /*search = ArticleDocument.search()\
            .query('match', title=title)\
            .extra(min_score=15)\
            .params(size=100)
        results = search.execute()
        for result in results:
            result.score = result.meta.score*/
    
        //return $results;
        return [];
    }

    /**
     * Get list of journals with articles citing/cited by DOIs in refs.
     * 
     * @return array
     */
    private function classifyReferences($refs, $skipArticle) {
        // Test citation which is in DOAJ and OpenCitations:
        // doi:10.3390/publications7010006 -> doi:10.12688/f1000research.11408.1
        if($refs == '' or $refs == null) {
            return [];
        }
    
        $dois = substr($this->extractDois($refs), 0, 200);
    
        # find articles citing the input references
        /*$citingArticles = DoajCitation.objects.filter(tow__in=dois)\
                                          .values('idx', 'frm', 'issn')\
                                          .annotate(total=Count('frm'));
        if ($skipArticle) {
            $citingArticles = list(filter(lambda a: a['idx'] != $skipArticle, $citingArticles));
        }

        if (count($citingArticles) == 0) {
            return [];
        }
        $maxCitations = max($citingArticles, key=lambda e: e['total'])['total'];
        $citingArticles = filter(lambda e: e['total']/$maxCitations >= 1/8, $citingArticles);
    
        $results = [];
        foreach ($citingArticles as $cite) {
            $title = $cite['frm'];
            $issns = [$cite['issn']];
            if ($cite['idx']) {
                try {
                    $article = Article.objects.get(idx=cite['idx']);
                    $title = $article.title or $title;
                    $issns = $article.journal_issns;
                } catch(Exception $e) {
                    $this->logger->warning('Article ' . $cite["idx"] . ' does not exist');
                }
            }
    
            $results.append({
                'idx': cite['idx'],
                'journal_issns': issns,
                'doi': cite['frm'],
                'title': cite['frm'],
                'score': cite['total'];
            });
        }
    
        return $results;*/
    }

    /**
     * Extract a list of DOIs from a string based on regexs.
     */
    private function extractDois($text) {
        // These regexs supposedly match > 99% of DOIs.
        // See: https://www.crossref.org/blog/dois-and-matching-regular-expressions/
        preg_match('10.\d{4,9}/[-._;()/:A-Z0-9]+', $text, $firstMatch);
        preg_match('10.1002/[^\s]+', $text, $secondMatch);
    
        return array_merge($firstMatch, $secondMatch);
    }
}
