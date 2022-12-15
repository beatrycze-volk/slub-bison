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
 * Average Publication Cost DTO
 */
class Apc
{
    /**
     * euro
     *
     * @var float
     */
    protected $euro;

    /**
     * price
     *
     * @var int
     */
    protected $price;

    /**
     * currency
     *
     * @var string
     */
    protected $currency;

    /**
     * __construct
     */
    public function __construct($apcMax)
    {
        $this->euro = $apcMax->euro;
        $this->price = $apcMax->price;
        $this->currency = $apcMax->currency;
    }

    /**
     * Returns the price in euro
     *
     * @return float
     */
    public function getEuro()
    {
        return $this->euro;
    }

    /**
     * Returns the price in original currency
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the original currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
