<?php

namespace Slub\Bison\Controller;

/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

use GuzzleHttp\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Slub\Bison\Utility\IndexDatabaseList;
use Slub\Bison\Utility\LocalFilter;
use Slub\Bison\Utility\LocalPriceList;
use Slub\Bison\Utility\MirrorJournalList;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Abstract base controller for the extension
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 */
abstract class AbstractController extends ActionController implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var Client
     * @access protected
     */
    protected $client;

    /**
     * @var array
     * @access protected
     */
    protected $extConfig;

    /**
     * This holds the request parameters
     *
     * @var array
     * @access protected
     */
    protected $requestData;

    /**
     * This holds some common data for the fluid view
     *
     * @var array
     * @access protected
     */
    protected $viewData;

    /**
     * @var IndexDatabaseList
     * @access protected
     */
    protected $indexDatabaseList;

    /**
     * @var LocalPriceList
     * @access protected
     */
    protected $localPriceList;

    /**
     * @var MirrorJournalList
     * @access protected
     */
    protected $mirrorJournalList;

    /**
     * @var LocalFilter
     * @access protected
     */
    protected $localFilter;

    /**
     * This is the constructor to initialize controllers.
     *
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        // Get extension configuration.
        $this->extConfig = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('bison');

        $this->client = new Client(
            [
                // Base URI is used with relative requests
                'base_uri' => 'https://service.tib.eu/bison/api/public/v1/',
                // You can set any number of default request options.
                'timeout' => 10.0,
                'headers' =>
                [
                    'User-Agent' => $this->extConfig['userAgent'],
                ],
            ]
        );

        $this->requestData = GeneralUtility::_GPmerged('tx_bison');

        $this->viewData = [
            'pageUid' => $GLOBALS['TSFE']->id,
            'uniqueId' => uniqid(),
            'requestData' => $this->requestData
        ];

        $this->indexDatabaseList = new IndexDatabaseList();
        $this->localPriceList = new LocalPriceList();
        $this->mirrorJournalList = new MirrorJournalList();

        $this->localFilter = new LocalFilter();
    }

    /**
     * Gets contact data stored in extension configuration.
     *
     * @access protected
     *
     * @return array
     */
    protected function getContactPerson()
    {
        return [
            'name' => $this->extConfig['contactName'],
            'email' => $this->extConfig['contactEmail'],
            'url' => $this->extConfig['contactUrl']
        ];
    }
}
