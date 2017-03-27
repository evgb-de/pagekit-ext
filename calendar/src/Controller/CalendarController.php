<?php

namespace Pagekit\Calendar\Controller;

use Pagekit\Application as App;

class CalendarController
{
  /**
  * @Access(admin=true)
  */
  public function indexAction()
  {
      $module = App::module('calendar');
      $config = $module->config;
      return [
          '$view' => [
              'title' => 'Calendar management',
              'name' => 'calendar:views/admin/index.php'
          ],
          '$data' => $config,
          'title' => 'Configure your Calendar',
          'entries' => $config['entries']
      ];
  }
}
 ?>
