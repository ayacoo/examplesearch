<?php

namespace Ayacoo\ExampleSearch\EventListener;

use TYPO3\CMS\Backend\Search\Event\ModifyQueryForLiveSearchEvent;

final class ModifyQueryForLiveSearchEventListener
{
    public function __invoke(ModifyQueryForLiveSearchEvent $event): void
    {
        // Get the current instance
        $queryBuilder = $event->getQueryBuilder();

        // Change limit depending on the table
        if ($event->getTableName() === 'be_dashboards') {
            $queryBuilder->setMaxResults(1);
        }

        // Reset the orderBy part
        $queryBuilder->resetQueryPart('orderBy');
    }
}
