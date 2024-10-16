<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tests\Integration\Extension\Model;

use OxidEsales\Eshop\Application\Model\Article as EshopModelArticle;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;
use WebBakery\Credit\Extension\Model\Basket;
use WebBakery\Credit\Logging\Service\BasketProductLoggerServiceInterface;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Basket::class)]
final class BasketIntegrationTest extends IntegrationTestCase
{
    private const TEST_PRODUCT_ID = 'testArticleId';

    public function setUp(): void
    {
        parent::setUp();
        $this->prepareTestData();
    }

    private function prepareTestData(): void
    {
        $product = oxNew(EshopModelArticle::class);
        $product->setId(self::TEST_PRODUCT_ID);
        $product->assign(
            [
                'oxprice' => 100,
                'oxstock' => 100
            ]
        );
        $product->save();
    }

    public function testAddToBasket(): void
    {
        $loggerSpy = $this->createMock(BasketProductLoggerServiceInterface::class);
        $loggerSpy->expects($this->once())->method('log');

        $basket = $this->createPartialMock(\WebBakery\Credit\Extension\Model\Basket::class, ['getService']);
        $basket->method('getService')->willReturnMap([
            [BasketProductLoggerServiceInterface::class, $loggerSpy]
        ]);

        $basket->addToBasket(self::TEST_PRODUCT_ID, 1, null, null, false, false, null);
    }
}
