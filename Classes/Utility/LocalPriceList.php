<?php

namespace Slub\Bison\Utility;

/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

use Slub\Bison\Model\LocalPrice;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The class for handling local prices stored in CSV file.
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property array<LocalPrice> $prices This holds the list of local prices
 */
class LocalPriceList extends SpreadsheetLoader
{

    /**
     * This holds the prices from CSV file
     *
     * @var array<LocalPrice>
     * @access private
     */
    private $prices;

    /**
     * Constructs the local price list
     *
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('filePrices');

        $this->prices = [];
        for ($i = 1; $i < count($this->data); $i++) {
            $this->prices[] = new LocalPrice(
                $this->data[$i][0],
                $this->data[$i][1],
                $this->data[$i][2],
                $this->data[$i][3],
                $this->data[$i][4],
                $this->data[$i][5]
            );
        }
    }

    /**
     * Assigns the local price to the journals.
     *
     * @access public
     *
     * @param array<Journal> $journals the list of journals to be assigned
     *
     * @return void
     */
    public function assignLocalPrices(&$journals)
    {
        for ($i = 0; $i < count($journals); $i++) {
            $this->assignLocalPrice($journals[$i]);
        }
    }

    /**
     * Assigns the local price to the single journal.
     *
     * @access public
     *
     * @param Journal $journal the journal to be assigned local price
     *
     * @return void
     */
    public function assignLocalPrice(&$journal)
    {
        foreach ($this->prices as $price) {
            if (!empty($price->getEIssn()) && !empty($journal->getEIssn())) {
                if ($price->getEIssn() == $journal->getEIssn()) {
                    $journal->setLocalPrice($price);
                    break;
                }
            } else {
                if ($price->getPIssn() == $journal->getPIssn()) {
                    $journal->setLocalPrice($price);
                    break;
                }
            }
        }
    }
}
