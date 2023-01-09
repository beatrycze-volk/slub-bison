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
    public function __construct()
    {
    }

    /**
     * __construct
     */
    public static function fromJournal($journal)
    {
        $instance = new self();
        $instance->url = $journal->ref_journal;
        $instance->authorInstructionsUrl = $journal->ref_author_instructions;
        $instance->aimsAndScopeUrl = $journal->aims_scope;
        $instance->editorialBoardUrl = $journal->editorial_board_url;
        return $instance;
    }

    /**
     * __construct
     */
    public static function fromUrl($url)
    {
        $instance = new self();
        $instance->url = $url;
        return $instance;
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
