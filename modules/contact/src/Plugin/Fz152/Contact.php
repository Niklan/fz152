<?php

namespace Drupal\fz152_contact\Plugin\Fz152;

use Drupal\fz152\Annotation\Fz152;
use Drupal\fz152\Fz152PluginBase;

/**
 * @Fz152(
 *   id = "contact",
 * )
 */
class Contact extends Fz152PluginBase {

  /**
   * {@inheritdoc}
   */
  public function getSettingsPage() {
    return [
      'path' => 'contact',
      'title' => 'Contact',
      'form' => '\Drupal\fz152_contact\Form\Fz152ContactSettings',
      'weight' => 5,
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function getContactBundles() {
    $bundle_info = \Drupal::service('entity_type.bundle.info');
    return $bundle_info->getBundleInfo('contact_message');
  }

  /**
   * {@inheritdoc}
   */
  public function getForms() {
    $forms = [];
    $contact_bundles = $this->getContactBundles();
    foreach ($contact_bundles as $bundle_name => $bundle_info) {
      $config = \Drupal::config("fz152_contact.settings.$bundle_name");
      if ($config->get('enabled')) {
        $forms[] = [
          'form_id' => 'contact_message_' . $bundle_name . '_form',
          'weight' => $config->get('weight') ?: NULL,
        ];
      }
    }
    return $forms;
  }

}
