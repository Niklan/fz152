<?php

/**
 * @file
 * Contains \Drupal\fz152\Form\fz152PageSettingsForm.
 */

namespace Drupal\fz152\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class fz152PageSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'fz152_page_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'fz152.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('fz152.settings');
     $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable privacy policy page'),
      '#default_value' => $config->get('privacy_policy_page.enable')
    ];
    $form['path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Privacy policy page path'),
      '#default_value' => $config->get('privacy_policy_page.path')
    ];
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Privacy policy page title'),
      '#default_value' => $config->get('privacy_policy_page.title')
    ];
    $text = $config->get('privacy_policy_page.text');
    $default_text = $text['value'];
    $default_format = isset($text['format']) ? $text['format'] : filter_default_format();

    $form['text'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Privacy policy text'),
      '#default_value' => $default_text,
      '#format' => $default_format,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration and set new values
    $this->config('fz152.settings')
        ->set('privacy_policy_page.enable', $form_state->getValue('enabled'))
        ->set('privacy_policy_page.path', $form_state->getValue('path'))
        ->set('privacy_policy_page.title', $form_state->getValue('title'))
        ->set('privacy_policy_page.text', $form_state->getValue('text'))
        ->save();

    // Rebuilding the menu router cache
    \Drupal::service('router.builder')->rebuild();
    drupal_set_message($this->t('Menu router cache data rebuilded.'));

    parent::submitForm($form, $form_state);
  }

}
