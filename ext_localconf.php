<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Bison',
        'Recommender',
        [
            \Slub\Bison\Controller\RecommenderController::class => 'main'
        ],
        // non-cacheable actions
        [
            \Slub\Bison\Controller\RecommenderController::class => ''
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
                }
                show = *
            }
       }'
    );
})();
