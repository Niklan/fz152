<?php

namespace Drupal\fz152;

use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Class Fz152PluginManager.
 */
class Fz152PluginManager extends DefaultPluginManager {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Fz152',
      $namespaces,
      $module_handler,
      'Drupal\fz15\Fz152PluginInterface',
      'Drupal\fz15\Annotation\Fz152'
    );
    // hook_fz152_info_alter() — ability to alter plugin values.
    $this->alterInfo('fz152_info');
    $this->setCacheBackend($cache_backend, 'fz152');
    $this->factory = new DefaultFactory($this->getDiscovery());
  }

}
