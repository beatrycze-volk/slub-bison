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
 * Language DTO
 */
class Language
{
    /**
     * lang
     *
     * @var string
     */
    protected $lang;

    /**
     * __construct
     */
    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Returns the lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }
}
