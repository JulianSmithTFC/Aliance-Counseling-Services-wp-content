<?php
add_shortcode( 'os_box_with_image_and_features', 'os_box_with_image_and_features_func' );
function os_box_with_image_and_features_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'image_url' => '',
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $image_html = '<div class="box-image"><img src="'.osetin_get_image_url_by_id($atts['image_url'], 'full', '').'"/></div>';
  $text_html = '<div class="box-content">'.$content.'</div>';

  $html =  '<div class="os-box-with-image-and-features">'.$image_html.$text_html.'</div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_box_with_image_and_features' );
function vc_elem_box_with_image_and_features() {
   vc_map( array(
      "name" => __( "Box with image and features", "psych-helper" ),
      "base" => "os_box_with_image_and_features",
      "icon" => "os-admin-icon-window-content",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __( "Main Image", "psych-helper" ),
            "param_name" => "image_url",
            "value" => '',
            "description" => __( "Choose image", "psych-helper" ),
            "group" => __( "Content", "psych-helper" ),
         ),
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text Content", "psych-helper" ),
            "param_name" => "content", 
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
            "description" => __( "Enter your content.", "psych-helper" ),
            "group" => __( "Content", "psych-helper" ),
         ),



      ))
   );
}