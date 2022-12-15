<?php

declare(strict_types=1);

namespace Slub\Bison\Result;


/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

/**
 * Keyword DTO
 */
class Keyword
{

    /**
     * keyword
     *
     * @var string
     */
    protected $keyword;

    /**
     * label
     *
     * @var string
     */
    protected $label;

    /**
     * __construct
     */
    public function __construct($keyword)
    {
        $this->keyword = $keyword;
        $this->label = str_replace(' ', '', $keyword);
    }

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
     * Returns the label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}
