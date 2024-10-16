<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tracker\Service;

use OxidEsales\Eshop\Application\Model\User;
use WebBakery\Credit\Greeting\Model\PersonalGreetingUserInterface;
use WebBakery\Credit\Greeting\Repository\GreetingRepositoryInterface;
use WebBakery\Credit\Tracker\Repository\TrackerRepositoryInterface;

/**
 * Example which we can decorate
 */
class TrackerService implements TrackerServiceInterface
{
    public function __construct(
        private TrackerRepositoryInterface $trackerRepository,
        private GreetingRepositoryInterface $greetingRepository,
    ) {
    }

    public function updateTracker(User&PersonalGreetingUserInterface $user): void
    {
        $savedGreeting = $this->greetingRepository->getSavedUserGreeting($user->getId());

        if ($savedGreeting !== $user->getPersonalGreeting()) {
            $tracker = $this->trackerRepository->getTrackerByUserId($user->getId());
            $tracker->countUp();
        }
    }
}
