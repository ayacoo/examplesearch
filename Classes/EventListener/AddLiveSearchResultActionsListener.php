<?php

namespace Ayacoo\ExampleSearch\EventListener;

use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Backend\Search\Event\ModifyResultItemInLiveSearchEvent;
use TYPO3\CMS\Backend\Search\LiveSearch\DatabaseRecordProvider;
use TYPO3\CMS\Backend\Search\LiveSearch\ResultItemAction;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;

final class AddLiveSearchResultActionsListener
{
    protected LanguageService $languageService;

    public function __construct(
        protected readonly IconFactory $iconFactory,
        protected readonly LanguageServiceFactory $languageServiceFactory,
        protected readonly UriBuilder $uriBuilder
    ) {
        $this->languageService = $this->languageServiceFactory->createFromUserPreferences($GLOBALS['BE_USER']);
    }

    public function __invoke(ModifyResultItemInLiveSearchEvent $event): void
    {
        $resultItem = $event->getResultItem();
        if ($resultItem->getProviderClassName() !== DatabaseRecordProvider::class) {
            return;
        }

        if (($resultItem->getExtraData()['table'] ?? null) === 'tt_content') {
            /**
             * WARNING: THIS EXAMPLE OMITS ANY ACCESS CHECK FOR SIMPLICITY REASONS - DO NOT USE AS-IS
             */
            $showHistoryAction = (new ResultItemAction('view_history'))
                ->setLabel($this->languageService->sL('LLL:EXT:core/Resources/Private/Language/locallang_mod_web_list.xlf:history'))
                ->setIcon($this->iconFactory->getIcon('actions-document-history-open', Icon::SIZE_SMALL))
                ->setUrl((string)$this->uriBuilder->buildUriFromRoute('record_history', [
                    'element' => $resultItem->getExtraData()['table'] . ':' . $resultItem->getExtraData()['uid']
                ]));
            $resultItem->addAction($showHistoryAction);
        }
    }
}
