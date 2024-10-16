<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Greeting\Controller;

use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Application\Model\User as EshopModelUser;
use WebBakery\Credit\Core\Module as ModuleCore;
use WebBakery\Credit\Extension\Model\User as TemplateModelUser;
use WebBakery\Credit\Greeting\Service\GreetingMessageServiceInterface;
use WebBakery\Credit\Settings\Service\ModuleSettingsServiceInterface;
use WebBakery\Credit\Tracker\Repository\TrackerRepositoryInterface;

/**
 * @extendable-class
 *
 * This is a brand new (module own) controller which extends from the
 * shop frontend controller class.
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class GreetingController extends FrontendController
{
    /**
     * Current view template
     *
     * @var string
     */
    protected $_sThisTemplate = '@wb_credit/templates/greetingtemplate';

    /**
     * Rendering method.
     *
     * @return mixed
     */
    public function render()
    {
        $template = parent::render();
        $moduleSettings = $this->getService(ModuleSettingsServiceInterface::class);
        $repository = $this->getService(TrackerRepositoryInterface::class);

        /** @var TemplateModelUser $user */
        $user = $this->getUser();

        if (is_a($user, EshopModelUser::class) && $moduleSettings->isPersonalGreetingMode()) {
            $greeting = $user->getPersonalGreeting();
            $tracker = $repository->getTrackerByUserId($user->getId());
            $counter = $tracker->getCount();
        }

        $this->addTplParam(ModuleCore::OEMT_GREETING_TEMPLATE_VARNAME, $greeting ?? '');
        $this->addTplParam(ModuleCore::OEMT_COUNTER_TEMPLATE_VARNAME, $counter ?? 0);

        return $template;
    }

    /**
     * NOTE: every public method in the controller will become part of the public API.
     *       A controller public method can be called via browser by cl=<controllerkey>&fnc=<methodname>.
     *       Take care not to accidentally expose methods that should not be part of the API.
     *       Leave the business logic to the service layer.
     */
    public function updateGreeting(): void
    {
        $moduleSettings = $this->getService(ModuleSettingsServiceInterface::class);

        /** @var EshopModelUser $user */
        $user = $this->getUser();

        if (is_a($user, EshopModelUser::class) && $moduleSettings->isPersonalGreetingMode()) {
            $greetingService = $this->getService(GreetingMessageServiceInterface::class);
            $greetingService->saveGreeting($user);
        }
    }
}
