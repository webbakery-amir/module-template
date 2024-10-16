<?php

/**
 * Copyright © Web Bakery. All rights reserved.
 * See LICENSE file for license details.
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id'          => 'wb_credit',
    'title'       => 'CHANGE MY TITLE',
    'description' =>  '',
    'thumbnail'   => 'pictures/logo.png',
    'version'     => '3.0.0',
    'author'      => 'Web Bakery',
    'url'         => '',
    'email'       => '',
    'extend'      => [
        \OxidEsales\Eshop\Application\Controller\StartController::class => \WebBakery\Credit\Extension\Controller\StartController::class,
        \OxidEsales\Eshop\Application\Model\Basket::class => \WebBakery\Credit\Extension\Model\Basket::class,
        \OxidEsales\Eshop\Application\Model\User::class => \WebBakery\Credit\Extension\Model\User::class,
    ],
    'controllers' => [
        'oemtgreeting' => \WebBakery\Credit\Greeting\Controller\GreetingController::class,
        'oemt_admin_greeting' => \WebBakery\Credit\Greeting\Controller\Admin\GreetingAdminController::class,
    ],
    'events' => [
        'onActivate' => '\WebBakery\Credit\Core\ModuleEvents::onActivate',
        'onDeactivate' => '\WebBakery\Credit\Core\ModuleEvents::onDeactivate'
    ],
    'settings' => [
        //TODO: add help texts for settings to explain possibilities and point out which ones only serve as example
        /** Main */
        [
            'group'       => 'oemoduletemplate_main',
            'name'        => 'oemoduletemplate_GreetingMode',
            'type'        => 'select',
            'constraints' => 'generic|personal',
            'value'       => 'generic'
        ],
        [
            'group' => 'oemoduletemplate_main',
            'name'  => 'oemoduletemplate_BrandName',
            'type'  => 'str',
            'value' => 'Testshop'
        ],
        [
            'group' => 'oemoduletemplate_main',
            'name'  => 'oemoduletemplate_LoggerEnabled',
            'type'  => 'bool',
            'value' => false
        ],
        [
            'group' => 'oemoduletemplate_main',
            'name'  => 'oemoduletemplate_Timeout',
            'type'  => 'num',
            'value' => 30
            //'value' => 30.5
        ],
        [
            'group' => 'oemoduletemplate_main',
            'name'  => 'oemoduletemplate_Categories',
            'type'  => 'arr',
            'value' => ['Sales', 'Manufacturers']
        ],
        [
            'group' => 'oemoduletemplate_main',
            'name'  => 'oemoduletemplate_Channels',
            'type'  => 'aarr',
            'value' => ['1' => 'de', '2' => 'en']
        ],
        [
            'group'    => 'oemoduletemplate_main',
            'name'     => 'oemoduletemplate_Password',
            'type'     => 'password',
            'value'    => 'changeMe',
            'position' => 3
        ]
    ],
];
