<?php


add_shortcode( 'os_small_newsletter_form_cta', 'os_small_newsletter_form_cta_func' );
function os_small_newsletter_form_cta_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'bg_image_url' => '',
     'bg_color' => '',
     'header_text' => '',
     'sub_header_text' => '',
     'form_code' => '',
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  if($atts['sub_header_text'] != '') {
    $sub_header = '<div class="sub-header-text">'.$atts['sub_header_text'].'</div>';
  }else{
    $sub_header = '';
  }

  $html =   '<div class="os-container">
              <div class="os-cta-small-newsletter" style="background-color: '.$atts['bg_color'].';background-image: url('.osetin_get_image_url_by_id($atts['bg_image_url'], 'osetin-full-width', '').');">
                <div class="cta-content">
                  <div class="cta-text">
                    <h4>'.$atts['header_text'].'</h4>
                    '.$sub_header.'
                  </div>
                  <div class="cta-form"><i class="os-icon os-icon-envelope"></i>'.$content.'</div>
                </div>
              </div>
            </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_small_newsletter_form' );
function vc_elem_small_newsletter_form() {
   vc_map( array(
      "name" => __( "Newsletter Call to Action", "psych-helper" ),
      "base" => "os_small_newsletter_form_cta",
      "icon" => "os-admin-icon os-admin-icon-email-2-at",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Form shortcode or html", "psych-helper" ),
            "param_name" => "content", 
            "value" => "",
            "description" => __( "Type in form shortcode or html.", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Header", "psych-helper" ),
            "param_name" => "header_text",
            "value" => "",
            "description" => __( "Enter block header text", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Sub Header", "psych-helper" ),
            "param_name" => "sub_header_text",
            "value" => "",
            "description" => __( "Enter sub header text", "psych-helper" )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Background Color (optional)", "psych-helper" ),
            "param_name" => "bg_color",
            "value" => '',
            "description" => __( "Choose color for the background", "psych-helper" )
         ),
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __( "Background Image (optional)", "psych-helper" ),
            "param_name" => "bg_image_url",
            "value" => '',
            "description" => __( "Choose image for cta the background", "psych-helper" )
         ))
      )
   );
}