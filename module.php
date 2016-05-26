<?php

function r_ui_init() {
  global $theme;
  $module_path = drupal_get_path('module', 'r_ui');
  if ( $theme == 'adminimal' ) {
    drupal_add_css($module_path . '/css/adminimal.css', array('group' => CSS_THEME, 'media' => 'all', 'weight' => 960));
    //dpm($theme);
  }
  $paths = array(
    'node/add/*',
    'node/*/edit*',
    'admin/structure/taxonomy/*/add*',
    'taxonomy/term/*/edit*',
  );
  if ( _r_ui_evaluate_path($paths) ) {
    drupal_add_css($module_path . '/css/admin.css', array('group' => CSS_THEME, 'media' => 'all', 'weight' => 970));
  }
}

function _r_ui_evaluate_path($path_check = array()) {
  // Match path if necessary.
  if (!empty($path_check)) {
    $path_check = implode($path_check,"\n");
    $path = drupal_get_path_alias($_GET['q']);
    // Compare with the internal and path alias (if any).
    $page_match = drupal_match_path($path, $path_check);
    if ($path != $_GET['q']) {
      $page_match = $page_match || drupal_match_path($_GET['q'], $path_check);
    }
  } else {
    $page_match = FALSE;
  }
  return $page_match;
}

function xx_media_alter_media_wysiwyg_token_to_markup_alter(&$element, $tag_info, $settings) {
  //dpm($element);
  //dpm($tag_info);
  //dpm($settings);
  $element['content']['#attributes']['class'] = array("file-image");
  if (isset($settings['fields']['field_file_image_position']['und'][0]['value']) && $settings['fields']['field_file_image_position']['und'][0]['value'] != 'none' ) {
    $element['content']['#attributes']['class'][] = 'image-' . $settings['fields']['field_file_image_position']['und'][0]['value'];
  }
}
