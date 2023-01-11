<?php

namespace Slub\Bison\Controller;

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
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use GuzzleHttp\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Slub\Bison\Utility\IndexDatabaseList;
use Slub\Bison\Utility\MirrorJournalList;
use Slub\Bison\Utility\LocalConditionsFilter;
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
    * @var LocalConditionsFilter
    * @access protected
    */
    protected $localConditionsFilter;

    /**
    * @var MirrorJournalList
    * @access protected
    */
    protected $mirrorJournalList;

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

        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://service.tib.eu/bison/api/public/v1/',
            // You can set any number of default request options.
            'timeout'  => 10.0,
            'headers' => [
                'User-Agent' => $this->extConfig['userAgent'],
            ],
        ]);
        
        $this->requestData = GeneralUtility::_GPmerged('tx_bison');
        
        $this->viewData = [
            'pageUid' => $GLOBALS['TSFE']->id,
            'uniqueId'=> uniqid(),
            'requestData' => $this->requestData
        ];

        $this->indexDatabaseList = new IndexDatabaseList();
        $this->localConditionsFilter = new LocalConditionsFilter();
        $this->mirrorJournalList = new MirrorJournalList();
    }
    /**
     * Gets contact data stored in extension configuration.
     *
     * @access protected
     *
     * @return array 
     */
    protected function getContactPerson() { 
        return [
            'name' => $this->extConfig['contactName'],
            'email'=> $this->extConfig['contactEmail'],
            'url' => $this->extConfig['contactUrl']
        ];
    }
}
