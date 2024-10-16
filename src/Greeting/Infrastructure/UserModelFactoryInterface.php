<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

namespace WebBakery\Credit\Greeting\Infrastructure;

use OxidEsales\Eshop\Application\Model\User;

interface UserModelFactoryInterface
{
    /**
     * @return User
     */
    public function create(): User;
}
