<?php

/**
 * @file
 * Contains \Drupal\fz152\Controller\fz152RouteSubscriber.
 */

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
    $config = \Drupal::config('fz152.settings');
    $is_enabled = $config->get('privacy_policy_page.enable');
    $path = $config->get('privacy_policy_page.path');

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
