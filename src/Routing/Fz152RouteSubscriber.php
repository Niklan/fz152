<?php

namespace Drupal\fz152\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic trousers route events.
 */
class Fz152RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    $config = \Drupal::config('fz152.privacy_policy_page');
    $is_enabled = $config->get('enable');
    $path = $config->get('path');

    if ($is_enabled) {
      if ($route = $collection->get('fz152.privacy_policy_page')) {
        $route->setPath($path);
      }
    }
    else {
      $collection->remove('fz152.privacy_policy_page');
    }
  }

}
