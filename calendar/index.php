<?php

use Pagekit\Application;

// packages/evgb-de/calendar/index.php

return [

    'name' => 'calendar',

    'type' => 'extension',

    // called when Pagekit initializes the module
    'main' => function (Application $app) {
    },
    // Enable the calendar: appreviation
    'resources' => [
      'calendar' => ''
    ],

    'config' => [
      'entries' => [
        ['name' => 'GCal', 'property' => true],
        ['name' => 'GCal', 'property' => false]
      ]
    ],

    'autoload' => [
      'Pagekit\\Calendar\\' => 'src'
    ],

    'routes' => [
      '@calendar' => [
        'path' => '/calendar',
        'controller' => 'Pagekit\\Calendar\\Controller\\CalendarController'
      ]
    ],

    'menu' => [
      'calendar' => [
        'label'  => 'Calendar',
        'icon'   => 'app/system/assets/images/placeholder-icon.svg',
        'url'    => '@calendar',
      ]
    ],
  ];

?>
