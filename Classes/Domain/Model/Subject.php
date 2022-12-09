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
 * Subject
 */
class Subject extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * term
     *
     * @var string
     */
    protected $term = null;

    /**
     * Returns the term
     *
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Sets the term
     *
     * @param string $term
     * @return void
     */
    public function setTerm(string $term)
    {
        $this->term = $term;
    }
}
