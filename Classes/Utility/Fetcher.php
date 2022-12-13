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

use Slub\Bison\Exception\IdNotFoundException;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The article fetcher for id.
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage slubbison
 * @access public
 */
class Fetcher implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * This holds the logger
     *
     * @var LogManager
     * @access private
     */
    private $logger;

    /**
     * This holds the request factory
     *
     * @var RequestFactory
     * @access private
     */
    private $requestFactory;

    private function __construct()
    {
        $this->cache = GeneralUtility::makeInstance(CacheManager::class)->getCache('tx_slubbison_currency');
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(get_class($this));
        $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
    }

    /**
     * Use cross ref API to retrieve title, abstract and references for DOI.
     */
    private function fetchCrossRef($id) {
        //$crossRef = Crossref(mailto='bison@tib.eu', ua_string='BISON-DOI-fetcher');
        #TODO timeout?
        try {
            $article = $crossRef.works($id)['message'];
            $references = '';
            /*if ($article['references-count'] > 0 and 'reference' in $article) {
                # Show references that have either a DOI or a title. The title is
                # not used but might put people at ease who are worried that some
                # of their references are missing.
                $references = filter(lambda r: 'DOI' in r or 'article-title' in r,
                                    article['reference'])
                                    $references = '\n'.join(
                    map(lambda r: f'{r.get("DOI", "")} {r.get("article-title", "")}',
                        references)
                )
            }
            return {
                'title': article.get('title', [''])[0],
                'abstract': article.get('abstract', '')
                                .replace('<jats:title>', '')
                                .replace('</jats:title>', '')
                                .replace('<ns4:p>', '')
                                .replace('</ns4:p>', '')
                                .replace('<jats:p>', '')
                                .replace('</jats:p>', ''),
                'references': references
            }*/
        } catch (Exception $e) {
            throw new IdNotFoundException($id, $e->getMessage());
        }
    }

    /**
     * Use arXiv API to retrieve title and abstract for arXiv ID.
     * 
     * References/Citations are not provided by the API. However, they could
     * be extracted from the PDF.
     */
    private function fetchArXiv($id) {
        /*fetch_arXiv.regex = getattr(fetch_arXiv, 'regex', None) or \
        re.compile(r"\d{4}.\d{4,6}(v\d+)?")
        try {
            arxiv_id = re.search(fetch_arXiv.regex, input_id).group()
        } catch (Exception $e) {
            throw new IdNotFoundException($id);
        }

        $results = feedparser.parse(
            'http://export.arxiv.org/api/query?id_list=' + arxiv_id
        )
        if 'status' not in results or results.status != 200:
            throw new IdNotFoundException($id);
        
        #TODO: Do title and summary always exist?
        return {
            'title': results.entries[0].title,
            'abstract': results.entries[0].summary,
            'references': ''
        }*/
    }

    /**
     * Use data cite API to retrieve title and abstract for DOI.
     */
    private function fetchDataCite($doi) {
        $response = $this->requestFactory->request(API_URL, 'GET', $configuration);requests.get('https://api.datacite.org/dois/' + doi).json();
        /*if ('data' not in $response) {
            throw new IdNotFoundException($doi);
        }
    
        $title;
        $abstract;

        try {
            $title = r['data']['attributes']['titles'][0]['title'];
            $abstract = r['data']['attributes']['descriptions'][0]['description'];
        } catch (Exception $e) {
            $this->logger->warning($e->getMessage());
        }
    
        // TODO: are there references in DataCite metadata?
        return {'title': title, 'abstract': abstract, 'references': ''}*/
    }
}
