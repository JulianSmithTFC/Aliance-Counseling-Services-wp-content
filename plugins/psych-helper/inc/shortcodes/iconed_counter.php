<?php

add_shortcode( 'os_iconed_counter', 'os_iconed_counter_func' );
function os_iconed_counter_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'icon_class' => '',
     'icon_color' => '',
     'icon_size' => '',
     'counter_text' => '',
     'counter_description' => '',
     'counter_color' => '',
     'color_type' => 'light',
     'css' => ''
  ), $atts );



  $icon_style = '';
  $heading_style = '';


  if($atts['counter_color']) $heading_style.= 'color: '.$atts['counter_color'].';';
  if($atts['icon_color']) $icon_style.= 'color: '.$atts['icon_color'].';';
  if($atts['icon_size']) $icon_style.= 'font-size: '.$atts['icon_size'].';';
  $icon_html = '<i class="'.$atts['icon_class'].'" style="'.$icon_style.'"></i>';

  $color_type = ' color-scheme-dark';
  if($atts['color_type'] == 'light'){
    $color_type = ' color-scheme-light';
  }

  $html =   '<div class="os-counter-with-icon '.$color_type.' '.vc_shortcode_custom_css_class($atts['css']).'">
                <div class="cwi-icon-w">'.$icon_html.'</div>
                <div class="cwi-content-w">
                  <h5 class="cwi-header" style="'.$heading_style.'">'.$atts['counter_text'].'</h5>
                  <div class="cwi-desc">'.$atts['counter_description'].'</div>
                </div>
            </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_iconed_counter' );
function vc_elem_iconed_counter() {
   vc_map( array(
      "name" => __( "Counter with Icon", "psych-helper" ),
      "base" => "os_iconed_counter",
      "icon" => "os-admin-icon-podium",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Counter Value", "psych-helper" ),
            "param_name" => "counter_text",
            "value" => "",
            "description" => __( "Enter heading text for the counter", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Counter Description", "psych-helper" ),
            "param_name" => "counter_description",
            "value" => "",
            "description" => __( "Enter description text for the counter", "psych-helper" )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Heading Text Color (optional)", "psych-helper" ),
            "param_name" => "counter_color",
            "value" => '',
            "description" => __( "Choose color for heading text", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Icon Class", "psych-helper" ),
            "param_name" => "icon_class",
            "value" => "",
            "description" => __( "Enter class of the icon font you want to use. See all available icons by <a href='http://zelus.pinsupreme.com/icon-list' target='_blank'>clicking here</a>", "psych-helper" )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Icon Color (optional)", "psych-helper" ),
            "param_name" => "icon_color",
            "value" => '',
            "description" => __( "Choose color for the icon", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Icon Size (optional)", "psych-helper" ),
            "param_name" => "icon_size",
            "value" => "",
            "description" => __( "Enter size for icon you want to use (e.g. 50px).", "psych-helper" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Color Type", "psych-helper" ),
            "param_name" => "color_type",
            "value" => array( __('Light', 'psych-helper') => 'light',  __('Dark', 'psych-helper') => 'dark'),
            "description" => __( "Color Scheme Type for the element", "psych-helper" )
         ))
      )
   );
}
