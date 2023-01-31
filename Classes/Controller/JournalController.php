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
     *
     * @return void
     */
    public function injectJournalRepository(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    /**
     * The journal function returning one journal based on idx.
     *
     * @access public
     *
     * @return void
     */
    public function mainAction()
    {
        $this->getJournal();

        $this->view->assign('journal', $this->journal);
        $this->view->assign('contact', $this->getContactPerson());
        $this->view->assign('viewData', $this->viewData);
    }

    /**
     * Gets journal from API.
     *
     * @access private
     *
     * @return void
     */
    private function getJournal()
    {
        try {
            $response = $this->client->request(
                'GET',
                'journal/'.$this->requestData['id']
            );

            if ($response->getStatusCode() === 200) {
                $content = $response->getBody()->getContents();
                $journalJson = json_decode($content);
                $this->journal = new Journal($journalJson);
                $this->mirrorJournalList->assignMirrorJournal($this->journal);
                $this->localPriceList->assignLocalPrice($this->journal);
            }
        } catch (Exception $e) {
            $this->logger->error('Request error: '.$e->getMessage());
        }
    }
}
