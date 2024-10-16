<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tests\Unit\Greeting\Infrastructure;

use OxidEsales\Eshop\Application\Model\User;
use WebBakery\Credit\Greeting\Infrastructure\UserModelFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \WebBakery\Credit\Greeting\Infrastructure\UserModelFactory
 */
class UserModelFactoryTest extends TestCase
{
    public function testCreateProducesCorrectTypeOfObjects(): void
    {
        $coreRequestFactoryMock = $this->getMockBuilder(UserModelFactory::class)
            ->onlyMethods(['create'])
            ->getMock();

        $this->assertInstanceOf(User::class, $coreRequestFactoryMock->create());
    }
}
