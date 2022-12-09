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
 * Keyword
 */
class Keyword extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * keyword
     *
     * @var string
     */
    protected $keyword = null;

    /**
     * Returns the keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Sets the keyword
     *
     * @param string $keyword
     * @return void
     */
    public function setKeyword(string $keyword)
    {
        $this->keyword = $keyword;
    }
}
