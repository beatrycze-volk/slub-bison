<?php

namespace Slub\Bison\Utility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The currency converter for APC (article processing charge).
 * 
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage slubbison
 * @access public
 */
class CurrencyConverter implements \TYPO3\CMS\Core\SingletonInterface
{
    private const API_URL = 'https://api.exchangerate-api.com/v4/latest/EUR';

    /**
     * This holds the cache
     *
     * @var CacheManager
     * @access private
     */
    private $cache;

    /**
     * This holds the logger
     *
     * @var LogManager
     * @access private
     */
    private $logger;

    /**
     * This holds the request factory
     *
     * @access private
     */
    private $requestFactory;

    private function __construct()
    {
        $this->cache = GeneralUtility::makeInstance(CacheManager::class)->getCache('tx_slubbison_currency');
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(get_class($this));
        $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
    }

    /**
     * Converts value in currency to euro.
     */
    public function convert($value, $currency) {
        if ($currency == 'EUR') {
            return $value;
        }
    
        $rates = $this->cache->get('exchange_rates');
        // update exchange rates if they are not in the cache
        if (!$rates) {
            $configuration = ['timeout' => 60];
            try {
                $response = $this->requestFactory->request(API_URL, 'GET', $configuration);
            } catch (\Exception $e) {
                $this->logger->warning('Updating exchange rates from "' . API_URL . '" failed. Error: ' . $e->getMessage() . '.');
                return false;
            }
            $content = $response->getBody()->getContents();
            var_dump($content);
            //convert content into array key - currency, value - rate
            $this->cache->set('exchange_rates', $rates);
        }

        if (!array_key_exists($currency, $rates)) {
            $this->logger->warning('Unknown exchange rate for ' . $currency . '.');
            return false;
        }

        return round($value / $rates[$currency], 2);
    }
}
