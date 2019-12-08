<?php
add_shortcode( 'os_text_and_features', 'os_text_and_features_func' );
function os_text_and_features_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'layout_style' => '',
     'text_width' => '',
     'image_url' => '',
     'second_image_url' => '',
     'color_type' => 'light',
     'custom_text_highlight' => '',
     'custom_element_highlight' => '',
     'custom_headers_color' => '',
     'custom_text_color' => '',
     'css' => ''
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content



  $color_type = ' color-scheme-light';
  if($atts['color_type'] == 'dark'){
    $color_type = ' color-scheme-dark';
  }

  $css_style = '';
  $photos_html = '';

  $first_image_css_style = '';
  $second_image_css_style = '';

  if($atts['image_url']) $first_image_css_style .= 'background-image: url('.osetin_get_image_url_by_id($atts['image_url'], 'full', '').');';
  if($atts['second_image_url']) $second_image_css_style .= 'background-image: url('.osetin_get_image_url_by_id($atts['second_image_url'], 'full', '').');';



  if($atts['layout_style'] == 'as_photos'){
    $layout_style = 'layout-as-photos';
    $photos_html = '<div class="os-photo-one" style="'.$first_image_css_style.'"></div>';
    if($second_image_css_style) $photos_html.= '<div class="os-photo-two" style="'.$second_image_css_style.'"></div>';
  }else{
    $layout_style = 'layout-as-background';
    $css_style = $first_image_css_style;
  }

  $html = '<div class="os-container">
            <div class="os-text-and-features-w '.$color_type.' '.$layout_style. ' ' . vc_shortcode_custom_css_class($atts['css']) . '" style="'.$css_style.'">
              '.$photos_html.'
              <div class="container-fluid">
                <div class="os-text-and-features-i">'. $content.'</div>
              </div>
            </div>
          </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_text_and_features' );
function vc_elem_text_and_features() {
   vc_map( array(
      "name" => __( "Text and Features Block", "psych-helper" ),
      "base" => "os_text_and_features",
      "icon" => "os-admin-icon-window-content",
      "class" => "",
      "is_container" => true,
      'show_settings_on_create' => false,
      "as_parent" => array('only' => 'vc_column_text, os_iconed_features'),
      'js_view' => 'VcColumnView',
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
                    array(
                      "type" => "dropdown",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __( "Layout Style", "psych-helper" ),
                      "param_name" => "layout_style", 
                      "value" => array(  __('Image as background', 'psych-helper') => 'as_background',   __('Images as photos', 'psych-helper') => 'as_photos'),
                      "std" => __('Select Layout', 'psych-helper'),
                      "description" => __( "Select Layout Style.", "psych-helper" ),
                      "group" => __( "Layout", "psych-helper" ),
                    ),
                    array(
                      "type" => "attach_image",
                      "class" => "",
                      "heading" => __( "Image for the side", "psych-helper" ),
                      "param_name" => "image_url",
                      "value" => '',
                      "description" => __( "Choose image", "psych-helper" ),
                      "group" => __( "Content", "psych-helper" ),
                    ),
                    array(
                      "type" => "attach_image",
                      "class" => "",
                      "heading" => __( "Second Image for the side", "psych-helper" ),
                      "param_name" => "second_image_url",
                      "value" => '',
                      "description" => __( "Choose image", "psych-helper" ),
                      "group" => __( "Content", "psych-helper" ),
                    ),
                    array(
                      "type" => "dropdown",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __( "Text Occupies", "psych-helper" ),
                      "param_name" => "text_width", 
                      "value" => array(  __('Half', 'psych-helper') => 'half',   __('More than half', 'psych-helper') => 'more',   __('Less than half', 'psych-helper') => 'less'),
                      "std" => __('Select Width', 'psych-helper'),
                      "description" => __( "Select Text Width.", "psych-helper" ),
                      "group" => __( "Layout", "psych-helper" ),
                    ),
                    array(
                      "type" => "dropdown",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __( "Color Type", "psych-helper" ),
                      "param_name" => "color_type",
                      "value" => array( __('Light', 'psych-helper') => 'light',  __('Dark', 'psych-helper') => 'dark'),
                      "description" => __( "Color Scheme Type for the element", "psych-helper" ),
                      'group' => __( 'Custom Colors', 'psych-helper' ),
                    ),
                    array(
                      "type" => "css_editor",
                      "heading" => __( "Css", "psych-helper" ),
                      "param_name" => "css",
                      "group" => __( "Design options", "psych-helper" ),
                    ),
      ))
   );
}
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Os_Text_And_Features extends WPBakeryShortCodesContainer {
    }
}
