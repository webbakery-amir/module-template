<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace WebBakery\Credit\Tracker\Model;

use OxidEsales\Eshop\Core\Model\BaseModel;

/**
 * @extendable-class
 * This is no shop extension.
 * This is a model class based on shop's BaseModel.
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class TrackerModel extends BaseModel
{
    protected $_sCoreTable = 'oemt_tracker';

    protected $_sClassName = 'oemttracker';

    protected $_blUseLazyLoading = true;

    public function countUp(): void
    {
        $this->assign([
            'oemtcount' => $this->getCount() + 1,
        ]);
        $this->save();
    }

    public function getCount(): int
    {
        return (int)$this->getFieldData('oemtcount');
    }
}
