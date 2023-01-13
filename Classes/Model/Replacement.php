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
 * Replacement DTO
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $id This holds the id of the replacement journal
 */
class Replacement
{

    /**
     * the id of the replacement journal
     *
     * @var string
     */
    protected $id;

    /**
     * Constructs replacement instance
     *
     * @param string $replacement the id of the replacement journal
     *
     * @return void
     */
    public function __construct($replacement)
    {
        $this->id = $replacement;
    }

    /**
     * Returns the id od replacement journal
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
