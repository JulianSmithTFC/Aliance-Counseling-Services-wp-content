<?php
add_shortcode( 'os_box_with_attachment', 'os_box_with_attachment_func' );
function os_box_with_attachment_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'file_url' => '',
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $file_link_html = '<div class="box-file-link-w"><i class="os-icon os-icon-paperclip"></i><a href="'.esc_attr($atts['file_url']).'" target="_blank">'.__('Download', 'psych-helper').'</a></div>';
  $text_html = '<div class="box-file-description">'.$content.'</div>';

  $html =  '<div class="os-box-with-attachment">'.$file_link_html.$text_html.'</div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_box_with_attachment' );
function vc_elem_box_with_attachment() {
   vc_map( array(
      "name" => __( "Box with Attachment", "psych-helper" ),
      "base" => "os_box_with_attachment",
      "icon" => "os-admin-icon-window-content",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "URL of the file", "psych-helper" ),
            "param_name" => "file_url",
            "value" => "",
            "description" => __( "Enter full file url", "psych-helper" )
         ),
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text Content", "psych-helper" ),
            "param_name" => "content", 
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
            "description" => __( "Enter your content.", "psych-helper" ),
         ),



      ))
   );
}