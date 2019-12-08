<?php
add_shortcode( 'os_logos_list', 'os_logos_list_func' );
function os_logos_list_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'title_text' => '',
     'logos' => ''
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $html =   '<div class="os-container">
              <div class="os-logos-list">
                <ul>
                  <li><h4 class="list-header">'.$atts['title_text'].'</h4></li>';

                  $logos_arr = explode(',', $atts['logos']);
                  foreach ($logos_arr as $logo_id) {
                    $html.= '<li><img alt="'.esc_attr($atts['title_text']).'" src="'.osetin_get_image_url_by_id($logo_id, 'small', '').'"/></li>';
                  }

  $html.=       '</ul>
              </div>
            </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_logos' );
function vc_elem_logos() {
   vc_map( array(
      "name" => __( "List of Logos", "psych-helper" ),
      "base" => "os_logos_list",
      "icon" => "os-admin-icon-photo-album",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Heading for List", "psych-helper" ),
            "param_name" => "title_text",
            "value" => "",
            "description" => __( "Enter heading text for the banner", "psych-helper" )
         ),
         array(
            "type" => "attach_images",
            "class" => "",
            "heading" => __( "Logos to show", "psych-helper" ),
            "param_name" => "logos",
            "value" => '',
            "description" => __( "Choose logos images", "psych-helper" )
         )
      )
   ) );
}