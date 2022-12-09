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
 * IsReplacedBy
 */
class IsReplacedBy extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * replacement
     *
     * @var string
     */
    protected $replacement = null;

    /**
     * Returns the replacement
     *
     * @return string
     */
    public function getReplacement()
    {
        return $this->replacement;
    }

    /**
     * Sets the replacement
     *
     * @param string $replacement
     * @return void
     */
    public function setReplacement(string $replacement)
    {
        $this->replacement = $replacement;
    }
}
