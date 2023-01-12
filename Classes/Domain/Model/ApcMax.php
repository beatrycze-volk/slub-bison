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
 * ApcMax
 */
class ApcMax extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * euro
     *
     * @var float
     */
    protected $euro = null;

    /**
     * price
     *
     * @var integer
     */
    protected $price = null;

    /**
     * currency
     *
     * @var string
     */
    protected $currency = null;

    /**
     * Returns the euro
     *
     * @return float
     */
    public function getEuro()
    {
        return $this->euro;
    }

    /**
     * Sets the euro
     *
     * @param float $euro
     * @return void
     */
    public function setEuro(float $euro)
    {
        $this->euro = $euro;
    }

    /**
     * Returns the price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the price
     *
     * @param int $price
     * @return void
     */
    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    /**
     * Returns the currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Sets the currency
     *
     * @param string $currency
     * @return void
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }
}
