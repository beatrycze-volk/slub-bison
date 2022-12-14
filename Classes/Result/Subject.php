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
 * Journal DTO
 */
class Subject
{

    /**
     * term
     *
     * @var string
     */
    protected $term;

    /**
     * id
     *
     * @var string
     */
    protected $code;

    /**
     * __construct
     */
    public function __construct($subject)
    {
        $this->term = $subject->term;
        $this->code = $subject->code;
    }

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
     * Returns the code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
