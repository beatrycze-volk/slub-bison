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
 * Article DTO
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $title This holds the article's title
 * @property string $doi This holds the article's DOI
 * @property string $type This holds the possible types of article: 'title', 'abstract' and 'doi'
 */
class Article
{

    /**
     * title
     *
     * @var string
     */
    protected $tile;

    /**
     * DOI
     *
     * @var string
     */
    protected $doi;

    /**
     * Constructor for article
     *
     * @access public
     *
     * @param array $article JSON article
     */
    public function __construct($article)
    {
        $this->title = $article->title;
        $this->doi = $article->doi;
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the doi
     *
     * @return string
     */
    public function getDoi()
    {
        return $this->doi;
    }
}
