<?php

add_shortcode( 'os_form_cta', 'os_form_cta_func' );
function os_form_cta_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'bg_image_url' => '',
     'form_header' => false,
     'form_sub_header' => false,
     'form_description' => false
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $form_header_html = '';

  if($atts['form_header']){
    $form_header_html.= '<h3>'.$atts['form_header'].'</h3>';
  }
  if($atts['form_header']){
    $form_header_html.= '<h5>'.$atts['form_sub_header'].'</h5>';
  }
  if($atts['form_description']){
    $form_header_html.= '<div class="cta-form-description">'.$atts['form_description'].'</div>';
  }
  if($form_header_html != ''){
    $form_header_html = '<div class="cta-form-header-w">'.$form_header_html.'</div>';
  }

  $html =   '<div class="os-container">
              <div class="os-cta-form-w" style="background-image: url('.osetin_get_image_url_by_id($atts['bg_image_url'], 'osetin-full-width', '').');">
                <div class="cta-form">
                  '.$form_header_html.'
                  <div class="cta-form-content">'.$content.'</div>
                </div>
              </div>
            </div>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_form_cta' );
function vs_elem_form_cta() {
   vc_map( array(
      "name" => __( "Form Call To Action", "psych-helper" ),
      "base" => "os_form_cta",
      "icon" => "os-admin-icon-copy-styles",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Form shortcode", "psych-helper" ),
            "param_name" => "content", 
            "value" => "",
            "description" => __( "Type in form shortcode and other content you want.", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Form Header", "psych-helper" ),
            "param_name" => "form_header",
            "value" => "",
            "description" => __( "Form header text", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Form Sub Header", "psych-helper" ),
            "param_name" => "form_sub_header",
            "value" => "",
            "description" => __( "Form sub header text", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Form Description", "psych-helper" ),
            "param_name" => "form_description",
            "value" => "",
            "description" => __( "Enter description text that goes below header", "psych-helper" )
         ),
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __( "Background Image", "psych-helper" ),
            "param_name" => "bg_image_url",
            "value" => '',
            "description" => __( "Choose image for the background", "psych-helper" )
         ))
      )
   );
}