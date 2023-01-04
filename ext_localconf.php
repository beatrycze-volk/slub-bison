<?php
defined('TYPO3') || die();

(static function() {
    // Use Caching Framework for currency converter
    if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_bison_currency'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_bison_currency'] = [];
    }
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_bison_currency']['backend'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_bison_currency']['backend'] = 'TYPO3\\CMS\\Core\\Cache\\Backend\\SimpleFileBackend';
    }
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_bison_currency']['options']['defaultLifeTime'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_bison_currency']['options']['defaultLifeTime'] = 87600; // 87600 seconds = 1 day
    }
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bison'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bison'] = [
            'Slub\Bison\ViewHelpers',
        ];
    }

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Bison',
        'Recommender',
        [
            \Slub\Bison\Controller\RecommenderController::class => 'main'
        ],
        // non-cacheable actions
        [
            \Slub\Bison\Controller\RecommenderController::class => 'main'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Bison',
        'Journal',
        [
            \Slub\Bison\Controller\JournalController::class => 'main'
        ],
        // non-cacheable actions
        [
            \Slub\Bison\Controller\JournalController::class =>'main'
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    recommender {
                        iconIdentifier = bison-plugin-recommender
                        title = LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_recommender.name
                        description = LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_recommender.description
                        tt_content_defValues {
                            CType = list
                            list_type = bison_recommender
                        }
                    }
                    journal {
                        iconIdentifier = bison-plugin-recommender
                        title = LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_journal.name
                        description = LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_journal.description
                        tt_content_defValues {
                            CType = list
                            list_type = bison_journal
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
