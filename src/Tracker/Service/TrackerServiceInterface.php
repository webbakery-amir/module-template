<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tracker\Service;

use OxidEsales\Eshop\Application\Model\User;
use WebBakery\Credit\Greeting\Model\PersonalGreetingUserInterface;

interface TrackerServiceInterface
{
    public function updateTracker(User&PersonalGreetingUserInterface $user): void;
}
