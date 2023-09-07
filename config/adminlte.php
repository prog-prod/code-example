<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Printopia',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Printopia</b> Admin',
    'logo_img' => 'images/logo_short.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Printopia',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'images/logo_short.png',
            'alt' => 'Admin Printopia',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'admin/dashboard',
    'logout_url' => 'admin/logout',
    'login_url' => 'admin/login',
    'register_url' => false,
    'password_reset_url' => false,
    'password_email_url' => false,
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        [
            'type' => 'darkmode-widget',
            "topnav" => true,
            //'topnav_right' => true, // Or "topnav => true" to place on the left.
        ],
        [
            'type' => 'navbar-notification',
            'id' => 'my-notification',      // An ID attribute (required).
            'icon' => 'fas fa-bell',          // A font awesome icon (required).
            'icon_color' => 'warning',              // The initial icon color (optional).
            'label' => 0,                      // The initial label for the badge (optional).
            'label_color' => 'danger',               // The initial badge color (optional).
            'url' => 'notifications/show',   // The url to access all notifications/elements (required).
            'topnav_right' => true,                   // Or "topnav => true" to place on the left (required).
            'dropdown_mode' => true,                // Enables the dropdown mode (optional).
            'dropdown_flabel' => 'All notifications', // The label for the dropdown footer link (optional).
//            'update_cfg' => [
//                'url' => 'notifications/get',         // The url to periodically fetch new data (optional).
//                'period' => 30,                       // The update period for get new data (in seconds, optional).
//            ],
        ],
        // Sidebar items:
        [
            'text' => 'dashboard',
            'url' => 'admin/dashboard',
            'icon' => 'fas fa-fw fa-solid fa-chart-line',
            'label_color' => 'success',
            'can' => '',
        ],
        [
            'text' => 'products',
            'icon' => 'fas fa-fw fa-brands fa-product-hunt',
            'icon_color' => 'info',
            'submenu' => [
                [
                    'text' => 'categories',
                    'url' => 'admin/categories',
                    'icon' => 'fas fa-fw fa-solid fa-sitemap',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'prints',
                    'icon' => 'fas fa-fw fa-solid fa-paw',
                    'submenu' => [
                        [
                            'text' => 'prints',
                            'url' => 'admin/prints',
                            'icon' => 'fas fa-fw fa-paw',
                            'label_color' => 'success',
                        ],
                        [
                            'text' => 'print_categories',
                            'icon' => 'fas fa-fw fa-project-diagram',
                            'url' => 'admin/print-categories',
                            'label_color' => 'success',
                        ],
                    ],
                ],
                [
                    'text' => 'products',
                    'url' => 'admin/products',
                    'icon' => 'fas fa-fw  fa-brands fa-product-hunt',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'reviews',
                    'url' => 'admin/reviews',
                    'icon' => 'fas fa-fw fa-comments',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'colors',
                    'url' => 'admin/colors',
                    'icon' => 'fas fa-fw fa-solid fa-droplet',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'sales',
                    'icon' => 'fas fa-fw fa-percent',
                    'url' => 'admin/sales',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'sizes',
                    'icon' => 'fas fa-fw fa-solid fa-shirt',
                    'url' => 'admin/sizes',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'brands',
                    'url' => 'admin/brands',
                    'icon' => 'fas fa-fw fa-brands fa-apple',
                    'label_color' => 'success',
                ],
            ]
        ],
        [
            'text' => 'orders',
            'icon' => 'fas fa-fw fa-solid fa-receipt',
            'label_color' => 'success',
            'icon_color' => 'yellow',
            'submenu' => [
                [
                    'text' => 'orders',
                    'url' => 'admin/orders',
                    'icon' => 'fas fa-fw fa-solid fa-receipt',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'customers',
                    'url' => 'admin/customers',
                    'icon' => 'fas fa-fw fa-solid fa-users',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'paymentMethods',
                    'url' => 'admin/payment-methods',
                    'icon' => 'fas fa-fw fa-brands fa-google-pay',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'payments',
                    'url' => 'admin/payments',
                    'icon' => 'fas fa-fw fa-solid fa-file-invoice-dollar',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'deliveries',
                    'url' => 'admin/deliveries',
                    'icon' => 'fas fa-fw fa-truck',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'sms_templates',
                    'url' => 'admin/sms-templates',
                    'icon' => 'fas fa-fw fa-solid fa-comment-sms',
                    'label_color' => 'success',
                ],
            ]
        ],
        [
            'text' => 'layouts',
            'icon' => 'fas fa-fw fa-th',
            'label_color' => 'success',
            'icon_color' => 'info',
            'submenu' => [
                [
                    'text' => 'layouts',
                    'url' => 'admin/layouts',
                    'icon' => 'fas fa-fw fa-th',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'pages',
                    'url' => 'admin/pages',
                    'icon' => 'fas fa-fw fa-file-lines',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'menus',
                    'url' => 'admin/menus',
                    'icon' => 'fas fa-fw fa-stream',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'sliders',
                    'url' => 'admin/sliders',
                    'icon' => 'fas fa-fw fa-images',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'filters',
                    'url' => 'admin/filters',
                    'icon' => 'fas fa-fw fa-filter',
                    'label_color' => 'success',
                ],
            ]
        ],
        [
            'text' => 'users',
            'icon' => 'fas fa-fw fa-solid fa-user-group',
            'label_color' => 'success',
            'icon_color' => 'info',

            'submenu' => [
                [
                    'text' => 'users',
                    'url' => 'admin/users',
                    'icon' => 'fas fa-fw fa-solid fa-user-group',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'admins',
                    'url' => 'admin/admin-users',
                    'icon' => 'fas fa-fw fa-solid fa-user-gear',
                    'label_color' => 'success',
                ],
            ]
        ],
        [
            'text' => 'trash',
            'icon' => 'fas fa-fw fa-trash',
            'url' => 'admin/trash',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'users',
                    'url' => 'admin/trash/users',
                    'icon' => 'fas fa-fw fa-users',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'brands',
                    'url' => 'admin/trash/brands',
                    'icon' => 'fas fa-fw fa-flag',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'orders',
                    'icon' => 'fas fa-fw fa-bars',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'orders',
                            'url' => 'admin/trash/orders',
                            'icon' => 'fas fa-fw fa-hand-holding-usd',
                            'label_color' => 'success',
                        ],
                        [
                            'text' => 'customers',
                            'url' => 'admin/trash/customers',
                            'icon' => 'fas fa-fw fa-user-friends',
                            'label_color' => 'success',
                        ],
                    ]
                ],
                [
                    'text' => 'products',
                    'icon' => 'fas fa-fw fa-bars',
                    'submenu' => [
                        [
                            'text' => 'categories',
                            'url' => 'admin/trash/categories',
                            'icon' => 'fas fa-fw fa-project-diagram',
                            'label_color' => 'success',
                        ],
                        [
                            'text' => 'products',
                            'url' => 'admin/trash/products',
                            'icon' => 'fas fa-fw fa-cart-plus',
                            'label_color' => 'success',
                        ],
                        [
                            'text' => 'reviews',
                            'url' => 'admin/trash/reviews',
                            'icon' => 'fas fa-fw fa-comments',
                            'label_color' => 'success',
                        ],
                    ]
                ],
                [
                    'text' => 'colors',
                    'url' => 'admin/trash/colors',
                    'icon' => 'fas fa-fw fa-palette',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'prints',
                    'icon' => 'fas fa-fw fa-bars',
                    'submenu' => [
                        [
                            'text' => 'prints',
                            'url' => 'admin/trash/prints',
                            'icon' => 'fas fa-fw fa-paws',
                            'label_color' => 'success',
                        ],
                        [
                            'text' => 'print_categories',
                            'icon' => 'fas fa-fw fa-project-diagram',
                            'url' => 'admin/trash/print-categories',
                            'label_color' => 'success',
                        ],
                    ],
                ],
                [
                    'text' => 'sales',
                    'icon' => 'fas fa-fw fa-percent',
                    'url' => 'admin/trash/sales',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'sizes',
                    'icon' => 'fas fa-fw fa-tags',
                    'url' => 'admin/trash/sizes',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'layouts',
                    'icon' => 'fas fa-fw fa-bars',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'layouts',
                            'url' => 'admin/trash/layouts',
                            'icon' => 'fas fa-fw fa-th',
                            'label_color' => 'success',
                        ],
                        [
                            'text' => 'pages',
                            'url' => 'admin/trash/pages',
                            'icon' => 'fas fa-fw fa-file',
                            'label_color' => 'success',
                        ],
                    ]
                ],
            ]
        ],
        [
            'text' => 'settings',
            'icon' => 'fas fa-fw fa-sharp fa-solid fa-sliders',
            'icon_color' => 'info',
            'submenu' => [
                [
                    'text' => 'notifications',
                    'url' => 'admin/settings/notifications',
                    'icon' => 'fas fa-fw fa-solid fa-envelope-open-text',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'banks',
                    'url' => 'admin/settings/banks',
                    'icon' => 'fas fa-fw fa-solid fa-building-columns',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'novaPoshta',
                    'url' => 'admin/settings/nova-poshta',
                    'icon' => 'fas fa-fw fa-solid fa-up-down-left-right',
                    'label_color' => 'success',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.css',
                ],
            ],
        ],
        'BsCustomFileInput' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bs-custom-file-input/bs-custom-file-input.min.js',
                ],
            ],
        ],
        'BootstrapColorpicker' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
                ],
            ],
        ],
        'BootstrapSwitch' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-switch/js/bootstrap-switch.min.js',
                ],
            ],
        ],
        'TempusDominusBs4' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/moment/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'Summernote' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/summernote/summernote-bs4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/summernote/summernote-bs4.min.css',
                ],
            ],
        ],
        'KrajeeFileinput' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/krajee-fileinput/css/fileinput.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/krajee-fileinput/themes/explorer-fa5/theme.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/krajee-fileinput/js/fileinput.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/krajee-fileinput/themes/fa5/theme.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/krajee-fileinput/themes/explorer-fa5/theme.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/krajee-fileinput/js/locales/es.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
