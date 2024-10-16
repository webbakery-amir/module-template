<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Extension\Model;

use OxidEsales\Eshop\Core\Model\BaseModel;
use WebBakery\Credit\Greeting\Model\PersonalGreetingUser;
use WebBakery\Credit\Greeting\Model\PersonalGreetingUserInterface;

/**
 * @eshopExtension
 *
 * This is an example for a module extension (chain extend) of
 * the shop user model.
 *
 * Example extends the shop user with new methods from PersonalGreetingUserInterface by hooking them from the trait
 *
 * NOTE: class must not be final.
 *
 * @mixin BaseModel
 */
class User extends User_parent implements PersonalGreetingUserInterface
{
    use PersonalGreetingUser;
}
