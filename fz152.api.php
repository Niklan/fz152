<?php

/**
 * @file
 * File with API from this module with examples.
 */

/**
 * Implements hook_fz152_info().
 *
 * With this hook, every module can define form_id's with checkbox weights which
 * will be passed to core code and will add checkbox to the form if it match.
 *
 * @return array with form_id's and weights. If you don't know what weight to
 *               use, or don't need it, just pass NULL. form_id is support for
 *               wildcards.
 */
function hook_fz152_info() {
  $forms = array(
    array(
      'form_id' => 'my_awesome_form',
      'weight' => 99,
    ),
    array(
      'form_id' => 'my_*_form',
      'weight' => NULL,
    ),
  );

  return $forms;
}

/**
 * Implements hook_fz152_info_alter().
 *
 * With this hook you can modify form_id's and their checkboxes weight, or
 * completely remove some of them from execution order.
 */
function hook_fz152_info_alter(&$forms) {
  foreach ($forms as $k => &$v) {
    if ($v['form_id'] == 'my_*_form') {
      $v['weight'] = 10;
    }
  }
}
