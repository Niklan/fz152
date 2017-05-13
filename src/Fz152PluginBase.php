<?php

namespace Drupal\fz152;

use Drupal\Component\Plugin\PluginBase;

abstract class Fz152PluginBase extends PluginBase implements Fz152PluginInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public function getId() {
    return $this->pluginDefinition['id'];
  }

  /**
   * {@inheritdoc}
   */
  public function getSettingsPage() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getForms() {
    return [];
  }

}