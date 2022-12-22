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
 * Publisher DTO
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property-read string $name the name of the publisher
 * @property-read string $country the country of the publisher
 */
class Publisher
{

    /**
     * name
     *
     * @var string
     */
    protected $name;

    /**
     * country
     *
     * @var string
     */
    protected $country;

    /**
     * __construct
     * 
     * @var string $name the name of the publisher
     * @var string $country the country of the publisher
     */
    public function __construct(string $name, string $country)
    {
        $this->name = $name;
        $this->country = $country;
    }

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }


}
