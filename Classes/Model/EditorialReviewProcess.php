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
 * EditorialReviewProcess DTO
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $process This holds the name of editorial review process
 */
class EditorialReviewProcess
{

    /**
     * process
     *
     * @var string
     */
    protected $process;

    /**
     * Constructor for editorial review process
     *
     * @access public
     *
     * @param string $process the name of the process
     */
    public function __construct($process)
    {
        $this->process = $process;
    }

    /**
     * Returns the process
     *
     * @return string
     */
    public function getProcess()
    {
        return $this->process;
    }
}
