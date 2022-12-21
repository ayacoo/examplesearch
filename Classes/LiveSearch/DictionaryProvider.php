<?php

namespace Ayacoo\ExampleSearch\LiveSearch;

use TYPO3\CMS\Backend\Search\LiveSearch\ResultItem;
use TYPO3\CMS\Backend\Search\LiveSearch\ResultItemAction;
use TYPO3\CMS\Backend\Search\LiveSearch\SearchDemand;
use TYPO3\CMS\Backend\Search\LiveSearch\SearchProviderInterface;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;

class DictionaryProvider implements SearchProviderInterface
{

    public function __construct(
        protected readonly IconFactory $iconFactory
    )
    {
    }

    public function find(SearchDemand $searchDemand): array
    {
        $actions = [];
        $resultItems = [];

        $resultItem = new ResultItem(self::class);
        $resultItem->setItemTitle('Google');
        $resultItem->setTypeLabel('My Dictionary');
        $resultItem->setIcon($this->iconFactory->getIcon('mimetypes-example-search-icon', Icon::SIZE_SMALL));

        $action = new ResultItemAction('open_website');
        $action->setLabel('Open website');
        $action->setIcon($this->iconFactory->getIcon('actions-open', Icon::SIZE_SMALL));
        $action->setUrl('https://www.typo3.org');
        $actions[] = $action;

        $action = new ResultItemAction('refresh_action');
        $action->setLabel('Refresh website');
        $action->setIcon($this->iconFactory->getIcon('actions-refresh', Icon::SIZE_SMALL));
        $action->setUrl('https://www.typo3.org');
        $actions[] = $action;

        $resultItem->setActions(...$actions);

        $resultItems[] = $resultItem;

        return [...$resultItems];
    }

    public function getFilterLabel(): string
    {
        return 'Dictionary records';
    }
}
