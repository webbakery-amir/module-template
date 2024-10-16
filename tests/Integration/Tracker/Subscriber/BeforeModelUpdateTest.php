<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tests\Unit\Tracker\Subscriber;

use OxidEsales\EshopCommunity\Internal\Transition\ShopEvents\BeforeModelUpdateEvent;
use WebBakery\Credit\Extension\Model\User;
use WebBakery\Credit\Tracker\Model\TrackerModel;
use WebBakery\Credit\Tracker\Service\TrackerServiceInterface;
use WebBakery\Credit\Tracker\Subscriber\BeforeModelUpdate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(BeforeModelUpdate::class)]
final class BeforeModelUpdateTest extends TestCase
{
    public function testHandleEventWithNotMatchingPayload(): void
    {
        $event = $this->createConfiguredStub(BeforeModelUpdateEvent::class, [
            'getModel' => $this->createStub(TrackerModel::class)
        ]);

        $sut = new BeforeModelUpdate(
            trackerService: $trackerSpy = $this->createMock(TrackerServiceInterface::class)
        );
        $trackerSpy->expects($this->never())->method('updateTracker');

        $sut->handle($event);
    }

    public function testHandleEventWithMatchingPayload(): void
    {
        $event = $this->createConfiguredStub(BeforeModelUpdateEvent::class, [
            'getModel' => $this->createStub(User::class)
        ]);

        $sut = new BeforeModelUpdate(
            trackerService: $trackerSpy = $this->createMock(TrackerServiceInterface::class)
        );
        $trackerSpy->expects($this->once())->method('updateTracker');

        $sut->handle($event);
    }

    public function testSubscribedEvents(): void
    {
        $handlers = BeforeModelUpdate::getSubscribedEvents();
        $this->assertArrayHasKey(BeforeModelUpdateEvent::class, $handlers);
    }
}
