<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tests\Codeception\Support\Helper;

use OxidEsales\Facts\Facts;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

final class Acceptance extends \Codeception\Module
{
    public function _beforeSuite($settings = []): void
    {
        exec((new Facts())->getShopRootPath() . '/bin/oe-console oe:module:activate Playground_module-template');
    }
}
