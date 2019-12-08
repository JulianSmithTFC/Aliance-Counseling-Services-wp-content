<?php
add_shortcode( 'os_iconed_features', 'os_iconed_features_func' );
function os_iconed_features_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'css' => '',
     'image_url' => '',
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
  $html = '<div class="os-iconed-features-w">'.$content.'</div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_iconed_features' );
function vc_elem_iconed_features() {
   vc_map( array(
      "name" => __( "Wrapper of Iconed Features", "psych-helper" ),
      "base" => "os_iconed_features",
      "icon" => "os-admin-icon-layers-linked-1",
      "class" => "",
      "is_container" => true,
      "js_view" => 'VcColumnView',
      'show_settings_on_create' => false,
      "as_parent" => array('only' => 'os_iconed_feature'),
      "category" => __( "Psychology", "psych-helper"),
      "params" => array()
      )
   );
}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Os_Iconed_Features extends WPBakeryShortCodesContainer {
    }
}