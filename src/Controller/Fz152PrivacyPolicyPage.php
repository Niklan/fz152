<?php

/**
 * @file
 * Contains \Drupal\fz152\Controller\fz152PolicyPageController.
 */

namespace Drupal\fz152\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Privacy policy page controller.
 */
class Fz152PrivacyPolicyPage extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function content() {
    $config = \Drupal::config('fz152.settings');
    $output = [];
    // Set page title
    $output['#title'] = $config->get('privacy_policy_page.title');

    // Set page content
    $text = $config->get('privacy_policy_page.text');
    $format = isset($text['format']) ? $text['format'] : filter_default_format();
    $output['#markup'] = check_markup($text['value'], $format);

    return $output;
  }

}
