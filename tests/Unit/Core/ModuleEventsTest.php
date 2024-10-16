<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tests\Unit\Core;

use WebBakery\Credit\Core\ModuleEvents;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ModuleEvents::class)]
class ModuleEventsTest extends TestCase
{
    public function testEventsExecutable(): void
    {
        ModuleEvents::onActivate();
        ModuleEvents::onDeactivate();

        $this->addToAssertionCount(2);
    }
}
