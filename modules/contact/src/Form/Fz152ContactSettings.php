<?php

namespace Drupal\fz152_contact\Form;

use Drupal\Core\Entity\EntityTypeBundleInfo;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class Fz152ContactSettings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'fz152_contact_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    $contact_bundles = $this->getContactBundles();
    $config_names = [];
    foreach ($contact_bundles as $bundle_name => $bundle_info) {
      $config_names[] = "fz152_contact.settings.$bundle_name";
    }
    return $config_names;
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
  public function buildForm(array $form, FormStateInterface $form_state) {
    $contact_bundles = $this->getContactBundles();

    foreach ($contact_bundles as $bundle_name => $bundle_info) {
      $config = $this->config("fz152_contact.settings.$bundle_name");
      $form['contact_' . $bundle_name . '_enable'] = [
        '#type' => 'checkbox',
        '#title' => $bundle_info['label'] . " ($bundle_name)",
        '#default_value' => $config->get('enabled'),
      ];

      $form['contact_' . $bundle_name . '_weight'] = [
        '#type' => 'number',
        '#title' => 'Weight of element',
        '#default_value' => $config->get('weight'),
        '#state' => [
          'visible' => [
            'input[name="contact_' . $bundle_name . '_enable"]' => [
              'checked' => TRUE,
            ],
          ],
        ],
      ];
    }
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $contact_bundles = $this->getContactBundles();

    foreach ($contact_bundles as $bundle_name => $bundle_info) {
      \Drupal::configFactory()->getEditable("fz152_contact.settings.$bundle_name")
        ->set('enabled', $form_state->getValue('contact_' . $bundle_name . '_enable'))
        ->set('weight', $form_state->getValue('contact_' . $bundle_name . '_weight'))
        ->save();
    }
    parent::submitForm($form, $form_state);
  }

}
