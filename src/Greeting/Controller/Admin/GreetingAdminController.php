<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Greeting\Controller\Admin;

use WebBakery\Credit\Core\Module as ModuleCore;
use OxidEsales\Eshop\Application\Controller\Admin\AdminController;
use WebBakery\Credit\Extension\Model\User as TemplateModelUser;
use WebBakery\Credit\Greeting\Service\UserServiceInterface;

class GreetingAdminController extends AdminController
{
    protected $_sThisTemplate = '@wb_credit/admin/user_greetings';

    public function render()
    {
        $userService = $this->getService(UserServiceInterface::class);
        if ($this->getEditObjectId()) {
            /** @var TemplateModelUser $oUser */
            $oUser = $userService->getUserById($this->getEditObjectId());
            $this->addTplParam(ModuleCore::OEMT_ADMIN_GREETING_TEMPLATE_VARNAME, $oUser->getPersonalGreeting());
        }

        return parent::render();
    }
}
