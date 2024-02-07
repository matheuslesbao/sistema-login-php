<?php

namespace app\controllers;

use app\helpers\Auth;
use League\Plates\Engine;

abstract class Controller
{
    private static array $instances = [];

  private static function addInstances($instanceKey, $instanceClass)
  {
    if (!isset(self::$instances[$instanceKey])) {
      self::$instances[$instanceKey] = $instanceClass;
    }
  }
    protected function view(string $view, array $data = [])
    {
        $pathViews = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR. 'views' ;

        self::addInstances('auth', Auth::class);
        // Create new Plates instance
        $templates = new Engine($pathViews);
        $templates->addData(['instances' => self::$instances]);

        // Render a template
        echo $templates->render($view, $data);
        
    }
}
