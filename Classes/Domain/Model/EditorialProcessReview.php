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
 * EditorialProcessReview
 */
class EditorialProcessReview extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * process
     *
     * @var string
     */
    protected $process = null;

    /**
     * Returns the process
     *
     * @return string
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * Sets the process
     *
     * @param string $process
     * @return void
     */
    public function setProcess(string $process)
    {
        $this->process = $process;
    }
}
