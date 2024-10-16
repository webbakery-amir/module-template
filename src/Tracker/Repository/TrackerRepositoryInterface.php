<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tracker\Repository;

use WebBakery\Credit\Tracker\Model\TrackerModel;

/**
 * @extendable-class
 */
interface TrackerRepositoryInterface
{
    public function getTrackerByUserId(string $userId): TrackerModel;
}
