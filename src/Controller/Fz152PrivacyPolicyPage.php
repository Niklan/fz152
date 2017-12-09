<?php

namespace Drupal\fz152\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Privacy policy page controller.
 */
class Fz152PrivacyPolicyPage extends ControllerBase {

  /**
   * Builds a policy page.
   *
   * @return array
   *   Renderable array.
   */
  public function content() {
    $config = $this->config('fz152.privacy_policy_page');
    // Build page content.
    $text = $config->get('text');
    $format = isset($text['format']) ? $text['format'] : filter_default_format();
    $output['content'] = [
      '#type' => 'processed_text',
      '#text' => isset($text['value']) ? $text['value'] : '',
      '#format' => $format,
    ];

    return $output;
  }

  /**
   * Return configurable page title for router name.
   *
   * @return string
   *   The configured title.
   */
  public function title() {
    return $this->config('fz152.privacy_policy_page')->get('title');
  }

}
