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

use Slub\Bison\Utility\CurrencyConverter;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Average Publication Cost DTO
 */
class Price
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
    public function __construct()
    {
    }

    /**
     * __construct
     */
    public static function fromAPC($apcMax)
    {
        $instance = new self();
        $instance->euro = $apcMax->euro;
        $instance->price = $apcMax->price;
        $instance->currency = $apcMax->currency;
        return $instance;
    }

    /**
     * __construct
     */
    public static function fromAmountAndCurrency($amount, $currency)
    {   if(!empty($amount)) {
            $instance = new self();
            $instance->price = $amount;
            $instance->currency = $currency;
            $instance->euro = GeneralUtility::makeInstance(CurrencyConverter::class)->convert($amount, $currency);
            return $instance;
        }
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
