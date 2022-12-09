<?php

declare(strict_types=1);

namespace Slub\Bison\Domain\Model;


/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

/**
 * Article
 */
class Article extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = null;

    /**
     * doi
     *
     * @var string
     */
    protected $doi = null;

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
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
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

    /**
     * Sets the doi
     *
     * @param string $doi
     * @return void
     */
    public function setDoi(string $doi)
    {
        $this->doi = $doi;
    }
}
