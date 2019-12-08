<?php


add_shortcode( 'os_section_wrapper', 'os_section_wrapper_func' );
function os_section_wrapper_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'angled_bottom' => 'none',
     'angled_top' => 'none',
     'color_type' => 'light',
     'css' => '',
     'compact' => false), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $color_type = ' color-scheme-light';
  if($atts['color_type'] == 'dark'){
    $color_type = ' color-scheme-dark';
  }

  $layout_style = '';
  $layout_style.= ' angle--bottom-'.$atts['angled_bottom'];
  $layout_style.= ' angle--top-'.$atts['angled_top'];

  $html = '<div class="os-section-wrapper ' .$layout_style.' '.$color_type.' '.vc_shortcode_custom_css_class($atts['css']).'">'.$content.'</div>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_os_section_wrapper' );
function vs_elem_os_section_wrapper() {
   vc_map( array(
      "name" => __( "Section Wrapper", "psych-helper" ),
      "base" => "os_section_wrapper",
      "icon" => "os-admin-icon-diploma-2",
      'is_container' => true,
      "class" => "",
      "js_view" => 'VcColumnView',
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "checkbox",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Remove Vertical Padding", "psych-helper" ),
            "param_name" => "remove_padding", 
            "value" => false,
            "description" => '',
            "group" => __( "Layout", "psych-helper" ),
          ),
          array(
            "type" => "css_editor",
            "heading" => __( "Css", "psych-helper" ),
            "param_name" => "css",
            "group" => __( "Design options", "psych-helper" ),
          ),array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Color Type", "psych-helper" ),
            "param_name" => "color_type",
            "value" => array( __('Light', 'psych-helper') => 'light',  __('Dark', 'psych-helper') => 'dark'),
            "description" => __( "Color Scheme Type for the element", "psych-helper" ),
            "group" => __( "Design options", "psych-helper" ),
         ))
      )
   );
}
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Os_Section_Wrapper extends WPBakeryShortCodesContainer {
    }
}