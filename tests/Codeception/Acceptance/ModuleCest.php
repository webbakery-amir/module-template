<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Module\Translation\Translator;
use WebBakery\Credit\Core\Module;
use WebBakery\Credit\Tests\Codeception\Support\AcceptanceTester;

/**
 * @group Playground_module-template
 * @group Playground_module-template_module
 */
final class ModuleCest
{
    public function testCanDeactivateModule(AcceptanceTester $I): void
    {
        $I->wantToTest('that deactivating the module does not destroy the shop');

        $I->openShop();
        $I->waitForText(Translator::translate('OEMODULETEMPLATE_GREETING'));

        $I->deactivateModule(Module::MODULE_ID);
        $I->reloadPage();

        $I->waitForPageLoad();
        $I->dontSee(Translator::translate('OEMODULETEMPLATE_GREETING'));
    }
}
