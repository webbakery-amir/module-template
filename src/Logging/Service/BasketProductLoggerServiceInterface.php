<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Logging\Service;

interface BasketProductLoggerServiceInterface
{
    public function log(string $productID): void;
}
