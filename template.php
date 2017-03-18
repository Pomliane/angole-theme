<?php
/**
 * @file
 * The primary PHP file for this theme.
 * The two hooks implemented here are used to display the front-menu entries as cards.
 */

function bootstrap_menu_tree__menu_front_menu(&$variables) {
  return '<div class="row">' . $variables['tree'] . '</div>';
}

function angole_menu_link__menu_front_menu($variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = '<h3>' . l($element['#title'], $element['#href'], $element['#localized_options']) . '</h3>';
  $output .= '<div class="cardbody">' . $element['#original_link']['localized_options']['attributes']['title'] . '</div>';
  return '<div class="col col-sm-4"><div class="final-card">' . $output . $sub_menu . "</div></div>\n";
}

/*
function angole_preprocess_views_view_fields(&$vars) {
  if ($vars['view']->name == 'dev_formations_et_ateliers') {
   // kpr($vars);
    $view = $vars['view'];
    kpr($view->style_plugin->rendered_fields[$view->row_index]['field_dates']);
    $view->style_plugin->rendered_fields[$view->row_index]['field_dates'] = "bob";
    kpr($view->style_plugin->rendered_fields[$view->row_index]['field_dates']);
    if (count($vars)) {
      $vars['output'] = "debug";
    }
  }
}

function angole_preprocess_views_view_fields(&$vars) {
  if ($vars['view']->name == 'dev_formations_et_ateliers') {
    $view = $vars['view'];
    foreach ($vars['fields'] as $id => $field) {
      if (count($vars['view']->result[$view->row_index]->field_field_dates) > 0) {
        //kpr($view->style_plugin->rendered_fields[$view->row_index]['field_dates']);
        //$view->style_plugin->rendered_fields[$view->row_index]['field_dates'] = "bob";
        $vars['fields']['field_dates']->content = "bob";
        //kpr($view->style_plugin->rendered_fields[$view->row_index]['field_dates']);
        kpr($vars);
      }
    }
  }
}
*/

function angole_preprocess_views_view(&$vars) {
  if ($vars['view']->name == "dev_formations_et_ateliers") {
    $vars['titles'] = array();
    foreach ($view->result[$view->row_index] as $key => $item) {
      $vars['titles'][] = $item->title;
    }
    kpr($vars);
  }
}


function angole_preprocess_views_view_field(&$vars) {
  if ($vars['view']->name == 'dev_formations_et_ateliers' && $vars['field']->field == 'field_dates') {
    $view = $vars['view'];
    if (count($view->result[$view->row_index]->field_field_dates) > 1) {
      $first = strip_tags($view->result[$view->row_index]->field_field_dates[0]['rendered']['#markup']);
      array_shift($view->result[$view->row_index]->field_field_dates);
      foreach ($view->result[$view->row_index]->field_field_dates as $key => $date) {
        $dates .= strip_tags($date['rendered']['#markup']) . "<br />";
      }
 //     $next = render($view->result[$view->row_index]->field_field_dates);
      $vars['output'] = $first;
      $vars['output'] .= "<a href='#' class='btn btn-default btn-sm pull-right' data-toggle='popover' title='Autres dates' data-content='";
      $vars['output'] .= $dates;
      $vars['output'] .= "'>Autres dates</a>";
      //kpr($vars);
    }
  }
}
