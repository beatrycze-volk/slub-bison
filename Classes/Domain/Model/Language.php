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
 * Language
 */
class Language extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * lang
     *
     * @var string
     */
    protected $lang = null;

    /**
     * Returns the lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Sets the lang
     *
     * @param string $lang
     * @return void
     */
    public function setLang(string $lang)
    {
        $this->lang = $lang;
    }
}
