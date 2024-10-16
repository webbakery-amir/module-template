<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Greeting\Infrastructure;

use OxidEsales\Eshop\Application\Model\User;

class UserModelFactory implements UserModelFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(): User
    {
        return oxNew(User::class);
    }
}
