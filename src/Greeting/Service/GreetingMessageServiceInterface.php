<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Greeting\Service;

use OxidEsales\Eshop\Application\Model\User as EshopModelUser;

interface GreetingMessageServiceInterface
{
    public function getGreeting(?EshopModelUser $user = null): string;

    public function saveGreeting(EshopModelUser $user): bool;
}
