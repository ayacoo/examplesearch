<?php

namespace Ayacoo\ExampleSearch\EventListener;

use TYPO3\CMS\Backend\Search\Event\BeforeSearchInDatabaseRecordProviderEvent;

final class BeforeSearchInDatabaseRecordProviderEventListener
{
    public function __invoke(BeforeSearchInDatabaseRecordProviderEvent $event): void
    {
        $event->ignoreTable('be_dashboards');
    }
}
