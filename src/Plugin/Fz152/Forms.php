<?php

namespace Drupal\fz152\Plugin\Fz152;

use Drupal\fz152\Annotation\Fz152;
use Drupal\fz152\Fz152PluginBase;

/**
 * @Fz152(
 *   id = "forms",
 * )
 */
class Forms extends Fz152PluginBase {

  /**
   * {@inheritdoc}
   */
  public function getSettingsPage() {
    return [
      'path' => 'forms',
      'title' => 'Forms',
      'form' => '\Drupal\fz152\Form\Fz152SettingsForms',
      'weight' => 0,
    ];
  }

  public function getForms() {
    $config = \Drupal::config('fz152.forms');
    $forms_settings = $config->get('forms');
    $forms = array();
    if (!empty($forms_settings)) {
      foreach (explode(PHP_EOL, $forms_settings) as $form_id) {
        $form_id_exploded = explode('|', $form_id);
        $forms[] = array(
          'form_id' => $form_id_exploded[0],
          'weight' => isset($form_id_exploded[1]) ? $form_id_exploded[1] : NULL,
        );
      }
    }
    return $forms;
  }
}
