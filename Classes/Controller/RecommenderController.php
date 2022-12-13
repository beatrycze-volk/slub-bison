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

/**
 * JournalController
 */
class RecommenderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * journalRepository
     *
     * @var \Slub\Bison\Domain\Repository\JournalRepository
     */
    protected $journalRepository = null;

    /**
     * @param \Slub\Bison\Domain\Repository\JournalRepository $journalRepository
     */
    public function injectJournalRepository(\Slub\Bison\Domain\Repository\JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    /**
     * action main
     */
    public function mainAction()
    {
        $this->view->assign('test', 'test content');
    }

    /**
     * action fetch
     */
    public function fetchAction()
    {
        $this->view->assign('test', 'test content');
    }
}
