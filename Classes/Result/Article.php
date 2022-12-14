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
 * Article DTO
 */
class Article
{

    /**
     * idx
     *
     * @var string
     */
    protected $idx;

    /**
     * id
     *
     * @var string
     */
    protected $id;

    /**
     * __construct
     */
    public function __construct($journal)
    {

    }

    /**
     * Returns the idx
     *
     * @return string
     */
    public function getIdx()
    {
        return $this->idx;
    }

    /**
     * Sets the idx
     *
     * @param string $idx
     * @return void
     */
    public function setIdx(string $idx)
    {
        $this->idx = $idx;
    }


}
