<?php

add_shortcode( 'os_history_entry', 'os_history_entry_func' );
function os_history_entry_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'event_date' => ''), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $html = '
  <div class="os-container">
    <div class="os-history-entry">';

      $html.= '<div class="history-entry-date"><div class="history-entry-date-i">'.$atts['event_date'].'</div></div>';

      $html.= '<div class="history-event-description"><div class="history-event-description-i">'.$content.'</div></div>';

      $html.='
    </div>
  </div>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_history_entry' );
function vs_elem_history_entry() {
   vc_map( array(
      "name" => __( "History Entry", "psych-helper" ),
      "base" => "os_history_entry",
      "icon" => "os-admin-icon-edit-3",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Event Date or Year", "psych-helper" ),
            "param_name" => "event_date",
            "value" => "",
            "description" => __( "Enter event date (e.g. 2015)", "psych-helper" )
         ),
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Event Content", "psych-helper" ),
            "param_name" => "content", 
            "value" => "",
            "description" => __( "Type in what happened at that date.", "psych-helper" )
         ))
      )
   );
}