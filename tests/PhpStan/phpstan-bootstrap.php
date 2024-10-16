<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

class_alias(
    \OxidEsales\Eshop\Application\Model\User::class,
    \WebBakery\Credit\Extension\Model\User_parent::class
);

class_alias(
    \OxidEsales\Eshop\Application\Controller\StartController::class,
    \WebBakery\Credit\Extension\Controller\StartController_parent::class
);

class_alias(
    \OxidEsales\Eshop\Application\Model\Basket::class,
    \WebBakery\Credit\Extension\Model\Basket_parent::class
);
