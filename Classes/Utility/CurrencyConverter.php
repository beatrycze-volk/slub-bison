<?php

namespace SLUB\Bison\Utility;

/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The currency converter for prices.
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property CacheManager $cache This holds the cache
 * @property LogManager $logger This holds the logger
 * @property RequestFactory $logger This holds the request factory
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
     * @var RequestFactory
     * @access private
     */
    private $requestFactory;

    /**
     * Constructs the currency converter
     * 
     * @return void
     */
    public function __construct()
    {
        $this->cache = GeneralUtility::makeInstance(CacheManager::class)->getCache('tx_bison_currency');
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(get_class($this));
        $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
    }

    /**
     * Converts value in currency to euro.
     * 
     * @param integer $value to be converted
     * @param string $currency currency from which conversion happens
     * 
     * @return float
     */
    public function convert($value, $currency)
    {
        if ($currency === 'EUR') {
            return $value;
        }

        $rates = $this->cache->get('exchange_rates');
        // Update exchange rates if they are not in the cache
        if (!$rates) {
            $configuration = ['timeout' => 60];
            try {
                $response = $this->requestFactory->request(self::API_URL, 'GET', $configuration);
            } catch (\Exception $e) {
                $this->logger->warning('Updating exchange rates from "' . self::API_URL . '" failed. Error: ' . $e->getMessage() . '.');
                return false;
            }

            $content = $response->getBody()->getContents();
            $result = json_decode($content, true);
            $rates = $result['rates'];
            // Convert content into array key - currency, value - rate
            $this->cache->set('exchange_rates', $rates);
        }

        if (!array_key_exists($currency, $rates)) {
            $this->logger->warning('Unknown exchange rate for ' . $currency . '.');
            return false;
        }

        return round(($value / $rates[$currency]), 2);
    }
}
