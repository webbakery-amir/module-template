<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Greeting\Service;

use OxidEsales\Eshop\Application\Model\User as EshopModelUser;
use WebBakery\Credit\Greeting\Infrastructure\UserModelFactoryInterface;

/**
 * @extendable-class
 */
class UserService implements UserServiceInterface
{
    /**
     * @var UserModelFactoryInterface
     */
    private $userModelFactory;

    public function __construct(
        UserModelFactoryInterface $userModelFactory
    ) {
        $this->userModelFactory = $userModelFactory;
    }

    public function getUserById(string $userId): EshopModelUser
    {
        $userModel = $this->userModelFactory->create();
        $userModel->load($userId);

        return $userModel;
    }
}
