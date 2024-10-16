<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

#AfterModelUpdateEvent

declare(strict_types=1);

namespace WebBakery\Credit\Tracker\Subscriber;

use OxidEsales\Eshop\Application\Model\User as EshopModelUser;
use OxidEsales\EshopCommunity\Internal\Transition\ShopEvents\BeforeModelUpdateEvent;
use WebBakery\Credit\Greeting\Model\PersonalGreetingUserInterface;
use WebBakery\Credit\Tracker\Service\TrackerServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @extendable-class
 */
class BeforeModelUpdate implements EventSubscriberInterface
{
    public function __construct(
        private TrackerServiceInterface $trackerService
    ) {
    }

    public function handle(BeforeModelUpdateEvent $event): BeforeModelUpdateEvent
    {
        $payload = $event->getModel();

        if (is_a($payload, PersonalGreetingUserInterface::class)) {
            /** @var EshopModelUser&PersonalGreetingUserInterface $payload */
            $this->trackerService->updateTracker($payload);
        }

        return $event;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeModelUpdateEvent::class => 'handle',
        ];
    }
}
