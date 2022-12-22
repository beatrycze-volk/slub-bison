<?php

declare(strict_types=1);

namespace Slub\Bison\Model;


/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

/**
 * Access Data DTO
 */
class AccessData
{

    /**
     * url
     *
     * @var string
     */
    protected $url;

    /**
     * author instructions url
     *
     * @var string
     */
    protected $authorInstructionsUrl;

    /**
     * aims and scope url
     *
     * @var string
     */
    protected $aimsAndScopeUrl;

    /**
     * editorial board url
     *
     * @var string
     */
    protected $editorialBoardUrl;

    /**
     * __construct
     */
    public function __construct($journal)
    {
        $this->url = $journal->ref_journal;
        $this->authorInstructionsUrl = $journal->ref_author_instructions;
        $this->aimsAndScopeUrl = $journal->aims_scope;
        $this->editorialBoardUrl = $journal->editorial_board_url;
    }

    /**
     * Returns the url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns the author instructions url
     *
     * @return string
     */
    public function getAuthorInstructionsUrl()
    {
        return $this->authorInstructionsUrl;
    }

    /**
     * Returns the aims and scope url
     *
     * @return string
     */
    public function getAimsAndScopeUrl()
    {
        return $this->aimsAndScopeUrl;
    }

    /**
     * Returns the editorial board url
     *
     * @return string
     */
    public function getEditorialBoardUrl()
    {
        return $this->editorialBoardUrl;
    }
}
