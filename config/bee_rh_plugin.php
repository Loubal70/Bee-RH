<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Plugin Class Autoloading
    |--------------------------------------------------------------------------
    |
    | Define PSR-4 autoloading rules for your plugin PHP classes. The key is
    | the namespace and the value is the relative path, from plugin's root
    | directory, to the directory holding your files.
    |
    */
    'autoloading' => [
        'Themosis\\BeeRH\\' => 'resources',
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your application.
    |
    */
    'providers'   => [
        \Themosis\BeeRH\Providers\AssetServiceProvider::class,
        \Themosis\BeeRH\Providers\RouteServiceProvider::class,
        \Themosis\BeeRH\Providers\Admin\OptionPageServiceProvider::class,
        \Themosis\BeeRH\Providers\Admin\RoleServiceProvider::class,
        \Themosis\BeeRH\Providers\ComposersServiceProvider::class,
        \Themosis\BeeRH\PostTypes\Questionnaire::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin views directories path.
    |--------------------------------------------------------------------------
    |
    | You can define a list of directories paths for the views of your plugin.
    | Paths are relatives to the plugin base directory.
    |
    */
    'views'       => [
        'views',
    ],
];
