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
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $url This holds the url of the journal's webpage
 * @property string $authorInstructionsUrl This holds the url of the author instructions
 * @property string $aimsAndScopeUrl This holds the url of the journal aims and scope
 * @property string $editorialBoardUrl This holds the url of the editorial board
 */
class AccessData
{

    /**
     * url of the journal's webpage
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
     * Empty constructor
     */
    public function __construct()
    {
    }

    /**
     * Constructor from journal JSON
     *
     * @access public
     *
     * @static
     *
     * @param array $journal JSON journal
     *
     * @return AccessData instance of this class
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
     * Constructor from URL
     *
     * @access public
     *
     * @static
     *
     * @param string $url URL of the webpage of the journal
     *
     * @return AccessData instance of this class
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
