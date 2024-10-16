<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tracker\Repository;

use Doctrine\DBAL\Query\QueryBuilder;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use OxidEsales\EshopCommunity\Internal\Transition\Utility\ContextInterface;
use WebBakery\Credit\Tracker\Model\TrackerModel;

/**
 * @extendable-class
 */
class TrackerRepository implements TrackerRepositoryInterface
{
    /** @var QueryBuilderFactoryInterface */
    private $queryBuilderFactory;

    /** @var ContextInterface */
    private $context;

    public function __construct(
        QueryBuilderFactoryInterface $queryBuilderFactory,
        ContextInterface $context,
    ) {
        $this->queryBuilderFactory = $queryBuilderFactory;
        $this->context = $context;
    }

    public function getTrackerByUserId(string $userId): TrackerModel
    {
        $tracker = oxNew(TrackerModel::class);
        $trackerId = $this->getGreetingTrackerId($userId);

        if ($trackerId) {
            $tracker->load($trackerId);
        }

        //if it cannot be loaded from database, create a new object
        if (!$tracker->isLoaded()) {
            $tracker->assign(
                [
                    'oxuserid' => $userId,
                    'oxshopid' => $this->context->getCurrentShopId(),
                ]
            );
        }

        return $tracker;
    }

    private function getGreetingTrackerId(string $userId): string
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->queryBuilderFactory->create();

        $parameters = [
            'oxuserid' => $userId,
            'oxshopid' => $this->context->getCurrentShopId(),
        ];

        $result = $queryBuilder->select('oxid')
            ->from('oemt_tracker')
            ->where('oxuserid = :oxuserid')
            ->andWhere('oxshopid = :oxshopid')
            ->setParameters($parameters)
            ->setMaxResults(1)
            ->execute();

        if (is_object($result)) {
            $value = (string)$result->fetchOne();
        }

        return $value ?? '';
    }
}
