<?php
add_shortcode( 'os_step', 'os_step_func' );
function os_step_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'step_number' => '',
     'image_url' => '',
     'text_side' => 'left',
     'color_type' => 'light',
     'custom_step_number_color' => '',
     'custom_step_bg' => '',
     'custom_headers_color' => '',
     'custom_text_color' => '',
     'css' => ''
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  if($atts['text_side'] == 'left') $direction = 'text-on-left';
  else $direction = '';


  $color_type = ' color-scheme-light';
  if($atts['color_type'] == 'dark'){
    $color_type = ' color-scheme-dark';
  }

  $html = '<div class="os-container">
            <div class="os-step-w '.$color_type.' '.$direction. ' ' . vc_shortcode_custom_css_class($atts['css']) . '">
              <div class="container-fluid">
                <div class="os-step-i">
                  <div class="os-step-text"><h5 class="os-step-number">'.esc_html__('Step ', 'zelus-by-osetin').$atts['step_number'].':</h5><div class="os-step-text-i">'. $content.'</div></div>
                  <div class="os-step-image-w" style="background-image:url('.osetin_get_image_url_by_id($atts['image_url'], 'large', '').')">
                  </div>
                </div>
              </div>
            </div>
          </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_os_step' );
function vc_elem_os_step() {
   vc_map( array(
      "name" => __( "Step", "psych-helper" ),
      "base" => "os_step",
      "icon" => "os-admin-icon-window-content",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
                   array(
                      "type" => "textarea_html",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __( "Step Text Content", "psych-helper" ),
                      "param_name" => "content",
                      "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
                      "description" => __( "Feature Description.", "psych-helper" ),
                      "group" => __( "Content", "psych-helper" ),
                   ),
                    array(
                      "type" => "textfield",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __( "Step Number", "psych-helper" ),
                      "param_name" => "step_number",
                      "value" => "",
                      "description" => __( "Leave blank to hide step number", "psych-helper" ),
                      "group" => __( "Content", "psych-helper" ),
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
                      "type" => "dropdown",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __( "Text Side", "psych-helper" ),
                      "param_name" => "text_side", 
                      "value" => array( __('On the left', 'psych-helper') => 'left', __('On the right', 'psych-helper') => 'right' ),
                      "std" => __('Select Side', 'psych-helper'),
                      "description" => __( "Select text side.", "psych-helper" ),
                      "group" => __( "Content", "psych-helper" ),
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
