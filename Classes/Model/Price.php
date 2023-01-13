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
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property float $euro This holds the price converted to EUR
 * @property integer $price This holds the average publication cost in original currency
 * @property string $currency This holds the currency in which price is given
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
     * @var integer
     */
    protected $price;

    /**
     * currency
     *
     * @var string
     */
    protected $currency;

    /**
     * Empty constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Constructor from the average publication cost JSON
     *
     * @access public
     *
     * @static
     *
     * @param array $apcMax JSON average publication cost
     *
     * @return Price instance of this class
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
     * Constructor from the amount and currency
     *
     * @access public
     *
     * @static
     *
     * @param integer $amount the average publication cost in original currency
     * @param string $currency the currency in which price is given
     *
     * @return Price instance of this class
     */
    public static function fromAmountAndCurrency($amount, $currency)
    {   if (!empty($amount)) {
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
