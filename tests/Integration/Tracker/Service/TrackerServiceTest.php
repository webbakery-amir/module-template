<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tests\Integration\Tracker\Service;

use OxidEsales\Eshop\Application\Model\User as ShopUser;
use WebBakery\Credit\Extension\Model\User;
use WebBakery\Credit\Greeting\Model\PersonalGreetingUserInterface;
use WebBakery\Credit\Greeting\Repository\GreetingRepositoryInterface;
use WebBakery\Credit\Tracker\Model\TrackerModel;
use WebBakery\Credit\Tracker\Repository\TrackerRepository;
use WebBakery\Credit\Tracker\Service\TrackerService as TrackerService;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TrackerService::class)]
final class TrackerServiceTest extends TestCase
{
    public const TEST_TRACKER_ID = '_testoxid';

    public const TEST_USER_ID = '_testuser';

    public const TEST_GREETING = 'Hi there';

    public function testUpdateTrackerNoGreetingChange(): void
    {
        $greetingRepository = $this->createConfiguredStub(GreetingRepositoryInterface::class, [
            'getSavedUserGreeting' => self::TEST_GREETING
        ]);

        $repo = $this->createPartialMock(TrackerRepository::class, ['getTrackerByUserId']);
        $repo->expects($this->never())->method('getTrackerByUserId');

        $tracker = new TrackerService(
            $repo,
            $greetingRepository
        );

        $tracker->updateTracker($this->getUserWithPersonalGreetingStub());
    }

    public function testUpdateTrackerGreetingChange(): void
    {
        $greetingRepository = $this->createConfiguredStub(GreetingRepositoryInterface::class, [
            'getSavedUserGreeting' => self::TEST_GREETING . ' with a change'
        ]);

        $repo = $this->createConfiguredStub(TrackerRepository::class, [
            'getTrackerByUserId' => $trackerSpy = $this->createMock(TrackerModel::class)
        ]);
        $trackerSpy->expects($this->once())->method('countUp');

        $sut = new TrackerService(
            $repo,
            $greetingRepository
        );

        $sut->updateTracker($this->getUserWithPersonalGreetingStub());
    }

    private function getUserWithPersonalGreetingStub(): ShopUser&PersonalGreetingUserInterface
    {
        /** @var ShopUser&PersonalGreetingUserInterface $stub */
        $stub = $this->createConfiguredStub(User::class, [
            'getId' => self::TEST_USER_ID,
            'getPersonalGreeting' => self::TEST_GREETING,
        ]);

        return $stub;
    }
}
