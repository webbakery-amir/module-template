<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Greeting\Repository;

interface GreetingRepositoryInterface
{
    public function getSavedUserGreeting(string $userId): string;
}
