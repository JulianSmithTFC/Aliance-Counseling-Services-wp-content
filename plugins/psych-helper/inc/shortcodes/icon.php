<?php

add_shortcode( 'os_icon', 'os_icon_func' );
function os_icon_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'icon_class' => '',
     'icon_font_size' => '',
     'icon_color' => ''
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $css = '';
  if($atts['icon_font_size'] != '') {
    $css.= 'font-size: '.$atts['icon_font_size'].';';
  }
  if($atts['icon_color'] != '') {
    $css.= 'color: '.$atts['icon_color'].';';
  }

  $html = '<i class="os-icon '.$atts['icon_class'].'" style="'.$css.'"></i>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_os_icon' );
function vs_elem_os_icon() {
   vc_map( array(
      "name" => __( "Icon", "psych-helper" ),
      "base" => "os_icon",
      "icon" => "os-admin-icon-photo-add",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Icon Class", "psych-helper" ),
            "param_name" => "icon_class",
            "value" => "",
            "description" => __( "Input class for the icon you want to use, see all classes at http://zelus.pinsupreme.com/icon-list", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Icon Font Size", "psych-helper" ),
            "param_name" => "icon_font_size",
            "value" => "",
            "description" => __( "Enter font size for the icon (e.g. 40px)", "psych-helper" )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Icon Color (Optional)", "psych-helper" ),
            "param_name" => "icon_color",
            "value" => '',
            "description" => __( "Choose color for the icon", "psych-helper" )
         ))
      )
   );
}