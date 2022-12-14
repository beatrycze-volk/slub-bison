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
     * @var 
     * @access protected
     */
    protected $client;   

    /**
     * @var array
     * @access protected
     */
    protected $extConfig;

    /**
     * @var array
     * @access protected
     */
    protected $esConfig;

    /**
     * This holds the request parameter
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
     * Initialize the plugin controller
     *
     * @access protected
     * @return void
     */
    protected function initialize()
    {   
        // Get extension configuration.
        $this->extConfig = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('bison');

        $this->loadElasticSearchConnectionInfo();

        //$this->client = ClientBuilder::create()
        //    ->setHosts(['https://service.tib.eu/bison/api/public/v1/search'])
        //    ->build();

        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://service.tib.eu/bison/api/public/v1/',
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]);
        
        $this->requestData = GeneralUtility::_GPmerged('tx_bison');
        
        $this->viewData = [
            'pageUid' => $GLOBALS['TSFE']->id,
            'uniqueId'=> uniqid(),
            'requestData' => $this->requestData
        ];
    }

    /**
     * Override getErrorFlashMessage to present
     * nice flash error messages.
     *
     * @return string
     */
    protected function getErrorFlashMessage(): string
    {
        $defaultFlashMessage = parent::getErrorFlashMessage();
        $localLangKey = sprintf('error.%s.%s', $this->request->getControllerName(), $this->actionMethodName);
        return $this->translate($localLangKey, $defaultFlashMessage);
    }

    /**
     * Helper function to render localized flash messages
     *
     * @param string $action
     * @param integer $severity optional severity code. One of the t3lib_FlashMessage constants
     * @return void
     */
    public function addLocalizedFlashMessage(string $action, int $severity = FlashMessage::OK): void
    {
        $messageLocalLangKey = sprintf('flashmessage.%s.%s', $this->request->getControllerName(), $action);
        $localizedMessage = $this->translate($messageLocalLangKey, '[' . $messageLocalLangKey . ']');
        $titleLocalLangKey = sprintf('%s.title', $messageLocalLangKey);
        $localizedTitle = $this->translate($titleLocalLangKey, '[' . $titleLocalLangKey . ']');
        $this->addFlashMessage($localizedMessage, $localizedTitle, $severity);
    }

    /**
     * Helper function to use localized strings in BlogExample controllers
     *
     * @param string $key local lang key
     * @param string $defaultMessage
     * @return string
     */
    protected function translate(string $key, string $defaultMessage = ''): string
    {
        $message = LocalizationUtility::translate($key, 'SlubBison');
        if ($message === null) {
            $message = $defaultMessage;
        }
        return $message;
    }

     /**
     * Sets the connection information for Elastic Search
     *
     * @access protected
     *
     * @return void
     */
    protected function loadElasticSearchConnectionInfo()
    {
        if (empty($this->esConfig)) {
            $config = [];
            $config['scheme'] = empty($conf['esHttps']) ? 'http' : 'https';
            $config['host'] = ($conf['esHost'] ? $conf['esHost'] : '127.0.0.1');
            $config['username'] = $conf['esUser'];
            $config['password'] = $conf['esPass'];
            $config['port'] = MathUtility::forceIntegerInRange($conf['esPort'], 1, 65535, 8983);
            
            // Trim path of slashes and (re-)add trailing slash if path not empty.
            $config['path'] = trim($conf['esPath'], '/');
            if (!empty($config['path'])) {
                $config['path'] .= '/';
            }

            // Set connection timeout lower than PHP's max_execution_time.
            $maxExecutionTime = intval(ini_get('max_execution_time')) ? : 30;
            $config['timeout'] = MathUtility::forceIntegerInRange($conf['esTimeout'], 1, $maxExecutionTime, 10);
            $this->config = $config;
        }
    }

    /**
     * This is the constructor
     *
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        $this->initialize();
    }
}
