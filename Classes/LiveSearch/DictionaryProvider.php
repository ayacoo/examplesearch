<?php

namespace Ayacoo\ExampleSearch\LiveSearch;

use TYPO3\CMS\Backend\Search\LiveSearch\ResultItem;
use TYPO3\CMS\Backend\Search\LiveSearch\ResultItemAction;
use TYPO3\CMS\Backend\Search\LiveSearch\SearchDemand\SearchDemand;
use TYPO3\CMS\Backend\Search\LiveSearch\SearchProviderInterface;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Imaging\IconSize;

readonly class DictionaryProvider implements SearchProviderInterface
{

    public function __construct(
        protected IconFactory $iconFactory
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
        $resultItem->setIcon($this->iconFactory->getIcon('mimetypes-example-search-icon', IconSize::SMALL));

        $action = new ResultItemAction('open_website');
        $action->setLabel('Open website');
        $action->setIcon($this->iconFactory->getIcon('actions-open', IconSize::SMALL));
        $action->setUrl('https://www.typo3.org');
        $action->setTarget('_blank');
        $actions[] = $action;

        $action = new ResultItemAction('refresh_action');
        $action->setLabel('Refresh website');
        $action->setIcon($this->iconFactory->getIcon('actions-refresh', IconSize::SMALL));
        $action->setUrl('https://www.typo3.org');
        $action->setTarget('_blank');
        $actions[] = $action;

        $resultItem->setActions(...$actions);

        $resultItems[] = $resultItem;

        return [...$resultItems];
    }

    public function getFilterLabel(): string
    {
        return 'Dictionary records';
    }

    public function count(SearchDemand $searchDemand): int
    {
        return 1;
    }
}
