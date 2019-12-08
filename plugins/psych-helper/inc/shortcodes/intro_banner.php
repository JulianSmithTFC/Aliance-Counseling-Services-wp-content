<?php
add_shortcode( 'os_intro_banner', 'os_intro_banner_func' );
function os_intro_banner_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'header_text' => '',
     'image_url' => '',
     'enable_arrows' => false
  ), $atts );


  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $extra_class = $atts['enable_arrows'] ? '' : 'without-arrows';

  $html =   '<div class="os-container">
              <div class="os-intro-banner '.$extra_class.'" style="background-image: url('.osetin_get_image_url_by_id($atts['image_url'], 'full', '').');">
                <div class="banner-content">
                  <h1 class="banner-header">'.$atts['header_text'].'</h1>
                  <div class="banner-text">'.$content.'</div>
                </div>
                <div class="scroll-arrow">
                  <i class="os-icon os-icon-arrow-1-down arrow-first"></i>
                  <i class="os-icon os-icon-arrow-1-down arrow-second"></i>
                  <i class="os-icon os-icon-arrow-1-down arrow-third"></i>
                  <i class="os-icon os-icon-mouse-2 arrow-mouse"></i>
                </div>
                <svg class="os-intro-scroll-bg" width="193px" height="47px" viewBox="0 0 193 47" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <path d="M96.4967964,0.16015625 C143.388672,0.16015625 161.011719,32.3546569 193,46.4859222 L-1.02318154e-12,46.4859222 C31.6328125,29.2287075 49.6049209,0.16015625 96.4967964,0.16015625 Z" id="Rectangle-5" fill="#FFFFFF"></path>
                </svg>
              </div>

            </div>';

  return $html;
}


add_action( 'vc_before_init', 'vc_elem_intro_banner' );
function vc_elem_intro_banner() {
   vc_map( array(
      "name" => __( "Intro Banner", "psych-helper" ),
      "base" => "os_intro_banner",
      "icon" => "os-admin-icon-diploma-2",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Banner Heading", "psych-helper" ),
            "param_name" => "header_text",
            "value" => "",
            "description" => __( "Enter heading text for the banner", "psych-helper" )
         ),
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __( "Background Image", "psych-helper" ),
            "param_name" => "image_url",
            "value" => '',
            "description" => __( "Choose background image", "psych-helper" )
         ),
         array(
            "type" => "checkbox",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Add Arrows Down and Scroll Icon", "psych-helper" ),
            "param_name" => "enable_arrows", 
            "value" => false,
            "description" => ''
         ),
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text Content", "psych-helper" ),
            "param_name" => "content", 
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
            "description" => __( "Enter your content.", "psych-helper" )
         )
      )
   ) );
}
