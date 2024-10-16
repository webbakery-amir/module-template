<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Greeting\Model;

interface PersonalGreetingUserInterface
{
    public const OEMT_USER_GREETING_FIELD = 'oemtgreeting';

    public function getPersonalGreeting(): string;

    public function setPersonalGreeting(string $personalGreeting): void;
}
